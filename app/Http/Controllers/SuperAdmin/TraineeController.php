<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function typePrograms(){
        $page = 'Type Programs';
        return view('super-admin.trainee.type-programs.index',compact('page'));
    }

    public function index(){
        $page = 'Trainee';
        return view('super-admin.trainee.index',compact('page'));
    }

    public function create(){
        $page = 'Create Trainee';
        return view('super-admin.trainee.create',compact('page'));
    }
}
