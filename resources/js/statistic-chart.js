import Chart from 'chart.js/auto';
const ctx = document.getElementById('chart');
const data = ctx.getAttribute('chart-data');
const initChart = async function () {
    if (ctx) {
        return new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Article',
                    data: JSON.parse(data),
                    fill: false,
                    backgroundColor: 'orangered',
                }]
            },
        });
    }
}

initChart();
