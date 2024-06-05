<?php
require 'config.php';

// Função para recuperar os últimos dados do sensor do banco de dados
function getLatestSensorData() {
    global $conn;

    // Consultar os últimos dados do sensor no banco de dados
    $stmt = $conn->query('SELECT * FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1');
    if (!$stmt) {
        return ["error" => "Erro ao executar a consulta no banco de dados: " . $conn->error];
    }

    $sensorData = $stmt->fetch_assoc();
    if (!$sensorData) {
        return ["error" => "Nenhum dado do sensor encontrado"];
    }

    // Limitar os valores numéricos a duas casas decimais após a vírgula
    foreach ($sensorData as $key => $value) {
        if (is_numeric($value)) {
            $sensorData[$key] = number_format($value, 2, '.', '');
        }
    }

    return $sensorData;
}

// Rota para obter os últimos dados do sensor
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sensorData = getLatestSensorData();
    echo json_encode($sensorData);
}
?>
