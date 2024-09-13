@extends('layouts.user_type.auth')

@section('content')
    {{-- @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Muzakki']) --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Tambah Muzakki</h5>
                    </div>
                    <hr class="horizontal dark mt-0">
                    <div class="card-body">
                        <form action="{{ route('muzakki.store') }}" method="post" id="muzakkiForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="rt" class="form-label">RT</label>
                                <select class="form-control" id="rt" name="rt" onchange="checkRT(this.value)">
                                    <option value="" disabled selected>--Pilih RT/Lainnya--</option>
                                    <option value="19">RT 19</option>
                                    <option value="20">RT 20</option>
                                    <option value="21">RT 21</option>
                                    <option value="22">RT 22</option>
                                    <option value="23">RT 23</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="mb-3" id="lainnyaForm" style="display: none;">
                                <label for="alamat_rt" class="form-label">Lainnya</label>
                                <input type="text" class="form-control" id="alamat_rt" name="alamat_rt">
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

    <script>
        function checkRT(value) {
            var lainnyaForm = document.getElementById('lainnyaForm');
            lainnyaForm.style.display = (value === 'lainnya') ? 'block' : 'none';
        }
    </script>
@endsection
