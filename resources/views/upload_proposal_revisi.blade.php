@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Proposal Revisi</div>

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
                    
                    @foreach($liat as $li)
                        <form action="/upload_proposal_revisi_proses/{{ Auth::user()->id  }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}  
                            <input type="hidden" value="{{ Auth::user()->id }}" name="id_pembimbing" />                
                            <div class="form-group">
                                <b>ID Revisi</b><br/>
                                <input class="form-control" type="text" value="{{ rand(10,10000) }}" name="id_revisi" readonly />
                            </div>
                             
                            <div class="form-group">
                                <b>File</b><br/>
                                <input type="file" name="file">
                            </div>

                            <b>Mahasiswa</b><br/>
                            <select name="id_mahasiswa">
                                <option value="{{ $li->id }}">{{ $li->name }}</option>
                            </select>  
                            
                            <input type="hidden" name="id_proposal" value="{{ $li->id_proposal }}" />

                            <br/><br/>

                            <div class="form-group">
                                <b>Catatan Pembimbing</b>
                                <textarea placeholder="Kosongkan saja jika tidak ada catatan khusus untuk revisi dokumen ini.." class="form-control" name="catatan_pembimbing"></textarea>
                            </div>

                            <input type="submit" value="Upload" class="btn btn-primary">
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection