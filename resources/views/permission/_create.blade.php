<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Permission</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="add_permission_form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body p-4">
            <div class="row">
              <div class="col-lg">
                <label for="name" class="fw-500 fs-rem-80">Nombre Permiso<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Nombre Permiso" autofocus>
                <div class="invalid-feedback"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" id="add_permission_btn" class="btn btn-outline-primary rounded-0">Agregar Permission</button>
          </div>
        </form>
      </div>
    </div>
  </div>
