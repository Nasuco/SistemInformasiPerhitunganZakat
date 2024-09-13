@extends('layouts.user_type.auth')



@section('content')

<div class="container mt-4">
    <div class="row">
        <!-- Total Zakat Beras -->
        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 font-weight-bold">Total Zakat Beras</p>
                                <h5 class="mb-0">{{ $totalMuzakkiBeras }}/{{ $totalJiwaBeras }} Jiwa</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Zakat Uang -->
        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 font-weight-bold">Total Zakat Uang</p>
                                <h5 class="mb-0">{{ $totalMuzakkiUang }}/{{ $totalJiwaUang }} Jiwa</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Zakat Maal -->
        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 font-weight-bold">Total Zakat Maal</p>
                                <h5 class="mb-0">{{ $totalMuzakkiMaal }} Jiwa</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Fidyah -->
        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 font-weight-bold">Total Fidyah</p>
                                <h5 class="mb-0">{{ $totalMuzakkiFidyah }} Jiwa</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Beras -->
    <div class="row mt-4">
        <div class="col-md-6 pb-4">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">Total Zakat Beras</h5>
                </div>
                <div class="card-body">
                    <canvas id="pieChartBeras" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">Total Zakat Uang</h5>
                </div>
                <div class="card-body">
                    <canvas id="pieChartUang" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">Total Zakat Beras (Kg)</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChartBeras" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">Total Zakat Uang (Rp)</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChartUang" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">Total Zakat Maal (Rp)</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChartMaal" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">Total Fidyah (Rp)</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChartFidyah" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
{{-- <div class="card-body p-4">
    <div class="card h-100 p-3">
        <div
            class="overflow-hidden position-relative border-radius-lg h-100 d-flex justify-content-center align-items-center">
            <img src="../assets/img/rs.png" class="w-100 h-100 object-fit-cover" alt="Image">
        </div>
    </div>
</div> --}}
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var dataBeras = @json($chartDataBeras);
        var dataUang = @json($chartDataUang);

        var labeledDataBeras = Object.keys(dataBeras).map(function (key) {
            return isNaN(key) ? key : 'RT ' + key;
        });

        var labeledDataUang = Object.keys(dataUang).map(function (key) {
            return isNaN(key) ? key : 'RT ' + key;
        });

        var ctxBeras = document.getElementById('pieChartBeras').getContext('2d');
        var ctxUang = document.getElementById('pieChartUang').getContext('2d');

        // Menetapkan warna berdasarkan RT
        var colorPalette = {
            'RT 19': 'rgba(153, 102, 255, 0.8)',
            'RT 20': 'rgba(255, 159, 64, 0.8)',
            'RT 21': 'rgba(255, 99, 132, 0.8)',
            'RT 22': 'rgba(54, 162, 235, 0.8)',
            'RT 23': 'rgba(255, 206, 86, 0.8)',
            'Perum': 'rgba(75, 192, 19, 0.8)',
            // ... tambahkan warna lain sesuai kebutuhan
        };

        var myPieChartBeras = new Chart(ctxBeras, {
            type: 'pie',
            data: {
                labels: labeledDataBeras,
                datasets: [{
                    data: Object.values(dataBeras),
                    backgroundColor: labeledDataBeras.map(rt => colorPalette[rt]),
                }],
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
        });

        var myPieChartUang = new Chart(ctxUang, {
            type: 'pie',
            data: {
                labels: labeledDataUang,
                datasets: [{
                    data: Object.values(dataUang),
                    backgroundColor: labeledDataUang.map(rt => colorPalette[rt]),
                }],
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctxBeras = document.getElementById('barChartBeras').getContext('2d');
        var ctxUang = document.getElementById('barChartUang').getContext('2d');
        var ctxMaal = document.getElementById('barChartMaal').getContext('2d');
        var ctxFidyah = document.getElementById('barChartFidyah').getContext('2d');

        var barChartBeras = new Chart(ctxBeras, {
            type: 'bar',
            data: {
                labels: {!! $totalKgBeras->keys() !!},
                datasets: [{
                    label: 'Kilogram (Kg)' + '  ' + '('+{!! $totalKgBerasAll !!}+')',
                    data: {!! $totalKgBeras->values() !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Perbaikan pada barChartUang
        var barChartUang = new Chart(ctxUang, {
            type: 'bar',
            data: {
                labels: {!! $totalRpUang->keys() !!},
                datasets: [{
                    label: 'Rupiah (Rp)' + '  ' + '('+{!! $totalRpUangAll !!}+')',
                    data: {!! $totalRpUang->values() !!},
                    backgroundColor: 'rgba(153, 102, 255, 0.8)',
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Perbaikan pada barChartMaal
        var barChartMaal = new Chart(ctxMaal, {
            type: 'bar',
            data: {
                labels: {!! $totalRpMaal->keys() !!},
                datasets: [{
                    label: 'Rupiah (Rp)' + '  ' + '('+{!! $totalRpMaalAll !!}+')',
                    data: {!! $totalRpMaal->values() !!},
                    backgroundColor: 'rgba(255, 159, 64, 0.8)',
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Perbaikan pada barChartFidyah
        var barChartFidyah = new Chart(ctxFidyah, {
            type: 'bar',
            data: {
                labels: {!! $totalRpFidyah->keys() !!},
                datasets: [{
                    label: 'Rupiah (Rp)' + '  ' + '('+{!! $totalRpFidyahAll !!}+')',
                    data: {!! $totalRpFidyah->values() !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    });
</script>



@endsection
{{-- @push('ahligiziHome')
    <script>
        window.onload = function () {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                display: false
                            },
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                            label: "Mobile apps",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#cb0c9f",
                            borderWidth: 3,
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                            maxBarThickness: 6

                        },
                        {
                            label: "Websites",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#3A416F",
                            borderWidth: 3,
                            backgroundColor: gradientStroke2,
                            fill: true,
                            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                            maxBarThickness: 6
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }

    </script>
@endpush --}}
