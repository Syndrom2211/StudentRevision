@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (Auth::user()->level == 'mahasiswa')
                    <div class="panel-heading">Pengaturan Mahasiswa</div>
                @else
                    <div class="panel-heading">Pengaturan Pembimbing</div>
                @endif

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- ISI -->
                    @foreach ($liat as $li)
                        Nama : {{ $li->name }}<br/>
                        Email : {{ $li->email }}<br/>
                    @endforeach
                    
                    <a href="/pengaturan_mhs_ubah/{{ Auth::user()->id }}">
                        <button class="btn btn-primary">Ubah</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection