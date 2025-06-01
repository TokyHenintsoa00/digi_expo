@extends('parent.ParentAdmin')

@section('dasboardAdminSection')

<style>

</style>

<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
  <!-- Page Views Card -->
  <div class="col-md-4 mx-auto">
    <div class="card text-center">
        <div class="card-body">
            <!-- Icône -->
            <div class="mb-2">
                <i class="fas fa-microphone-alt fa-2x text-primary"></i>
            </div>
            <h5 class="card-title text-muted">Témoignage</h5>
            <h3 class="font-weight-bold" id="temoignageCount">0</h3>
        </div>
    </div>
</div>



<div class="col-md-4 mx-auto">
    <div class="card text-center">
        <div class="card-body">
            <!-- Icône -->
            <div class="mb-2">
                <i class="fas fa-video fa-2x text-danger"></i>
            </div>
            <h5 class="card-title text-muted">Vidéo conference</h5>
            <h3 class="font-weight-bold" id="videoContenueCount">0</h3>

        </div>
    </div>
</div>

<div class="container mt-9">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Graphiques des Utilisateurs, des Stocks et des Stands</h4>
        </div>
        <div class="card-body">
           <div class="d-flex justify-content-start align-items-end mb-4 gap-3 flex-wrap">
                <div class="me-4"> <!-- marge à droite (end) -->
                    <label for="timeFilter">Période:</label>
                    <select id="timeFilter" class="form-control">
                        <option value="month">Mois</option>

                    </select>
                </div>
                <div>
                    <label for="yearInput">Année:</label>
                    <input type="number" id="yearInput" class="form-control" placeholder="Entrez une année">
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5 class="text-center">Graphique de stand</h5>
                    <div id="barChart" style="height: 350px;"></div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center mb-0">Graphique des gestion personnel</h5>
                        <select id="dataFilter" class="form-control w-50 ml-3">
                            <option value="utilisateurs">Utilisateurs</option>
                            <option value="mouvements">Demission et licensiment</option>
                        </select>
                    </div>
                    <div id="areaChart" style="height: 350px;"></div>
                </div>

                <div class="col-md-6 mb-4">
                    <h5 class="text-center">graphique de galerie photos</h5>
                    <div id="donutChart" style="height: 350px;"></div>
                </div>
                <div class="col-md-6 mb-4">
                    <h5 class="text-center">graphique de galerie vidéos</h5>
                    <div id="donutChart1" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Première ligne de 4 petits tableaux -->
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre de stand par jour</h6>
            <table class="table table-sm">
                <thead>
                    <tr><th>Date</th><th>Jour</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="standByDayBody">

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre de personnel par jour</h6>
            <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Jour</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="empByDayBody">

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre demmission et licensiment par jour</h6>
            <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Jour</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="mvtempByDayBody">

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre de contenue photo par jour</h6>
             <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Jour</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="contenuePhotoByDayBody">

                </tbody>
            </table>
        </div>
    </div>

    <!-- Deuxième ligne de 4 petits tableaux -->
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre de stand en annee</h6>
            <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="standByYearBody">

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre de personnel en annee</h6>
            <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="empByYearBody">

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre demmission et licensiment en annee</h6>
            <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="mvtempByYearBody">

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre de contenue photo en annee</h6>
             <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="contenuePhotoByYearBody">

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card p-3">
            <h6 class="text-center">Nombre de contenue video par jour</h6>
             <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Jour</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="contenueVideoByDayBody">

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card p-3">
             <h6 class="text-center">Nombre de contenue video en annee</h6>
             <table class="table table-sm">
                <thead>
                    <tr><th>Annee</th><th>Nombre total</th></tr>
                </thead>
                <tbody id="contenueVideoByYearBody">

                </tbody>
            </table>
        </div>
    </div>
</div>


