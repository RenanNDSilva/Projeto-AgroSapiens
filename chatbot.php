<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Conexão ao banco de dados
$servername = "localhost";
$username = "raphael";
$password = "12345Cx*,";
$dbname = "agrosapiens_clima";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["response" => "Erro de conexão com o banco de dados"]);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$userMessage = $data['message'];

$response = getResponse($userMessage, $conn);

echo json_encode(["response" => $response]);

$conn->close();

function getResponse($message, $conn) {
    $message = strtolower($message);

    if (stripos($message, 'últimos dados') !== false) {
        return getLastReading($conn);
    } elseif (stripos($message, 'temperatura') !== false && stripos($message, 'média') === false) {
        return getCurrentTemperature($conn);
    } elseif (stripos($message, 'umidade') !== false && stripos($message, 'média') === false) {
        return getCurrentHumidity($conn);
    } elseif (stripos($message, 'pressão') !== false && stripos($message, 'média') === false) {
        return getCurrentPressure($conn);
    } elseif (stripos($message, 'índice de calor') !== false && stripos($message, 'média') === false) {
        return getCurrentHeatIndex($conn);
    } elseif (stripos($message, 'ponto de orvalho') !== false && stripos($message, 'média') === false) {
        return getCurrentDewPoint($conn);
    } elseif (stripos($message, 'pressão de vapor') !== false && stripos($message, 'média') === false) {
        return getCurrentVaporPressure($conn);
    } elseif (stripos($message, 'déficit de pressão de vapor') !== false && stripos($message, 'média') === false) {
        return getCurrentVaporPressureDeficit($conn);
    } elseif (stripos($message, 'média') !== false) {
        return getAverageStatistics($message, $conn);
    } else {
        return "Desculpe, não entendi sua pergunta. Tente perguntar sobre 'últimos dados', 'temperatura', 'umidade', 'pressão', 'índice de calor', 'ponto de orvalho', 'pressão de vapor', 'déficit de pressão de vapor', ou 'média'.";
    }
}

function getLastReading($conn) {
    $sql = "SELECT * FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "Os últimos dados são: Temperatura: " . round($row['temperature'], 2) . "°C, Pressão: " . round($row['pressure'], 2) . " hPa, Altitude: " . round($row['altitude'], 2) . " m, Umidade: " . round($row['humidity'], 2) . "%, Índice de Calor: " . round($row['heat_index'], 2) . "°C, Ponto de Orvalho: " . round($row['dew_point'], 2) . "°C, Pressão de Vapor: " . round($row['vapor_pressure'], 2) . " hPa, Déficit de Pressão de Vapor: " . round($row['vapor_pressure_deficit'], 2) . " hPa.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getCurrentTemperature($conn) {
    $sql = "SELECT temperature FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "A temperatura atual é: " . round($row['temperature'], 2) . "°C.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getCurrentHumidity($conn) {
    $sql = "SELECT humidity FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "A umidade atual é: " . round($row['humidity'], 2) . "%.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getCurrentPressure($conn) {
    $sql = "SELECT pressure FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "A pressão atual é: " . round($row['pressure'], 2) . " hPa.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getCurrentHeatIndex($conn) {
    $sql = "SELECT heat_index FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "O índice de calor atual é: " . round($row['heat_index'], 2) . "°C.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getCurrentDewPoint($conn) {
    $sql = "SELECT dew_point FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "O ponto de orvalho atual é: " . round($row['dew_point'], 2) . "°C.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getCurrentVaporPressure($conn) {
    $sql = "SELECT vapor_pressure FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "A pressão de vapor atual é: " . round($row['vapor_pressure'], 2) . " hPa.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getCurrentVaporPressureDeficit($conn) {
    $sql = "SELECT vapor_pressure_deficit FROM leituras_climaticas ORDER BY timestamp DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "O déficit de pressão de vapor atual é: " . round($row['vapor_pressure_deficit'], 2) . " hPa.";
    } else {
        return "Não há leituras disponíveis.";
    }
}

function getAverageStatistics($message, $conn) {
    $metrics = [
        'temperatura' => 'temperature', 
        'umidade' => 'humidity', 
        'pressão' => 'pressure', 
        'índice de calor' => 'heat_index', 
        'ponto de orvalho' => 'dew_point', 
        'pressão de vapor' => 'vapor_pressure', 
        'déficit de pressão de vapor' => 'vapor_pressure_deficit'
    ];
    
    $intervals = [
        'hoje' => 1, 
        'nos últimos 10 dias' => 10, 
        'nos últimos 30 dias' => 30
    ];

    foreach ($metrics as $metric => $field) {
        if (stripos($message, $metric) !== false) {
            foreach ($intervals as $key => $days) {
                if (stripos($message, $key) !== false) {
                    $interval = $days === 1 ? "CURDATE()" : "CURDATE() - INTERVAL $days DAY";
                    $sql = "SELECT AVG($field) as avg_value FROM leituras_climaticas WHERE timestamp >= $interval";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        return "A média da $metric $key é: " . round($row['avg_value'], 2) . ($metric === 'temperatura' || $metric === 'índice de calor' || $metric === 'ponto de orvalho' ? "°C" : ($metric === 'umidade' ? "%" : " hPa")) . ".";
                    } else {
                        return "Não há leituras disponíveis para a $metric $key.";
                    }
                }
            }
        }
    }

    return "Por favor, especifique uma métrica (temperatura, umidade, pressão, índice de calor, ponto de orvalho, pressão de vapor, déficit de pressão de vapor) e um intervalo de tempo (hoje, nos últimos 10 dias, nos últimos 30 dias).";
}