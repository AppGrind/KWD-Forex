<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BtnController extends Controller
{

    public static function delete($id, $url='', $size=true, $name=null, $class='', $message='Delete action is not reversible!', $tooltip='Delete')
    {
        # code...
        return view('layouts.delete', compact('id', 'url', 'size', 'name', 'message', 'class', 'tooltip'))->render();
    }

    public static function ajax_delete($id, $url='', $size=true, $name=null, $message='Delete action is not reversible!')
    {
        # code...
        return view('layouts.delete', compact('id', 'url', 'size', 'name', 'message'))->render();
    }
}
