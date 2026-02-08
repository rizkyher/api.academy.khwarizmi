<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
 public function index()
 {
  return Lesson::with('videos','resources')->get();
 }

 public function store(Request $r)
 {
  return Lesson::create($r->all());
 }

 public function show(Lesson $lesson)
 {
  return $lesson->load('videos','resources');
 }

 public function update(Request $r, Lesson $lesson)
 {
  $lesson->update($r->all());

  return $lesson;
 }

 public function destroy(Lesson $lesson)
 {
  $lesson->delete();

  return ['msg'=>'deleted'];
 }
}
