@extends('layouts.guest')

@section('title', __('Register'))

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-8" style="max-width: 700px;">
            <div class="card shadow border-dark ">
                <div class="card-header fw-bold">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" {{-- action="{{ route('register') }}" --}} id="register_form">
                        @csrf
                        <div id="show_alert"></div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                <div class="invalid-feedback"></div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                <div class="invalid-feedback"></div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <div class="invalid-feedback"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="register_button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('#register_form').submit(function(e){
            e.preventDefault();
            $('#register_button').prop('disabled', true);
            $.ajax({
                url: '{{ route('register_ajax')}}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#register_button').prop('disabled', false);
                },
                success: function(r){
                    jshelper.success(r.messages);
                    $('#register_form')[0].reset();
                    removeValidationClasses("#register_form");
                    if(r.redirect){
                        setTimeout(function(){ window.location = r.redirect; }, 3000);
                    }
                },
                error: function (xhr) {
                    const parentForm = '#register_form';
                    if (xhr.status === 422) { //Unprocessable Entity.
                        let m = xhr.responseJSON.messages;
                        $.each(m, function(key, value) {
                            showError(` #${key}`,value, parentForm);   // Display error messages for each input field individually
                        });
                    } else {
                        console.log(xhr);
                        jshelper.handleError(xhr);
                    }
                },
                complete: function() {
                    $(`#register_button`).prop("disabled",false);
                },
            });
        });
    });
</script>
@endsection
