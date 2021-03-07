<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExaminationQuestion;

class PracticeController extends Controller
{
    public function index () 
    {
        $examinationQuestionsData = ExaminationQuestion::get()->random(2); 
        $examinationQuestions =[];
        foreach($examinationQuestionsData as $examinationQuestion){
            $random = array('1', '2', '3', '4');
            shuffle($random);
            $examinationQuestion['sort'] = $random;
            $examinationQuestions[] = $examinationQuestion;
            
        }

        $assignData = [
            'examinationQuestions' => $examinationQuestions,
        ];
// dd($assignData);
        return view('index', $assignData);
    }

    public function result (Request $request) 
    {
        // dd($request);
        // 問題数を取得する
        $examinationCount = count($request->input('no'));

        // 採点をする
        $examinationQuestions = ExaminationQuestion::get()->toArray();
        // $filtered = $collection->whereIn('age', [20, 23]);

        $noListFromDatabase= array_column($examinationQuestions, 'no');
        $correctAnswerCount = 0;
        $inCorrectAnswerLists = [];
        foreach($request->input('no') as $inputKey => $value){
            $assignNo = array_search($inputKey, $noListFromDatabase);
            if($value == $examinationQuestions[$assignNo]['answer']){
                // dd('正解数をカウントする。');
                $correctAnswerCount++;
            }else{
                // dd('はずれたら、Noのリストを格納する。');
                $examinationQuestions[$assignNo]['inCorrectAnswer'] = $value;
                $inCorrectAnswerLists[] = $examinationQuestions[$assignNo];

            }
        }
        // 点数を出す
        $score = $correctAnswerCount /$examinationCount * 100 ;


        $assignData = [
            'examinationCount' => $examinationCount, //問題数
            'correctAnswerCount' => $correctAnswerCount, //正解数
            'score' => $score, //点数
            'inCorrectAnswerLists' => $inCorrectAnswerLists, //不正解した問題と、選んだ選択肢と、解答のデータ
        ];
        // dd($assignData);


        // 問題文の表示
        // 間違った問題と解答の表示

        return view('complete', $assignData);
    }


}
