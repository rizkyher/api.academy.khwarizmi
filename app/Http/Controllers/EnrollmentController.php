<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
 public function enroll(Request $r)
 {
  return Enrollment::firstOrCreate([
   'user_id'=>$r->user()->id,
   'course_id'=>$r->course_id
  ]);
 }

 public function myCourses(Request $r)
 {
  return $r->user()->courses;
 }
}
