<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Espace Administrateur</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo_head.png" width="32" height="32" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  

  <style>
    html, body {
      height: 100%;
      margin: 0;
        display: flex;
      flex-direction: column;
    }

    .main-container {
      flex: 1;
      display: flex;
      flex-direction: column;
    }


    footer {
      background-color: #001f54;
      color: white;
      padding: 20px 0;
      margin-top: auto; /* Permet au footer de s'ajuster automatiquement */
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
   #main-wrapper{
    background-color: #f6f9fc; /* Couleur de fond modifiée ici */
  }

  .app-header{
    background-color: #f6f9fc;
  }

  </style>
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
            <i class="fa fa-times fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            <li class="nav-small-cap">
              <i class="fa fa-cogs nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Admin</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('viewCreationSalonAdmin')}}" aria-expanded="false">
                    <span>
                    <i class="fa fa-plus"></i>
                    </span>
                    <span class="hide-menu">Formulaire d'ajout</span>
                </a>
                </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/viewAdminPage" aria-expanded="false">
                <span>
                  <i class="fa fa-check"></i>
                </span>
                <span class="hide-menu"> Les validations</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('viewGestionPersonnelByAdmin')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user-check"></i> <!-- Icône mise à jour pour "Recrutement employer" -->
                    </span>
                    <span class="hide-menu">Gestion personnel</span>
                </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('viewListStandAndEmpAndNombreStand')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-list"></i>
                </span>
                <span class="hide-menu">Information de stand <br>et employer</span>
              </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('viewListMembreStand')}}" aria-expanded="false">
                  <span>
                    <i class="fa fa-list"></i>
                  </span>
                  <span class="hide-menu">List des membre du stand</span>
                </a>
              </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('dasboardAdmin')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-chart-line"></i>
                </span>
                <span class="hide-menu">Statistique et <br>dashboard</span>
              </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('viewCalendrierSuiviAdmin')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-calendar"></i>
                    </span>
                    <span class="hide-menu">Calendrier de suivi</span>
                </a>
            </li>

          </ul>
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
                <i class="fa fa-bars"></i>
              </a>
            </li>
          </ul>
          <!-- Profile Image and Logout Button aligned to the right -->
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="/getSignOutAdmin" class="btn btn-outline-primary mx-3 mt-2 d-block">Se déconnecter</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            @yield('creationSalonAdminSection')
            @yield('AdminSection')
            @yield('validationPermissionStandSection')
            @yield('informationStandSection')
            @yield('listStandAndEmpSection')
            @yield('recrutementEmpSection')
            @yield('gestionPersonnelByAdminSection')
            {{-- // rehefa misy directeur ihany zay vao mandalo ao io yeld ambany io sinon tonga dia
            licensiment --}}
            @yield('promouvoirEmpEnDirecteurSection')
            @yield('licensimentEmpByAdminSection')
            @yield('allListSection')
            @yield('informationDeStandSection')
            @yield('listMembreStandSection')
            @yield('calendrierSuiviAdminSection')
            @yield('dasboardAdminSection')

        </div>
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

  <footer style="background-color: #001f54; color: white; padding: 20px 0;">
    <div class="container">
      <div class="row">
        <!-- Section 1 -->
        <div class="col-md-3">



          <h5>Ressources</h5>
          <ul style="list-style: none; padding: 0;">
            <li><a href="/dasboardAdmin" style="color: #ffca28; text-decoration: none;">Tableau de bord</a></li>
            <li><a href="/viewCalendrierSuiviAdmin" style="color: #ffca28; text-decoration: none;">Calendrier de suivi</a></li>

          </ul>

        </div>

        <!-- Section 2 -->
        <div class="col-md-3">
          <h5>Personnel</h5>
          <ul style="list-style: none; padding: 0;">
            <li><a href="/viewLicensimentEmpByAdmin" style="color: #ffca28; text-decoration: none;">Licensiment</a></li>
            <li><a href="/viewListStandAndEmpAndNombreStand" style="color: #ffca28; text-decoration: none;">Les personnels</a></li>
            <li><a href="/viewListMembreStand" style="color: #ffca28; text-decoration: none;">Membre de l'exposition</a></li>
          </ul>
        </div>

        <!-- Section 3 -->
        <div class="col-md-3">

            <h5>Validation</h5>
          <ul style="list-style: none; padding: 0;">
            <li><a href="/viewValidationPermissionStand" style="color: #ffca28; text-decoration: none;">Permission d'exposition</a></li>
            <li><a href="/viewValidationRecrutementEmp" style="color: #ffca28; text-decoration: none;">Recrutement</a></li>
          </ul>

        </div>

        <!-- Section 4 -->
        <div class="col-md-3">

          <br>
          <div>
            <a href="#" aria-label="Facebook" style="color: white; margin-right: 10px;">
              <img src="assets/images/logos/facebook.svg" alt="Facebook" width="24" height="24">
            </a>
            <a href="#" aria-label="Twitter" style="color: white; margin-right: 10px;">
              <img src="assets/images/logos/twitter.svg" alt="Twitter" width="24" height="24">
            </a>
            <a href="#" aria-label="YouTube" style="color: white; margin-right: 10px;">
              <img src="assets/images/logos/youtube.svg" alt="YouTube" width="24" height="24">
            </a>
            <a href="#" aria-label="Microphone" style="color: white; margin-right: 10px;">
              <img src="assets/images/logos/mic-fill.svg" alt="Microphone" width="24" height="24">
            </a>
          </div>
        </div>
      </div>
      <hr style="border-color: #ffffff55;">
      <div class="text-center" style="font-size: 14px;">
        <p>Copyright ©2024 Université d'Antananarivo. Tous droits réservés.</p>
        <p>Développé par <a href="#" style="color: #ffca28;">Direction de la Communication, Marketing, et Relations Publiques</a></p>
      </div>
    </div>
  </footer>

</body>

</html>
