<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
 protected $fillable = [
  'lesson_id',
  'title',
  'description',
  'deadline'
 ];

 public function lesson()
 {
  return $this->belongsTo(Lesson::class);
 }

 public function submissions()
 {
  return $this->hasMany(Submission::class);
 }
}
