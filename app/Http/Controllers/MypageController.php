<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\ExaminationResult;

class MypageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $examinationResultDatas = ExaminationResult::get()->where('user_id', $userId); 
    //  dd($examinationResultDatas->sum('number_correct_answers'));
        $assignData = [
            'examinationResultDatas' => $examinationResultDatas,
            'totalScore' => $examinationResultDatas->sum('number_correct_answers'),
        ];

        return view('mypage', $assignData);
    }
}
