<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Responsable</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('../assets/images/logos/logo_head.png')}}" width="32" height="32" />
  <link rel="stylesheet" href="{{asset('../assets/css/styles.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style1.css')}}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> --}}
    <link rel="stylesheet" href="{{asset('assets/css/mainSiteStyle.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styleGaleriePhoto.css')}}">

    <style>
 /* Style du panneau de notifications */
 .notifications-panel {
    position: fixed;
    top: 0;
    right: -320px; /* Caché hors écran */
    width: 300px;
    height: 100%;
    overflow-y: auto; /* Activer le défilement vertical */
    background-color: white;
    border-left: 1px solid #ddd;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    z-index: 1100; /* Plus élevé pour être devant le aside */
    transition: right 0.4s ease; /* Transition pour le slide */
}

  /* Apparition du panneau */
  .notifications-panel.show {
    right: 0;
  }

  .notifications-panel h5 {
    font-size: 18px;
    margin-bottom: 15px;
  }

  .notif-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
  }

  .notif-item i {
    font-size: 20px;
    margin-right: 10px;
  }

  .notif-item small {
    font-size: 12px;
    color: gray;
  }

  #clearAll {
    margin-top: 20px;
    background-color: #001365;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    width: 100%;
    font-size: 14px;
  }

  /* Overlay sombre */
  #overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000; /* Doit être sous le panneau de notifications */
    display: none; /* Caché initialement */
}

  #overlay.show {
    display: block; /* Affiche l'overlay */
  }

  .notif-item.read {
    opacity: 0.6; /* Rend les notifications lues plus transparentes */
    color: gray;
}

.notif-item.unread {
    font-weight: bold;
    color: black;
}

  .notifications-content {
    overflow-y: auto;
    max-height: calc(80vh - 60px); /* Ajustement en fonction de la taille du titre */
    padding-bottom: 20px;
  }
/* /----------------------------------------------------------------------- */

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

/* Barre de navigation horizontale */
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
    @php
    use App\Models\Notification;
    $notifications = Notification::where('user_id', Session::get('id_emp'))
                        ->orWhere('receiver_id', Session::get('id_emp'))
                      ->orderBy('created_at', 'desc')
                      ->get();

    $unreadCount = $notifications->where('is_read', false)->count();

  @endphp
  <!--  Body Wrapper -->
  <div class="page-wrapper main-container" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
  data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    {{-- NOTIFICATION PANNEL --}}
      <div class="notifications-panel" id="notificationsPanel">
        <h5>Notifications</h5>
          <div class="notifications-content">
            @forelse($notifications as $notification)
              <div class="notif-item {{ $notification->is_read ? 'read' : 'unread' }}">
                <i class="ti ti-bell"></i>
                <span>
                  <a href="{{ route('notifications.markAsRead', ['id' => $notification->id]) }}"
                    class="notification-link"
                    data-id="{{ $notification->id }}">
                    {{ $notification->message }}
                  </a>
                </span>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
              </div>
            @empty
              <p>Aucune notification</p>
            @endforelse
          </div>
        <button id="clearAll" class="btn btn-primary">Sortir</button>
      </div>

    <!-- Sidebar Start -->
    <aside class="top-navbar">
      <div class="brand-logo d-flex align-items-center">
          <a href="/" class="text-nowrap logo-img">
              <img src="../assets/images/logos/logo.svg" width="190" alt="Logo" style="margin-top: 10px;" />
          </a>
      </div>
      <nav class="navbar-menu d-flex justify-content-around">
          <ul class="navbar-list d-flex">
              <li class="navbar-item">
                  <a class="navbar-link" href="{{route('viewDirecteurEmpPage')}}">
                      <i class="ti ti-table"></i>
                      <span>Publication de stand</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{route('viewGestionPersonnel')}}">
                      <i class="ti ti-user-check"></i>
                      <span>Gestion personnel</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{route('viewGestionBrochure')}}">
                      <i class="ti ti-file-text"></i>
                      <span>Gestion de brochure</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{route('viewGestionContenue')}}">
                      <i class="ti ti-file-info"></i>
                      <span>Gestion de contenu</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{route('viewDemandeNouvelleStand')}}">
                      <i class="ti ti-hand-stop"></i>
                      <span>Demande de stand</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{'viewVideoConference'}}">
                      <i class="ti ti-video"></i>
                      <span>Vidéo conférence</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{'viewTemoignage'}}">
                      <i class="ti ti-microphone-2"></i>
                      <span>Témoignage</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{route('viewCalendrierSuivi')}}">
                      <i class="ti ti-calendar"></i>
                      <span>Calendrier</span>
                  </a>
              </li>
              <li class="navbar-item">
                  <a class="navbar-link" href="{{route('viewMessageDirecteur')}}">
                      <i class="ti ti-message"></i>
                      <span>Discussion</span>
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
                <!-- Overlay sombre (initialement caché) -->
                <div id="overlay" class="hidden"></div>

                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link nav-icon-hover" id="notifBell">
                    <i class="ti ti-bell-ringing"></i>
                    @if($unreadCount > 0)
                        <span class="notification-count" style="color: red">{{ $unreadCount }}</span>
                    @endif
                    </a>
                </li>
            </ul>

                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                      <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                          <div class="message-body">
                            <form action="{{ route('getSignOutEmp') }}" method="POST" class="mx-3 mt-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary d-block">Se déconnecter</button>
                            </form>
                          </div>
                        </div>
                      </li>
                    </ul>
                </div>

          </nav>

      </header>

      <!--  Header End -->
      <div class="container-fluid mx-auto px-3" style="max-width: 95%;">        <!--  Row 1 -->
        <div class="row">

            @yield('directeurEmpPageSection')
            @yield('standDirecteurSection')
            @yield('modificationStandEmpSection')
            @yield('demandeStandSection')
            @yield('gestionPersonnelSection')
            @yield('formulaireRecrutementSection')
            @yield('licensimentEmployerSection')
            @yield('gestionContenueSection')
            @yield('AddPosterAndProjetEmpSection')
            @yield('viewModificationPosterProjetSection')
            @yield('formulaireModificationPosterProjetSection')
            @yield('formulaireAddVideoSection')
            @yield('viewModificationVideoSection')
            @yield('formulaireModificationVideoSection')
            @yield('gestionBrochureSection')
            @yield('choixStandBrochureSection')
            @yield('choixContenuePourBrochureSection')
            @yield('formulaireBrochureSection')
            @yield('formulaireDeModificationBrochureSection')
            @yield('demissionEmployerSection')
            @yield('listEmpNombreEmpStandSection')
            @yield('videConferenceSection')
            @yield('planificationVideoConferenceSection')
            @yield('modificationVideoConferenceSection')
            @yield('formulaireModificationVideoConferenceSection')
            @yield('addLinkVideoSection')
            @yield('viewCalendrierSuiviSection')
            @yield('viewMessageDirecteurSection')
            @yield('viewMessageSendOrReciveDirecteurSection')
            @yield('TemoignageSection')
            @yield('planificationTemoignageSection')
            @yield('informationExpositionSection')
            @yield('ConferenceClientSection')
            @yield('justificationDemissionEditeurSection')
            @yield('PlanificationGalerieSection')
            @yield('listTemoignageSection')
            @yield('ModificationTemoignageSection')
            @yield('AjoutLiensTemoignageSection')

        </div>
    </div>
  </div>
  <script src="{{asset('../assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('../assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('../assets/js/app.min.js')}}"></script>
  <script src="{{asset('../assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('../assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('../assets/js/dashboard.js')}}"></script>
  <script>

    $(document).ready(function() {
    $('#notifBell').on('click', function() {
        $('#notificationsPanel').toggleClass('show');
        $('#overlay').toggleClass('show');
        $('.notification-count').remove();
    });

    $('.notification-link').on('click', function(e)
    {
            e.preventDefault();
            let url = $(this).attr('href');

            // Marque la notification comme lue en arrière-plan
            $.get(url, function() {
            $(e.target).closest('.notif-item').addClass('read').removeClass('unread'); // Style comme lue
                window.location.href = url;
            });
    });

    $('#clearAll, #overlay').on('click', function() {
        $('#notificationsPanel').removeClass('show');
        $('#overlay').removeClass('show');
    });


    });



