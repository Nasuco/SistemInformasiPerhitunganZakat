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
                        <h6 class="mb-0 p-2">Daftar Zakat Maal</h6>
                        <form class="d-flex align-items-center pe-2 pb-3" action="{{ route('maal.search') }}" method="GET">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Type here..." name="muzakki">
                            </div>
                        </form>
                        <a href="{{ route('maal.create') }}" class="btn btn-primary">Tambah Zakat Maal</a>
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
                                            Jumlah (Rp)
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
                                    @foreach($zakatMaals as $maal)
                                    <tr>
                                        {{-- <td class="text-center">
                                            <h6 class="mb-0 text-sm">{{ $maal->id }}</h6>
                                        </td> --}}
                                        <td class="text-center">
                                            <h6 class="mb-0 text-sm">{{ $maal->muzakki->name }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs text-secondary mb-0">{{ $maal->jumlah_rupiah }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs text-secondary mb-0">{{ $maal->tanggal_penerimaan }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('maal.edit', $maal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ route('maal.show', $maal->id) }}" class="btn btn-sm btn-success">Detail</a>
                                            <form action="{{ route('maal.destroy', $maal->id) }}" method="post"
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
                          <p class="text-muted mb-1">Menampilkan halaman {{ $zakatMaals->currentPage() }} dari {{ $zakatMaals->lastPage() }}</p>
                          <div class="d-flex justify-content-around align-items-center">
                            <a href="{{ $zakatMaals->previousPageUrl() }}" class="btn btn-sm btn-outline-secondary @if($zakatMaals->onFirstPage()) disabled @endif"><i class="fas fa-chevron-left"></i></a>
                            <a href="{{ $zakatMaals->nextPageUrl() }}" class="btn btn-sm btn-outline-secondary @if(!$zakatMaals->hasMorePages()) disabled @endif"><i class="fas fa-chevron-right"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>                   
                </div>
                
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-center">
                        <h6 class="mb-0 p-2">Jumlah Total Zakat Maal</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 d-flex justify-content-center align-items-center">
                        <div class="table-responsive p-0"></div>
                            <table class="table align-middle mb-0"> <!-- Added align-middle class -->
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah Muzakki
                                        </th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <h6 class="mb-0 text-sm">{{ $totalPeople }} Muzakki</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center mb-0 text-sm">Jumlah Total (Rp): <b>Rp. {{ $totalWeight }}</b></td>
                                    </tr>
                                </tbody>
                                {{-- <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah Total (Rp)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <h6 class="mb-0 text-sm">Rp {{ $totalWeight }}</h6>
                                        </td>
                                    </tr>
                                </tbody> --}}
                            </table>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
        {{-- @include('layouts.footers.auth.footer') --}}
    </div>
@endsection