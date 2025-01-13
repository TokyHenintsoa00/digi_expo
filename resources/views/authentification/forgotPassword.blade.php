{{-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        input[type="email"], button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Mot de passe oublié</h2>

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

    <form action="/sendResetLink" method="POST">
        @csrf
        <div>
            <label for="email">Adresse e-mail :</label>
            <input type="email" name="email" required>
        </div>
        <button type="submit">Envoyer le lien de réinitialisation</button>
    </form>

    <p style="text-align: center;">
        <a href="{{ route('viewAuthentificationAdmin') }}">Retour à la connexion</a>
    </p>
</div>

</body>
</html> --}}


<!doctype html>
<html lang="en">
  <head>
    <title>Authentification Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Lien pour Plus Jakarta Sans -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo_head.png" width="32" height="32" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="{{asset('assets/css/style1.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets/css/styleAutehtification.css">

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
            <h2 class="heading-section">Espace Administrateur</h2>
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
              <div class="img" style="background-image: url(assets1/images/bg-2.png);"></div>
              <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                  <div class="w-100">
                    <h3 class="mb-4">Entrer votre mail</h3>
                  </div>
                  {{-- <div class="w-100">
                    <p class="social-media d-flex justify-content-end">
                      <a href="/viewAuthentificationAdmin/facebook" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                    </p>
                  </div> --}}
                </div>
                <form action="/sendResetLink" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                    <label class="label" for="name">Adresse mail</label>
                    <input type="email" class="form-control" placeholder="XXXX@gmail.com" name="email" required>
                  </div>
                  <div class="form-group d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <a href="{{ route('viewAuthentificationAdmin') }}" class="btn btn-link">Retour à la connection</a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="assets1/js/jquery.min.js"></script>
    <script src="assets1/js/popper.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/js/main.js"></script>
  </body>
</html>
