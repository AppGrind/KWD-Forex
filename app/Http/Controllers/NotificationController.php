<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        //
        $notification = Auth::user()->notifications->where('id', $id)->first();
        if($notification == null){
            flash('Only the owner can read the full contents!', 'warning');
            return back();
        }
        if($notification->markAsRead() == null){
            $notification->markAsRead();
        }

        return view('backend.notifications.show', compact('notification'));
//        dd($notification->data['sender']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $notification = Auth::user()->notifications->where('id', $id)->first();
        if($notification == null){
            flash('Only the owner can delete this!', 'warning');
            return back();
        }
        $notification->delete();

        flash('Notification deleted!', 'success');
        return redirect()->route('users.show', Auth::id());
    }
}
