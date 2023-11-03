<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import Http

class NumpadController extends Controller
{
    public function index()
{
    $previousData = [];
    return view('numpad', compact('previousData'));
}


    public function submit(Request $request)
    {
        // Validate the entered value
        $request->validate([
            'entered_value' => 'required|numeric|digits:4',
        ]);

        // Get the entered number from the form
        $enteredValue = $request->input('entered_value');

        // Send a POST request to the MathController to perform the calculation
        $response = Http::post('/calculate', ['number' => $enteredValue]);

        if ($response->successful()) {
            // If the request was successful, get the calculated value and previous data
            $data = $response->json();
            $calculatedValue = $data['newNumber'];
            $previousData = $data['historyData'];
        } else {
            // Handle the case where the request to MathController fails
            $calculatedValue = 'Calculation Error';
            $previousData = [];
        }

        return view('numpad', [
            'enteredValue' => $enteredValue,
            'calculatedValue' => $calculatedValue,
            'previousData' => $previousData,
        ]);
    }
}
