@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <a href="{{route('user.edit',Auth::id())}}">編集</a>
            </div>
        </div>
    </div>
</div>
@endsection
