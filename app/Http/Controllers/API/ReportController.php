<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\ExaminationQuestion;
use App\ExaminationResult;
use App\Http\Controllers\Controller; //APIコントローラの時は、コレが要る
use App\SubGenre;
use App\Genre;

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
     * ホーム画面
     */
    public function home(Request $request) 
    {
        $genreWithSubgenreDatas = Genre::with('subgenres')->orderBy('id', 'asc')->get();
        $authUser = Auth::user();

        $assignData = [
            'genreWithSubgenreDatas' => $genreWithSubgenreDatas,
            'authUser' => $authUser,
        ];
        return response()->json($assignData);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($subGenreId)
    {
        ##############################
        ### 総合スコア・月間スコア
        ##############################
        $userId = Auth::id();
        $examinationResult = ExaminationResult::where('user_id', $userId);
        $baseExaminationResults = ExaminationResult::groupBy('user_id')
        ->select('user_id', DB::raw('SUM(number_correct_answers) as number_correct_answers'));

        // 総合スコアを取得する。
        if($subGenreId == config('common.genre_id.total_score.value')){
            $examinationResultSum = $examinationResult->sum("number_correct_answers");
            $examinationResults = $baseExaminationResults->orderBy('number_correct_answers', 'desc')->limit(config('common.examination_ranking_result.count.value'))->get();

            $myRankingNumber = null;
            foreach($examinationResults as $key => $value){
                $examinationData[$key]['user_name'] = $value->user->name;
                $examinationData[$key]['number_correct_answers'] = $value['number_correct_answers'];
                if($value->user->id == $userId){
                    $myRankingNumber = $key+1;
                }
            }
            $assignData = [
                'reportMode' => 1,
                'userId' => $userId,
                'myRankingNumber' => $myRankingNumber,
                'myscore' => $examinationResultSum,
                'ranking' => $examinationResults,
            ];
        }

        // 月間スコアを取得する。
        if($subGenreId == config('common.genre_id.month_score.value')){
            $from = Carbon::now()->startOfMonth()->toDateString(); //月初日
            $to = Carbon::now()->endOfMonth()->toDateString(); //月末日
            $examinationResultMonthSum = $examinationResult->whereBetween('created_at', [$from, $to])->sum("number_correct_answers");
            $examinationResultsMonth =$baseExaminationResults->whereBetween('created_at', [$from, $to])->orderBy('number_correct_answers', 'desc')->limit(config('common.examination_ranking_result.count.value'))->get();

            $myRankingNumber = null;
            foreach($examinationResultsMonth as $key => $value){
                $examinationData[$key]['user_name'] = $value->user->name;
                $examinationData[$key]['number_correct_answers'] = $value['number_correct_answers'];
                if($value->user->id == $userId){
                    $myRankingNumber = $key+1;
                }
            }

            $assignData = [
                'reportMode' => 1,
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
        if($subGenreId != config('common.genre_id.total_score.value') && $subGenreId != config('common.genre_id.month_score.value')){        
            $timeAttackResult = ExaminationResult::where('user_id', $userId)->where('sub_genre_id', $subGenreId)->where('best_time_flag', 1)->first();

            // 他の人のランキングを作る。（同列未考慮）
            $timeAttackRankingResult = ExaminationResult::where('sub_genre_id', $subGenreId)
            ->where('best_time_flag', 1)
            ->select('user_id','time_attack')->orderBy('time_attack', 'asc')->limit(config('common.examination_ranking_result.count.value'))->get();

            $mybesttime = $timeAttackResult['time_attack'] ?? null;

            $myRankingNumber = null;
            foreach($timeAttackRankingResult as $key => $value){
                $timeAttackRankingResult[$key]['user_name'] = $value->user->name;
                $timeAttackRankingResult[$key]['time_attack'] =  $value ['time_attack'];
                if($value->user->id == $userId){
                    $myRankingNumber = $key+1;
                }
            }
            
            $assignData = [
                'reportMode' => 2,
                'userId' => $userId,
                'myRankingNumber' => $myRankingNumber,
                'mybesttime' => $mybesttime,
                'timeAttacks' => $timeAttackRankingResult,
            ];
        }


        return response()->json($assignData);
    }
}
