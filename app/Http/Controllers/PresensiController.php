<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PresensiController extends Controller
{
    function index()
    {
        try {
            $academicYear = 20232024;
            $semester = 1;
            $status = 'active';
            $classId = 1;
            $jadwalId = 1;

            $students = Student::with(['kbmPresensis' => function ($query) use ($jadwalId) {
                $query->where('kbm_jadwal_id', $jadwalId);
            }])
                ->whereHas('classes', function ($query) use ($classId, $academicYear, $semester, $status) {
                    $query->where('class_id', $classId)
                        ->where('academic_year', $academicYear)
                        ->where('semester', $semester)
                        ->where('status', $status);
                })
                ->orderBy('name')
                ->get();
            $data['students'] = $students;

            $reportStudents = Student::with(['kbmPresensis' => function ($query) {
                $query->select(
                    'student_id',
                    DB::raw("COUNT(IF(presence = 'H', 1, NULL)) AS hadir"),
                    DB::raw("COUNT(IF(presence = 'S', 1, NULL)) AS sakit")
                )
                    ->groupBy('student_id');
            }])
                ->whereHas('classes', function ($query) use ($classId, $academicYear, $semester, $status) {
                    $query->where('class_id', $classId)
                        ->where('academic_year', $academicYear)
                        ->where('semester', $semester)
                        ->where('status', $status);
                })
                ->orderBy('name')
                ->get();

                $data['reportStudents'] = $reportStudents;

            return  view('presensi', $data);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
