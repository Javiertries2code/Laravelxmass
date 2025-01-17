
@extends('layouts.app')
@section('content')
<h1>student</h1>



<h1>Cursos de {{ $user->name }}</h1>

<table >
    <thead>
        <tr>
            <th>Course</th>
            <th>Subjects</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>
                    <ul>
                        @foreach ($course->subjects as $subject)
                            <li>{{ $subject->code }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
