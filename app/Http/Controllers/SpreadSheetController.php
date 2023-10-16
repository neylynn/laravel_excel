<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use App\Imports\DeveloperImport;
use App\Jobs\ProcessCreateDeveloper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class SpreadSheetController extends Controller
{
    
    public function showQueuImportPage()
    {
        return view("import_by_queue");
    }


    public function importFileWithQueue(Request $request)
    {
        // $faker = \Faker\Factory::create();    

        // for($i=1; $i<=10000; $i++){
        //     $developer = Developer::create([
        //         'fullname' =>  $faker->name(),
        //         'email' => $faker->email(),
        //         'phone' => $faker->randomNumber()
        //     ]);    

        //     Log::info("developer info : ". json_encode($developer));
        // }

        // dd($request->all());


        $arrDevelopers = \Maatwebsite\Excel\Facades\Excel::toArray(new DeveloperImport(), $request->file('importingFile'),null,\Maatwebsite\Excel\Excel::XLSX);

        // dd($arrDevelopers);

        foreach ($arrDevelopers[0] as $key => $developer) {

            
            if($arrDevelopers[0][0] == $developer){
                continue;
            }

            // Log::info(json_encode($developer));
            // dd($developer);

            $developerToCreate = [
                'fullname' => $developer[0],
                'email' => $developer[1],
                'phone' => $developer[2]
            ];

            ProcessCreateDeveloper::dispatch($developerToCreate);


        }

        return back()->with('success', 'File Content has been imported successfully!');
    }
}
