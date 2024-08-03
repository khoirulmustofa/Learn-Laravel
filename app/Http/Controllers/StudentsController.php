<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {

        // return view('students.index');
        return $dataTable->render('students.index');
    }


}
