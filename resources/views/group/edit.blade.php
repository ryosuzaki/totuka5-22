@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$group}}
                    <form method="POST" action="{{route('group.update',$group->id)}}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="name">グループ名</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$group->name}}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                       
                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                            変更
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection