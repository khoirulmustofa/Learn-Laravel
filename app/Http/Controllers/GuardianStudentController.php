<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuardianStudentController extends Controller
{
    function index()
    {
        try {
            $academicYear = 20232024;
            $semester = 1;
            $status = 'active';

            $students = Student::whereHas('classes', function ($query) use ($academicYear, $semester, $status) {
                $query->where('academic_year', $academicYear)
                    ->where('semester', $semester)
                    ->where('status', $status);
            })
                ->with(['classes' => function ($query2) use ($academicYear, $semester, $status) {
                    $query2->wherePivot('academic_year', $academicYear)
                        ->wherePivot('semester', $semester)
                        ->wherePivot('status', $status)
                        ->orderBy('name');
                }, 'guardians' => function ($query3) use ($academicYear, $semester, $status) {
                    $query3->with(['user']);
                }])
                ->orderBy('name')
                ->get();
            $data['students'] = $students;



            return  view('student', $data);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}


// with(['kbmPresensis' => function ($query) use ($jadwalId) {
//     $query->where('kbm_jadwal_id', $jadwalId);
// }])
//     ->whereHas('classes', function ($query) use ($classId, $academicYear, $semester, $status) {
//         $query->where('class_id', $classId)
//             ->where('academic_year', $academicYear)
//             ->where('semester', $semester)
//             ->where('status', $status);
//     })