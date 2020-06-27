@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading">Lihat Komentar Pembimbing</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Dokumen</th>
                          <th scope="col">Pembimbing</th>
                          <th scope="col">Komentar</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($liat as $li)  
                        <tr>
                          <td>{{ $li->id_proposal }}</td>
                          <td>{{ $li->nama_dokumen }}</td>
                          <td>{{ $li->name }}</td>
                          <td>{{ $li->teks_komentar }}</td>
                          <td>
                              @if ($li->kategori_komentar == 'content-related')
                                <font color='green'>{{ $li->kategori_komentar }}</font>
                              @elseif ($li->kategori_komentar == 'non content-related')
                                <font color='red'>{{ $li->kategori_komentar }}</font>
                              @endif
                          </td>
                          <td>{{ $li->tgl_komentar }}</td>
                          <td>
                            <a href="/proposalku/komentar/petunjuk_revisi/{{ $li->id_komentar }}"><button class="btn btn-primary">Lihat</button></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <a href="/proposalku/{{ Auth::user()->id }}"><button class="btn btn-primary">Kembali</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
