<?php

use PhpOffice\PhpSpreadsheet as Office;

// if (! function_exists('groupByKey')) {
//     /**
//      * 配列を指定のキーでグループ化　コレクションのgroupBy()メソッドの配列版
//      */
//     function groupByKey($array, $key)
//     {

//         $groups = [];
//         foreach ($array as $item) {
//             $groups[$item[$key]][] = $item;
//         }
//         return $groups;
//     }
// }



if (! function_exists('groupByKey')) {
    /**
     * 配列を指定のキーでグループ化　コレクションのgroupBy()メソッドの配列版
     */
    function groupByKey($modelName, $sheetName, $truncate = true, $fakeSamples = 0)
    {
        Schema::disableForeignKeyConstraints();
        $model = resolveModel($modelName);
        // dd($model);

        if ($truncate && Schema::hasTable($sheetName)) {
            $model::truncate();
        }

        // $seeds = excel()->load(pms('database.seeders.seeds'), $sheetName);
        $seeds =load('database/seeders/seeds/seeds.xlsx', $sheetName);

        if ($seeds) {
            $fakeSamples -= count($seeds);

            collect($seeds)->each(function ($seed) use ($model) {
                if (! empty($seed['password'])) {
                    $seed['password'] = Hash::make($seed['password']);
                }

                $model::factory()->create($seed);
            });

            if ($fakeSamples > 0) {
                $model::factory($fakeSamples)->create();
            }
        }

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
