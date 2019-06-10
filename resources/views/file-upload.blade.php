@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                  <form method="POST" action="/upload-file" enctype="multipart/form-data">
                      @csrf

                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">File</label>

                          <div class="col-md-6">
                              <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" required autofocus>

                              @error('file')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <button type="submit" class="btn btn-primary">
                          Upload
                      </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
