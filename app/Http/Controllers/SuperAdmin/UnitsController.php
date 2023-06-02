<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Unit;
use App\Models\LearningSpecialty;
use App\Models\TraineeCapacity;

class UnitsController extends Controller
{
    public function index()
    {
        $page = 'Units';
        $learning = LearningSpecialty::get();
        return view('super-admin.units.index',compact('page','learning'));
    }

    public function datatable(Request $request){
        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));
        $columns = array(
            2 => 'name',
            3 => 'short_name',
            5 => 'status'
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new Unit();
        if(isset($request->ls_id)){
            $data = $data->where('ls_id',$request->ls_id);
        }
        $jsonArray['recordsTotal'] = $data->count();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $data = $data->where('name', 'like', "%{$search}%");
            $data = $data->orWhere('short_name', 'like', "%{$search}%");
        }

        $jsonArray['recordsFiltered'] = $data->count();

        $data = $data->with(['divisions','LearningSpecialty'])->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        $index = 0;
        foreach ($data as $r) {
            if($r->status == '1'){
                $status = '<span class="badge badge-success">Yes</span>';
            }else{
                $status = '<span class="badge badge-danger">No</span>';
            }
            $index++;
            $jsonObject = array();
            $jsonObject[] = $index;
            $jsonObject[] = $r->divisions->name;
            $jsonObject[] = $r->name;
            $jsonObject[] = $r->short_name;
            $jsonObject[] = $r->LearningSpecialty->name;
            $jsonObject[] = $status;
            $jsonObject[] ='
                <a href="'.route('units.edit',[$r->id]).'" class="btn btn-sm btn-success">Edit</a>
                <span onclick="confirmDeletion(`'.route('units.destroy',[$r->id]).'`)" class="btn btn-sm btn-danger">Delete</span>';
            $jsonArray['data'][] = $jsonObject;
        }

        return json_encode($jsonArray);
    }

    public function create()
    {
        $division = Division::get();
        $learning = LearningSpecialty::get();
        $page = "Create Units";
        return view('super-admin.units.create',compact('page','division','learning'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'division_id'       => 'required',
            'name'              => 'required',
            'short_name'        => 'required',
            'ls_id'             => 'required',
            'status'            => 'required'
        ],[
            'division_id.required'  => 'The division field is required.',
            'ls_id.required'        => 'The learning specialty field is required.'
        ]);

        $data = $request->only('division_id','name','short_name','ls_id','status');

        $units = Unit::create($data);
        TraineeCapacity::create([
            'units_id' => $units->id
        ]);
        return response()->json(['success' => true, 'message' => 'Units create successfully']);
    }

    public function edit(string $id)
    {
        $units = Unit::where('id',$id)->with('divisions')->first();
        $learning = LearningSpecialty::get();
        $page = 'Edit Units';
        $division = Division::get();
        return view('super-admin.units.edit',compact('page','units','division','learning'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'division_id'       => 'required',
            'name'              => 'required',
            'short_name'        => 'required',
            'ls_id'             => 'required',
            'status'            => 'required',
        ],[
            'division_id.required'  => 'The division field is required.',
            'ls_id.required'        => 'The learning specialty field is required.'
        ]);

        $unit = Unit::find($id);
        $unit->division_id = $request->division_id;
        $unit->name = $request->name;
        $unit->short_name = $request->short_name;
        $unit->ls_id = $request->ls_id;
        $unit->status = $request->status;
        $unit->save();

        return response()->json(['success' => true, 'message' => 'Unit update successfully']);
    }

    public function destroy(string $id)
    {
        TraineeCapacity::where('units_id',$id)->delete();
        Unit::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Unit delete successfully']);
    }


    // ======================================== Capacity ========================================

        // public function capacityUpdate(Request $request){
        //     $request->validate([
        //         'capacity_id'       => 'required',
        //         'capacity'          => 'required',
        //     ]);

        //     $capacitys = TraineeCapacity::find($request->capacity_id);
        //     $capacitys->capcaity = $request->capacity;
        //     $capacitys->save();

        //     return response()->json(['success' => true, 'message' => 'Capacity update successfully']);
        // }
    // ======================================== Capacity ========================================
}
