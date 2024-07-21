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