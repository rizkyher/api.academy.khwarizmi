<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
 public function register(Request $r)
 {
  $r->validate([
   'name'=>'required',
   'email'=>'required|email|unique:users',
   'password'=>'required|min:6'
  ]);

  $user = User::create([
   'name'=>$r->name,
   'email'=>$r->email,
   'password'=>bcrypt($r->password)
  ]);

  Profile::create([
   'user_id'=>$user->id
  ]);

  return response()->json([
   'token'=>$user->createToken('auth')->plainTextToken
  ]);
 }

 public function login(Request $r)
 {
  if(!Auth::attempt($r->only('email','password'))){
   return response()->json(['msg'=>'Invalid'],401);
  }

  return [
   'token'=>$r->user()->createToken('auth')->plainTextToken
  ];
 }

 public function logout(Request $r)
 {
  $r->user()->tokens()->delete();

  return ['msg'=>'logout'];
 }
}
