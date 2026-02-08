<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
 public function index()
 {
  return Submission::with('user')->get();
 }

 public function store(Request $r)
 {
  return Submission::create([
   'assignment_id'=>$r->assignment_id,
   'user_id'=>$r->user()->id,
   'file_url'=>$r->file_url
  ]);
 }

 public function show(Submission $submission)
 {
  return $submission;
 }

 public function update(Request $r, Submission $submission)
 {
  $submission->update($r->all());

  return $submission;
 }

 public function destroy(Submission $submission)
 {
  $submission->delete();

  return ['msg'=>'deleted'];
 }
}
