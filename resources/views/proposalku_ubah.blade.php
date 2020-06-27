@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ubah Proposal dengan ID : {{ $proposalku->id_proposal }} </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- form validasi -->
                            <form action="/proposalku/proposalku_ubah_proses" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_proposal" value="{{ $proposalku->id_proposal }}">
                                <input type="hidden" value="{{ $proposalku->id_mahasiswa }}" name="id_mahasiswa" />
                                <div class="form-group">
                                    <b>Dokumen</b><br/>
                                    <input type="file" name="file">
                                </div>

                                <div class="form-group">
                                    <b>Keterangan</b>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>

                                <input type="submit" value="Upload" class="btn btn-primary">
                            </form>
                            
                            <br/>
                    
                            <div class="form-group">
                                <a href="/proposalku/{{ Auth::user()->id }}">
                                    <button class="btn btn-primary">Kembali</button>
                                </a>
                            </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection