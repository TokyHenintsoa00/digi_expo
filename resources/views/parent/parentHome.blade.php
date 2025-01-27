<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DigiExpo</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo_head.png" width="32" height="32" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style1.css">
    <style>
       footer {
        width: 100%;
        margin: 0;
        padding: 20px 0;
        background-color: #001f54;
        color: white;
        }

        footer ul li a:hover {
        text-decoration: underline;
        }

        footer form input {
        border: 1px solid #ddd;
        border-radius: 3px;
        }

        footer form button:hover {
        background-color: #e0b20d;
        }

        footer h5 {
        color: white;
        }

        footer .container-fluid {
        max-width: 100%;
        padding: 0 15px;
        }

        /* Media queries pour s'assurer du bon rendu sur différents écrans */
        @media (min-width: 1200px) {
        footer {
            padding: 30px 0;
        }
        }

        @media (max-width: 768px) {
        footer {
            text-align: center;
        }
        }


        html, body {
        height: 100%; /* Assurez-vous que le body et html prennent toute la hauteur */
        margin: 0; /* Supprimez les marges par défaut */
        }

        .main-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Prend toute la hauteur de la fenêtre */
        }

        .body-wrapper {
        flex: 1; /* Permet au contenu principal de prendre tout l'espace restant */
        }

        footer {
        background-color: #001f54;
        color: white;
        padding: 20px 0;

        }

        #main-wrapper{
    background-color: #f6f9fc; /* Couleur de fond modifiée ici */
  }

  .app-header{
    background-color: #f6f9fc;
  }


  aside.top-navbar {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    background-color: #ffffff; /* Couleur de fond */
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Ombre légère */
    padding: 10px 20px;
    position: sticky;
    top: 0;
    z-index: 100;
    overflow-x: auto; /* Ajoute un défilement horizontal si l'écran est trop petit */
    white-space: nowrap; /* Empêche les éléments de passer à la ligne */
}

/* Logo */
.brand-logo {
    margin-right: 20px;
    flex-shrink: 0; /* Empêche le logo de rétrécir */
}

/* Liste des liens */
.navbar-menu {
    flex-grow: 1;
}

.navbar-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 20px; /* Espacement entre les éléments */
}

.navbar-item {
    text-align: center;
    flex-shrink: 0; /* Empêche les liens de se rétrécir */
}

/* Lien de navigation */
.navbar-link {
    text-decoration: none;
    color: #333;
    font-size: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    white-space: nowrap; /* Empêche les titres de se couper */
}

.navbar-link i {
    font-size: 20px;
}

.navbar-link:hover {
    color: #EFB719; /* Couleur au survol */
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar-link span {
        font-size: 12px; /* Réduit la taille du texte pour les petits écrans */
    }

    .navbar-list {
        gap: 15px; /* Réduit l'espacement entre les liens */
    }
}

@media (max-width: 480px) {
    .navbar-link i {
        font-size: 18px; /* Réduit légèrement l'icône */
    }

    .navbar-link span {
        font-size: 10px; /* Texte encore plus petit sur mobile */
    }
}


    </style>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5YVYP8CSQZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-5YVYP8CSQZ');
</script>

</head>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper main-container" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
  data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <aside class="top-navbar">
        <div class="brand-logo d-flex align-items-center">
            <a href="/" class="text-nowrap logo-img">
                <img src="../assets/images/logos/logo.svg" width="190" alt="Logo" style="margin-top: 10px;" />
            </a>
        </div>
        <nav class="navbar-menu d-flex justify-content-around">
            <ul class="navbar-list d-flex">
                <li class="navbar-item">
                    <a class="navbar-link" href="/homePage">
                        <i class="ti ti-layout"></i>
                        <span>Exposition</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="/videoDirect">
                        <i class="ti ti-video"></i>
                        <span>Video conference avec <br>les hotesses</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('viewVideoConferenceHome')}}">
                        <i class="ti ti-video"></i>
                        <span>Conference</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('listTemoignage')}}">
                        <i class="ti ti-microphone-2"></i>
                        <span>Temoignage</span>
                    </a>
                </li>

                <li class="navbar-item">
                    <a class="navbar-link" href="/viewpermissionDeFaireUnStand">
                        <i class="ti ti-hand-stop"></i>
                        <span>Permission de faire <br>un stand</span>
                    </a>
                </li>
                <div class="ms-auto d-flex align-items-center">
                    <!-- Bouton Se connecter -->
                    <a href="{{route('viewauthentificationEmp')}}" class="btn btn-primary">
                      Se connecter
                    </a>
                </div>

            </ul>

        </nav>

    </aside>

    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          {{-- <div class="ms-auto d-flex align-items-center">
            <!-- Bouton Se connecter -->
            <a href="{{route('viewauthentificationEmp')}}" class="btn btn-primary">
              Se connecter
            </a>
          </div> --}}
        </nav>
      </header>

      <!--  Header End -->
      <div class="container-fluid mx-auto px-3" style="max-width: 95%;">        <!--  Row 1 -->
        <!--  Row 1 -->
        <div class="row">
            @yield('homeReceptionSection')
            @yield('homePageSection')
            @yield('videoDirectSection')
            @yield('demandeAideSection')
            @yield('permissionDeFaireUnStandSection')
            @yield('gestionContenueHomeSection')
            @yield('ContenueDeStandSection')
            @yield('contenueVideoSection')
            @yield('linkVideoSection')
            @yield('listTemoignageSection')

        </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <footer style="background-color: #001f54; color: white; padding: 20px 0; width: 100%; margin: 0;">
    <div class="container" style="max-width: 100%; padding: 0 15px;">
      <div class="text-center" style="font-size: 14px;">
        <p>Copyright ©2024 Université d'Antananarivo. Tous droits réservés.</p>
        <p>Développé par <a href="#" style="color: #ffca28;">Direction de la Communication, Marketing, et Relations Publiques</a></p>
      </div>
    </div>
  </footer>

</footer>

</body>

</html>