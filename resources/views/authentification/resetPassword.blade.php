{{-- <!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de votre mot de passe</title>
</head>
<body>
    <h1>Réinitialiser votre mot de passe</h1>

    @if ($errors->any())
        <div>
            <strong>Oups !</strong> Il y a eu des problèmes avec votre entrée.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/resetPassword" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirmez le mot de passe :</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Réinitialiser le mot de passe</button>
    </form>
</body>
</html> --}}




<!doctype html>
<html lang="en">
  <head>
    <title>Authentification Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Lien pour Plus Jakarta Sans -->
    <link rel="shortcut icon" type="image/png" href="{{asset('../assets/images/logos/logo_head.png')}}" width="32" height="32" />
    <link rel="stylesheet" href="{{asset('../assets/css/styles.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style1.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets1/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styleAutehtification.css')}}">

    <!-- Add custom styles for width -->
    <style>
      .login-wrap {
        width: 50%; /* Ajustez la largeur ici */
        margin: 0 auto; /* Centre le bloc */
      }
    </style>
  </head>
  <body>
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-5">
            @if ($errors->any())
            <div class="error">
                <strong>Oups !</strong> Il y a eu des problèmes avec votre entrée.<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
              <div class="img" style="background-image: url({{asset('assets1/images/bg-2.png')}});"></div>
              <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                  <div class="w-100">
                    <h3 class="mb-4">Renitialisation de mots de passe</h3>
                  </div>
                  {{-- <div class="w-100">
                    <p class="social-media d-flex justify-content-end">
                      <a href="/viewAuthentificationAdmin/facebook" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                    </p>
                  </div> --}}
                </div>
                <form action="/resetPassword" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group mb-3">
                        <label class="label" for="name">Entrer votre nouveau mots de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="label" for="name">Confirmer votre mots de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>


                  <div class="form-group d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="{{asset('assets1/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets1/js/popper.js')}}"></script>
    <script src="{{asset('assets1/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets1/js/main.js')}}"></script>
  </body>
</html>