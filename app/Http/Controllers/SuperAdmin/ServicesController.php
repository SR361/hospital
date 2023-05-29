<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function divisions(){
        $page = 'Divisions';
        return view('super-admin.service.divisions',compact('page'));
    }

    public function units(){
        $page = 'Units';
        return view('super-admin.units.index',compact('page'));
    }

    public function unitsCreate(){
        $page = "Create Units";
        return view('super-admin.units.create',compact('page'));
    }

    public function learningSpecialty(){
        $page = 'Learning Specialty';
        return view('super-admin.service.learning-specialty',compact('page'));
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
