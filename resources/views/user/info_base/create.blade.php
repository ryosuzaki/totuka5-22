@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <form method="POST" action="{{ route('user_info_base.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name">情報ベース名</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                       
                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                            情報ベース登録
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection