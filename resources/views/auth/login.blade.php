{{-- @extends('adminlte::auth.login') --}}


@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<div class="container  p-5 m-17">
@if (session('error'))
<div class="alert alert-danger" role="error">
    {{ session('error') }}
</div>
@endif
    <div class="card">
        <div class="card-body">
            <div class="fluid h-loginv2">
                <div class="row d-flex justify-content-center align-items-center h-50">
                  <div class="col-5">
                    <img title="Logo" src="vendor/adminlte/dist/img/SGNAN.png" class="rounded mx-auto m-10 p-10" alt="Sample image">
                  </div>

                  <div class="col-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                      <!-- Email input -->
                      <div class="form mb-4">
                        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 88.8px;"></div><div class="form-notch-trailing">

                            <input title="Campo de Correo" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </div>
                            </div>
                        </div>



                      <!-- Password input -->
                      <div class="form mb-3">
                        <input  title="Campo de Contraseña" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('adminlte::adminlte.password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror



                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64.8px;"></div><div class="form-notch-trailing"></div></div></div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button  title="Iniciar Sessión" type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                <span class="fas fa-sign-in-alt"></span>
                                {{ __('adminlte::adminlte.sign_in') }}
                            </button>
                        </div>
                            {{-- Password reset link --}}
                            @if($password_reset_url)
                                <p class="my-0">
                                    <a  title="Recuperar mi Contraseña" href="{{ $password_reset_url }}">
                                        {{ __('adminlte::adminlte.i_forgot_my_password') }}
                                    </a>
                                </p>
                            @endif
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>


