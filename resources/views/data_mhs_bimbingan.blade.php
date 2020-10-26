@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lihat Data Mahasiswa Bimbingan</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/tambah_data_mhs_bimbingan"><button class="btn btn-primary">Tambah</button></a>
                    
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Pembimbing</th>
                          <th scope="col">Mahasiswa</th>
                          <th scope="col">Notifikasi Revisi Proposal</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($liat as $li)  
                        <tr>
                          <td>{{ $li->id_mhs_bimbingan }}</td>
                          <td>{{ Auth::user()->name }}</td>
                          <td>{{ $li->name }}</td>
                          
                              @if ($li->status_revisi == 'Sudah Revisi')
                                <td>
                                    <form action="/proses_notifikasi_revisi" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $li->id_mhs_bimbingan }}" name="id_mhs_bimbingan" />
                                        <input type="submit" name="update_status" value="Sudah Revisi" class="btn btn-success" />
                                    </form>
                                </td>
                              @elseif ($li->status_revisi == 'Belum Revisi')
                                <td>
                                    <form action="/proses_notifikasi_revisi" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $li->id_mhs_bimbingan }}" name="id_mhs_bimbingan" />
                                        <input type="submit" name="update_status" value="Belum Revisi" class="btn btn-danger" />
                                    </form>
                                </td>
                              @endif
                          <td>
                            <a href="/data_mhs_bimbingan/edit/{{ $li->id_mhs_bimbingan }}"><button class="btn btn-primary">Ubah</button></a>
                            <a href="/proposal_mhs_bimbingan/{{ $li->id_mhs_bimbingan }}"><button class="btn btn-primary">Lihat Proposal</button></a>
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
