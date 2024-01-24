<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2>Selamat datang <?= session('user')['nama'] ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Grafik Data Mahasiswa -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Data Mahasiswa</h5>
                    <div id="chartMahasiswa"></div>
                </div>
            </div>
        </div>

        <!-- Grafik Data Usulan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Data Usulan</h5>
                    <div id="chartUsulan"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>

<script>
        var mahasiswaData = <?= json_encode($mahasiswa); ?>;
        var categories = [];
        var data = [];

        // Periksa apakah ada data mahasiswa
        if (mahasiswaData.length === 0) {
            // Jika tidak ada data, tampilkan pesan
            document.querySelector("#chartMahasiswa").innerHTML = "<p>Tidak ada data yang ditampilkan</p>";
        } else {
            // Batasi data semester hingga 8
            mahasiswaData = mahasiswaData.slice(0, 8);

            mahasiswaData.forEach(function(item) {
                categories.push(item.semester);
                data.push(parseInt(item.total_mahasiswa));
            });

            var chartOptions = {
                series: [{
                    name: "Jumlah Mahasiswa",
                    data: data
                }],
                chart: {
                    type: "bar",
                    height: 345,
                    offsetX: -15,
                    toolbar: {
                        show: true
                    },
                    foreColor: "#adb0bb",
                    fontFamily: "inherit",
                    sparkline: {
                        enabled: false
                    },
                },
                colors: ["#5D87FF"],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "35%",
                        borderRadius: [6],
                    },
                },
                markers: {
                    size: 0
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                grid: {
                    borderColor: "rgba(0,0,0,0.1)",
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },
                yaxis: {
                    show: true,
                    min: 0,
                    max: Math.max(...data),
                    tickAmount: 4,
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color",
                        },
                        formatter: function(value) {
                            return parseInt(value);
                        },
                    },
                    title: {
                        text: 'Jumlah Mahasiswa', // Tambahkan judul y-axis
                    },
                },
                xaxis: {
                    type: "category",
                    categories: categories,
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color"
                        },
                    },
                },
                stroke: {
                    show: true,
                    width: 3,
                    lineCap: "butt",
                    colors: ["transparent"],
                },
                tooltip: {
                    theme: "light"
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 3,
                            },
                        },
                    },
                }],
            };

            var chart = new ApexCharts(document.querySelector("#chartMahasiswa"), chartOptions);
            chart.render();
        }


        // chart data usulan

        var sudahDokumen = <?= $sudahDokumen; ?>;
        var belumDokumen = <?= $belumDokumen; ?>;

        if (sudahDokumen + belumDokumen === 0) {
            document.querySelector("#chartUsulan").innerHTML = "<p>Tidak ada data yang ditampilkan</p>";
        } else {
            var chartUsulanOptions = {
                series: [{
                    name: 'Jumlah Mahasiswa',
                    data: [sudahDokumen, belumDokumen]
                }],
                chart: {
                    type: "bar",
                    height: 345,
                    toolbar: {
                        show: true
                    },
                    foreColor: "#adb0bb",
                    fontFamily: "inherit"
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "35%",
                        borderRadius: 6,
                    },
                },
                xaxis: {
                    categories: ["Sudah Upload", "Belum Upload"],
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color"
                        }
                    }
                },
                yaxis: {
                    show: true,
                    min: 0,
                    tickAmount: 4,
                    labels: {
                        formatter: function(value) {
                            return value.toFixed(0);
                        },
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color"
                        }
                    },
                    title: {
                        text: 'Jumlah Mahasiswa', // Tambahkan judul y-axis
                    },
                },
                stroke: {
                    show: true,
                    dashArray: 5
                },
                colors: ["#5D87FF", "#49BEFF"],
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: true,
                    position: "bottom",
                    fontSize: "14px",
                    markers: {
                        radius: 12
                    }
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            height: 280
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }]
            };

            var chartUsulan = new ApexCharts(document.querySelector("#chartUsulan"), chartUsulanOptions);
            chartUsulan.render();
        }
    </script>


<?= $this->endSection() ?>