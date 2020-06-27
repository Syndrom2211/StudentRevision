@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (Auth::user()->level == 'mahasiswa')
                    <div class="panel-heading">Status Revisi Proposal</div>
                @else
                    <div class="panel-heading">Dashboard</div>
                @endif
                
                <div class="panel-body">
                    @if (Auth::user()->level == 'mahasiswa')
                        <div class="alert alert-success" role="alert">                            
                            @foreach ($hasil as $li)
                                @foreach ($hasil2 as $lo)
                                    Selamat Datang Mahasiswa {{ Auth::user()->name }} ,
                                    @if (($lo->id_mahasiswa == Auth::user()->id) AND ($li->status_revisi == 'Belum Revisi'))
                                        <b><font color='red'>Maaf, Proposal Anda Belum di Revisi</font></b>
                                    @elseif (($lo->id_mahasiswa == Auth::user()->id) AND ($li->status_revisi == 'Sudah Revisi'))
                                        <b><font color='green'>Selamat, Proposal Anda Sudah di Revisi</font></b>
                                    @else
                                        <b><font color='green'>Maaf, Anda belum Upload Proposal</font></b>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-success">
                            Selamat Datang Pembimbing {{ Auth::user()->name }}
                        </div>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection