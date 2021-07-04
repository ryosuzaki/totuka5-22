@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('user.info_base.update',[$base->id])}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label for="name">情報名</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$base->name}}" required autofocus>
                    </div>                       
                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                        情報更新
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection