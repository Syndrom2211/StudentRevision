@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Data Mahasiswa Bimbingan</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br/>
                        @endforeach
                    </div>
                    @endif

                    <form action="/proses_tambah_data_mhs_bimbingan" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="id_pembimbing" />
                            <b>Mahasiswa</b>
                            <br/>
                            <select name="mahasiswa" class="form-control">
                                @foreach($liat as $li)
                                    <option value="{{ $li->id }}">{{ $li->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="status_revisi" value="Belum Revisi" />
                        </div>

                        <div class="form-group">
                            <input name="pembimbing" type="hidden" value="<!-- dari data login -->" />
                        </div>
                        
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </form>
                    <br/>
                    
                    <div class="form-group">
                        <a href="/data_mhs_bimbingan"><button class="btn btn-primary">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
