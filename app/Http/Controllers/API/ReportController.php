<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::id();
        $examinationResult = ExaminationResult::where('user_id', $userId);
        $baseExaminationResults = ExaminationResult::groupBy('user_id')
        ->select('user_id', DB::raw('SUM(number_correct_answers) as number_correct_answers'));

        // 総合スコアを取得する。
        if($genreId == 900){
            $examinationResultSum = $examinationResult->sum("number_correct_answers");
            $examinationResults = $baseExaminationResults->orderBy('number_correct_answers', 'desc')->limit(3)->get();

            $myRankingNumber = null;
            foreach($examinationResults as $key => $value){
                $examinationData[$key]['user_name'] = $value->user->name;
                $examinationData[$key]['number_correct_answers'] = $value['number_correct_answers'];
                if($value->user->id == $userId){
                    $myRankingNumber = $key+1;
                }
            }

            $assignData = [
                'userId' => $userId,
                'myRankingNumber' => $myRankingNumber,
                'myscore' => $examinationResultSum,
                'ranking' => $examinationResults,
            ];
        }

        // dd($assignData);
        // 月間スコアを取得する。
        if($genreId == 950){
            $from = Carbon::now()->startOfMonth()->toDateString(); //月初日
            $to = Carbon::now()->endOfMonth()->toDateString(); //月末日
            $examinationResultMonthSum = $examinationResult->whereBetween('created_at', [$from, $to])->sum("number_correct_answers");
            $examinationResultsMonth =$baseExaminationResults->whereBetween('created_at', [$from, $to])->orderBy('number_correct_answers', 'desc')->limit(3)->get();

            $myRankingNumber = null;
            foreach($examinationResultsMonth as $key => $value){
                $examinationData[$key]['user_name'] = $value->user->name;
                $examinationData[$key]['number_correct_answers'] = $value['number_correct_answers'];
                if($value->user->id == $userId){
                    $myRankingNumber = $key+1;
                }
            }

            $assignData = [
                'userId' => $userId,
                'myRankingNumber' => $myRankingNumber,
                'myscore' => $examinationResultMonthSum,
                'ranking' => $examinationResultsMonth,
            ];
        }


        ##############################
        ### タイムアタック
        ##############################
        // 個人のタイムアタックを取得する
        if($genreId != 900 && $genreId != 950){        
            $timeAttackResult = ExaminationResult::where('user_id', $userId)->where('genre_id', $genreId)->where('best_time_flag', 1)->first();
            // 他の人のランキングを作る。（同列未考慮）
            $timeAttackRankingResult = ExaminationResult::where('genre_id', $genreId)
            ->where('best_time_flag', 1)
            ->select('user_id','time_attack')->orderBy('number_correct_answers', 'desc')->limit(3)->get();
            // 文字列の調整
            $mybesttime = substr($timeAttackResult['time_attack'], 6);
            $mybesttime = str_replace(".", "秒", $mybesttime);

            $myRankingNumber = null;
            foreach($timeAttackRankingResult as $key => $value){
                $timeAttackRankingResult[$key]['user_name'] = $value->user->name;
                $besttime = substr($value ['time_attack'], 6);
                $besttime = str_replace(".", "秒", $besttime);
                $timeAttackRankingResult[$key]['time_attack'] = $besttime;
                if($value->user->id == $userId){
                    $myRankingNumber = $key+1;
                }
            }


            $assignData = [
                'userId' => $userId,
                'myRankingNumber' => $myRankingNumber,
                'mybesttime' => $mybesttime,
                'timeAttacks' => $timeAttackRankingResult,
            ];
        }

        return response()->json($assignData);
    }
}
