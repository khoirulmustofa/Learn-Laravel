<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## Many to Many Relationships

```php

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

```



