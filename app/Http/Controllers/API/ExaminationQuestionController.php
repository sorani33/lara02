<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\ExaminationQuestion;
use App\Http\Controllers\Controller; //APIコントローラの時は、コレが要る

class ExaminationQuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($genre_id)
    {
//         // $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id)->random(4); 
//         $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id); 
//         $examinationQuestions =[];
//         foreach($examinationQuestionsData as $examinationQuestion){
//             // $random = array('1', '2', '3', '4');
//             // shuffle($random);
//             // $examinationQuestion['sort'] = $random;
//             // $examinationQuestions[] = $examinationQuestion;
//             // dd($examinationQuestion);

//             $examinationQuestions[$examinationQuestion->no]['subject'] = $examinationQuestion->subject;
//             $examinationQuestions[$examinationQuestion->no]['question'] = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3');
//             shuffle($examinationQuestions[$examinationQuestion->no]['question']);
//             $examinationQuestions[$examinationQuestion->no]['created_at'] = $examinationQuestion->created_at;

//             // $getexaminationQuestionaaa = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3') + array('no'=>$examinationQuestion->no);
//             // uasort($getexaminationQuestionaaa, function() { return mt_rand(-1, 1); });
//             // $examinationQuestions[] = $getexaminationQuestionaaa;
//         }

//         $assignData = [
//             'examinationQuestions' => $examinationQuestions,
//             'genre_id' => $genre_id,
//         ];
// dd($assignData);
        return view('home');
    }


    public function show( $genre_id)
    {
        // dd($genre_id);
        $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id)->random(3); 
        // $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id); 
        $examinationQuestions =[];
        foreach($examinationQuestionsData as $examinationQuestion){
            // $random = array('1', '2', '3', '4');
            // shuffle($random);
            // $examinationQuestion['sort'] = $random;
            // $examinationQuestions[] = $examinationQuestion;
            // dd($examinationQuestion);

            $examinationQuestions[$examinationQuestion->no]['subject'] = $examinationQuestion->subject;
            $examinationQuestions[$examinationQuestion->no]['question'] = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3');
            shuffle($examinationQuestions[$examinationQuestion->no]['question']);
            $examinationQuestions[$examinationQuestion->no]['created_at'] = $examinationQuestion->created_at;

            // $getexaminationQuestionaaa = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3') + array('no'=>$examinationQuestion->no);
            // uasort($getexaminationQuestionaaa, function() { return mt_rand(-1, 1); });
            // $examinationQuestions[] = $getexaminationQuestionaaa;
        }

        $assignData = [
            'examinationQuestions' => $examinationQuestions,
            'genre_id' => $genre_id,
        ];
        return response()->json($assignData);
        // return view('home');
    }


    public function result (Request $request) 
    {
        dd($request);
        // dd($request->all);
        // dd($request);
        // +request: Symfony\Component\HttpFoundation\ParameterBag {#52 ▼
        //     #parameters: array:3 [▼
        //       "_token" => "oSLGoOvCHAICU4jKph45XsfgSB0Ab7WiTcP8LPo2"
        //       "genre_id" => "1"
        //       "no" => array:4 [▼
        //         1 => "ねこ"
        //         2 => "ねこ"
        //         3 => "どれ"
        //         4 => "むー"
        //       ]
        //     ]

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

            $examinationQuestions[$assignNo]['inCorrectAnswer'] = $value;
            $inCorrectAnswerLists[$inputKey] = $examinationQuestions[$assignNo];

            if($value == $examinationQuestions[$assignNo]['answer']){
                // dd('正解数をカウントする。');
                $correctAnswerCount++;
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = true;
            }else if(empty($value)){
                // dd('未回答のばあい');
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = null;
            }else{
                // dd('はずれたら、Noのリストを格納する。');
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = false;
            }
        }
        // 点数を出す
        $score = $correctAnswerCount /$examinationCount * 100 ;

        // DBに保存するexamination_results
        $user = ExaminationResult::create([
            'user_id' => 1,
            'genre_id' => $request->input('genre_id'),
            'number_questions' => $examinationCount, //問題数
            'number_correct_answers' => $correctAnswerCount, //正解数
            'mark' => $score,
        ]);

        // 満点フラグ
        $manten = $examinationCount == $correctAnswerCount  ? true : false;

        $assignData = [
            'examinationCount' => $examinationCount, //問題数
            'correctAnswerCount' => $correctAnswerCount, //正解数
            'manten' => $manten, //正解数
            'score' => $score ?? false, //点数
            'inCorrectAnswerLists' => $inCorrectAnswerLists, //不正解した問題と、選んだ選択肢と、解答のデータ
            'genre_id' => $request->input('genre_id'),
        ];
        // dd($assignData);


        // 問題文の表示
        // 間違った問題と解答の表示

        return view('complete', $assignData);
    }
}
