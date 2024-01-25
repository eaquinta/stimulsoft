<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Persona</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" id="add_persona_form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body p-4">
            <div class="row">
              <div class="col-lg">
                <label for="primer_nombre" class="fw-500 fs-rem-80">Primer Nombre <span class="text-danger">*</span></label>
                <input type="text" name="primer_nombre" id="primer_nombre" class="form-control rounded-0" placeholder="Primer Nombre">
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-lg">
                <label for="segundo_nombre" class="fw-500 fs-rem-80">Segundo Nombre</label>
                <input type="text" name="segundo_nombre" class="form-control rounded-0" placeholder="Segundo Nombre">
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-lg">
                  <label for="tercer_nombre" class="fw-500 fs-rem-80">Tercer Nombre</label>
                  <input type="text" name="tercer_nombre" class="form-control rounded-0" placeholder="Tercer Nombre">
                  <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <label for="primer_apellido" class="fw-500 fs-rem-80">Primer Apellido <span class="text-danger">*</span></label>
                <input type="text" name="primer_apellido" id="primer_apellido" class="form-control rounded-0" placeholder="Primer Apellido">
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-lg">
                <label for="segundo_apellido" class="fw-500 fs-rem-80">Segundo Apellido</label>
                <input type="text" name="segundo_apellido" class="form-control rounded-0" placeholder="Segundo Apellido">
              </div>
              <div class="col-lg">
                  <label for="apellido_casada" class="fw-500 fs-rem-80">Apellido Casada</label>
                  <input type="text" name="apellido_casada" class="form-control rounded-0" placeholder="Apellido Casada">
                </div>
            </div>
            <div class="my-2">
              <label for="email" class="fw-500 fs-rem-80">E-mail</label>
              <input type="email" name="email" class="form-control rounded-0" placeholder="E-mail">
            </div>
            <div class="my-2">
              <label for="telefono" class="fw-500 fs-rem-80">Phone</label>
              <input type="tel" name="telefono" class="form-control rounded-0" placeholder="Phone">
            </div>
            <div class="my-2">
              <label for="post" class="fw-500 fs-rem-80">Post</label>
              <input type="text" name="post" class="form-control rounded-0" placeholder="Post">
            </div>
            <div class="my-2">
              <label for="foto" class="fw-500 fs-rem-80">Foto de Perfil</label>
              <input type="file" name="foto" class="form-control rounded-0">
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" id="add_persona_btn" class="btn btn-outline-primary rounded-0">Agregar Persona</button>
          </div>
        </form>
      </div>
    </div>
  </div>
