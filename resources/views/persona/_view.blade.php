<style>
input:disabled {
   background-color: red;
}
</style>
<div class="modal fade" id="viewPersonaModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-secondary" id="exampleModalLabel">{{ __('View') }} Persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="view_persona_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="emp_avatar" id="emp_avatar">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg">
                            <label for="primer_nombre" class="fw-500 fs-rem-80">Primer Nombre</label>
                            <input type="text" id="primer_nombre" class="form-control rounded-0 bg-white" disabled readonly>
                        </div>
                        <div class="col-lg">
                            <label for="segundo_nombre" class="fw-500 fs-rem-80">Segundo Nombre</label>
                            <input type="text" id="segundo_nombre" class="form-control rounded-0 bg-white" disabled readonly>
                        </div>
                        <div class="col-lg">
                            <label for="tercer_nombre" class="fw-500 fs-rem-80">Tercer Nombre</label>
                            <input type="text" id="tercer_nombre" class="form-control rounded-0 bg-white" disabled readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="primer_apellido" class="fw-500 fs-rem-80">Primer Apellido</label>
                            <input type="text" id="primer_apellido" class="form-control rounded-0 bg-white" disabled readonly>
                        </div>
                        <div class="col-lg">
                            <label for="segundo_apellido" class="fw-500 fs-rem-80">Segundo Apellido</label>
                            <input type="text" id="segundo_apellido" class="form-control rounded-0 bg-white" disabled readonly>
                        </div>
                        <div class="col-lg">
                            <label for="apellido_casada" class="fw-500 fs-rem-80">Apellido Casada</label>
                            <input type="text" id="apellido_casada" class="form-control rounded-0 bg-white" disabled readonly>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email" class="fw-500 fs-rem-80">E-mail</label>
                        <input type="text" id="email" class="form-control rounded-0 bg-white" disabled readonly>
                    </div>
                    <div class="my-2">
                        <label for="telefono">Phone</label>
                        <input type="text" id="telefono" class="form-control rounded-0 bg-white" disabled readonly>
                    </div>
                    <div class="my-2">
                        <label for="post">Post</label>
                        <input type="text" id="post" class="form-control rounded-0 bg-white" disabled readonly>
                    </div>
                    <div class="my-2">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" class="form-control rounded-0 bg-white" disabled readonly>
                    </div>
                    <div class="mt-2" id="avatar">

                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
