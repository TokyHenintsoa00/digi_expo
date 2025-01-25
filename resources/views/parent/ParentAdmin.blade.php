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



  /* Barre de navigation horizontale */
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
                    <a class="navbar-link" href="{{route('viewCreationSalonAdmin')}}">
                        <i class="ti ti-files"></i>
                        <span>Formulaire d'ajout</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('viewAdminPage')}}">
                        <i class="ti ti-checks"></i>
                        <span>Les validations</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('viewGestionPersonnelByAdmin')}}">
                        <i class="ti ti-user-check"></i>
                        <span>Gestion personnel</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('viewListStandAndEmpAndNombreStand')}}">
                        <i class="ti ti-file-info"></i>
                        <span>Information de stand <br>et employer</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('viewListMembreStand')}}">
                        <i class="ti ti-list"></i>
                        <span>List des membre du stand</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('dasboardAdmin')}}">
                        <i class="ti ti-chart-dots"></i>
                        <span>Statistique et <br>dashboard</span>
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="navbar-link" href="{{route('viewCalendrierSuiviAdmin')}}">
                        <i class="ti ti-calendar"></i>
                        <span>Calendrier de suivi</span>
                    </a>
                </li>




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
      <div class="container-fluid mx-auto px-3" style="max-width: 95%;">        <!--  Row 1 -->
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
