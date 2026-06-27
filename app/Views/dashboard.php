<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SafeHome IoT</title>

<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .alert.red { background: #ff4d4d; color: white; padding: 10px; margin: 5px 0; }
    .alert.orange { background: orange; color: white; padding: 10px; margin: 5px 0; }
    .alert.green { background: green; color: white; padding: 10px; margin: 5px 0; }
</style>

</head>

<body>

<div class="sidebar">
    <h1>🏠 este es SafeHome</h1>
    <ul>
        <li><a href="#dashboard">📊 Dashboard</a></li>
        <li><a href="#sensores">🌡 Sensores</a></li>
        <li><a href="#alertas">🚨 Alertas</a></li>
        <li><a href="#historial">📋 Historial</a></li>
    </ul>
</div>

<div class="main">

<header id="dashboard">
    <h2>SafeHome IoT Dashboard  </h2>
    <div id="status" class="status">🟢 Sistema Armado</div>
</header>

<!-- CARDS -->
<div class="cards">
    <div class="card"><h3>🌡 Temperatura</h3><p id="tempCard">--</p></div>
    <div class="card"><h3>💧 Humedad</h3><p id="humCard">--</p></div>
    <div class="card"><h3>☣ Gas</h3><p id="gasCard">--</p></div>
    <div class="card"><h3>📡 Estado</h3><p id="estadoCard">--</p></div>
</div>

<!-- GRAFICAS -->
<section class="panel-grid">

    <div class="panel">
        <h2>📊 En Vivo </h2>
        <canvas id="liveChart"></canvas>
    </div>

    <div class="panel">
        <h2>🔥 Máximos Detectados</h2>
        <canvas id="maxChart"></canvas>
        <br>

<table id="maximosTabla" border="1" width="100%">
</table>
    </div>

</section>

<!-- ALERTAS -->
<section id="alertas">
    <h2>🚨 Alertas</h2>
    <div id="alertBox"></div>
</section>

<!-- HISTORIAL -->
<section id="historial">
    <h2>📋 Historial</h2>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Temp</th>
                <th>Hum</th>
                <th>Gas</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody id="tabla"></tbody>
    </table>
</section>

<p id="ultima-sync">⏱ Última sincronización: --</p>

</div>

<script src="<?= base_url('js/app.js') ?>"></script>

</body>
</html>