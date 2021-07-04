<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\ExaminationQuestion;
use App\ExaminationResult;
use App\Http\Controllers\Controller; //APIコントローラの時は、コレが要る

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
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
    public function index($genreId)
    {
        // dd($genreId);
        ##############################
        ### 総合スコア・月間スコア
        ##############################
        $userId = 1;
        $examinationResult = ExaminationResult::where('user_id', $userId);
        $baseExaminationResults = ExaminationResult::groupBy('user_id')
        ->select('user_id', DB::raw('SUM(number_correct_answers) as number_correct_answers'));

        // 総合スコアを取得する。
        if($genreId == 900){
            $examinationResultSum = $examinationResult->sum("number_correct_answers");
            $examinationResults = $baseExaminationResults->orderBy('number_correct_answers', 'desc')->limit(3)->get()->toarray();
            $assignData = [
                'myscore' => $examinationResultSum,
                'ranking' => $examinationResults,
            ];
        }

        // dd($assignData);
        // 月間スコアを取得する。
        if($genreId == 950){
            $from = date('2021-07-01');
            $to = date('2021-07-30');
            $examinationResultMonthSum = $examinationResult->whereBetween('created_at', [$from, $to])->sum("number_correct_answers");
            $examinationResultsMonth =$baseExaminationResults->whereBetween('created_at', [$from, $to])->where('number_correct_answers', '<', 3)->get()->toarray();
            $assignData = [
                'myscore' => $examinationResultMonthSum,
                'ranking' => $examinationResultsMonth,
            ];
        }


        ##############################
        ### タイムアタック
        ##############################
        // 個人のタイムアタックを取得する
        if($genreId != 900 && $genreId != 950){        
            $genreId = $genreId;
            $timeAttackResult = ExaminationResult::where('user_id', $userId)->where('genre_id', $genreId)->where('best_time_flag', 1)->first()->toarray();
            // 他の人のランキングを作る。（同列未考慮）
            $timeAttackRankingResult = ExaminationResult::where('genre_id', $genreId)
            ->where('best_time_flag', 1)
            ->select('user_id','time_attack')->orderBy('number_correct_answers', 'desc')->limit(3)->get()->toarray();
            $assignData = [
                'mybesttime' => $timeAttackResult['time_attack'],
                'timeAttacks' => $timeAttackRankingResult,
            ];
            dd($assignData);
        }

        return response()->json($assignData);
    }
}
