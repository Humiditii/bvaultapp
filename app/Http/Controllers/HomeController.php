<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Upload;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $user = Auth::user();

        //$getUserSize = Upload::where('user_id', Auth::id())->sum('size');
        //$getUserSizeType = Upload::where('user_id', Auth::id());

        $getMbSize = Upload::where([
            ['user_id',  Auth::id()],
            ['sizeType', 'Mb'],
        ])->sum('size');
        
        $getKbSize = Upload::where([
            ['user_id',  Auth::id()],
            ['sizeType', 'Kb'],
        ])->sum('size');

        $convertMbToKb = $getMbSize*1024; // to kb

        $sumAllKbTogether = $getKbSize + $convertMbToKb;


        if ($sumAllKbTogether > 1024) {
            $convertKbBackToMb = round($sumAllKbTogether/1024, 2);
            $sizeType = 'Mb';
        }else{
            $convertKbBackToMb = round($sumAllKbTogether/1024, 2);
            $sizeType = 'Mb';
        }
    

        $defaultSizeAllocted = 200;

        $percentageUsed = round(($convertKbBackToMb/200)*100, 2);

        $percentageRemaining = 100 - $percentageUsed;

        $remainingSize = $defaultSizeAllocted - $convertKbBackToMb;

        session(['remainingSize' => $remainingSize]);

      

       return view('home', compact('user', 'convertKbBackToMb','sizeType','defaultSizeAllocted','percentageUsed','remainingSize','percentageRemaining'));
    }

    public function download(){
        
    }
}
