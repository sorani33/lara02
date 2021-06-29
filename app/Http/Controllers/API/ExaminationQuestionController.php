<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\ExaminationQuestion;
use App\ExaminationResult;
use App\Http\Controllers\Controller; //APIコントローラの時は、コレが要る

use Carbon\Carbon;

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
        return view('home');
    }


    public function show( $genre_id)
    {
        // dd($genre_id);
        $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id)->random(3); 
        $examinationQuestions =[];
        foreach($examinationQuestionsData as $examinationQuestion){
            $examinationQuestions[$examinationQuestion->no]['subject'] = $examinationQuestion->subject;
            $examinationQuestions[$examinationQuestion->no]['question'] = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3');
            shuffle($examinationQuestions[$examinationQuestion->no]['question']);
            $examinationQuestions[$examinationQuestion->no]['created_at'] = $examinationQuestion->created_at;
        }

        $assignData = [
            'examinationQuestions' => $examinationQuestions,
            'genre_id' => $genre_id,
        ];
        return response()->json($assignData);
    }


    public function result (Request $request) 
    {
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
        $examinationCount = count($request->param['no']);

        // 採点をする
        $examinationQuestions = ExaminationQuestion::get()->toArray();

        $noListFromDatabase= array_column($examinationQuestions, 'no');
        $correctAnswerCount = 0;
        $inCorrectAnswerLists = [];
        foreach($request->param['no'] as $inputKey => $value){
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


        // タイムアタックモードの場合の処理
        if($request->param['mode'] == 2){
            if($score == 100){
                $bestTimeFlag = 0;
                $timeAttack = $request->param['timeAttack']; //"49.880"

                // 個人ベストタイムを取得する。
                $examinationResult = ExaminationResult::where('user_id', 1)->where('best_time_flag', 1)->first();
        
                if(isset($examinationResult)){
                    $timeAttackInDatabase = $examinationResult->time_attack; //00:00:04.591
                    $carbon1 = Carbon::parse($timeAttackInDatabase)->format('s.v');
                    $carbon2 = Carbon::parse($request->param['timeAttack'])->format('s.v');
            
                    // データが有り、タイムを更新していればデータも更新する。
                    if($carbon1 > $carbon2){
                        // dd('タイム更新');
                        $bestTimeFlag = 1;
                        $examinationResult->update(['best_time_flag' => 0]);
                    }    
                }    

            }
        }
        
        // DBに保存する
        $user = ExaminationResult::create([
            'user_id' => 1,
            'genre_id' => $request->param['genre_id'],
            'mode' => $request->param['mode'],
            'number_questions' => $examinationCount, //問題数
            'number_correct_answers' => $correctAnswerCount, //正解数
            'mark' => $score,
            'time_attack' => $timeAttack ?? null,
            'best_time_flag' => $bestTimeFlag ?? null,
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


        // 問題文の表示
        // 間違った問題と解答の表示
        return response()->json($assignData);
    }
}
