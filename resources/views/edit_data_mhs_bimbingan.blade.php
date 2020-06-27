@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ubah Mahasiswa Bimbingan dengan ID : {{ $hasil->id_mhs_bimbingan }} </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- form validasi -->
                            <form action="/data_mhs_bimbingan/edit_data_mhs_bimbingan_proses" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" value="{{ $hasil->id_mhs_bimbingan }}" name="id_mhs_bimbingan" />
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="id_pembimbing" />
                                    <b>Mahasiswa</b>
                                    <br/>
                                    <select class="form-control" name="mahasiswa">
                                        @foreach($hasil2 as $li)  
                                            <option value="{{ $li->id }}">{{ $li->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="submit" value="Simpan" class="btn btn-primary">
                            </form>
                    <br/>
                    <div class="form-group">
                        <a href="/data_mhs_bimbingan">
                            <button class="btn btn-primary">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection