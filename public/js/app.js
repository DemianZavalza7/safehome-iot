const api = "/api/recientes?limit=30";

let liveChart;
let maxChart;

async function cargarDatos()
{
    const respuesta = await fetch(api);
    const datos = await respuesta.json();

    if(datos.length === 0)
        return;

    const ultimo = datos[datos.length - 1];

    // ================= CARDS =================

    document.getElementById("tempCard").innerHTML =
        ultimo.temperatura + " °C";

    document.getElementById("humCard").innerHTML =
        ultimo.humedad + " %";

    document.getElementById("gasCard").innerHTML =
        ultimo.gasraw;

    document.getElementById("estadoCard").innerHTML =
        ultimo.indice;

    // ================= ALERTAS =================

    let alerta = "";

    if(ultimo.indice === "Peligro")
    {
        alerta =
        `<div class="alert red">
            🚨 PELIGRO DE GAS DETECTADO
        </div>`;
    }
    else if(ultimo.indice === "Alerta")
    {
        alerta =
        `<div class="alert orange">
            ⚠ ALERTA DE GAS
        </div>`;
    }
    else
    {
        alerta =
        `<div class="alert green">
            ✅ SISTEMA NORMAL
        </div>`;
    }

    document.getElementById("alertBox").innerHTML = alerta;

    // ================= TABLA HISTORIAL =================

    let filas = "";

    datos.slice().reverse().forEach(d => {

        filas += `
        <tr>
            <td>${d.id}</td>
            <td>${d.temperatura}</td>
            <td>${d.humedad}</td>
            <td>${d.gasraw}</td>
            <td>${d.fecha}</td>
        </tr>
        `;
    });

    document.getElementById("tabla").innerHTML = filas;

    // ================= MAXIMOS =================

    const maxTemp =
        Math.max(...datos.map(x => Number(x.temperatura)));

    const maxHum =
        Math.max(...datos.map(x => Number(x.humedad)));

    const maxGas =
        Math.max(...datos.map(x => Number(x.gasraw)));

    // ================= TABLA MAXIMOS =================

    document.getElementById("maximosTabla").innerHTML = `
        <tr>
            <th>Sensor</th>
            <th>Máximo</th>
        </tr>

        <tr>
            <td>🌡 Temperatura</td>
            <td>${maxTemp}</td>
        </tr>

        <tr>
            <td>💧 Humedad</td>
            <td>${maxHum}</td>
        </tr>

        <tr>
            <td>☣ Gas</td>
            <td>${maxGas}</td>
        </tr>
    `;

    // ================= GRAFICA EN VIVO =================

    const labels = datos.map(x => x.id);

    if(!liveChart)
    {
        liveChart = new Chart(
            document.getElementById("liveChart"),
            {
                type: "line",
                data:
                {
                    labels: labels,

                    datasets:
                    [
                        {
                            label: "Temperatura",
                            data: datos.map(x => x.temperatura),
                            borderColor: "red",
                            tension: 0.3
                        },

                        {
                            label: "Humedad",
                            data: datos.map(x => x.humedad),
                            borderColor: "blue",
                            tension: 0.3
                        },

                        {
                            label: "Gas",
                            data: datos.map(x => x.gasraw),
                            borderColor: "lime",
                            tension: 0.3
                        }
                    ]
                }
            });
    }
    else
    {
        liveChart.data.labels = labels;

        liveChart.data.datasets[0].data =
            datos.map(x => x.temperatura);

        liveChart.data.datasets[1].data =
            datos.map(x => x.humedad);

        liveChart.data.datasets[2].data =
            datos.map(x => x.gasraw);

        liveChart.update();
    }

    // ================= GRAFICA MAXIMOS =================

    if(!maxChart)
    {
        maxChart = new Chart(
            document.getElementById("maxChart"),
            {
                type: "bar",
                data:
                {
                    labels:
                    [
                        "Temperatura",
                        "Humedad",
                        "Gas"
                    ],

                    datasets:
                    [
                        {
                            label: "Máximos",

                            data:
                            [
                                maxTemp,
                                maxHum,
                                maxGas
                            ],

                            backgroundColor:
                            [
                                "red",
                                "blue",
                                "green"
                            ]
                        }
                    ]
                }
            });
    }
    else
    {
        maxChart.data.datasets[0].data =
        [
            maxTemp,
            maxHum,
            maxGas
        ];

        maxChart.update();
    }

    document.getElementById("ultima-sync").innerHTML =
        "⏱ Última sincronización: "
        + new Date().toLocaleTimeString();
}

cargarDatos();

setInterval(cargarDatos, 3000);
