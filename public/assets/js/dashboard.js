document.addEventListener("DOMContentLoaded", function() {
    // Utiliser la variable globale chartOptions
    // if (window.chartOptions) {
    //     var chartElement = document.querySelector("#chart");
    //     if (chartElement) {
    //         var chart = new ApexCharts(chartElement, window.chartOptions);
    //         chart.render();
    //     }
    // } else {
    //     console.error("chartOptions n'est pas défini.");
    // }

    // Rendu des autres graphiques si nécessaire
    var breakupElement = document.querySelector("#breakup");
    if (breakupElement && window.breakupOptions) {
        var breakupChart = new ApexCharts(breakupElement, window.breakupOptions);
        breakupChart.render();
    }

    var earningElement = document.querySelector("#earning");
    if (earningElement && window.earningOptions) {
        var earningChart = new ApexCharts(earningElement, window.earningOptions);
        earningChart.render();
    }
});
