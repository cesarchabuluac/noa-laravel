<div>
    <a href="#restoreModal-{{$attributes['model']}}" {{ $attributes->merge(['class' => 'restore-button', 'data-bs-effect' => 'effect-fall', 'data-bs-toggle' => 'modal', 'data-target' => '#restoreModal-' . $attributes['model']]) }}>
        <i class="fe fe-check"></i>
    </a>
    <div class="modal fade" id="restoreModal-{{$attributes['model']}}" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Confirmar activación</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>¿Estás seguro de que deseas activar este registro?</h6>
                </div>               
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ $attributes['action'] }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success">Activar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>