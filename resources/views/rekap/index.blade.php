@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">Rekap Zakat</h1>

        <div class="row">
            <a href="{{ route('rekap.pdf') }}" class="btn btn-primary" target="_blank">Generate PDF</a>

            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary">
                        <h5 class="card-title mb-0 text-white">Jumlah Muzakki Zakat Beras</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">RT/Alamat</th>
                                        <th class="text-center">Jumlah Orang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jumlahOrangBeras as $key => $data)
                                        <tr>
                                            <td class="text-center">{{ $data->alamat_rt }}</td>
                                            <td class="text-center">{{ $data->jumlah_orang }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="2">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary">
                        <h5 class="card-title mb-0 text-white">Jumlah Muzakki Zakat Uang</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">RT/Alamat</th>
                                        <th class="text-center">Jumlah Orang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jumlahOrangUang as $key => $data)
                                        <tr>
                                            <td class="text-center">{{ $data->alamat_rt }}</td>
                                            <td class="text-center">{{ $data->jumlah_orang }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="2">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card shadow mt-4">
                    <div class="card-header bg-gradient-primary">
                        <h5 class="card-title mb-0 text-white">Jumlah Muzakki Zakat Maal dan Fidyah</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">Jumlah Muzakki Zakat Maal</th>
                                        <th class="text-center">Jumlah Muzakki Fidyah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $jumlahOrangMaal }}</td>
                                        <td class="text-center">{{ $jumlahOrangFidyah }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary">
                        <h5 class="card-title mb-0 text-white">Perolehan Zakat Beras</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">RT/Alamat</th>
                                        <th class="text-center">Jumlah Kg</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jumlahOrangBeras as $key => $data)
                                        <tr>
                                            <td class="text-center">{{ $data->alamat_rt }}</td>
                                            <td class="text-center">{{ $data->jumlah_beras }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary">
                        <h5 class="card-title mb-0 text-white">Perolehan Zakat Uang</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">RT/Alamat</th>
                                        <th class="text-center">Jumlah Rp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jumlahOrangUang as $key => $data)
                                        <tr>
                                            <td class="text-center">{{ $data->alamat_rt }}</td>
                                            <td class="text-center">Rp. {{ $data->jumlah_uang_rp }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
