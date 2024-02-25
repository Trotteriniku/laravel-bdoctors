<div class="card-body">

    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title w-75">Statistiche per messaggi e recensioni</h5>
        <div class="w-25 d-flex justify-content-around align-items-center">
            <span>Filtra:</span>
            <select class="form-select w-50" name="otherYearSelector" id="otherYearSelector">
                <option value="2024" class="dropdown-header text-start" selected>2024
                </option>
                <option value="2023" class="dropdown-header text-start">2023
                </option>
            </select>
        </div>

    </div>
    <canvas id="lineChart" style="max-height: 400px;"></canvas>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        let dataMessages = <?php echo json_encode($messagesMonthlyCounts); ?>;
        let dataReviews = <?php echo json_encode($reviewsMonthlyCounts); ?>;

        const chartElement = document.querySelector("#lineChart");
        let chart;

        document.getElementById("otherYearSelector").addEventListener("change", function() {
            let opzioneSelezionata = this.value;

            if (opzioneSelezionata === '2023') {
                dataMessages = <?php echo json_encode($lastMessagesMonthlyCounts); ?>;
                dataReviews = <?php echo json_encode($lastReviewsMonthlyCounts); ?>;
            } else {
                dataMessages = <?php echo json_encode($messagesMonthlyCounts); ?>;
                dataReviews = <?php echo json_encode($reviewsMonthlyCounts); ?>;
            }

            // Aggiorna i dati del grafico
            chart.data.datasets[0].data = dataMessages;
            chart.data.datasets[1].data = dataReviews;
            chart.update();
        });

        chart = new Chart(chartElement, {
            type: "line",
            data: {
                labels: [
                    "Gennaio",
                    "Febbraio",
                    "Marzo",
                    "Aprile",
                    "Maggio",
                    "Giugno",
                    "Luglio",
                    "Agosto",
                    "Settembre",
                    "Ottobre",
                    "Novembre",
                    "Dicembre",
                ],
                datasets: [{
                        label: "Messaggi",
                        data: dataMessages,
                        fill: false,
                        borderColor: "rgb(75, 192, 192)",
                        tension: 0.5,
                    },
                    {
                        label: "Recensioni",
                        data: dataReviews,
                        fill: true,
                        borderColor: "rgb(237, 59, 59)",
                        tension: 0.4,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    });
</script>
