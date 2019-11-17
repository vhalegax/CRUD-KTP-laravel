@extends("layouts.dashboard")

@section("title") Daftar KTP @endsection 

@section('pageTitle') Daftar KTP @endsection

@section("content")          
    @if(session('status'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif 
            
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group-append">
                <a href="{{route('ktp.create')}}" class="btn btn-primary">Tambah KTP</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th width="25%"><b>Gambar</b></th>
                    <th width="25%"><b>NIK</b></th>
                    <th width="25%"><b>Nama</b></th>
                    <th width="25%"><b>Aksi</b></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($ktp as $ktp)
                   <tr>
                   <td>
                        @if($ktp->foto)
                            <img 
                            src="{{asset('storage/' . $ktp->foto)}}" 
                            width="48px"/>
                        @else 
                            No image
                        @endif
                    </td>
                   <td>{{$ktp->nik}}</td>
                   <td>{{$ktp->nama}}</td>
                   <td>
                        <a href="{{route('ktp.show', ['id' => $ktp->nik])}}" class="btn btn-info">Detail</a>
                        <a href="{{route('ktp.edit', ['id' => $ktp->nik])}}" class="btn btn-success">Ubah</a>
                        <form  class="d-inline" action="{{route('ktp.destroy', ['id' => $ktp->nik])}}" 
                        method="POST"  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Ktp?')" >
                        @csrf 
                        <input type="hidden"name="_method" value="DELETE"/>
                        <button type="submit" class="btn btn-danger" >Hapus</button>
                        </form>
                   </td>
                   </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

