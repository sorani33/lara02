<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\ExaminationResult;
use App\User;
use App\UserTitle;


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

        return view('mypage.index', $assignData);
    }

    public function editName()
    {
        $user = Auth::user();
        $assignData = [
            'user' => $user,
        ];

        return view('mypage.profile', $assignData);
    }

    public function editNameSave (Request $request) 
    {
        // dd($request['user_name']);
        $user = Auth::user();

        User::where('id', $user->id)
        ->update([
            'name' => $request['user_name'],
            'class_id' => $request['class_name'],
        ]);
        return redirect()->route('mypage');
        return view('mypage.index');
    }

    public function editTitle()
    {
// dd('editTitle');
    $user = Auth::user();
    // $examinationQuestionsData = UserTitle::get()->where('user_id', $user->id);
    // $examinationQuestionsData = UserTitle::with('users')->where('user_id', $user->id)->get();
    $examinationQuestionsData = User::with('titles')->where('id', $user->id)->get();
    // $examinationQuestionsData = User::get()->where('id', $user->id);

    dd($examinationQuestionsData);
    $assignData = [
        ];

        return view('mypage.title', $assignData);
    }

    public function editTitleSave()
    {
dd('editsaveTitle');
        return view('mypage', $assignData);
    }
}
