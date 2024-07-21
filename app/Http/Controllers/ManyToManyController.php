<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\ClassModel;
use App\Models\Student;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManyToManyController extends Controller
{
    function index()
    {
        try {
            $academicYear = 20232024;
            $semester = 1;
            $status = 'active';

            $data['classes'] = ClassModel::with(['students' => function ($query) use ($academicYear, $semester, $status) {
                $query->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->wherePivot('status', $status)
                    ->orderBy('name')
                    ->with(['asramas' => function ($query2) use ($academicYear, $semester, $status) {
                        $query2->wherePivot('academic_year', $academicYear)
                            ->wherePivot('semester', $semester)
                            ->wherePivot('status', $status);
                    }]);
            }])->get();

            $data['asramas'] = Asrama::with(['students' => function ($query) use ($academicYear, $semester, $status) {
                $query->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->wherePivot('status', $status)
                    ->orderBy('name');
            }, 'teachers' => function ($query3) use ($academicYear, $semester) {
                $query3->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->with('profile');
            }])->get();

            $data['asramaSingle'] = Asrama::with(['students' => function ($query) use ($academicYear, $semester, $status) {
                $query->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->wherePivot('status', $status)
                    ->orderBy('name')
                    ->with(['classes' => function ($query2) use ($academicYear, $semester, $status) {
                        $query2->wherePivot('academic_year', $academicYear)
                            ->wherePivot('semester', $semester)
                            ->wherePivot('status', $status);
                    }]);
            }])->find(17);

            $data['studentSingle'] = Student::with(['classes' => function ($query) use ($academicYear, $semester, $status) {
                $query->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->wherePivot('status', $status);
            }, 'asramas' => function ($query) use ($academicYear, $semester, $status) {
                $query->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->wherePivot('status', $status);
            }])->find(1);

            $students  = Student::with(['classes' => function ($query4) use ($academicYear, $semester, $status) {
                $query4->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->wherePivot('status', $status)
                    ->orderBy('name');
            }, 'asramas' => function ($query5) use ($academicYear, $semester, $status) {
                $query5->wherePivot('academic_year', $academicYear)
                    ->wherePivot('semester', $semester)
                    ->wherePivot('status', $status)
                    ->with(['teachers' => function ($query3) use ($academicYear, $semester) {
                        $query3->wherePivot('academic_year', $academicYear)
                            ->wherePivot('semester', $semester)
                            ->with('profile');
                    }]);
            }])
                ->orderBy('name')
                ->get();

            $data['students'] =  $students;

            $studentsMap = $students->map(function ($student) {
                return [
                    'name' => $student->name,
                    'class' => $student->classes->first()->name,
                    'asrama' => optional($student->asramas->first())->name,
                    'teacher' => optional(optional($student->asramas->first())->teachers->first())->name,
                ];
            });
            // $collection = collect($studentsMap);
            // $data['studentsSorted'] = $collection->sortBy([
            //     ['class', 'asc'],
            //     ['name', 'asc'],
            // ])->contains('class', 'A');

            // Filter collection where class contains 'A'
            // $filteredStudents = $studentsMap->filter(function ($student) {
            //     return strpos($student['class'], 'A') !== false;
            // });

            // Sort the filtered collection by class and name
            $data['studentsSorted'] = $studentsMap->sortBy([
                ['class', 'asc'],
                ['name', 'asc'],
            ]);

            // return  response()->json($data);
            return  view('many_to_many', $data);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
