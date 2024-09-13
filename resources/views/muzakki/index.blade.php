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
    {{-- @include('layouts.navbars.auth.topnav', ['title' => 'Muzakki']) --}}
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
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 p-2">Daftar Muzakki</h6>
                        <form class="d-flex align-items-center pe-2 pb-3" action="{{ route('muzakki.search') }}" method="GET">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Type here..." name="muzakki">
                            </div>
                        </form>
                        <a href="{{ route('muzakki.create') }}" class="btn btn-primary">Tambah Muzakki</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-middle mb-0"> <!-- Added align-middle class -->
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            RT / Alamat
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($muzakkis as $muzakki)
                                    <tr>
                                        <td class="text-center"> <!-- Center-align content -->
                                            <h6 class="mb-0 text-sm">{{ $muzakki->name }}</h6>
                                        </td>
                                        <td class="text-center"> <!-- Center-align content -->
                                            <p class="text-xs text-secondary mb-0">{{ $muzakki->alamat_rt }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('muzakki.edit', $muzakki->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('muzakki.destroy', $muzakki->id) }}" method="post"
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
                </div>
            </div>
        </div>
        {{-- @include('layouts.footers.auth.footer') --}}
    </div>
@endsection