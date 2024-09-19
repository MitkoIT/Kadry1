const ctx = document.getElementById('myDiagram').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar', // Change to 'line', 'pie', etc. for different chart types
    data: {
        labels: ['Wszyscy', 'Aktywni', 'Nieaktywni'],
        datasets: [{
            label: '# Użytkowników',
            data: [15, 2, 13],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(0, 255, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(1, 255, 235, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
               display:false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        },
        layout: {
        },
    }
});