{{--
<script>
    const yearInput = document.getElementById('yearInput');
        const temoignageCount = document.getElementById('temoignageCount');

        yearInput.addEventListener('change', function () {
        const year = yearInput.value;

        if (year) {
        fetch(`/admin/get-data-temoignage-by-year?year=${year}`)
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data) && data.length > 0) {
                    temoignageCount.textContent = data[0].nombre_temoigange;
                } else {
                    temoignageCount.textContent = 0;
                }
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des données:', error);
                temoignageCount.textContent = 'Erreur';
            });
        }
        });
</script> --}}


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let barChart;
        let areaChart2;
        let donutChart1;
        let areaChartOptions;
        let areaChartUrl = '/admin/get-data-user-by-year'; // URL par défaut pour les utilisateurs
        let areaChartColor = '#40BB58'; // Couleur par défaut


        //nombre de contenue photo et video
        //photo,video,utilisateur
        function initializeDonutChart1() {
            // Initialisation du Donut Chart 1
            donutChart1 = new ApexCharts(document.querySelector("#donutChart1"), {
                 series: [{ name: 'Nombre de video', data: [] }],
                chart: { type: 'area', height: 350 },
                xaxis: {
                    categories: [],
                    labels: { rotate: 0 },
                },
                colors: ['#8B5CF6'],
                stroke: { curve: 'smooth', width: 2 },
                tooltip: { shared: true, intersect: false },
                legend: { position: 'top' },
            });

            areaChart2 = new ApexCharts(document.querySelector("#donutChart"), {
                 series: [{ name: 'Nombre de photo', data: [] }],
                chart: { type: 'area', height: 350 },
                xaxis: {
                    categories: [],
                    labels: { rotate: 0 },
                },
                colors: ['#EC4899'],
                stroke: { curve: 'smooth', width: 2 },
                tooltip: { shared: true, intersect: false },
                legend: { position: 'top' },
            });

            donutChart1.render();
            areaChart2.render();
        }



        function updateDonutChart1(year) {

        fetch(`/admin/get-data-video-contenue-by-year?year=${year}`)
            //fetch(routeName)
            .then(response => response.json())
                    .then(data => {
                        const categories = data.map(item => item.nom_mois || "");
                        const values = data.map(item => item.nombre_contenue || 0);

                        donutChart1.updateOptions({
                            series: [{ name: 'Données', data: values }],
                            xaxis: { categories: categories },
                        });
                    })
                    .catch(error => console.error("Erreur pour l'AreaChart:", error));
        }

            function updateAreaChart2(year)
            {

                fetch(`/admin/get-data-photo-contenue-by-year?year=${year}`)
                .then(response => response.json())
                        .then(data => {
                            const categories = data.map(item => item.nom_mois || "");
                            const values = data.map(item => item.nombre_contenue || 0);

                            areaChart2.updateOptions({
                                series: [{ name: 'Données', data: values }],
                                xaxis: { categories: categories },
                            });
                        })
                        .catch(error => console.error("Erreur pour l'AreaChart:", error));
            }



        function initializeCharts()
        {
            // Initialisation du barChart sans données
            barChart = new ApexCharts(document.querySelector("#barChart"), {
                series: [{ name: 'Nombre de Stands', data: [] }],
                chart: { type: 'area', height: 350 },
                xaxis:
                { categories: [],
                    labels: {
                        style: {
                            fontSize: '12px'
                        },
                        rotate: 0,
                        hideOverlappingLabels: false,
                    }
                },
                colors: ['#001365'],
                stroke: { curve: 'smooth', width: 2 },
                tooltip: { shared: true, intersect: false },
                legend: { position: 'top' },

            });

            // Initialisation de l'areaChart
            areaChartOptions = new ApexCharts(document.querySelector("#areaChart"), {
                series: [{ name: 'Utilisateurs', data: [] }],
                chart: { type: 'area', height: 350 },
                xaxis: {
                    categories: [],
                    labels: {
                        style: {
                            fontSize: '12px'
                        },
                        rotate: 0,
                        hideOverlappingLabels: false,
                    }
                },
                colors: ['#40BB58'],
                stroke: { curve: 'smooth', width: 2 },
                tooltip: { shared: true, intersect: false },
                legend: { position: 'top' },
            });



            barChart.render();
            areaChartOptions.render();

        }



        // Mise à jour du barChart
        function updateBarChart(year) {
            fetch(`/admin/get-data-by-year?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    const categories = data.map(item => item.nom_mois || "");
                    const values = data.map(item => item.nombre_stands || 0);

                    barChart.updateOptions({
                        series: [{ name: 'Nombre de Stands', data: values }],
                        xaxis: { categories: categories },
                    });
                })
                .catch(error => console.error("Erreur pour le BarChart:", error));
        }

        // Mise à jour de l'areaChart
        function updateAreaChart(year) {
            fetch(areaChartUrl + `?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    const categories = data.map(item => item.nom_mois || "");
                    const values = areaChartUrl === '/admin/get-data-user-by-year'
                        ? data.map(item => item.nombre_de_personnel || 0)
                        : data.map(item => item.nombre_mouvement || 0);

                    areaChartOptions.updateOptions({
                        series: [{ name: 'Données', data: values }],
                        xaxis: { categories: categories },
                    });
                })
                .catch(error => console.error("Erreur pour l'AreaChart:", error));
        }

        document.getElementById("dataFilter").addEventListener("change", function () {
            const filterValue = this.value;
            areaChartUrl = filterValue === 'utilisateurs'
                ? '/admin/get-data-user-by-year'
                : '/admin/get-data-mvt-by-year';
            areaChartColor = filterValue === 'utilisateurs' ? '#40BB58' : '#FF0000';

            areaChartOptions.updateOptions({ colors: [areaChartColor] });

            const year = document.getElementById("yearInput").value;
            if (year) updateAreaChart(year);
        });

        document.getElementById("yearInput").addEventListener("input", function () {
            const year = this.value;
            const joursEnFrancais = {
                "Monday": "Lundi",
                "Tuesday": "Mardi",
                "Wednesday": "Mercredi",
                "Thursday": "Jeudi",
                "Friday": "Vendredi",
                "Saturday": "Samedi",
                "Sunday": "Dimanche"
            };

            if (year) {
                updateBarChart(year);
                updateAreaChart(year);
                updateDonutChart1(year);
                updateAreaChart2(year);

                // Ajout pour récupérer le nombre de témoignages
                fetch(`/admin/get-data-temoignage-by-year?year=${year}`)
                .then(response => response.json())
                .then(data => {
                const temoignageCount = document.getElementById('temoignageCount');
                if (Array.isArray(data) && data.length > 0) {
                    temoignageCount.textContent = data[0].nombre_temoigange;
                } else {
                    temoignageCount.textContent = 0;
                }
                })
                .catch(error => {
                console.error('Erreur lors de la récupération des témoignages:', error);
                document.getElementById('temoignageCount').textContent = 'Erreur';
                });

                // Ajout pour récupérer le nombre de video
                fetch(`/admin/get-data-video-conference-by-year?year=${year}`)
                .then(response => response.json())
                .then(data => {
                const videoConferenceCount = document.getElementById('videoContenueCount');
                if (Array.isArray(data) && data.length > 0) {
                    videoConferenceCount.textContent = data[0].nombre_video;
                } else {
                    videoConferenceCount.textContent = 0;
                }
                })
                .catch(error => {
                console.error('Erreur lors de la récupération des témoignages:', error);
                document.getElementById('videoContenueCount').textContent = 'Erreur';
                });


               fetch(`/admin/get-data-stand-by-day?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('standByDayBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');

                                const tdDate = document.createElement('td');
                                tdDate.textContent = item.annee;

                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.nom_jour;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.total_stands;

                                tr.appendChild(tdDate);
                                tr.appendChild(tdJour);
                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });


                fetch(`/admin/get-data-stand-by-year?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('standByYearBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');


                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.annee;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.nombre_stands;

                                tr.appendChild(tdJour);
                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });




                fetch(`/admin/get-data-emp-by-day?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('empByDayBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');

                                const tdDate = document.createElement('td');
                                tdDate.textContent = item.annee;

                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.nom_jour;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.total_user;

                                tr.appendChild(tdDate);
                                tr.appendChild(tdJour);
                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });



                fetch(`/admin/get-data-emp-by-year?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('empByYearBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');


                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.annee;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.nombre_de_personnel;

                                tr.appendChild(tdJour);
                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });


                fetch(`/admin/get-data-mvtemp-by-day?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('mvtempByDayBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');

                                const tdDate = document.createElement('td');
                                tdDate.textContent = item.date_mouvement;

                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.nom_jour;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.nombre_mouvement;

                                tr.appendChild(tdDate);
                                tr.appendChild(tdJour);
                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });



                fetch(`/admin/get-data-mvtemp-by-year?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('mvtempByYearBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');


                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.annee;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.nombre_mouvement;

                                tr.appendChild(tdJour);
                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });


                fetch(`/admin/get-data-photo-by-day?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('contenuePhotoByDayBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');

                                const tdDate = document.createElement('td');
                                tdDate.textContent = item.annee;

                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.nom_jour;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.total_contenue;

                                tr.appendChild(tdDate);
                                tr.appendChild(tdJour);
                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });


                fetch(`/admin/get-data-photo-by-year?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('contenuePhotoByYearBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');

                                const tdDate = document.createElement('td');
                                tdDate.textContent = item.annee;



                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.nombre_contenue;

                                tr.appendChild(tdDate);

                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });



                fetch(`/admin/get-data-video-by-day?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('contenueVideoByDayBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');

                                const tdDate = document.createElement('td');
                                tdDate.textContent = item.date_creation_video;

                                const tdJour = document.createElement('td');
                                tdJour.textContent = item.nom_jour;

                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.nombre_contenue;

                                tr.appendChild(tdDate);

                                tr.appendChild(tdJour);

                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });


                fetch(`/admin/get-data-video-by-year?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('contenueVideoByYearBody'); // ✅ définir ici
                        tbody.innerHTML = ''; // Vider le contenu précédent

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const tr = document.createElement('tr');

                                const tdDate = document.createElement('td');
                                tdDate.textContent = item.date_creation_video;


                                const tdNombre = document.createElement('td');
                                tdNombre.textContent = item.nombre_contenue;

                                tr.appendChild(tdDate);



                                tr.appendChild(tdNombre);

                                tbody.appendChild(tr);
                            });
                        } else {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `<td colspan="2" class="text-center">Aucune donnée</td>`;
                            tbody.appendChild(tr);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des témoignages:', error);
                        const tbody = document.getElementById('standByDayBody'); // ✅ à redéfinir ici aussi dans le catch
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Erreur</td></tr>`;
                });



            }
        });



        initializeCharts();
         // Initialisation des charts
        initializeDonutChart1();


    });
</script>
{{-- //-------------------------- --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const timeFilter = document.getElementById('timeFilter');
        const yearInputDiv = document.getElementById('yearInput').parentElement;

        // Fonction pour créer un select avec les mois
        function createMonthSelect() {
            const select = document.createElement('select');
            select.className = 'form-control';
            select.id = 'monthSelect';

            const months = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];

            months.forEach((month, index) => {
                const option = document.createElement('option');
                option.value = index + 1; // 1 à 12
                option.textContent = month;
                select.appendChild(option);
            });

            return select;
        }

        timeFilter.addEventListener('change', function () {
            // Si "Jour" est sélectionné
            if (timeFilter.value == 'day') {
                // Remplace l'input année par un select des mois
                yearInputDiv.innerHTML = `
                    <label for="monthSelect">Mois:</label>

                `;
                yearInputDiv.appendChild(createMonthSelect());
            } else {
                // Revenir à l'input année
                yearInputDiv.innerHTML = `
                    <label for="yearInput">Année:</label>
                    <input type="number" id="yearInput" class="form-control" placeholder="Entrez une année">
                `;
            }


        });




    });


</script>


@endsection
