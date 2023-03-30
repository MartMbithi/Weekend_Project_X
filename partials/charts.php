<?php
/*
 *   Crafted On Thu Mar 30 2023
 *   Author Martin (martin@devlan.co.ke)
 */
?>
<script>
    /* Prevent double submissions */
    $(function() {
        /* House  */
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Vacant',
                'Occupied',
            ],
            datasets: [{
                data: [700, 500],
                backgroundColor: ['#f56954', '#00a65a'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        /* Expenses Vs Revenue */
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Expenses',
                'Revenue',
            ],
            datasets: [{
                data: [7000, 500],
                backgroundColor: ['#00c0ef', '#3c8dbc'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })

    })
</script>