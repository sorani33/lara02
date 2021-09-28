<?php

use PhpOffice\PhpSpreadsheet as Office;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


// if (! function_exists('seederByXlsx')) {
//     /**
//      * 配列を指定のキーでグループ化　コレクションのgroupBy()メソッドの配列版
//      */
//     function seederByXlsx($array, $key)
//     {

//         $groups = [];
//         foreach ($array as $item) {
//             $groups[$item[$key]][] = $item;
//         }
//         return $groups;
//     }
// }



if (! function_exists('seederByXlsx')) {
    /**
     * xlsxからデータ投入
     */
    function seederByXlsx($modelName, $sheetName, $truncate = true, $fakeSamples = 0)
    {
        Schema::disableForeignKeyConstraints();
        $model = resolveModel($modelName);

        if ($truncate && Schema::hasTable($sheetName)) {
            $model::truncate();
        }
        $seeds =load('database/seeds.xlsx', $sheetName);
        $seeds = $seeds->toArray();
        $i =0;
        foreach($seeds as $seed){
            $seeddata[] = $seed;
            $seeddata[$i]['created_at'] = Carbon::now();
            $seeddata[$i]['updated_at'] = Carbon::now();    
            $i++;
        }
        DB::table($sheetName)->insert($seeddata);
        // if ($seeds) {
        //     $fakeSamples -= count($seeds);

        //     collect($seeds)->each(function ($seed) use ($model) {
        //         if (! empty($seed['password'])) {
        //             $seed['password'] = Hash::make($seed['password']);
        //         }
        // // dd($seed);
        //         // $model::factory()->create($seed);
        //         factory(App\ExaminationQuestion::class)->create($seed);
        //         // factory(ExaminationQuestion::class)->create($seed);
        //     });

        //     if ($fakeSamples > 0) {
        //         // $model::factory($fakeSamples)->create();
        //         factory($fakeSamples)->create($seed);
        //     }
        // }

        Schema::enableForeignKeyConstraints();
        }
    }




    function load($excelFile, $sheetName = '', $null = null)
    {
        $reader = new Office\Reader\Xlsx();
        // dd($reader);//ここまで
        $excel = $reader->load($excelFile);
        $sheet = $sheetName ? $excel->getSheetByName($sheetName) : $excel->getSheet(0);

        if (empty($sheet)) {
            return null;
        }

        $rows = $sheet->toArray();
        $header = array_shift($rows);

        return collect($rows)->map(function ($row) use ($header, $null) {
            $column = [];

            collect($row)->map(function ($value, $index) use ($header, &$column, $null) {
                return $column[$header[$index]] = $value ?? $null;
            });

            return array_filter($column, 'strlen');
        });
    }



    function resolveModel($Modelname){
        return 'App\\'.$Modelname;
    }
