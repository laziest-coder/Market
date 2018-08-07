
<link rel="icon" type="image/png" href="{{ asset('img/fr.png') }}">
<title>Login | Register </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
  .main {
    background-image: url("{{ asset('img/loginpage.jpg') }}");

    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .card {
    margin-top: 150px;
  }

  .reg {
    display: none;
  }
  .tui {
    border: 0px;
    width: 50%;
    padding: 10px;
    background-color: rgba(0, 0, 0, 0.00);
  }
  .card-header {
    display: inline-flex;
  }
</style>
<script>
  function register(e)
  {
      if(e.target.id == 'log'){
        document.getElementById("register").style.display = "none";
        document.getElementById("login").style.display = "block";
      }else if(e.target.id == 're'){
        document.getElementById("register").style.display = "block";
        document.getElementById("login").style.display = "none";
      }
  }
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
<div class="main">
<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-8 rel">
            <div class="card">
                <div class="card-header">
                  <button class="tui" id="log" onclick="register(event)">Вход в систему</button>
                  <button class="tui" id="re" onclick="register(event)">Регистрация</button>
                </div>
                <div class="card-body" id="login">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-mail адресс:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Вход') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Забыли свой пароль?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body reg" id="register">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-righ"> </label>
                          <div class="col-md-8">
                            <input type="radio" name="role" id="user" value="customer">
                            <label for="customer">Клиент</label>
                            <input type="radio" name="role" id="user" value="seller">
                            <label for="seller">Поставщик</label>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя:') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердите пароль:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary form" onclick="submit()">
                                    {{ __('Регистрироваться') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
