@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lihat Proposal</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/upload_proposal"><button class="btn btn-primary">Unggah</button></a>
                    
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama Dokumen</th>
                          <th scope="col">Tipe</th>
                          <th scope="col">Unduh</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Komentar</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($liat as $li)  
                        <tr>
                          <td>{{ $li->id_proposal }}</td>
                          <td>{{ $li->nama_dokumen }}</td>
                          <td>{{ $li->tipe_dokumen }}</td>
                            <td><a target="_blank" href="../{{ $li->link_dokumen }}">aaa</a></td>
                          <td>{{ $li->keterangan }}</td>
                          <td><a href="/proposalku/komentar/{{ $li->id_proposal }}"><button class="btn btn-primary">Lihat</button></a></td>
                          <td>
                            <a href="/proposalku/edit/{{ $li->id_proposal }}"><button class="btn btn-primary">Ubah</button></a>
                            <a href="/proposalku/hapus/{{ $li->id_proposal }}"><button class="btn btn-primary">Hapus</button></a>
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
