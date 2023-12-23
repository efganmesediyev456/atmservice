@extends('layouts.auth')

@section('content')


    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">ATM (Admin)</h1>
            {{--        <p class="sign-up__subtitle">Sign in to your account to continue</p>--}}
            <form id="submit" style="width: 450px;" class="sign-up-form form" action="{{ route('admin.login') }}" method="POST">
                <label class="form-label-wrapper">
                    @csrf
                    <p class="form-label">Email</p>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <input name="email" class="form-input" type="email" placeholder="Enter your email" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Password</p>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <input name="password" class="form-input" type="password" placeholder="Enter your password" required>
                </label>
                {{--                <a class="link-info forget-link" href="##">Forgot your password?</a>--}}
                <label class="form-checkbox-wrapper">

                </label>
                <button onClick="onClick()" type="submit" class="form-btn primary-default-btn transparent-btn">Sign in</button>
            </form>
        </article>
    </main>

@endsection


@push('js')
    <script>
        $("#submit").on("submit", function (e){

            e.preventDefault();


            grecaptcha.ready(function() {
                grecaptcha.execute('{{config('app.RECAPTCHA_KEY')}}', {action: 'submit'}).then(function(token) {
                    $.ajax({
                        url:'{{route('admin.login')}}',
                        type:'post',
                        data:{
                            email:$('[name="email"]').val(),
                            password:$('[name="password"]').val(),
                            _token:'{{csrf_token()}}',
                            token:token
                        },
                        success:function (e){
                            toastr.success('Success')

                            setTimeout(function (){
                                window.location.href='/admin/dashboard'
                            }, 2000);
                        },
                        error:function (e){
                            for(a in e.responseJSON){
                                toastr.error(e.responseJSON[a])
                            }


                        }
                    })
                });
            });


        })

    </script>
@endpush
