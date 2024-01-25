<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Agregar {{ __('User') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="add_user_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg">
                            <label for="name" class="fw-500 fs-rem-80">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Nombre">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="email" class="fw-500 fs-rem-80">{{__("Email")}} <span class="text-danger">*</span></label>
                            <input type="text" name="email" id="email" class="form-control rounded-0" placeholder="{{__("Email")}}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="password" class="fw-500 fs-rem-80">{{__('Password')}} <span class="text-danger">*</span></label>
                            <input type="text" name="password" id="password" class="form-control rounded-0" placeholder="{{__('Password')}}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="password_confirmation" class="fw-500 fs-rem-80">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <input type="text" name="password_confirmation" id="password_confirmation" class="form-control rounded-0" placeholder="{{ __('Confirm Password') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="roles" class="fw-500 fs-rem-80">Roles<span class="text-danger">*</span></label>
                            <select class="form-select" id="roles" name="roles[]" multiple="multiple"></select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="add_user_btn" class="btn btn-outline-primary rounded-0">Agregar {{ __('User') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
