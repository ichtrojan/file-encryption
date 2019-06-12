@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Encrypted Files</div>

                <div class="card-body">
                  <div class="container">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>File Name</th>
                          <th>Download Link</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($infos as $info)
                        <tr>
                          <td>{{$info->filename}}</td>
                          <td><a href="/download/{{$info->ref}}"><button class="btn btn-primary">Decrypt and Download</button></a></br><a href="/download/encrypted/{{$info->ref}}"><button class="btn btn-danger">Download Encrypted File</button></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
