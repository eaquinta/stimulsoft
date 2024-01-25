<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-dark">
      <div class="modal-header bg-light">
        <h5 class="modal-title text-secondary" id="exampleModalLabel">{{ __('Edit')}} Permission</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_permission_form" enctype="multipart/form-data">
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
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">{{ __('Close')}}</button>
          <button type="submit" id="edit_permission_btn" class="btn btn-outline-success rounded-0">{{ __('Update')}} Permission</button>
        </div>
      </form>
    </div>
  </div>
</div>
