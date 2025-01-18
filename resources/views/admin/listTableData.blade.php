@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size:1.5rem">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif
        {{-- probando tabla "a rayas" --}}
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            @foreach ($headers as $key => $header)
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {!! Str::limit($item->{$key}, 200) !!}
                                </td>
                            @endforeach
                            <td>
                                @if (isset($actions['delete']))
                                    <!-- Botón para eliminar -->
                                    <form action="{{ route($actions['delete'], ['id' => $item->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminar esta fila? {{ $item->id }}?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif

                                @if (isset($actions['edit']))
                                    <!-- Botón para editar -->
                                    <form action="{{ route($actions['edit'], ['id' => $item->id]) }}" method="GET" style="display: inline-block;">
                                        <button class="btn btn-sm btn-primary" type="submit">
                                            Editar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div>    {{ $data->links() }} --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $data->links() }}
        </div>

    </div>
@endsection

