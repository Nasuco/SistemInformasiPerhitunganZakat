@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Detail Zakat Maal</h5>
                    </div>
                    <hr class="horizontal dark mt-0">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Muzakki</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $zakatMaals->muzakki->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_rupiah" class="form-label">Jumlah (Rp)</label>
                            <input type="text" class="form-control" id="jumlah_rupiah" name="jumlah_rupiah" value="{{ $zakatMaals->jumlah_rupiah }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan:</label>
                            <input type="text" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan" value="{{ $zakatMaals->tanggal_penerimaan }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" readonly>{{ $zakatMaals->keterangan }}</textarea>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('maal.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection