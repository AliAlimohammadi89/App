<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Expert;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index()
    {
        $Experts = Expert::latest()->paginate(6);
        return response([
            'data' => $Experts,
            'status' => 'success'
        ]);
    }
}
