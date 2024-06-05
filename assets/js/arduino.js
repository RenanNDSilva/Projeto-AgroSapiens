// Função para fazer uma requisição GET para obter os dados do sensor
function fetchSensorData() {
    fetch('get-latest-sensor-data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar os dados do sensor: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error('Erro ao processar os dados do sensor: ' + data.error);
            }
            // Atualizar os dados na página
            document.getElementById('temperature-value').innerText = data.temperature;
            document.getElementById('pressure-value').innerText = data.pressure;
            document.getElementById('altitude-value').innerText = data.altitude;
            document.getElementById('humidity-value').innerText = data.humidity;
            document.getElementById('heat_index-value').innerText = data.heat_index;
            document.getElementById('dew_point-value').innerText = data.dew_point;
            document.getElementById('vapor_pressure-value').innerText = data.vapor_pressure;
            document.getElementById('vapor_pressure_deficit-value').innerText = data.vapor_pressure_deficit;
        })
        .catch(error => console.error(error));
}

// Atualizar os dados do sensor a cada meio segundo (500 milissegundos)
setInterval(fetchSensorData, 500);

// Inicializar os dados do sensor na página
fetchSensorData();