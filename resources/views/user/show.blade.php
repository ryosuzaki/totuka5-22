@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-3">
        {{ Breadcrumbs::render('user.show') }}
            <div class="card-body">
                <h3 class="text-center">{{$user->name}}</h3>
                <p class="h3 text-center">{{$user->email}}</p>
                <div class="row">
                    <a class="btn btn-primary btn-block" href="{{route('user.edit')}}"><i class="material-icons">edit</i> 変更</a>
                </div>
            </div>
        </div>
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary">
                    @foreach ($bases as $base)
                    <li class="nav-item mx-auto">
                        <a class="nav-link @if($bases[0]==$base) active @endif" href="#pill{{$base->index}}" data-toggle="tab">{{$base->name}}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content tab-space pb-0">
                    @foreach ($bases as $base)
                    @php
                    $template=$base->getTemplate();
                    @endphp
                    <div class="tab-pane @if($bases[0]==$base) active @endif" id="pill{{$base->index}}">
                        @include('user.info.show.'.$template->id, ['base'=>$base])
                        <div class="row">
                            <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('user.info.edit',$base->id)}}">{!! $template->edit['icon'] !!} {{$template->edit['name']}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row">
                    <a class="btn btn-primary btn-block" href="{{route('user.info_base.index')}}"><i class="material-icons">list</i> 情報編集</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
