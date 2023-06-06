<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\CustomFileUpload;
use App\Rules\MatchOldPassword;
use App\Models\User;

class ProfileController extends Controller
{
    use CustomFileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = User::where('id',Auth::id())->first();
        $page = 'Profile';
        return view('super-admin.profile.index',compact('page','profile'));
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
        $validated = request()->validate([
            'name' => 'required',
        ]);
        $profile = User::find($id);
        $data = $request->only('name');

        if ($request->hasFile('image')) {
            $this->deleteFile($profile->image, 'public/profile/');
            $data['image'] = $this->uploadFile($request->image, 'profile');
        }
        User::find($id)->update($data);
        return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return response()->json(['success' => false, 'message' => 'Current password wrong!']);
        }
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return response()->json(['success' => true, 'message' => 'Password changed successfully.']);
        // dd('Password change successfully.');
    }
}
