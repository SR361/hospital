<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LearningSpecialty;

class RotationController extends Controller
{
    public function index(){
        $page = 'Rotation';
        $learning = LearningSpecialty::get();
        return view('super-admin.rotations.index',compact('page','learning'));
    }

    public function datatable(Request $request){
        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));
        $columns = array(
            1 => 'name',
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new LearningSpecialty();
        // if(isset($request->ls_id)){
        //     $data = $data->where('ls_id',$request->ls_id);
        // }

        // $data = $data->where('status','1');
        $jsonArray['recordsTotal'] = $data->count();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $data = $data->where('name', 'like', "%{$search}%");
        }

        $jsonArray['recordsFiltered'] = $data->count();

        $data = $data->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        $index = 0;
        foreach ($data as $r) {
            $index++;
            $jsonObject = array();
            $jsonObject[] = $index;
            $link = route('rotation.show',[$r->id,$request->rotation_id]);
            $jsonObject[] = '<a href="'.$link.'">'.$r->name.'</a>';
            $jsonObject[] = rand(10,99);
            $jsonObject[] = 'G'.rand(0,9);
            $jsonArray['data'][] = $jsonObject;
        }

        return json_encode($jsonArray);
    }

    public function show(string $id,$rotation){
        $page = 'Rotation';
        return view('super-admin.rotations.show',compact('page','id','rotation'));
    }
}
