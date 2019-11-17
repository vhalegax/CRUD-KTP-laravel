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

    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data KTP</h4>
                </div>
                <div class="modal-body">
                        <span id="form_result"></span>
                        <form method="post" id="ktpform" name="ktpform" class="form-horizontal" enctype="multipart/form-data">
                        @csrf

                        <div class='form-row'>

                            <div class="form-group col-12">
                                <label>Nik : </label>
                                <input type="number" name="nik" id="nik" class="form-control" />
                            </div>

                            <div class="form-group col-12">
                                <label>Nama : </label>
                                <input type="text" name="nama" id="nama" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Tempat : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Tgl Lahir : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Jenis Kelamin : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Golongan Darah : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-12">
                                <label>Alamat : </label>
                                <textarea name="" id="" class="form-control"></textarea>
                            </div>

                            <div class="form-group col-2">
                                <label>RT : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-2">
                                <label>RW : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-4">
                                <label>Kel/Desa : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-4">
                                <label>Kecamatan : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Agama : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Status Perkawinan : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Pekerjaan : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label>Kewarganegaraan : </label>
                                <input type="text" name="" id="" class="form-control" />
                            </div>

                            <div class="form-group col-12">
                                <label>Foto : </label><br>
                                <input type="file" name="image" id="image" />
                                <span id="store_image"></span>
                            </div>
                        </div>
                        <br />
                        <hr>
                        <div class="text-center">
                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <input type="submit" name="simpan" id="simpan" class="btn btn-success" value="Tambah" />
                            <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close"> Kembali </button> 
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Confirmation</h2>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                    </div>
                    <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
      
@endsection

