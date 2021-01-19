<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeService;

class HomeController extends Controller
{
    public function csv_data_upload(Request $request, HomeService $HomeService)
    {
        
        //print_r($request->input('csvdata'));
        $res = $request->input('csvdata');
        $row = explode(',',$res);
        $html = '<tr>';
        for ($i=0; $i < count($row); $i++) { 
            # code...
            $html .= "<td>".$row[$i]."</td>";
        }
        $html .="</tr>";

        return response()->json([
            "data" => $res ? $html: "<h3>No Data</h3>"
        ]);
    }

    
}
