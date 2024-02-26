<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConsumeApiController extends Controller
{
    public function index()  
    {
        $response = Http::get('http://localhost:8000/api/post/only/get');

        $data = $response->json();
    
        dd($data);    
    }
}
