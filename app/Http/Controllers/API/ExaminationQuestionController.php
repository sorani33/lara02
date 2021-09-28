<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
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
    public function index($genre_id)
    {
        return view('home');
    }


    public function show($sub_genre_id)
    {

        $examinationQuestionsData = ExaminationQuestion::get()->where('sub_genre_id', $sub_genre_id)->random(config('common.examination_question.count.value')); 
        // dd($examinationQuestionsData);

        $examinationQuestions =[];
        foreach($examinationQuestionsData as $examinationQuestion){
            $examinationQuestions[$examinationQuestion->id]['subject'] = $examinationQuestion->subject;
            $examinationQuestions[$examinationQuestion->id]['question'] = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3');
            shuffle($examinationQuestions[$examinationQuestion->id]['question']);
            $examinationQuestions[$examinationQuestion->id]['created_at'] = $examinationQuestion->created_at;
        }

        $assignData = [
            'examinationQuestions' => $examinationQuestions,
            'sub_genre_id' => $sub_genre_id,
        ];
        return response()->json($assignData);
    }


    public function result(Request $request) 
    {
        // 問題数を取得する
        $examinationCount = count($request->param['sub_genre_id']);

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
                // dd('正解数をカウントする。');
                $correctAnswerCount++;
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = 1;
            }else if(empty($value)){
                // dd('未回答のばあい');
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = 2;
            }else{
                // dd('はずれたら、Noのリストを格納する。');
                $inCorrectAnswerLists[$inputKey]['correctAnswer'] = 3;
            }
        }

        // 点数を出す
        $score = $correctAnswerCount /$examinationCount * 100 ;

        // タイムアタックモードの場合の処理
        if($request->param['gamemode'] == 2){
            if($score == 100){
                $bestTimeFlag = 0;
                $timeAttack = $request->param['timeAttack']; //"49.880"
                // 個人ベストタイムを取得する。
                $examinationResult = ExaminationResult::where('user_id', 1)->where('best_time_flag', 1)->first();
        
                //初回データだとたぶんflagつかない

                if(isset($examinationResult)){
                    $timeAttackInDatabase = $examinationResult->time_attack; //00:00:04.591
                    $carbon1 = Carbon::parse($timeAttackInDatabase)->format('s.v');
                    $carbon2 = Carbon::parse($request->param['timeAttack'])->format('s.v');
            
                    // データが有り、タイムを更新していればデータも更新する。
                    if($carbon1 > $carbon2){
                        $bestTimeFlag = 1;
                        $examinationResult->update(['best_time_flag' => 0]);
                    }    
                }    

            }
        }
        
        // try {
        //     DB::transaction(function () use ($request, $shopReviewId) {
        //         //保存
        //             ShopReview::where('id', $shopReviewId)->update($request['shop_review']);
        //             // throw new \Exception('ここで処理を終わらせる');  //トランザクションテスト用
        //     });
        //     $saveResult = [
        //         'message'   => '保存しました。',
        //         'result'    => true,
        //     ];
        // } catch (Exception $e) {
        //     report($e);
        //     $saveResult = [
        //         'message'   => '保存出来ませんでした。',
        //         'result'    => false,
        //     ];
        // } finally {

        // }
        // return view('mypage.posted.completed');

        // DBに保存する
        $user = ExaminationResult::create([
            // 'user_id' => Auth::id(),
            'user_id' => 1,
            'genre_id' => $request->param['genre_id'],
            'sub_genre_id' => $request->param['sub_genre_id'],
            'gamemode' => $request->param['gamemode'],
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
