<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
 public function handle($request, Closure $next, ...$roles)
 {
  if(!auth()->check()){
   abort(401);
  }

  if(!in_array(auth()->user()->role,$roles)){
   abort(403,'Forbidden');
  }

  return $next($request);
 }
}
