<!doctype html>
<html lang="en">
  <head>
    <title>Authentification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Lien pour Plus Jakarta Sans -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo_head.png" width="32" height="32" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="assets/css/styleAutehtification.css">

    <!-- Add custom styles for width -->
    <style>
      .login-wrap {
        width: 50%; /* Ajustez la largeur ici */
        margin: 0 auto; /* Centre le bloc */
      }

      .custom-error {
    display: flex;
    align-items: center;
    background-color: #b92532; /* Couleur de fond rouge clair */
    color: #ffffff; /* Couleur du texte rouge foncé */
    border: 1px solid #b92532; /* Bordure */
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-size: 14px;
}

.custom-error i {
    font-size: 18px;
    margin-right: 10px;
    color: #ffffff;
}

    </style>
  </head>
  <body>
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-5">


          </div>

        </div>
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
              <div class="img" style="background-image: url(assets1/images/bg-2.png);"></div>
              <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                  <div class="w-100">

                    <h3 class="mb-4">Espace personnel</h3>

                  </div>

                </div>
                 {{-- <h2 class="heading-section">Espace personel</h2> --}}
            @if ($errors->any())
            <div class="alert alert-danger custom-error">
                <i class="fa fa-exclamation-circle"></i>
                <span>{{ $errors->first('error') }}</span>
            </div>
            @endif
                <form action="/signInEmp" class="signin-form" method="POST">
                    @csrf
                  <div class="form-group mb-3">
                    <label class="label" for="name">Adresse email</label>
                    <input type="email" class="form-control" placeholder="XXXX@gmail.com" name="email" required>
                  </div>
                  <div class="form-group mb-3">
                    <label class="label" for="password">Votre matricule</label>
                    <input type="text" class="form-control" placeholder="pXXX" name="matricule_emp" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Se connnecter</button>
                  </div>
                  <div class="form-group d-md-flex">
                    <div class="w-50 text-left">
                      <label class="checkbox-wrap checkbox-primary mb-0">Se souvenir de moi
                        <input type="checkbox" checked name="remember">
                        <span class="checkmark"></span>
                      </label>
                    </div>
                    <div class="w-50 text-md-right">
                      <a href="{{route('viewAuthentificationAdmin')}}">Se connecter en tant que administrateur</a>
                    </div>
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
