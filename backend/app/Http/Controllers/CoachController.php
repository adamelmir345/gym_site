<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        return response()->json(Coach::all());
    }

    public function show($id)
    {
        return response()->json(Coach::findOrFail($id));
    }
}
