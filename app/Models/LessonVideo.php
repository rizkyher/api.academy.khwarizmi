<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonVideo extends Model
{
 protected $fillable = [
  'lesson_id',
  'title',
  'youtube_url',
  'duration',
  'order'
 ];

 public function lesson()
 {
  return $this->belongsTo(Lesson::class);
 }

 public function progress()
{
 return $this->hasMany(VideoProgress::class,'lesson_video_id');
}

}
