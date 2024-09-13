@extends('layouts.user_type.auth')

@section('content')
    {{-- @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Muzakki']) --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Tambah Zakat Uang</h5>
                    </div>
                    <hr class="horizontal dark mt-0">
                    <div class="card-body">
                        <form action="{{ route('uang.store') }}" method="post" id="uangForm">
                            @csrf
                            <div class="">
                                <label for="nama" class="form-label">Nama Muzakki</label>
                                <div class="row">
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <select class="form-control pe-3" id="muzakki_select" name="muzakki_id">
                                            <option value="" selected disabled>Pilih atau Ketik Nama Muzakki</option>
                                            @foreach ($muzakkis as $muzakki)
                                                <option value="{{ $muzakki->id }}">
                                                    {{ $muzakki->name }} - 
                                                    @if (is_numeric($muzakki->alamat_rt))
                                                        Rt. {{ $muzakki->alamat_rt }}
                                                    @else
                                                        {{ $muzakki->alamat_rt }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('muzakki.create') }}" class="btn btn-sm btn-primary w-100 mb-2">Tambah Muzakki</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="rupiah" class="form-label">Rupiah (Minimum 30000)</label>
                                <input type="text" class="form-control" id="rupiah" name="rupiah" value="30000" required>
                                @error('rupiah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>     
                            <div class="mb-3">
                                <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
                                <input type="text" class="form-control" id="jumlah_keluarga" name="jumlah_keluarga" required>
                                @error('jumlah_keluarga')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>                                      
                            <div class="mb-3">
                                <label for="jumlah_rupiah" class="form-label">Jumlah (Rp)</label>
                                <input type="text" class="form-control" id="jumlah_rupiah" name="jumlah_rupiah" value="{{ number_format($jumlah_rupiah, 0, ',', '') }}" readonly>
                                @error('jumlah_rupiah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan:</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan:</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('layouts.footers.auth.footer') --}}
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#muzakki_select').select2({
                tags: true,
                tokenSeparators: [',', ' '],
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get references to the input fields
            const rupiahInput = document.getElementById('rupiah');
            const jumlahKeluargaInput = document.getElementById('jumlah_keluarga');
            const jumlahRpInput = document.getElementById('jumlah_rupiah');

            // Add an input event listener to both rupiah and jumlah_keluarga fields
            [rupiahInput, jumlahKeluargaInput].forEach(function (inputField) {
                inputField.addEventListener('input', function () {
                    // Get the values from rupiah and jumlah_keluarga
                    const rupiahValue = rupiahInput.value;
                    const jumlahKeluargaValue = jumlahKeluargaInput.value;

                    // Calculate the total jumlah_rupiah
                    const totalJumlahRp = rupiahValue * jumlahKeluargaValue;

                    // Update the value of jumlah_rupiah input
                    jumlahRpInput.value = totalJumlahRp;
                });
            });
        });
    </script>
@endsection
