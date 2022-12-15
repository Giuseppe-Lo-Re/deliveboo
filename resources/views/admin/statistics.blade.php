@extends('admin.components.content')

@section('main_content')
    <section>
        <h1 class="text-center mb-0">Statistiche</h1>
        <div class="text-center mb-4">(basate sugli ultimi 12 mesi)</div>

        <div class="mb-4 text-center">
            <div class="mb-2">Cambia stile grafico</div>
            <select autocomplete="off" onchange="changeChartStyle(this)">
                @foreach ($chart_types as $chart_type)
                    <option value="{{$chart_type}}">{{$chart_type}}</option>
                @endforeach
            </select>
        </div>

        <div class="ms_chart-wrapper">
            <canvas id="ms_js-chart"></canvas>
        </div>
        
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        // cart labels
        const labels = <?php echo json_encode(array_reverse($timestamps)); ?>;

        // charts data1
        const data1 = {
            labels: labels,
            datasets: [
                {
                    label: 'Ordini',
                    backgroundColor: ['rgba(220, 236, 201, 0.75)', 'rgba(179, 221, 204, 0.75)', 'rgba(138, 205, 206, 0.75)', 'rgba(98, 190, 210, 0.75)', 'rgba(70, 170, 206, 0.75)', 'rgba(61, 145, 190, 0.75)', 'rgba(53, 119, 174, 0.75)', 'rgba(45, 94, 158, 0.75)', 'rgba(36, 68, 142, 0.75)', 'rgba(28, 43, 127, 0.75)', 'rgba(22, 32, 101, 0.75)', 'rgba(17, 23, 75, 0.75)'],
                    hoverBackgroundColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    borderWidth: 1,
                    borderColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    data: <?php echo json_encode($monthly_orders); ?>,
                },
                {
                    label: 'Entrate (€)',
                    backgroundColor: 'rgba(38, 79, 54, 0.65)',
                    hoverBackgroundColor: 'rgb(38, 79, 54)',
                    borderWidth: 1,
                    borderColor: 'rgb(38, 79, 54)',
                    data: <?php echo json_encode($monthly_revenue); ?>,
                }
            ]
        }

        // charts data2
        const data2 = {
            labels: labels,
            datasets: [
                {
                    label: 'Ordini',
                    radius: 5,
                    hoverRadius: 10,
                    hitRadius: 20,
                    backgroundColor: ['rgba(220, 236, 201, 0.75)', 'rgba(179, 221, 204, 0.75)', 'rgba(138, 205, 206, 0.75)', 'rgba(98, 190, 210, 0.75)', 'rgba(70, 170, 206, 0.75)', 'rgba(61, 145, 190, 0.75)', 'rgba(53, 119, 174, 0.75)', 'rgba(45, 94, 158, 0.75)', 'rgba(36, 68, 142, 0.75)', 'rgba(28, 43, 127, 0.75)', 'rgba(22, 32, 101, 0.75)', 'rgba(17, 23, 75, 0.75)'],
                    hoverBackgroundColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    borderWidth: 1,
                    borderColor: 'rgb(17, 23, 75)',
                    pointBorderColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    data: <?php echo json_encode($monthly_orders); ?>,
                },
                {
                    label: 'Entrate (€)',
                    radius: 5,
                    hoverRadius: 10,
                    hitRadius: 20,
                    backgroundColor: 'rgba(38, 79, 54, 0.65)',
                    hoverBackgroundColor: 'rgb(38, 79, 54)',
                    borderWidth: 1,
                    borderColor: 'rgb(38, 79, 54)',
                    data: <?php echo json_encode($monthly_revenue); ?>,
                }
            ]
        }

        // charts data3
        const data3 = {
            labels: labels,
            datasets: [
                {
                    label: 'Ordini',
                    radius: 3,
                    hoverRadius: 6,
                    hitRadius: 15,
                    backgroundColor: 'rgba(138, 205, 206, 0.6)',
                    hoverBackgroundColor: 'rgb(138, 205, 206)',
                    pointBackgroundColor: ['rgba(220, 236, 201, 0.75)', 'rgba(179, 221, 204, 0.75)', 'rgba(138, 205, 206, 0.75)', 'rgba(98, 190, 210, 0.75)', 'rgba(70, 170, 206, 0.75)', 'rgba(61, 145, 190, 0.75)', 'rgba(53, 119, 174, 0.75)', 'rgba(45, 94, 158, 0.75)', 'rgba(36, 68, 142, 0.75)', 'rgba(28, 43, 127, 0.75)', 'rgba(22, 32, 101, 0.75)', 'rgba(17, 23, 75, 0.75)'],
                    pointHoverBackgroundColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    borderWidth: 1,
                    borderColor: 'rgb(17, 23, 75)',
                    pointBorderColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    data: <?php echo json_encode($monthly_orders); ?>,
                }
            ]
        }

        // charts data4
        const data4 = {
            labels: labels,
            datasets: [
                {
                    label: 'Ordini',
                    backgroundColor: ['rgba(220, 236, 201, 0.75)', 'rgba(179, 221, 204, 0.75)', 'rgba(138, 205, 206, 0.75)', 'rgba(98, 190, 210, 0.75)', 'rgba(70, 170, 206, 0.75)', 'rgba(61, 145, 190, 0.75)', 'rgba(53, 119, 174, 0.75)', 'rgba(45, 94, 158, 0.75)', 'rgba(36, 68, 142, 0.75)', 'rgba(28, 43, 127, 0.75)', 'rgba(22, 32, 101, 0.75)', 'rgba(17, 23, 75, 0.75)'],
                    hoverBackgroundColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    borderWidth: 1,
                    borderColor: ['rgb(220, 236, 201)', 'rgb(179, 221, 204)', 'rgb(138, 205, 206)', 'rgb(98, 190, 210)', 'rgb(70, 170, 206)', 'rgb(61, 145, 190)', 'rgb(53, 119, 174)', 'rgb(45, 94, 158)', 'rgb(36, 68, 142)', 'rgb(28, 43, 127)', 'rgb(22, 32, 101)', 'rgb(17, 23, 75)'],
                    data: <?php echo json_encode($monthly_orders); ?>,
                }
            ]
        }

        // charts configurations
        // bar chart
        const config1 = {
            type: 'bar',
            data: data1,
            options: {
                maintainAspectRatio: false,
                scales: {
                    
                }
            }
        }

        // line chart
        const config2 = {
            type: 'line',
            data: data2,
            options: {
                maintainAspectRatio: false,
                scales: {
                    
                }
            }
        }

        // radar chart
        const config3 = {
            type: 'radar',
            data: data3,
            options: {
                maintainAspectRatio: false,
                scales: {
                
                }
            }
        }

        // polarArea chart
        const config4 = {
            type: 'polarArea',
            data: data4,
            options: {
                maintainAspectRatio: false,
                scales: {
                
                }
            }
        }

        // doughnut chart
        const config5 = {
            type: 'doughnut',
            data: data4,
            options: {
                maintainAspectRatio: false,
                scales: {
                
                }
            }
        }

        // default chart render
        let myChart = new Chart(
            document.getElementById('ms_js-chart'),
            config1
        );

        // when the user select a different option the changeChartStyle function destroy myChart and
        // after that re-render it with different config fased on the option selected by the user himself
        function changeChartStyle(chartStyle) {
            myChart.destroy();

            if(chartStyle.value === 'bar') {
                myChart = new Chart(
                    document.getElementById('ms_js-chart'),
                    config1
                );
            } else if(chartStyle.value === 'line') {
                myChart = new Chart(
                    document.getElementById('ms_js-chart'),
                    config2
                );
            } else if(chartStyle.value === 'radar') {
                myChart = new Chart(
                    document.getElementById('ms_js-chart'),
                    config3
                );
            } else if(chartStyle.value === 'polarArea') {
                myChart = new Chart(
                    document.getElementById('ms_js-chart'),
                    config4
                );
            } else if(chartStyle.value === 'doughnut') {
                myChart = new Chart(
                    document.getElementById('ms_js-chart'),
                    config5
                );
            }
        }
    </script>
@endsection