<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PreviousData;

class PreviousDataController extends Controller
{
    public function index()
{
    // Fetch the previous data from your database or any other source
    $previousData = PreviousData::latest('created_at')->take(20)->get();

    return view('previous_data', compact('previousData'));
}

}
