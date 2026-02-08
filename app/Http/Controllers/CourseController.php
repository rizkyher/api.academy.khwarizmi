<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
 public function index()
 {
  return Course::with('lessons')->paginate(10);
 }

 public function store(Request $r)
 {
  return Course::create(
   $r->validate([
    'category_id'=>'required',
    'title'=>'required',
    'description'=>'required'
   ])
  );
 }

 public function show(Course $course)
 {
  return $course->load('lessons.videos');
 }

 public function update(Request $r, Course $course)
 {
  $course->update($r->all());

  return $course;
 }

 public function destroy(Course $course)
 {
  $course->delete();

  return ['msg'=>'deleted'];
 }
}
