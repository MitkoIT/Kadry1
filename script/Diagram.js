const ctx = document.getElementById('myDiagram').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar', // Change to 'line', 'pie', etc. for different chart types
    data: {
        labels: ['Nieaktywni', 'Aktywni', 'Wszyscy'],
        datasets: [{
            label: '# Użytkowników',
            data: [13, 2, 15],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
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