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
                          <th scope="col">Komentar</th>
                          <th scope="col">Petunjuk Revisi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($liat as $li)  
                        <tr>
                          <td>{{ $li->id_proposal }}</td>
                          <td>{{ $li->teks_komentar }}</td>
                          <td>{{ $li->teks_petunjuk_revisi }}</td>
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
