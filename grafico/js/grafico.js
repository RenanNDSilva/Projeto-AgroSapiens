/* /var/www/html/climate_dashboard/js/scripts.js */
document.addEventListener('DOMContentLoaded', function () {
    const ctxTemperature = document.getElementById('temperatureChart').getContext('2d');
    const ctxPressure = document.getElementById('pressureChart').getContext('2d');
    const ctxAltitude = document.getElementById('altitudeChart').getContext('2d');
    const ctxHumidity = document.getElementById('humidityChart').getContext('2d');
    const ctxHeatIndex = document.getElementById('heatIndexChart').getContext('2d');
    const ctxDewPoint = document.getElementById('dewPointChart').getContext('2d');
    const ctxVaporPressure = document.getElementById('vaporPressureChart').getContext('2d');
    const ctxVaporPressureDeficit = document.getElementById('vaporPressureDeficitChart').getContext('2d');

    const createChart = (ctx, label) => new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: label,
                backgroundColor: '#677310',
                borderColor: '#677310',
                data: []
            }]
        },
        options: {}
    });

    const temperatureChart = createChart(ctxTemperature, 'Temperatura (°C)');
    const pressureChart = createChart(ctxPressure, 'Pressão (hPa)');
    const altitudeChart = createChart(ctxAltitude, 'Altitude (m)');
    const humidityChart = createChart(ctxHumidity, 'Umidade (%)');
    const heatIndexChart = createChart(ctxHeatIndex, 'Índice de calor (°C)');
    const dewPointChart = createChart(ctxDewPoint, 'Ponto de orvalho (°C)');
    const vaporPressureChart = createChart(ctxVaporPressure, 'Pressão de vapor (hPa)');
    const vaporPressureDeficitChart = createChart(ctxVaporPressureDeficit, ' Déficit de pressão de vapor (hPa)');

    document.getElementById('timeframe').addEventListener('change', function () {
        const days = this.value;
        fetch(`/climate_dashboard/data/get_data.php?days=${days}`)
            .then(response => response.json())
            .then(data => {
                const updateChart = (chart, data) => {
                    chart.data.labels = data.labels;
                    chart.data.datasets[0].data = data.values;
                    chart.update();
                };

                updateChart(temperatureChart, { labels: data.labels, values: data.temperature });
                updateChart(pressureChart, { labels: data.labels, values: data.pressure });
                updateChart(altitudeChart, { labels: data.labels, values: data.altitude });
                updateChart(humidityChart, { labels: data.labels, values: data.humidity });
                updateChart(heatIndexChart, { labels: data.labels, values: data.heat_index });
                updateChart(dewPointChart, { labels: data.labels, values: data.dew_point });
                updateChart(vaporPressureChart, { labels: data.labels, values: data.vapor_pressure });
                updateChart(vaporPressureDeficitChart, { labels: data.labels, values: data.vapor_pressure_deficit });
            });
    });

    // Trigger initial load
    document.getElementById('timeframe').dispatchEvent(new Event('change'));
});