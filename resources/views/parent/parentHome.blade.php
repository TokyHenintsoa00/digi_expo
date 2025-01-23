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
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="/" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo.svg" width="190" alt="" style="margin-top: 20px;" />

          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="/homePage" aria-expanded="false">
                <span>
                  <i class="ti ti-layout"></i>
                </span>
                <span class="hide-menu">Stand</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/videoDirect" aria-expanded="false">
                <span>
                  <i class="ti ti-video"></i>
                </span>
                <span class="hide-menu">video en direct</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('viewVideoConferenceHome')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-video"></i>
                </span>
                <span class="hide-menu">Conference</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('listTemoignage')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-microphone-2"></i>
                  </span>
                  <span class="hide-menu">Temoignage</span>
                </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="/viewpermissionDeFaireUnStand" aria-expanded="false">
                <span>
                  <i class="ti ti-hand-stop"></i>
                </span>
                <span class="hide-menu">Permission de faire <br>un stand</span>
              </a>
            </li>



        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
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
          <div class="ms-auto d-flex align-items-center">
            <!-- Bouton Se connecter -->
            <a href="{{route('viewauthentificationEmp')}}" class="btn btn-primary">
              Se connecter
            </a>
          </div>
        </nav>
      </header>

      <!--  Header End -->
      <div class="container-fluid">
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