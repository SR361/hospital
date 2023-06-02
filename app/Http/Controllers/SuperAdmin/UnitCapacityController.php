<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LearningSpecialty;
use App\Models\Unit;
use App\Models\TraineeCapacity;
use App\Models\Training;
use App\Models\TraineeUnitsCapacity;

class UnitCapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Capacity';
        $learning = LearningSpecialty::get();
        return view('super-admin.capacity.index',compact('page','learning'));
    }

    public function capacityDatatable(Request $request){

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));
        $columns = array(
            2 => 'name',
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new Unit();
        if(isset($request->ls_id)){
            $data = $data->where('ls_id',$request->ls_id);
        }

        $data = $data->where('status','1');
        $jsonArray['recordsTotal'] = $data->count();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $data = $data->where('name', 'like', "%{$search}%");
        }

        $jsonArray['recordsFiltered'] = $data->count();

        $data = $data->with('TraineeCapacity')->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        $index = 0;
        foreach ($data as $r) {
            $index++;
            $jsonObject = array();
            $jsonObject[] = $index;
            $jsonObject[] = $r->name;
            $jsonObject[] = '<input type="number" class="form-control w-50" value="'.$r->TraineeCapacity->capcaity.'" onkeyup="capacityupdate('.$r->TraineeCapacity->id.',this)">';
            $jsonObject[] = '<a href="'.route('unitscapacity.show',[$r->id]).'" class="btn btn-sm btn-success">Manage</a>';
            $jsonArray['data'][] = $jsonObject;
        }

        return json_encode($jsonArray);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $units = Unit::where('id',$id)->with('LearningSpecialty')->first();
        $training = Training::get();
        $page = 'Manage '.$units->name;
        return view('super-admin.capacity.manage',compact('page', 'units','training'));
        // dd($units);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'capacity_id'       => 'required',
            'capacity'          => 'required',
        ]);

        $capacitys = TraineeCapacity::find($request->capacity_id);
        $capacitys->capcaity = $request->capacity;
        $capacitys->save();

        return response()->json(['success' => true, 'message' => 'Capacity update successfully']);
    }

    public function TraineeUnitsCapacityUpdate(Request $request){
        if(isset($request->status)){
            $traineecapacity = TraineeUnitsCapacity::where('units_id',$request->unitid)->where('training_id',$request->trainingid)->first();
            if(is_null($traineecapacity)){
                $createdata = array(
                    'units_id' => $request->unitid, 'training_id' => $request->trainingid, 'status' => $request->status
                );
                $traineecapacity = TraineeUnitsCapacity::create($createdata);
                return response()->json(['success' => true, 'message' => 'Training capacity created successfully']);
            }else{
                $updatedata = array(
                    'units_id' => $request->unitid, 'training_id' => $request->trainingid, 'status' => $request->status
                );
                $traineecapacity = TraineeUnitsCapacity::where('units_id',$request->unitid)->where('training_id',$request->trainingid)->update($updatedata);
            }
            return response()->json(['success' => true, 'message' => 'Training capacity updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
