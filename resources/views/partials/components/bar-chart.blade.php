<div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title">Statistiche delle valuatazioni</h5>

        <select class="" id="yearSelector">
            <option value="2024" class="dropdown-header text-start" data-counts='@json($monthlyCounts)'>2024
            </option>
            <option value="2023" class="dropdown-header text-start" data-counts='@json($lastMonthlyCounts)'>2023
            </option>
        </select>
    </div>
    <canvas id="barChart" style="max-height: 400px;"></canvas>

</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const yearSelector = document.getElementById('yearSelector');
        const chartElement = document.querySelector("#barChart");

        function updateChart(data) {
            const chart = Chart.getChart(chartElement);
            if (chart) {
                chart.data.datasets[0].data = data;
                chart.update();
            } else {
                new Chart(chartElement, {
                    type: "bar",
                    data: {
                        labels: [
                            "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno",
                            "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"
                        ],
                        datasets: [{
                            label: "Statistiche voti",
                            data: data,
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.2)",
                                "rgba(255, 159, 64, 0.2)",
                                "rgba(255, 205, 86, 0.2)",
                                "rgba(75, 192, 192, 0.2)",
                                "rgba(54, 162, 235, 0.2)",
                                "rgba(153, 102, 255, 0.2)",
                                "rgba(201, 203, 207, 0.2)",
                            ],
                            borderColor: [
                                "rgb(255, 99, 132)",
                                "rgb(255, 159, 64)",
                                "rgb(255, 205, 86)",
                                "rgb(75, 192, 192)",
                                "rgb(54, 162, 235)",
                                "rgb(153, 102, 255)",
                                "rgb(201, 203, 207)",
                            ],
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                });
            }
        }

        yearSelector.addEventListener('change', function() {
            const selectedYearData = JSON.parse(this.options[this.selectedIndex].getAttribute(
                'data-counts'));
            updateChart(selectedYearData);
        });

        // Inizializza il grafico con i dati dell'anno corrente
        const initialData = JSON.parse(yearSelector.options[yearSelector.selectedIndex].getAttribute(
            'data-counts'));
        updateChart(initialData);
    });
</script>
