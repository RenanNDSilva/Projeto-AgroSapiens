<!-- /var/www/html/climate_dashboard/climate_charts.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardião | Gráficos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/grafico.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/Icon Renan.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <style>
        .chart-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .chart-column {
            width: calc(50% - 10px);
        }
    </style>
</head>

<body>
    <header>
        <nav id="navbar">
            <a href="../index.html">
                <h1><img src="../assets/img/Logo_1.png" alt="Logo" id="nav_logo"></h1>
            </a>
            <h2><a href="../guardiao.html" class="guardian-home">Guardião</a> | <span style="font-weight: normal;">Gráficos</span></h2>
            <div class="media-button">
                <button class="btn-default-login">
                    <div class="btn-config">
                        <i class="fa-solid fa-user" style="color: #fff;"></i>
                        <a href="../index.html">Sair</a>
                    </div>
                </button>
                <div class="social-media-buttons">
                    <a href="https://api.whatsapp.com/send?phone=5516997136311&text=Ol%C3%A1,%20gostaria%20de%20obter%20mais%20informa%C3%A7%C3%B5es%20sobre%20a%20solu%C3%A7%C3%A3o%20Guardi%C3%A3o.%20Agrade%C3%A7o%20desde%20j%C3%A1%20pela%20aten%C3%A7%C3%A3o" target="_blank">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/agrosapiens-ltda-4b1455310/" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="filter">
            <label for="timeframe">Período:</label>
            <select id="timeframe">
                <option value="1">Último dia</option>
                <option value="10">Últimos 10 dias</option>
                <option value="30">Últimos 30 dias</option>
            </select>
        </div>

        <div class="chart-container">
            <div class="chart-row">
                <div class="chart-column">
                    <canvas id="temperatureChart"></canvas>
                </div>
                <div class="chart-column">
                    <canvas id="pressureChart"></canvas>
                </div>
            </div>
            <div class="chart-row">
                <div class="chart-column">
                    <canvas id="altitudeChart"></canvas>
                </div>
                <div class="chart-column">
                    <canvas id="humidityChart"></canvas>
                </div>
            </div>
            <div class="chart-row">
                <div class="chart-column">
                    <canvas id="heatIndexChart"></canvas>
                </div>
                <div class="chart-column">
                    <canvas id="dewPointChart"></canvas>
                </div>
            </div>
            <div class="chart-row">
                <div class="chart-column">
                    <canvas id="vaporPressureChart"></canvas>
                </div>
                <div class="chart-column">
                    <canvas id="vaporPressureDeficitChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-spacing-corretion"></div>
    <footer>
        <img src="../assets/img/wave (2).svg" alt="#">
        <div id="footer_items">
            <span id="copyright">
                &copy 2024 por AgroSapiens | criado por ADS023
            </span>
        </div>
    </footer>

    <script src="../assets/js/script.js"></script>
    <script src="js/grafico.js"></script>
</body>

</html>