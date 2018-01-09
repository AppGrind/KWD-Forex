<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserProfileUpdatedEmail;
use App\Mail\UserProfileUpdatedEmail;
use App\Notifications\NotifyProfileUpdated;
use Hash;
use Gate;
use Validator;
use App\Http\Requests\UsersFormRequest;
use App\Http\Requests\UsersUpdateFormRequest;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('su', ['except'=>['show', 'edit', 'update', 'verify_account', 'update_password', 'edit_password']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('backend.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        if (!Auth::user()->is_verified) {
            return redirect('/verification');
        }

        if(Gate::denies('owner-or-admin', $user->id)) {
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        $editBtn = ['title'=>'Edit Profile', 'action' => 'users/' . $user->id . '/edit', 'icon' => 'icon md-edit'];
        $passwordBtn = ['title'=>'Change Password', 'action' => route('password.edit', $user->id), 'icon' => 'icon md-key'];
        $buttons =[];
        array_push($buttons, $editBtn, $passwordBtn);

        return view('backend.users.show', compact('user', 'buttons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if (!Auth::user()->is_verified) {
            return redirect('/verification');
        }

        if(Gate::denies('owner-or-admin', $user->id)){
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        $msgBtn = ['title'=>'Messages', 'action' => 'notifications', 'icon' => 'icon md-email-open'];
        $viewBtn = ['title'=>'View Profile', 'action' => 'users/' . $user->id . '/edit', 'icon' => 'icon md-edit'];
        $buttons =[];
        array_push($buttons, $msgBtn, $viewBtn);
        return view('backend.users.edit', compact('user', 'buttons'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersUpdateFormRequest $request, User $user)
    {

        if (!Auth::user()->is_verified) {
            return redirect('/verification');
        }

        if(Gate::denies('owner-or-admin', $user->id)){
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }
        $user->update($request->all());
        $user->save();

        SendUserProfileUpdatedEmail::dispatch($user);
        $user->notify(new NotifyProfileUpdated());

        flash('Changes saved successfully!', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!Auth::user()->is_verified) {
            return redirect('/verification');
        }

        if(Gate::denies('admin', $id)){
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        $user = User::findOrFail($id);
        $user->delete();

        flash('User deleted successfully', 'success');
        return redirect('dashboard');
    }


    public function verify_account(Request $request)
    {

        if(Auth::user()->code == trim(strtoupper($request['code']), " ")){
            $user = Auth::user();
            $user->update(['is_verified'=>true, 'status_is'=>'active']);
            $user->save();
            flash('Account verified successfully', 'success');
            return redirect('dashboard');
        }else{
            flash('Please check your code and try again!', 'error');
            return back();
        }
    }

    public function edit_password(User $user)
    {
        if(Gate::denies('owner', $user->id)){
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        return view('auth.passwords.update');
    }

    public function update_password(Request $request, User $user)
    {
        if(Gate::denies('owner', $user->id)){
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

//        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            // Here's how our new validation rule is used.
            'old_password' => 'hash:' . $user->password,
            'password' => 'required|different:old_password|min:6|max:12|confirmed'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $user->password = Hash::make($request['password']);
        $user->save();

        flash('Your password was updated successfully!', 'success');
        return redirect()->route('dashboard');
    }

}
