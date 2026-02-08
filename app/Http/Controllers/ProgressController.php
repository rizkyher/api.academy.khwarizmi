<?php

namespace App\Http\Controllers;

use App\Models\LessonProgress;
use App\Models\VideoProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
 public function lesson(Request $r)
 {
  return LessonProgress::updateOrCreate([
   'user_id'=>$r->user()->id,
   'lesson_id'=>$r->lesson_id
  ],[
   'completed'=>true
  ]);
 }

 public function video(Request $r)
 {
  return VideoProgress::updateOrCreate([
   'user_id'=>$r->user()->id,
   'lesson_video_id'=>$r->video_id
  ],[
   'watched_seconds'=>$r->seconds,
   'completed'=>$r->completed
  ]);
 }
}
