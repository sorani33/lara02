<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Genre;
use App\SubGenre;
use App\ExaminationQuestion;
use App\ExaminationResult;
use App\Http\Controllers\Controller; //APIコントローラの時は、コレが要る

use Auth;
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
    public function index(Request $request) 
    {
        return view('home');
    }



    /**
     * 出題の画面
     */
    public function show(Request $request)
    {
        $examinationQuestionsData = ExaminationQuestion::get()->where('sub_genre_id', $request->questionId); 

        //タイムアタックは出題数を絞る
        if($request->gamemode == config('common.gamemode.time_attack.value')){
            $examinationQuestionsData = $examinationQuestionsData->random(config('common.examination_question.count.value')); 
        }

        $examinationQuestions =[];
        foreach($examinationQuestionsData as $examinationQuestion){
            $examinationQuestions[$examinationQuestion->id]['subject'] = $examinationQuestion->subject;
            $examinationQuestions[$examinationQuestion->id]['question'] = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3');
            shuffle($examinationQuestions[$examinationQuestion->id]['question']);
            $examinationQuestions[$examinationQuestion->id]['created_at'] = $examinationQuestion->created_at;
        }
        $authUser = Auth::user();

        $assignData = [
            'examinationQuestions' => $examinationQuestions,
            'sub_genre_id' => $request->questionId,
            'authUser' => $authUser,
        ];
        return response()->json($assignData);
    }


    /**
     * 解答結果の画面
     */
    public function result(Request $request) 
    {
        $userId = Auth::id();
        // 問題数を取得する
        $examinationCount = count($request->param['sub_genre_id']);

        $subGenreData = SubGenre::where('id',$request->param['questionId'])->first();
        // 採点をする
        $examinationQuestions = ExaminationQuestion::get()->toArray();

        $noListFromDatabase= array_column($examinationQuestions, 'id');
        $correctAnswerCount = 0;
        $inCorrectAnswerLists = [];
        foreach($request->param['sub_genre_id'] as $inputKey => $value){
            $assignNo = array_search($inputKey, $noListFromDatabase);

            $examinationQuestions[$assignNo]['inCorrectAnswer'] = $value;
            $inCorrectAnswerLists[$inputKey] = $examinationQuestions[$assignNo];

            if($value == $examinationQuestions[$assignNo]['answer']){
                // dd('正解数をカウントする');
                $correctAnswerCount++;
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = config('common.correct_answer.correct.value');
            }else if(empty($value)){
                // dd('未回答のばあい');
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = config('common.correct_answer.unanswered.value');
            }else{
                // dd('はずれたら、Noのリストを格納する');
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = config('common.correct_answer.incorrect.value');
            }
        }
        // 点数を計算して四捨五入する
        $scoreDetailed = $correctAnswerCount /$examinationCount * 100 ;
        $score = round($scoreDetailed);

        // タイムアタックモードの場合の処理
        if($request->param['gamemode'] == config('common.gamemode.time_attack.value')){
            $bestTimeFlag = config('common.examination_result.best_time_flag.off.value');
            //ログイン状態で満点の時の処理。 個人ベストタイムを取得する。
            if($score == 100 && isset($userId)){
                $timeAttack = $request->param['timeAttack']; //"49.880"
                $examinationResult = ExaminationResult::where([
                    'user_id' =>  $userId,
                    'sub_genre_id' => $request->param['questionId'],
                    'best_time_flag' => 1,
                ])->first();

                //DBにデータがない時は、ベストタイム扱いにする。
                if(!isset($examinationResult)){
                    $bestTimeFlag = config('common.examination_result.best_time_flag.on.value');
                }
                // DBにデータがありタイムを更新している時は、ベストタイム扱いにして旧データのフラグを下げる。
                if(isset($examinationResult)){
                    $timeAttackInDatabase = $examinationResult->time_attack; //2.39
                    if($timeAttackInDatabase > $timeAttack){
                        $bestTimeFlag = config('common.examination_result.best_time_flag.on.value');
                        $examinationResult->update(['best_time_flag' => 0]);
                    }    
                }    
            }
        }
        // ログイン状態時の処理。DBに保存する
        if(isset($userId)){
            $user = ExaminationResult::create([
            'user_id' => Auth::id(),
            'genre_id' => $request->param['genre_id'],
            'sub_genre_id' => $request->param['questionId'],
            'gamemode' => $request->param['gamemode'],
            'number_questions' => $examinationCount, //問題数
            'number_correct_answers' => $correctAnswerCount, //正解数
            'mark' => $score,
            'time_attack' => $timeAttack ?? null,
            'best_time_flag' => $bestTimeFlag ?? null,
            ]);
        }

        // 満点フラグ
        $manten = $examinationCount == $correctAnswerCount  ? true : false;
        $assignData = [
            'subGenreName' => $subGenreData->name, //ジャンル名
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
