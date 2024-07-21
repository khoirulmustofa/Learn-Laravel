<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## One to One

`User.php` model:

```php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Define the relationship between the given user and its profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
```

`Profile.php` model:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Define the relationship between the given profile
     * and the user it belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```


## One to Many

`User.php` model:

```php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Define the relationship between the given user and the posts he/she created.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

`Post.php` model:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Define the relationship between the given post
     * and the user it was created by.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```


## Many to Many Relationships

### Controller

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

### View

```php

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Many To Many</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container">

    <div class="row">
        <div class="col-6">
            <table class="table table-bordered table-striped">
                @foreach ($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->students->count() }}</td>
                    <td>
                        <ol>
                            @foreach($class->students as $student)
                            <li>{{ $student->name }}


                                {{ $student->asramas->first()?->name}}


                            </li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-6">
            <table class="table table-bordered table-striped">
                @foreach ($asramas as $asrama)
                <tr>
                    <td>{{ $asrama->name }}</td>
                    <td>{{ $asrama->teachers->first()?->name }}</td>
                    <td>{{ $asrama->teachers->first()?->profile->website_url }}</td>
                    <td>{{ $asrama->students->count() }}</td>
                    <td>
                        <ol>
                            @foreach($asrama->students as $student)
                            <li>{{ $student->name }}
                            </li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
    <hr>
    <table class="table table-bordered table-striped">
        <tr>
            <td>{{ $asramaSingle->name}}</td>
            <td>{{ $asramaSingle->students->count() }}
                <hr>

                <ol>
                    @foreach($asramaSingle->students as $student)
                    <li>{{ $student->name }} - {{ $student->classes->first()?->name}}
                    </li>
                    @endforeach
                </ol>
            </td>
        </tr>

    </table>

    <h2>Student Information</h2>
    @if($studentSingle)
    <p>Name: {{ $studentSingle->name }}</p>
    <p>Classes:</p>
    <ul>
        @foreach($studentSingle->classes as $class)
        <li>{{ $class->name }} ({{ $class->pivot->academic_year }}, {{ $class->pivot->semester }}, {{ $class->pivot->status }})</li>
        @endforeach
    </ul>
    <p>Asrama:</p>
    <ul>
        @php
        $asrm = $studentSingle->asramas->first();
        @endphp
        <li>{{ $asrm->name }} ({{ $asrm->pivot->academic_year }}, {{ $asrm->pivot->semester }}, {{ $asrm->pivot->status }})</li>

    </ul>
    @else
    <p>Student with ID 1 not found.</p>
    @endif

    <hr>

    <div class="row">
        <div class="col-6">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Kelas</th>
                    <th>Aarama</th>
                    <th>Wali Asrama</th>
                </tr>
                @foreach ($students as $student)
                <tr>
                    <td>
                        {{ $student->name }}
                    </td>
                    <td> {{ $student->classes->first()->name }}</td>
                    <td> {{ $student->asramas->first()->name }}</td>
                    <td> {{ $student->asramas->first()?->teachers->first()?->name }}</td>

                </tr>
                @endforeach


            </table>
        </div>
        <div class="col-6">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Kelas</th>
                    <th>Aarama</th>
                    <th>Wali Asrama</th>
                </tr>
                @foreach ($studentsSorted as $val)
                <tr>

                    <td> {{ $val['name'] }}</td>
                    <td> {{ $val['class'] }}</td>
                    <td> {{ $val['asrama'] }}</td>
                    <td>
                        {{ $val['teacher'] }}
                    </td>

                </tr>
                @endforeach


            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

```
