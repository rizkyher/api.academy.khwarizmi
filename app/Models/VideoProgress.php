<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoProgress extends Model
{
 protected $fillable = [
  'user_id',
  'lesson_video_id',
  'watched_seconds',
  'completed'
 ];

 public function user()
 {
  return $this->belongsTo(User::class);
 }

 public function video()
 {
  return $this->belongsTo(LessonVideo::class,'lesson_video_id');
 }
}
