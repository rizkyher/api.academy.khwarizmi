<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
 public function show(Request $r)
 {
  return $r->user()->profile;
 }

 public function update(Request $r)
 {
  $profile = $r->user()->profile;

  $profile->update($r->all());

  return $profile;
 }
}
