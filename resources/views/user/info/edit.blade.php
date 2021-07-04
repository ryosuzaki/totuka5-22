@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item"><a href="#">{{Auth::user()->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$base->name}}の変更</li>
                    </ol>
                </nav>
                <form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
                    @csrf
                    @method('PUT')
                    @include('info.info.edit.'.$base->getTemplate()->id, ['info' => $info])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection