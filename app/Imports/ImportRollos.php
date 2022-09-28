<?php
   
namespace App\Imports;
   
use App\RollosDetail;
use Maatwebsite\Excel\Concerns\ToModel;
   
class ImportRollos implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RollosDetail([
            'id_rollo' => '61',
            'id_tela' => '24',
            'numero' => $row[0],
            'tono' => $row[1], 
            'longitud' => $row[2], 
            'corte_utilizado' => '2022-106', 
        ]);
    }
}