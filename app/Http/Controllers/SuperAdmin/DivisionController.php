<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Division';
        return view('super-admin.service.divisions',compact('page'));
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
        $request->validate([
            'name'              => 'required',
        ]);

        $data = $request->only('name');
        Division::create($data);

        return response()->json(['success' => true, 'message' => 'Division create successfully']);
    }

    public function datatable(Request $request){
        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));
        $columns = array(
            0 => 'id',
            1 => 'name',
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new Division();
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
            $jsonObject[] = $r->name;
            $jsonObject[] = '
                <span data-id="'.$r->id.'" data-name="'.$r->name.'" class="btn btn-sm btn-success division-edit-btn">Edit</span>
                <span onclick="confirmDeletion(`'.route('divisions.destroy',[$r->id]).'`)" class="btn btn-sm btn-danger">Delete</span>';
            $jsonArray['data'][] = $jsonObject;
        }

        return json_encode($jsonArray);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $division = Division::find($id);
        $division->name = $request->name;
        $division->save();

        return response()->json(['success' => true, 'message' => 'Division update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Division::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Division delete successfully']);
    }
}
