@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="col">
                        <div class="row align-items-center">
                                <h3 class="mb-0">Karyawan</h3>
                            </div>
                            {{-- @if(auth()->user()->karyawan_id == 1) --}}
                            <div class="col text-right">
                                <a href="/karyawan-backend/create" class="btn btn-sm btn-primary">Tambah</a>
                            </div>
                        </div>
                    </div>

                    @if (session()->has('pesan'))
                    <div class="alert alert-success" role="alert">
                    {{session('pesan')}}
                    </div>
                    @endif
                    @if (session()->has('pesanHapus'))
                    <div class="alert alert-danger" role="alert">
                    {{session('pesanHapus')}}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No Telp</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Tanggal Keluar</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawans as $karyawan)    
                                <tr>
                                    <th scope="row">
                                        {{$karyawan->nama_karyawan}}
                                    </th>
                                    <td>
                                        {{$karyawan->no_telp}}
                                    </td>
                                    <td>
                                        {{$karyawan->tgl_masuk}}
                                    </td>
                                    <td>
                                        {{$karyawan->tgl_keluar}}
                                    </td>
                                    
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-center dropdown-menu-arrow">
                                                <a class="dropdown-item" href="/karyawan-backend/{{$karyawan->id}}/edit">
                                                    <button type="button" class="btn btn-success">Edit</button>
                                                </a>
                                                    <form action="karyawan-backend/{{$karyawan->id}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                                                    </form> 
                                            </div>
                                        </div>
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
    
    {{$karyawans->links('pagination::bootstrap-5')}}
    
@endsection
@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush