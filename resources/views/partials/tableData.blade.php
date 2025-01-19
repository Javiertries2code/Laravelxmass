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
                            <form action="{{ route($actions['delete'], ['id' => $item->id]) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modal-javichu" data-id="{{ $item->id }}">
                                    <i class="bi bi-trash-fill"></i>

                                </button>
                            </form>
                        @endif

                        @if (isset($actions['edit']))
                            <!-- Botón para editar -->
                            <form action="{{ route($actions['edit'], ['id' => $item->id]) }}" method="GET"
                                style="display: inline-block;">
                                <button class="btn btn-sm btn-primary" type="submit">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-5 d-flex justify-content-center">
    {{ $data->links('pagination::bootstrap-5') }}
</div>

{{-- Logica para motrar un modal de confirmacion antes de borrar --}}
@include('partials.modal')
<script>
    let currentForm = null;
    document.addEventListener('DOMContentLoaded', function() {

        // init constantes
        const confirmDeleteModal = document.getElementById('modal-javichu');
        const confirmDeleteButton = document.getElementById('confirm-modal-btn');

        // accion al abrir el modal
        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botón que activó el modal
            const itemId = button.getAttribute('data-id'); // ID del elemento
            currentForm = button.closest('form'); // Formulario correspondiente

            // Actualiza el modal con el ID del elemento
            modalItemId.textContent = itemId;
        });

        // Maneja el botón de confirmación dentro del modal
        confirmDeleteButton.addEventListener('click', function() {
            if (currentForm) {
                currentForm.submit(); // Envía el formulario seleccionado
            }

        });
    });
</script>
