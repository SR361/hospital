<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LearningSpecialty;

class ServicesController extends Controller
{
    // public function divisions(){
    //     $page = 'Division';
    //     return view('super-admin.service.divisions',compact('page'));
    // }

    public function learningSpecialty(){
        $page = 'Learning Specialty';
        $ls = LearningSpecialty::get();
        return view('super-admin.service.learning-specialty',compact('page','ls'));
    }

    public function rotations(){
        $page = 'Rotations';
        return view('super-admin.rotations.index',compact('page'));
    }

    public function reporting(){
        $page = 'Reporting';
        return view('super-admin.reporting.index',compact('page'));
    }
}
