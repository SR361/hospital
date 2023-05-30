<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Unit;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Units';
        return view('super-admin.units.index',compact('page'));
    }

    public function datatable(Request $request){
        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));
        $columns = array(
            0 => 'name',
            1 => 'short_name'
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new Unit();
        $jsonArray['recordsTotal'] = $data->count();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $data = $data->where('name', 'like', "%{$search}%");
            $data = $data->orWhere('short_name', 'like', "%{$search}%");
        }

        $jsonArray['recordsFiltered'] = $data->count();

        $data = $data->with('divisions')->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        $index = 0;
        foreach ($data as $r) {
            $ls = json_decode($r->ls);
            $ls = implode(',',$ls);
            $index++;
            $jsonObject = array();
            $jsonObject[] = $index;
            $jsonObject[] = $r->divisions->name;
            $jsonObject[] = $r->name;
            $jsonObject[] = $r->short_name;
            $jsonObject[] = $ls;
            $jsonObject[] ='
                <a href="'.route('units.edit',[$r->id]).'" class="btn btn-sm btn-success">Edit</a>
                <span onclick="confirmDeletion(`'.route('units.destroy',[$r->id]).'`)" class="btn btn-sm btn-danger">Delete</span>';
            $jsonArray['data'][] = $jsonObject;
        }

        return json_encode($jsonArray);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $division = Division::get();
        $page = "Create Units";
        return view('super-admin.units.create',compact('page','division'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'division_id'       => 'required',
            'name'              => 'required',
            'short_name'        => 'required'
        ]);
        $ls = json_encode($request->ls);

        $data = $request->only('division_id','name','short_name');
        $data['ls'] = $ls;
        Unit::create($data);

        return response()->json(['success' => true, 'message' => 'Units create successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $units = Unit::where('id',$id)->with('divisions')->first();
        $page = 'Edit Units';
        $division = Division::get();
        return view('super-admin.units.edit',compact('page','units','division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'division_id'       => 'required',
            'name'              => 'required',
            'short_name'        => 'required'
        ]);
        $ls = json_encode($request->ls);
        $unit = Unit::find($id);
        $unit->division_id = $request->division_id;
        $unit->name = $request->name;
        $unit->short_name = $request->short_name;
        $unit->ls = $ls;
        $unit->save();

        return response()->json(['success' => true, 'message' => 'Unit update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Unit::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Unit delete successfully']);
    }
}
