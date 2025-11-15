<?php

namespace App\Http\Controllers;

use App\Models\WorkshopClass;

class ClassController extends Controller
{
    public function index()
    {
        $classes = WorkshopClass::orderBy('starts_at')->get();
        return view('content.class', compact('classes'));
    }
}