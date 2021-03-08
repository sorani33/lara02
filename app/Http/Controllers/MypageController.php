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
        $user = Auth::user();
        $examinationResultDatas = ExaminationResult::get()->where('user_id', $userId); 
    //  dd($examinationResultDatas->sum('number_correct_answers'));
        $assignData = [
            'user' => $user,
            'examinationResultDatas' => $examinationResultDatas,
            'totalScore' => $examinationResultDatas->sum('number_correct_answers'),
        ];

        return view('mypage', $assignData);
    }

    public function editName()
    {
dd('editname');
        return view('mypage', $assignData);
    }

    public function editNameSave()
    {
dd('editNameSave');
        return view('mypage', $assignData);
    }

    public function editTitle()
    {
dd('editTitle');
        return view('mypage', $assignData);
    }

    public function editTitleSave()
    {
dd('editsaveTitle');
        return view('mypage', $assignData);
    }
}
