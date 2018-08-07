

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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Сброс пароля') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Адрес') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Отправить ссылку сбросить пароль') }}
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
