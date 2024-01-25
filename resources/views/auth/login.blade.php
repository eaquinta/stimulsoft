@extends('layouts.guest')

@section('title', __('Log In'))

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 col-lg-6" style="max-width: 700px;">
            <div class="card shadow border-dark">
                <div class="card-header fw-bold">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="login_form">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text{{-- email --}}" class="form-control rounded-0" name="email" value="" {{-- required --}} autocomplete="{{__('email')}}" placeholder="{{__('Email')}}" autofocus>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control rounded-0" name="password" {{-- required --}} placeholder="{{__('password')}}" autocomplete="current-password">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary rounded-0" id="login_button">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
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
        $('#login_form').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: '{{ route('login_ajax')}}',
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
                        $('#login_form')[0].reset();
                        removeValidationClasses("#login_form");
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
                error: function (xhr) {
                    const parentForm = '#login_form';
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
                    $(`#login_button`).prop("disabled",false);
                },
            });
        });
    });
</script>
@endsection
