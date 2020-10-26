@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (Auth::user()->level == 'mahasiswa')
                    <div class="panel-heading">Ubah Data Akun Mahasiswa</div>
                @else
                    <div class="panel-heading">Ubah Data Akun Pembimbing</div>
                @endif

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                            <!-- form validasi -->
                            <form action="/pengaturan_mhs_ubah_proses/{{ Auth::user()->id }}" method="post">
                                {{ csrf_field() }}
                                @foreach ($liat as $li)
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input class="form-control" type="text" name="nama" value="{{ $li->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan">Email</label>
                                        <input class="form-control" type="text" name="email" value="{{ $li->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="usia">Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Konfirmasi password jika tidak mengubah password" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="Simpan">
                                    </div>
                                @endforeach
                            </form>
                    
                            <div class="form-group">
                                <a href="/pengaturan_mhs/{{ Auth::user()->id }}">
                                    <button class="btn btn-primary">Kembali</button>
                                </a>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection