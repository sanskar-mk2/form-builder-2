<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show(Request $request, Survey $survey)
    {
        return view('results.show', compact('survey'));
    }
}
