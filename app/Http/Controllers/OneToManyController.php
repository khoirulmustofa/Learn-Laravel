<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OneToManyController extends Controller
{
    function index()
    {
        try {

            $data['users'] = User::with(['profile', 'posts' => function ($query) {
                $query->with(['tags' => function ($query2) {
                    $query2->with(['subTag']);
                }]);
            }])->get();
            return  view('one_to_many', $data);
            //code...
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }
}
