<div class="card h-100">
    <div class="card-header">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <button
                    type="button"
                    class="nav-link active"
                    role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-tabs-line-card-income"
                    aria-controls="navs-tabs-line-card-income"
                    aria-selected="true">
                    Statistik Fakultas
                </button>
            </li>
        </ul>
    </div>
    <div class="card-body px-0">
        <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                <div class="container">
                    <input type="hidden" id="citations" value="{{json_encode($citations)}}" readonly/>
                    <input type="hidden" id="years" value="{{json_encode($years)}}" readonly/>
                    <input type="hidden" id="max_year" value="{{max($citations)}}">
                    <div class="mb-3 row">
                        <label for="start_year" class="col-md-4 col-form-label">From</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="start_year" wire:model="startYear">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="end_year" class="col-md-4 col-form-label">To</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="end_year" wire:model="endYear">
                        </div>
                    </div>
                </div>
                <div class="d-flex p-4 pt-3">
                    <div class="avatar flex-shrink-0 me-3">
                        <img src="{{asset('theme/sneatadmin/assets/img/icons/unicons/wallet.png')}}" alt="User"/>
                    </div>

                    <div>
                        <small class="text-muted d-block">Total Citation</small>
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 me-1">{{$totalCitation}}</h6>
                            <small class="text-success fw-medium">
                                </i>
                                dari tahun {{min($years)}} s.d {{max($years)}}
                            </small>
                        </div>
                    </div>
                </div>
                <div id="citationChart"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        'use strict';
        document.addEventListener('contentChanged', function (){
            viewchart();
        });
        function viewchart() {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            var citations = $('#citations').val();
            var years = $('#years').val();
            var max_year = $('#max_year').val();
            const citationChartEl = document.querySelector('#citationChart'),
                citationChartConfig = {
                    series: [
                        {
                            data: JSON.parse(citations).map(Number),
                        }
                    ],
                    chart: {
                        height: 300,
                        parentHeightOffset: 0,
                        parentWidthOffset: 0,
                        toolbar: {
                            show: false
                        },
                        type: 'area'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'straight'
                    },
                    legend: {
                        show: false
                    },
                    markers: {
                        size: 6,
                        colors: 'transparent',
                        strokeColors: 'transparent',
                        strokeWidth: 4,
                        discrete: [
                            {
                                fillColor: config.colors.white,
                                seriesIndex: 0,
                                dataPointIndex: 7,
                                strokeColor: config.colors.primary,
                                strokeWidth: 2,
                                size: 6,
                                radius: 8
                            }
                        ],
                        hover: {
                            size: 7
                        }
                    },
                    colors: [config.colors.primary],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: shadeColor,
                            shadeIntensity: 0.6,
                            opacityFrom: 0.5,
                            opacityTo: 0.25,
                            stops: [0, 95, 100]
                        }
                    },
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 3,
                        padding: {
                            top: -20,
                            bottom: 0,
                            left: 10,
                            right: 10
                        }
                    },
                    xaxis: {
                        categories: JSON.parse(years).map(Number),
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: true,
                            style: {
                                fontSize: '13px',
                                colors: axisColor
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: false
                        },
                        min: 0,
                        max: parseInt(max_year),
                        tickAmount: 4
                    }
                };
            if (typeof citationChartEl !== undefined && citationChartEl !== null) {
                const chart = new ApexCharts(citationChartEl, citationChartConfig);
                chart.render();
            }
        };
        viewchart();
    </script>

@endpush

