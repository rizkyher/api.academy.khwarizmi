<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 public function index()
 {
  return Category::all();
 }

 public function store(Request $r)
 {
  return Category::create($r->all());
 }

 public function show(Category $category)
 {
  return $category;
 }

 public function update(Request $r, Category $category)
 {
  $category->update($r->all());

  return $category;
 }

 public function destroy(Category $category)
 {
  $category->delete();

  return ['msg'=>'deleted'];
 }
}
