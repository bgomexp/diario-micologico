"use strict";
import "flyonui/flyonui"

//Cambios en el select
document.querySelector("#year").addEventListener("change", function () {
  const url = "/estadisticas/" + document.querySelector("#year").value;
  window.location.href = url;
});

//Gráfico de entradas
window.renderGraficoEntradas = function(valores) {
    const ctx = document.getElementById('graficoEntradas').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                     'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Entradas registradas',
                data: valores,
                fill: false,
                borderColor: 'rgba(166, 188, 151, 1)',
                backgroundColor: 'rgba(166, 188, 151, 0.5)',
                borderWidth: 2,
                tension: 0.3,
                pointBackgroundColor: 'rgba(166, 188, 151, 1)',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
};

//Gráfico de ejemplares
window.renderGraficoUnidades = function(valores) {
    const ctx = document.getElementById('graficoUnidades').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: `Ejemplares encontrados`,
                data: valores,
                backgroundColor: 'rgba(166, 188, 151, 0.5)',
                borderColor: 'rgba(166, 188, 151, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
};

//Gráfico de top de especies
window.renderGraficoTopEspecies = function(labels, valores) {
    const ctx = document.getElementById('graficoTopEspecies').getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Top 10 especies recolectadas',
                data: valores,
                backgroundColor: [
                    '#adc178',
                    '#c5d396',
                    '#dde5b4',
                    '#e3dd90',
                    '#e8d56c',
                    '#f2c523',
                    '#6c584c',
                    '#8b6e5a',
                    '#a98467',
                    '#aba370',
                ],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 8 // 👈 Reduce espacio entre el gráfico y la leyenda
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.parsed;
                            return `${label}: ${value}`;
                        }
                    }
                }
            }
        }
    });
};
