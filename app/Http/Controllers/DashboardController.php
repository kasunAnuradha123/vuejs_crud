<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
       return Inertia::render('Dashboard', [
            'usersCount' => User::where('status', 'active')->count(),
            'userChartData' => $this->userChartData(),
        ]);
    }


    public function userChartData(){
        $users = User::where('status', 'active')->get();
        $userName = [];
        $userMark = [];
        $userChartData = [];
        foreach($users as $key =>$value){
            $userName[$key] = $value->name;
            $userMark[$key] = $value->mark;
        }

        $userChartData = [
            'name' => $userName,
            'mark' => $userMark,
        ];
        return $userChartData;
    }
}
