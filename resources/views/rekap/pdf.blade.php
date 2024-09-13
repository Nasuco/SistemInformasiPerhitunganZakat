<!-- resources/views/rekap-pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Zakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
    
    </style>
</head>
<body>
    <div class="container-fluid" style="margin: 20px; page-break-after: always;">
        <div class="mb-3">
            <h1 class="text-center fw-bold">PANITIA ZAKAT FITRAH</h1>
            <h2 class="text-center fw-bold">Masjid Syuhairoh Binti Ali</h2>
            <p class="text-center fw-normal">Jambon, Sabrang Lor, Kec. trucuk, Kab. Klaten, Jawa Tengah 57467<br>Tahun 1445 H / 2024 M</p>
        </div>
        <hr class="border border-dark border-4 opacity-75">
        <div>
            <h3 class="text-center mb-4">REKAPITULASI PELAKSANAAN ZAKAT FITRAH TAHUN 1445 H / 2024 M</h3>
            <table class="table">
                <thead>
                    <h3>I.&nbsp;&nbsp;&nbsp;&nbsp;Zakat Beras</h3>
                    <tr>
                        <th>RT</th>
                        <th>Jumlah Jiwa</th>
                        <th>Jumlah Kg</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jumlahOrangBeras as $data)
                        <tr>
                            <td>{{ $data->alamat_rt }}</td>
                            <td>{{ $data->jumlah_orang }} jiwa</td>
                            <td>{{ $data->jumlah_beras }} kg</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="border border-dark border-1 opacity-100 mb-4" style="width: 100%;">
            <table class="table">
                <thead>
                    <h3>II.&nbsp;&nbsp;&nbsp;&nbsp;Zakat Uang</h3>
                    <tr>
                        <th>RT</th>
                        <th>Jumlah Jiwa</th>
                        <th>Jumlah Rp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jumlahOrangUang as $data)
                        <tr>
                            <td>{{ $data->alamat_rt }}</td>
                            <td>{{ $data->jumlah_orang }} jiwa</td>
                            <td>Rp. {{ $data->jumlah_uang_rp }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="border border-dark border-1 opacity-100 mb-4" style="width: 100%;">
            <table class="table">
                <thead>
                    <h3>III.&nbsp;&nbsp;&nbsp;&nbsp;Zakat Maal</h3>
                    <tr>
                        <th>Jumlah Jiwa</th>
                        <th>Jumlah Rp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalOrangMaal }} jiwa</td>
                        <td>Rp. {{ $totalRpMaal }}</td>
                    </tr>
                </tbody>
            </table>
            <hr class="border border-dark border-1 opacity-100 mb-4" style="width: 100%;">
            <table class="table">
                <thead>
                    <h3>IV.&nbsp;&nbsp;&nbsp;&nbsp;Fidyah</h3>
                    <tr>
                        <th>Jumlah Jiwa</th>
                        <th>Jumlah Rp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalOrangFidyah }} jiwa</td>
                        <td>Rp. {{ $totalRpFidyah }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-fluid" style="margin: 20px;">
        <div class="mb-3">
            <h1 class="text-center fw-bold">PANITIA ZAKAT FITRAH</h1>
            <h2 class="text-center fw-bold">Masjid Syuhairoh Binti Ali</h2>
            <p class="text-center fw-normal">Jambon, Sabrang Lor, Kec. trucuk, Kab. Klaten, Jawa Tengah 57467<br>Tahun 1445 H / 2024 M</p>
        </div>
        <hr class="border border-dark border-4 opacity-75">
        <div class="mb-5">
            <h3 class="text-center mb-4">REKAPITULASI PELAKSANAAN ZAKAT FITRAH TAHUN 1445 H / 2024 M</h3>
            <table class="table">
                <thead>
                    <h3>I.&nbsp;&nbsp;&nbsp;&nbsp;Zakat Beras</h3>
                    <tr>
                        <th>Total Jiwa</th>
                        <th>Total Kg</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalOrangBeras }} jiwa</td>
                        <td>{{ $totalKgBeras }} Kg</td>
                    </tr>
                </tbody>
            </table>
            <hr class="border border-dark border-1 opacity-100 mb-4" style="width: 100%;">
            <table class="table">
                <thead>
                    <h3>II.&nbsp;&nbsp;&nbsp;&nbsp;Zakat Uang</h3>
                    <tr>
                        <th>Total Jiwa</th>
                        <th>Total Rp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalOrangUang }} jiwa</td>
                        <td>Rp. {{ $totalRpUang }}</td>
                    </tr>
                </tbody>
            </table>
            <hr class="border border-dark border-1 opacity-100 mb-4" style="width: 100%;">
    
            <table class="table">
                <thead>
                    <h3>III.&nbsp;&nbsp;&nbsp;&nbsp;Zakat Maal</h3>
                    <tr>
                        <th>Total Jiwa</th>
                        <th>Total Rp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalOrangMaal }} jiwa</td>
                        <td>Rp. {{ $totalRpMaal }}</td>
                    </tr>
                </tbody>
            </table>
            <hr class="border border-dark border-1 opacity-100 mb-4" style="width: 100%;">
    
            <table class="table">
                <thead>
                    <h3>IV.&nbsp;&nbsp;&nbsp;&nbsp;Fidyah</h3>
                    <tr>
                        <th>Total Jiwa</th>
                        <th>Total Rp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalOrangFidyah }} jiwa</td>
                        <td>Rp. {{ $totalRpFidyah }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- Tanda Tangan --}}
        <p class="text-center">Mengetahui,</p>
        <table class="table text-center float-left">
            <thead>
                <tr>
                    <td>Ketua Panitia Zakat Fitrah</td>
                    <td>Total Rp</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $totalOrangFidyah }} jiwa</td>
                    <td>Rp. {{ $totalRpFidyah }}</td>
                </tr>
            </tbody>
        </table>
        <div class="row text-center">
            <div class="col-6">
                <p class="text-center">Mengetahui,</p>
                <p class="text-left">Ketua Panitia Zakat Fitrah</p>
                <br><br><br>
                <p class="text-center">(...........................................)</p>
            </div>
            <div class="col-6 text-right">
                <p class="text-center">Klaten, {{ date('d F Y') }}</p>
                <p class="text-center">Panitia Zakat Fitrah</p>
                <br><br><br>
                <p class="text-center">(...........................................)</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
