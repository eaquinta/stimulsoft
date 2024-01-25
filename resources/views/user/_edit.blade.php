<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-dark">
      <div class="modal-header bg-light">
        <h5 class="modal-title text-secondary" id="exampleModalLabel">{{ __('Edit')}} User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_user_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4">
          <div class="row">
            <div class="col-lg">
              <label for="name" class="fw-500 fs-rem-80">Nombre</label>
              <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Nombre">
              <div class="invalid-feedback"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <label for="email" class="fw-500 fs-rem-80">Email</label>
              <input type="text" name="email" id="email" class="form-control rounded-0" placeholder="Email">
              <div class="invalid-feedback"></div>
            </div>
          </div>

          {{-- <div class="row row-cols-xs-1 row-cols-md-2 row-cols-lg-3 mt-3">
                <div class="col mb-3">
                    <div class="card border-dark mb-3">
                        <div class="card-header bg-light" id="headingBlog">
                            <h3 class="mb-0 text-secondary">
                              Permisos <i class="fas fa-pull-right fa-key"></i>
                            </h3>
                        </div>
                        <div id="collapseBlog" aria-labelledby="headingBlog">
                            <div class="list-group list-group-flush">
                                <label for="" class="list-group-item list-group-item-action">
                                    <input type="checkbox" name="permissions[]" value="1"> Permiso Nombre
                                </label>
                              <a class="list-group-item list-group-item-action" href="#"><i class="fas fa-hand-holding"></i> Solicitud Pedidos</a>
                              <a class="list-group-item list-group-item-action" href="#"><i class="fas fa-hand-holding"></i> Ordenes de Compra</a>
                              <a class="list-group-item list-group-item-action" href="#"><i class="fas fa-hand-holding"></i> Solicitud Despacho</a>
                              <a class="list-group-item list-group-item-action" href="#"><i class="fas fa-hand-holding"></i> Solicitud Materiales Sala</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div> --}}
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">{{ __('Close')}}</button>
          <button type="submit" id="edit_user_btn" class="btn btn-outline-success rounded-0">{{ __('Update')}} User</button>
        </div>
      </form>
    </div>
  </div>
</div>
