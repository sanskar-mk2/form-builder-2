<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSurvey;
use App\Exports\ExportSurvey;
use App\Models\Suvery;

class ImportExport extends Controller
{
    public function import(Request $request){
        if(!$request->file('file')){
            return redirect()->back();
        }
        $survey=new ImportSurvey;
        Excel::import( $survey,
                      $request->file('file')->store('files'));

                 $survey=json_encode($survey->contents);
                   $data=compact('survey');
                     return redirect()->back()->with(['survey' => $survey]);

                   
    }

    public function export(Request $request ){
       

        return (new ExportSurvey)->download('survey.xlsx');
     }
}
