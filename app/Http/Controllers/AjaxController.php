<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //

    public function verify_account(Request $request)
    {

        $user =  User::findOrFail($request->id);
        $status = $request->status == 1? false : true;

        $user->update(['is_verified' => $status, 'status_is' => $status ? 'active' : 'inactive']);
        $user->save();

        $title = $user->is_verified ? 'Verified' : 'Unverified';
        $message = $user->fullname .' has been ' .( $user->is_verified ? 'verified' : 'unverified');
        $level = 'success';
        $status_is = $user->is_verified ? 1 : 0;

        return response()->json([   'status' => 'ok',
                                    'code' => 200,
                                    'data' => [
                                                'title'     => $title,
                                                'message'   => $message,
                                                'level'     => $level,
                                                'status_is'    => $status_is
                                            ]]);
    }
}
