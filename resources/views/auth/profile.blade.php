@extends('layouts.app')

@section('title', __('Profile'))

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow border-dark">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="text-secondary {{__('Profile')}}">{{__('Profile')}}</h3>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-4 px-5 text-center" style="border-right: 1px solid #999;">
                            <img src="{{ $reg->foto ? 'storage/images/'.$reg->foto: asset('imgs/profile.png') }}" id="image_preview" class="img-fluid rounded-circle img-thumbnail" width="200">
                            <div>
                                <label for="foto">Cambiar foto de perfil</label>
                                <input type="file" name="foto" id="foto" class="form-control rounded-pill">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $reg->id }}">
                        <div class="col-lg-8">
                            <form action="#" method="POST" id="profile_form">
                                @csrf
                                <div class="my-2">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control rounded-0" value="{{ $reg->name }}">
                                </div>

                                <div class="my-2">
                                    <label for="email">Correo electrónico</label>
                                    <input type="email" name="email" id="email" class="form-control rounded-0" value="{{ $reg->email }}">
                                </div>

                                <div class="row">
                                    <div class="col-lg">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-select rounded-0">
                                            <option value="" selected disabled>-Select-</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-lg">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" id="dob" class="form-control rounded-0" value="">
                                    </div>
                                </div>

                                <div class="my-2">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control rounded-0" value="{{ $reg->telefono }}">
                                </div>

                                <div class="my-2">
                                    <input type="submit" id="profile_button" class="btn btn-secondary rounded-0 float-end" value="Actualizar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(function() {
        $('#foto').change(function(e){
            const file = e.target.files[0];
            let url = window.URL.createObjectURL(file);
            $('#image_preview').attr('src',url);
            let fd = new FormData();
            fd.append('foto', file);
            fd.append('user_id', $('#user_id').val());
            //fd.append('_token','');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('profile_image')}}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (r){
                    if(r.status == 200){
                        jshelper.success(r.messages);
                    } else {
                        console.log(r);
                        jshelper.failure();
                    }
                },
            });
        });
        $('#profile_form').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: '{{ route('profile_ajax')}}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function(){
                    $('#login_button').prop('disabled', true);
                },
                success: function(r){
                    if(r.status == 400) {
                        showError('#email',r.messages.email);
                        showError('#password',r.messages.password);
                        $('#login_button').prop('disabled', false);
                    } else if (r.status == 200) {
                        jshelper.success(r.messages);
                        $('#profile_form')[0].reset();
                        removeValidationClasses("#profile_form");
                    } else if (r.status == 401) {
                        jshelper.error(r.messages);
                    } else {
                        console.log(e);
                        jshelper.failure();
                    }

                    if(r.redirect){
                        setTimeout(function(){ window.location = r.redirect; }, 3000);
                    }

                },
                error: function (e) {
                    jshelper.failure();
                },
                complete: function() {
                    $(`#login_button`).prop("disabled",false);
                },
            });
        });
    });
</script>
@endsection
