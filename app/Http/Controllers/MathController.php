<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PreviousData;

class MathController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric|digits:4',
        ]);
        
        $number = $request->input('number');
        $position = random_int(0, 3);
        $isAddition = (bool)random_int(0, 1); // Randomly choose addition (1) or subtraction (0).
        $modifier = random_int(1, 5);
    
        // Make a copy of the original number for display
        $originalNumber = $number;
    
        // Modify the number based on the random position and operation
        $digits = str_split($number);
    
        if ($isAddition) {
            $digits[$position] = ($digits[$position] + $modifier) % 10;
        } else {
            $digits[$position] = ($digits[$position] - $modifier + 10) % 10;
        }
    
        // Calculate the alteration value
        $alterationValue = $isAddition ? $modifier : -$modifier;
    
        $newNumber = implode('', $digits);
    
        // Insert the new entry into the 'previous_data' table
        PreviousData::create([
            'original_number' => $originalNumber,
            'altered_number' => $newNumber,
            'position' => $position,
            'alteration_value' => $alterationValue,
        ]);
    
        $previousData = $this->getPreviousData();
    
        // Create an array for the view
        $viewData = [
            'originalNumber' => $originalNumber,
            'position' => $position,
            'alterationValue' => $alterationValue,
            'newNumber' => $newNumber,
            'isAddition' => $isAddition,
            'previousData' => $previousData,
        ];
    
        // Return a view with the result
        return view('result', $viewData);
    }

    public function result()
    {
        // Retrieve previous data
        $previousData = $this->getPreviousData();

        return view('result', [
            'previousData' => $previousData, // Pass previous data to the view
        ]);
    }

    // New method to retrieve previous data
    private function getPreviousData()
    {
        // Retrieve the latest 10 data entries from the database
        return PreviousData::latest('created_at')->take(20)->get();
    }

    public function home()
{
    // Your code to set up data, retrieve previous data, and pass it to the view.
    $previousData = $this->getPreviousData();
    
    return view('math', [
        'previousData' => $previousData,
    ]);
}

}
