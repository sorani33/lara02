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
    public function index()
    {
        // dd('home');
        $examinationQuestionsData = ExaminationQuestion::all();
dd($examinationQuestionsData);
        return view('home');
    }


    public function show(ExaminationQuestion $examinationQuestion)
    {
dd($examinationQuestion);
        return view('home');
    }
}
