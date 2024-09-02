<?php

namespace App\Imports;

use App\Models\YourModel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;

class ExampleImport implements ToArray
{
    public function array(array $array)
    {
        // Process the array data here
        return $array;
    }
}
