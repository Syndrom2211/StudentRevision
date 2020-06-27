@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Proposal</div>

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

                    <form action="/upload_proposal_proses" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}                  
                                              
                        <div class="form-group">
                            <b>File</b><br/>
                            <input type="file" name="file">
                        </div>
                        
                        @if (Auth::user()->level == 'mahasiswa')
                            <input type="hidden" value="{{ Auth::user()->id }}" name="id_mahasiswa" />
                        @else
                        <div class="form-group">
                            <b>Mahasiswa</b><br/>
                            <select class="form-control" name="id_mahasiswa">
                                <option value="">aaa</option>
                            </select>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <b>Keterangan</b>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>

                        <input type="submit" value="Upload" class="btn btn-primary">
                    </form>
                    <br/>
                    @if (Auth::user()->level == 'mahasiswa')
                        <a href="/proposalku/{{ Auth::user()->id }}"><button class="btn btn-primary">Kembali</button></a>
                    @else
                        <a href="/"><button class="btn btn-primary">Kembali</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
