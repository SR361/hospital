<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Trainee;
use App\Models\LearningSpecialty;
use App\Models\Unit;
use App\Traits\CustomFileUpload;
use App\Imports\TraineeImport;
use App\Http\Requests\TraineeImportRequest;
use Maatwebsite\Excel\Facades\Excel;

class TraineeController extends Controller
{
    use CustomFileUpload;
    public function typePrograms(){
        $page = 'Type Programs';
        $training = Training::get();
        return view('super-admin.trainee.type-programs.index',compact('page','training'));
    }

    public function index(){
        $page = 'Trainee';
        return view('super-admin.trainee.index',compact('page'));
    }

    public function datatable(Request $request){

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));
        $columns = array(
            1 => 'name',
            2 => 'gender',
            4 => 'university',
            5 => 'start_date'
        );

        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;
        $data = new Trainee();


        $jsonArray['recordsTotal'] = $data->count();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $data = $data->where('name', 'like', "%{$search}%");
        }

        $jsonArray['recordsFiltered'] = $data->count();

        $data = $data->with('training')->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        $index = 0;
        foreach ($data as $r) {
            $index++;
            $jsonObject = array();
            $jsonObject[] = $index;
            $jsonObject[] = $r->name;
            $jsonObject[] = $r->gender;
            $jsonObject[] = $r->training->name;
            $jsonObject[] = $r->university;
            $jsonObject[] = $r->start_date.' '.$r->end_date;
            $jsonObject[] = $r->training->duration;
            $jsonObject[] = '<a href="'.route('trainee.edit',[$r->id]).'" class="btn btn-sm btn-success">Edit</a>
            <span onclick="confirmDeletion(`'.route('trainee.destroy',[$r->id]).'`)" class="btn btn-sm btn-danger">Delete</span>';
            $jsonArray['data'][] = $jsonObject;
        }

        return json_encode($jsonArray);
    }

    public function create(){
        $page = 'Create Trainee';
        $learning = LearningSpecialty::get();
        $training = Training::get();
        return view('super-admin.trainee.create',compact('page','learning','training'));
    }

    public function store(Request $request){
        $validated = request()->validate([
            'name' => 'required',
            'gender' => 'required',
            'training_id' => 'required',
            'location' => 'required',
            // 'ls_id' => 'required',
            // 'units_id' => 'required',
            'university' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'training_id.required' => 'The training field is required.',
            // 'ls_id.required' => 'The learning specialty field is required.',
            // 'units_id.required' => 'The unit field is required.',
        ]);
        $imagename = NULL;
        if($request->file('image')){
            $image = $request->file('image');
            $imagename = $this->uploadFile(
                $image,
                'trainee-image'
            );
        }

        $trainee = Trainee::create([
            'name' => $validated['name'],
            'image' => $imagename,
            'gender' => $validated['gender'],
            'training_id' => $validated['training_id'],
            'location'      => $validated['location'],
            // 'ls_id' => $validated['ls_id'],
            // 'units_id' => $validated['units_id'],
            'university' => $validated['university'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return response()->json(['success' => true, 'message' => 'Trainee profile create successfully']);
    }

    public function edit($id){
        $page = 'Edit Trainee';
        $trainee = Trainee::where('id',$id)->first();
        $learning = LearningSpecialty::get();
        $training = Training::get();
        return view('super-admin.trainee.edit',compact('page','learning','training','trainee'));
    }

    public function update(Request $request, string $id){
        $validated = request()->validate([
            'name' => 'required',
            'gender' => 'required',
            'training_id' => 'required',
            'location' => 'required',
            // 'ls_id' => 'required',
            // 'units_id' => 'required',
            'university' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'training_id.required' => 'The training field is required.',
            // 'ls_id.required' => 'The learning specialty field is required.',
            // 'units_id.required' => 'The unit field is required.',
        ]);
        $trainee = Trainee::find($id);
        $data = $request->only('name', 'gender', 'training_id', 'location', 'ls_id','units_id','university', 'start_date', 'end_date');
        if ($request->hasFile('image')) {
            $this->deleteFile($trainee->image, 'public/trainee-image/');
            $data['image'] = $this->uploadFile($request->image, 'trainee-image');
        }
        Trainee::find($id)->update($data);
        return response()->json(['success' => true, 'message' => 'Trainee profile update successfully']);
    }

    public function destroy(string $id)
    {
        $trainee = Trainee::findOrFail($id);
        if($trainee->getRawOriginal('image')){
            $this->deleteFile($trainee->getRawOriginal('image'), 'public/trainee-image/');
            // $this->deleteFile(
            //     $trainee->getRawOriginal('image'),
            //     'trainee-image/'
            // );
        }
        $trainee->delete();
        return response()->json(['success' => true, 'message' => 'Trainee profile delete successfully']);
    }

    public function LSUnits(Request $request){
        if(isset($request->ls_id)){
            $units = Unit::where('ls_id',$request->ls_id)->where('status','1')->get();
            if(count($units) > 0){
                $option_html = '<option value="">Select Units</option>';
                foreach($units as $row){
                    $option_html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
                }
                return response()->json(['success' => true, 'message' => 'Units data found.', 'data' => $option_html]);
            }else{
                $option_html = '<option value="">Units Data Not Found!</option>';
            }
        }
    }

    public function traineeImport(){
        $page = 'Trainee Import';
        return view('super-admin.trainee.import',compact('page'));
    }

    public function traineeImportStore(TraineeImportRequest $request){
        Excel::import(new TraineeImport,$request->file('upload_csv'));
        return response()->json(['success' => true, 'message' => 'Trainee data import successfully']);
    }
}
