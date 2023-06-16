<div>
    <a href="#deleteModal-{{$attributes['model']}}" {{ $attributes->merge(['class' => 'delete-button', 'data-bs-effect' => 'effect-fall', 'data-bs-toggle' => 'modal', 'data-target' => '#deleteModal-' . $attributes['model']]) }}>
        <i class="fe fe-trash"></i>
    </a>
    <div class="modal fade" id="deleteModal-{{$attributes['model']}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>¿Estás seguro de que deseas eliminar este registro?</h6>
                </div>               
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ $attributes['action'] }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>