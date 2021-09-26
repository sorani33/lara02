<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Http\Controllers\Controller; //APIコントローラの時は、コレが要る

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class MypageController extends Controller
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
    public function edit()
    {
        $userId = Auth::id();
        $userData = User::where('id', $userId)->first();
        $assignData = [
            'userdata' => $userData,
        ];
        return response()->json($assignData);
    }
}
