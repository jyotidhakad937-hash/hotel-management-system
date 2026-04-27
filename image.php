<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Interactive Graph</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Monthly Statistics</h5>
        </div>
        <div class="card-body">
            <canvas id="myChart" height="100"></canvas>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // AJAX call bina page refresh kiye data laane ke liye
    $.ajax({
        // Yahan path change kiya gaya hai 👇
        url: 'php/fetch_data.php', 
        type: 'GET',
        success: function(response) {
            var months = [];
            var amounts = [];

            for(var i in response) {
                months.push(response[i].month_name);
                amounts.push(response[i].total_amount);
            }

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: months, 
                    datasets: [{
                        label: 'Total Revenue / Bookings',
                        data: amounts, 
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            // Agar path galat hoga toh browser console me error dikhega
            console.error("AJAX Error: " + status + error);
        }
    });
});
</script>

</body>
</html>