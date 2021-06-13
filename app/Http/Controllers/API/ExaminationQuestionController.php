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
    public function index($genre_id)
    {
//         // $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id)->random(4); 
//         $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id); 
//         $examinationQuestions =[];
//         foreach($examinationQuestionsData as $examinationQuestion){
//             // $random = array('1', '2', '3', '4');
//             // shuffle($random);
//             // $examinationQuestion['sort'] = $random;
//             // $examinationQuestions[] = $examinationQuestion;
//             // dd($examinationQuestion);

//             $examinationQuestions[$examinationQuestion->no]['subject'] = $examinationQuestion->subject;
//             $examinationQuestions[$examinationQuestion->no]['question'] = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3');
//             shuffle($examinationQuestions[$examinationQuestion->no]['question']);
//             $examinationQuestions[$examinationQuestion->no]['created_at'] = $examinationQuestion->created_at;

//             // $getexaminationQuestionaaa = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3') + array('no'=>$examinationQuestion->no);
//             // uasort($getexaminationQuestionaaa, function() { return mt_rand(-1, 1); });
//             // $examinationQuestions[] = $getexaminationQuestionaaa;
//         }

//         $assignData = [
//             'examinationQuestions' => $examinationQuestions,
//             'genre_id' => $genre_id,
//         ];
// dd($assignData);
        return view('home');
    }


    public function show( $genre_id)
    {
        // dd($genre_id);
        $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id)->random(5); 
        // $examinationQuestionsData = ExaminationQuestion::get()->where('genre_id', $genre_id); 
        $examinationQuestions =[];
        foreach($examinationQuestionsData as $examinationQuestion){
            // $random = array('1', '2', '3', '4');
            // shuffle($random);
            // $examinationQuestion['sort'] = $random;
            // $examinationQuestions[] = $examinationQuestion;
            // dd($examinationQuestion);

            $examinationQuestions[$examinationQuestion->no]['subject'] = $examinationQuestion->subject;
            $examinationQuestions[$examinationQuestion->no]['question'] = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3');
            shuffle($examinationQuestions[$examinationQuestion->no]['question']);
            $examinationQuestions[$examinationQuestion->no]['created_at'] = $examinationQuestion->created_at;

            // $getexaminationQuestionaaa = $examinationQuestion->only('answer', 'dummy_answer1', 'dummy_answer2', 'dummy_answer3') + array('no'=>$examinationQuestion->no);
            // uasort($getexaminationQuestionaaa, function() { return mt_rand(-1, 1); });
            // $examinationQuestions[] = $getexaminationQuestionaaa;
        }

        $assignData = [
            'examinationQuestions' => $examinationQuestions,
            'genre_id' => $genre_id,
        ];
        return response()->json($assignData);
        // return view('home');
    }
}
