<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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

        return view('result', [
            'originalNumber' => $originalNumber,
            'position' => $position,
            'alterationValue' => $alterationValue,
            'newNumber' => $newNumber,
            'isAddition' => $isAddition,
        ]);
    }
}