</script>
<footer>
    <div class="container">
      <div class="row">
        <!-- Section 1 -->
        <div class="col-md-3">
          <h5>Gestion personnel</h5>
          <ul style="list-style: none; padding: 0;">
            <li><a href="/directeur/viewRecrutementEmp" style="color: #ffca28; text-decoration: none;">Recrutement</a></li>
            <li><a href="/directeur/viewLicensimentEmployer" style="color: #ffca28; text-decoration: none;">Licensiment</a></li>
            <li><a href="/directeur/viewDemissionEmployer" style="color: #ffca28; text-decoration: none;">Demission des editeurs</a></li>
            <li><a href="/directeur/viewListEmpAndNombreEmpParStand" style="color: #ffca28; text-decoration: none;">Liste des editeurs</a></li>
          </ul>
        </div>

        <!-- Section 2 -->
        <div class="col-md-3">
          <h5>Contenue</h5>
          <ul style="list-style: none; padding: 0;">
            <li><a href="/directeur/viewformulaireAddPosterAndProjetEmp" style="color: #ffca28; text-decoration: none;">Ajouter une ou des photos</a></li>
            <li><a href="/directeur/viewModifierPosterProjet" style="color: #ffca28; text-decoration: none;">Modifier les photos</a></li>
            <li><a href="/directeur/viewFormulaireAddVideo" style="color: #ffca28; text-decoration: none;">Ajoutes une video</a></li>
            <li><a href="/directeur/viewModificationVideo" style="color: #ffca28; text-decoration: none;">Modifier votre video</a></li>
          </ul>
        </div>

        <!-- Section 3 -->
        <div class="col-md-3">
          <h5>Autres</h5>
          <ul style="list-style: none; padding: 0;">
            <li><a href="/directeur/viewChoixDeStandBrochure" style="color: #ffca28; text-decoration: none;">Ajout ou modifier une brochure</a></li>
            <li><a href="/directeur/viewTemoignage" style="color: #ffca28; text-decoration: none;">Temoignage</a></li>
            <li><a href="/directeur/viewCalendrierSuivi" style="color: #ffca28; text-decoration: none;">Calendrier</a></li>
            <li><a href="/directeur/viewVideoConference" style="color: #ffca28; text-decoration: none;">Video conference</a></li>
          </ul>
        </div>

        <!-- Section 4 -->
        <div class="col-md-3">
            <br>
          <div>
            <a href="#" aria-label="Facebook" style="color: white; margin-right: 10px;">
              <img src="{{asset('assets/images/logos/facebook.svg')}}" alt="Facebook" width="24" height="24">
            </a>
            <a href="#" aria-label="Twitter" style="color: white; margin-right: 10px;">
              <img src="{{asset('assets/images/logos/twitter.svg')}}" alt="Twitter" width="24" height="24">
            </a>
            <a href="#" aria-label="YouTube" style="color: white; margin-right: 10px;">
              <img src="{{asset('assets/images/logos/youtube.svg')}}" alt="YouTube" width="24" height="24">
            </a>
            <a href="#" aria-label="Microphone" style="color: white; margin-right: 10px;">
              <img src="{{asset('assets/images/logos/mic-fill.svg')}}" alt="Microphone" width="24" height="24">
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