<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousData extends Model
{
    protected $fillable = ['original_number', 'altered_number', 'position', 'alteration_value'];

}