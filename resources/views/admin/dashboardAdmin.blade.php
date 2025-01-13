@extends('parent.ParentAdmin')

@section('dasboardAdminSection')
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
            <h3 class="font-weight-bold">{{$countTemoignage}}</h3>
          
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
            <h5 class="card-title text-muted">Vidéo</h5>
            <h3 class="font-weight-bold">{{$countVideo}}</h3>

        </div>
    </div>
</div>

<div class="container mt-9">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Graphiques des Utilisateurs, des Stocks et des Stands</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-start mb-4">
                <div class="mr-3">
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
                    <h5 class="text-center">Nombre de contenue d'exposition</h5>
                    <div id="barChart" style="height: 350px;"></div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center mb-0">Graphique des gestion personnel    </h5>
                        <select id="dataFilter" class="form-control w-50 ml-3">
                            <option value="utilisateurs">Utilisateurs</option>
                            <option value="mouvements">Demission et licensiment</option>
                        </select>
                    </div>
                    <div id="areaChart" style="height: 350px;"></div>
                </div>

                <div class="col-md-6 mb-4">
                    <h5 class="text-center">Nombre de contenus photos</h5>
                    <div id="donutChart" style="height: 350px;"></div>
                </div>
                <div class="col-md-6 mb-4">
                    <h5 class="text-center">Nombre de contenus vidéos</h5>
                    <div id="donutChart1" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let barChart;
        let areaChart2;
        let donutChart1;
        let areaChartOptions;
        let areaChartUrl = '/get-data-user-by-year'; // URL par défaut pour les utilisateurs
        let areaChartColor = '#40BB58'; // Couleur par défaut



        function initializeDonutChart1() {
            // Initialisation du Donut Chart 1
            donutChart1 = new ApexCharts(document.querySelector("#donutChart1"), {
                 series: [{ name: 'Utilisateurs', data: [] }],
                chart: { type: 'area', height: 350 },
                xaxis: {
                    categories: [],
                    labels: { rotate: 0 },
                },
                colors: ['#ffca28'],
                stroke: { curve: 'smooth', width: 2 },
                tooltip: { shared: true, intersect: false },
                legend: { position: 'top' },
            });

            areaChart2 = new ApexCharts(document.querySelector("#donutChart"), {
                 series: [{ name: 'Utilisateurs', data: [] }],
                chart: { type: 'area', height: 350 },
                xaxis: {
                    categories: [],
                    labels: { rotate: 0 },
                },
                colors: ['#26367c'],
                stroke: { curve: 'smooth', width: 2 },
                tooltip: { shared: true, intersect: false },
                legend: { position: 'top' },
            });

            donutChart1.render();
            areaChart2.render();
        }

        function updateDonutChart1(year) {
        fetch(`/get-data-video-contenue-by-year?year=${year}`)
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
            fetch(`/get-data-photo-contenue-by-year?year=${year}`)
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



        function initializeCharts() {
            // Initialisation du barChart sans données
            barChart = new ApexCharts(document.querySelector("#barChart"), {
                series: [{ name: 'Nombre de Stands', data: [] }],
                chart: { type: 'bar', height: 350 },
                xaxis: { categories: [] },
                colors: ['#001365'],
            });

            // Initialisation de l'areaChart
            areaChartOptions = new ApexCharts(document.querySelector("#areaChart"), {
                series: [{ name: 'Utilisateurs', data: [] }],
                chart: { type: 'area', height: 350 },
                xaxis: {
                    categories: [],
                    labels: { rotate: 0 },
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
            fetch(`/get-data-by-year?year=${year}`)
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
                    const values = areaChartUrl === '/get-data-user-by-year'
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
                ? '/get-data-user-by-year'
                : '/get-data-mvt-by-year';
            areaChartColor = filterValue === 'utilisateurs' ? '#40BB58' : '#FF0000';

            areaChartOptions.updateOptions({ colors: [areaChartColor] });

            const year = document.getElementById("yearInput").value;
            if (year) updateAreaChart(year);
        });

        document.getElementById("yearInput").addEventListener("input", function () {
            const year = this.value;
            if (year) {
                updateBarChart(year);
                updateAreaChart(year);
                updateDonutChart1(year);
                updateAreaChart2(year);

            }
        });

        initializeCharts();
         // Initialisation des charts
    initializeDonutChart1();
    });
</script>

@endsection
