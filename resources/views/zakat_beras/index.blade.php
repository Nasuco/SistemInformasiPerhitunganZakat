@extends('layouts.user_type.auth')

@section('content')
<style>
    .input-group {
        border: none;
        border-radius: 5px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        width: 100%;
        max-width: 400px;
        margin: 0 auto; /* Center the search input */
    }

    .input-group:focus-within {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .input-group input {
        border: none;
        box-shadow: none;
        width: 100%;
    }

    .input-group-text {
        background-color: #fff;
        border: none;
    }

    .form-control {
        border: none;
        box-shadow: none;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .search-form {
        margin-top: 10px;
    }

    @media (max-width: 767px) {
        .search-form {
            order: 2;
        }
    }
</style>
    <div class="container-fluid py-4">
        @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
            @endif
            @if(session('delete'))
              <div class="alert alert-danger">
                  {{ session('delete') }}
              </div>
            @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 p-2">Daftar Zakat Beras</h6>
                        <form class="d-flex align-items-center pe-2 pb-3" action="{{ route('beras.search') }}" method="GET">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Type here..." name="muzakki">
                            </div>
                        </form>
                        <a href="{{ route('beras.create') }}" class="btn btn-primary">Tambah Zakat Beras</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-middle mb-0"> <!-- Added align-middle class -->
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Id
                                        </th> --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Muzakki
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            RT
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah Jiwa
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah (Kg)
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Penerimaan
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($zakatBeras as $beras)
                                    <tr>
                                        {{-- <td class="text-center">
                                            <h6 class="mb-0 text-sm">{{ $beras->id }}</h6>
                                        </td> --}}
                                        <td class="text-center">
                                            <h6 class="mb-0 text-sm">{{ $beras->muzakki->name }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs text-secondary mb-0">{{ $beras->muzakki->alamat_rt }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs text-secondary mb-0">{{ $beras->jumlah_keluarga }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs text-secondary mb-0">{{ $beras->jumlah_kg }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs text-secondary mb-0">{{ $beras->tanggal_penerimaan }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('beras.edit', $beras->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ route('beras.show', $beras->id) }}" class="btn btn-sm btn-success">Detail</a>
                                            <form action="{{ route('beras.destroy', $beras->id) }}" method="post"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="mt-3 text-center">
                          <p class="text-muted mb-1">Menampilkan halaman {{ $zakatBeras->currentPage() }} dari {{ $zakatBeras->lastPage() }}</p>
                          <div class="d-flex justify-content-around align-items-center">
                            <a href="{{ $zakatBeras->previousPageUrl() }}" class="btn btn-sm btn-outline-secondary @if($zakatBeras->onFirstPage()) disabled @endif"><i class="fas fa-chevron-left"></i></a>
                            <a href="{{ $zakatBeras->nextPageUrl() }}" class="btn btn-sm btn-outline-secondary @if(!$zakatBeras->hasMorePages()) disabled @endif"><i class="fas fa-chevron-right"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>                   
                </div>
                
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-center">
                            <h6 class="mb-0 p-2">Jumlah Total Zakat Beras</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2 d-flex justify-content-center align-items-center">
                            <div class="table-responsive p-0">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jumlah Muzakki
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jumlah Jiwa
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <h6 class="mb-0 text-sm">{{ $totalPeople }} Muzakki</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6 class="mb-0 text-sm">{{ $totalFamilies }} Jiwa</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center mb-0 text-sm">Jumlah Total (Kg): <b>{{ $totalWeight }} Kg</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <form method="post" action="{{ route('beras.saveManualInput') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="jumlah_mustahik">Tambah Jumlah Mustahik:</label>
                                                        <input type="number" class="form-control" name="jumlah_mustahik" id="jumlah_mustahik" required min="1" value="{{ $calculateBerasData->jumlah_mustahik }}" readonly>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" onclick="enableEdit()">Edit</button>
                                                </form>                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center mb-0 text-sm">Berat Rata-Rata Per Mustahik: <b>{{ $averageWeightPerMustahik }} kg</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
        {{-- @include('layouts.footers.auth.footer') --}}
    </div>

    <script>
        function enableEdit() {
            var inputMustahik = document.getElementById('jumlah_mustahik');
            inputMustahik.readOnly = false;
    
            var editButton = document.querySelector('.btn-secondary');
            editButton.style.display = 'none';
    
            var saveButton = document.querySelector('.btn-primary');
            saveButton.style.display = 'inline-block';
        }
    </script>
    
    {{-- <script>
    // Fungsi untuk mengambil nilai dari localStorage
    function getLocalStorage(key) {
        const storedValue = localStorage.getItem(key);
        return storedValue ? JSON.parse(storedValue) : null;
    }

    // Fungsi untuk menyimpan nilai ke localStorage
    function setLocalStorage(key, value) {
        localStorage.setItem(key, JSON.stringify(value));
    }

    // Fungsi untuk menghapus nilai dari localStorage
    function clearLocalStorage(key) {
        localStorage.removeItem(key);
    }

    function hitungPerkiraan() {
        const jumlahMustahikInput = document.getElementById('jumlah_mustahik');
        const hasilPerhitunganElement = document.getElementById('hasil_perhitungan');

        // Ambil nilai dari localStorage jika ada, jika tidak, maka set nilai awal ke 0
        const jumlahMustahik = parseInt(jumlahMustahikInput.value) || getLocalStorage('jumlahMustahik') || 0;
        const totalWeight = {{ $totalWeight }};
        const hasilPerhitungan = jumlahMustahik !== 0 ? totalWeight / jumlahMustahik : 0;

        // Tampilkan hasil perhitungan secara real-time
        hasilPerhitunganElement.innerText = `${hasilPerhitungan.toFixed(2)} Kg`;

        // Simpan nilai jumlah mustahik ke localStorage
        setLocalStorage('jumlahMustahik', jumlahMustahik);
        // Simpan hasil perhitungan ke localStorage
        setLocalStorage('hasilPerhitungan', hasilPerhitungan);
    }

    function simpanData() {
        // Ambil hasil perhitungan dari localStorage jika ada
        const hasilPerhitungan = getLocalStorage('hasilPerhitungan') || 0;

        // Tampilkan hasil perhitungan
        document.getElementById('hasil_perhitungan').innerText = `${hasilPerhitungan.toFixed(2)} Kg`;

        // Menonaktifkan input setelah penyimpanan
        document.getElementById('jumlah_mustahik').readOnly = true;
    }

    function editData() {
        // Tindakan yang diperlukan untuk memungkinkan pengeditan
        // Mengaktifkan kembali input untuk pengeditan
        document.getElementById('jumlah_mustahik').readOnly = false;
    }

    // Panggil hitungPerkiraan saat halaman dimuat untuk memulai dengan nilai yang ada di localStorage
    document.addEventListener('DOMContentLoaded', function () {
        hitungPerkiraan();

        // Tambahkan event listener untuk memanggil hitungPerkiraan saat input jumlah_mustahik berubah
        document.getElementById('jumlah_mustahik').addEventListener('input', function() {
            hitungPerkiraan();
        });
    });
</script> --}}

        
@endsection