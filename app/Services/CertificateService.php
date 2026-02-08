<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CertificateService
{
    /**
     * Generate certificate if user completed all lessons
     */
    public function generate(int $userId, int $courseId): ?Certificate
    {
        return DB::transaction(function () use ($userId, $courseId) {

            /* ============================
             * 1. Cek apakah sudah ada
             * ============================
             */
            $existing = Certificate::where('user_id', $userId)
                ->where('course_id', $courseId)
                ->first();

            if ($existing) {
                return $existing;
            }

            /* ============================
             * 2. Hitung total lesson
             * ============================
             */
            $totalLessons = Lesson::where('course_id', $courseId)
                ->count();

            // Kalau course belum ada lesson
            if ($totalLessons === 0) {
                return null;
            }

            /* ============================
             * 3. Hitung progress user
             * ============================
             */
            $completedLessons = LessonProgress::where('user_id', $userId)
                ->where('completed', true)
                ->whereHas('lesson', function ($query) use ($courseId) {
                    $query->where('course_id', $courseId);
                })
                ->count();

            /* ============================
             * 4. Validasi kelulusan
             * ============================
             */
            if ($completedLessons < $totalLessons) {
                return null;
            }

            /* ============================
             * 5. Generate certificate
             * ============================
             */
            return Certificate::create([
                'user_id'          => $userId,
                'course_id'        => $courseId,
                'certificate_code'=> $this->generateUniqueCode(),
                'issued_at'        => now(),
            ]);

        });
    }

    /**
     * Generate unique certificate code
     */
    protected function generateUniqueCode(): string
    {
        do {
            $code = Str::upper(Str::random(12));
        } while (
            Certificate::where('certificate_code', $code)->exists()
        );

        return $code;
    }
}
