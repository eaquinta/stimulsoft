<style>
input:disabled {
   background-color: red;
}
</style>
<div class="modal fade" id="viewPermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-secondary" id="exampleModalLabel">{{ __('View') }} Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="view_permission_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="emp_avatar" id="emp_avatar">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg">
                            <label for="name" class="fw-500 fs-rem-80">Nombre</label>
                            <input type="text" id="name" class="form-control rounded-0 bg-white" disabled readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
