<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
</head>
<body>
    <h1>Lista de Estudiantes</h1>
    <table>
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    @foreach($student as $key => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                    <td>
                        <li class="pt-1">
                            <div class="d-flex flex-row">

            <form action="{{ route('admin.editStudent', ['id' => $student['id']]) }}" method="GET">
                                    @csrf
                                    @method('UPDATE')
                                    <button class="btn btn-sm btn-danger" type="submit"
                                    onclick="return confirm('Are you sure?')">Editar
                                    </button>

                            <form action="{{route('admin.deleteStudent',$value)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"
                            onclick="return confirm('Are you sure?')">Delete
                            </button>
                            </form>
                            </div>
                            </li>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
