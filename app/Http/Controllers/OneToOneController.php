<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OneToOneController extends Controller
{
    function index()
    {
        try {

            $data['users'] = User::with('profile')->get();
            return  view('one_to_one',$data);
            //code...
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }
}
