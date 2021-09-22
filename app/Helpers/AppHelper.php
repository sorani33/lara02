<?php

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
    function groupByKey()
    {
dd('へるぱー');
        $groups = [];
        foreach ($array as $item) {
            $groups[$item[$key]][] = $item;
        }
        return $groups;
    }
}
