<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;

class TraineeController extends Controller
{
    public function typePrograms(){
        $page = 'Type Programs';
        $training = Training::get();
        return view('super-admin.trainee.type-programs.index',compact('page','training'));
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
