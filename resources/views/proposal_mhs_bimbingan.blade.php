@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lihat Data Proposal Mahasiswa Bimbingan</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                                    
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Mahasiswa</th>
                          <th scope="col">Proposal</th>
                          <th scope="col">Tanggal Upload</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($liat as $li)  
                        <tr>
                          <td>{{ $li->id_mhs_bimbingan }}</td>
                          <td>{{ $li->id_mhs_bimbingan }}</td>
                          <td>{{ $li->nama_dokumen }}</td>
                          <td>{{ $li->created_at }}</td>
                          <td>
                            <a target="_blank" href="../{{ preg_replace('/\s+/','',$li->link_dokumen) }}"><button class="btn btn-primary">Unduh</button></a>
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
@endsection
