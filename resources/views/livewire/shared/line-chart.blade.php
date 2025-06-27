@push('scripts')
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script>
    $(function () {
        var areaChartCanvas = $('#{{ $chartId }}').get(0).getContext('2d')
        var areaChartData = {
            labels  : @json($chartLabels),
            datasets: [
                {
                    label               : '{{ $description }}',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius         : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : @json($chartData)
                },
            ]
        }

        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : false,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : false,
                    }
                }]
            }
        }
        
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })
    })
</script>
@endpush

<div>
    <div class="chart">
        <canvas id="{{ $chartId }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 379px;" width="473" height="312" class="chartjs-render-monitor"></canvas>
    </div>
</div>
