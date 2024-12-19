<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return Festival::find(3);
    }
}