@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">

                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->getFormattedTypeName()}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->name}}</a></li>
                        <li class="breadcrumb-item"><a href="#">ユーザー</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
                    </ol>
                </nav>

                <h3 class="text-center">{{$user->name}}</h3>
                <p class="h3 text-center">{{$user->email}}</p>
            </div>
        </div>
        <div class="card mt-0">
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary">
                    @foreach ($bases as $base)
                    <li class="nav-item mx-auto">
                        <a class="nav-link @if($bases[0]==$base) active @endif" href="#pill{{$base->id}}" data-toggle="tab">{{$base->name}}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content tab-space pb-0">
                    @foreach ($bases as $base)
                    <div class="tab-pane @if($bases[0]==$base) active @endif" id="pill{{$base->id}}">
                        @include('info.info.show.'.$base->getTemplate()->id, ['base'=>$base])
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection