<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
 public function index()
 {
  return Assignment::with('submissions')->get();
 }

 public function store(Request $r)
 {
  return Assignment::create($r->all());
 }

 public function show(Assignment $assignment)
 {
  return $assignment->load('submissions');
 }

 public function update(Request $r, Assignment $assignment)
 {
  $assignment->update($r->all());

  return $assignment;
 }

 public function destroy(Assignment $assignment)
 {
  $assignment->delete();

  return ['msg'=>'deleted'];
 }
}
