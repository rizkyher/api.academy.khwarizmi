<?php

namespace App\Http\Controllers;

use App\Services\CertificateService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
 protected $service;

 public function __construct(CertificateService $service)
 {
  $this->service = $service;
 }

 public function generate(Request $r,$courseId)
 {
  return $this->service->generate(
   $r->user()->id,
   $courseId
  );
 }
}
