<?php

namespace App\Imports;

use App\Campaing;
use Maatwebsite\Excel\Concerns\ToModel;

class CampaingsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Campaing([
            'name' => $row[0],
            'code' => $row[0],
        ]);
    }
}
