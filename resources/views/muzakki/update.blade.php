@extends('layouts.user_type.auth')

@section('content')
    {{-- @include('layouts.navbars.auth.topnav', ['title' => 'Edit Muzakki']) --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Edit Muzakki</h5>
                    </div>
                    <hr class="horizontal dark mt-0">
                    <div class="card-body">
                        <form action="{{ route('muzakki.update', $muzakki->id) }}" method="post">
                            @csrf
                            @method('PUT') <!-- Menggunakan metode PUT untuk update -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $muzakki->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="rt" class="form-label" id="rtLabel">RT / Alamat</label>
                                <select class="form-control" id="rt" name="rt" onchange="checkRT(this.value)">
                                    <option value="" id="defaultOption" style="display: none;" {{ $muzakki->rt === null || $muzakki->rt === '' ? 'selected' : '' }}>{{ $muzakki->alamat_rt }}</option>
                                    <option value="19" {{ $muzakki->alamat_rt === '19' ? 'selected' : '' }}>RT 19</option>
                                    <option value="20" {{ $muzakki->alamat_rt === '20' ? 'selected' : '' }}>RT 20</option>
                                    <option value="21" {{ $muzakki->alamat_rt === '21' ? 'selected' : '' }}>RT 21</option>
                                    <option value="22" {{ $muzakki->alamat_rt === '22' ? 'selected' : '' }}>RT 22</option>
                                    <option value="23" {{ $muzakki->alamat_rt === '23' ? 'selected' : '' }}>RT 23</option>
                                    <option value="lainnya" {{ $muzakki->rt === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="mb-3" id="lainnyaForm" style="display: {{ $muzakki->rt === 'lainnya' ? 'block' : 'none' }}">
                                <label for="alamat_rt" class="form-label">Lainnya</label>
                                <input type="text" class="form-control" id="alamat_rt" name="alamat_rt" value="{{ $muzakki->alamat_rt }}">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('layouts.footers.auth.footer') --}}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var rtElement = document.getElementById('rt');
            if (rtElement) {
                checkRT(rtElement.value);
            }
        });
    
        function checkRT(value) {
            var lainnyaForm = document.getElementById('lainnyaForm');
            var alamatRtInput = document.getElementById('alamat_rt');

            if (value === 'lainnya') {
                lainnyaForm.style.display = 'block';
                // Set nilai alamat_rt sesuai dengan data sebelumnya jika rt adalah 'lainnya'
                alamatRtInput.value = '{{ $muzakki->rt === "lainnya" ? $muzakki->alamat_rt : "" }}';
            } else {
                lainnyaForm.style.display = 'none';
                // Reset nilai alamat_rt jika rt bukan 'lainnya'
                alamatRtInput.value = '';
            }
        }

        // Panggil fungsi checkRT saat halaman dimuat ulang
        window.onload = function() {
            checkRT(document.getElementById('rt').value);
        };
    </script>    
@endsection