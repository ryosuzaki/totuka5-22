@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
            @include('group.show.header.'.$group->getTypeName(), ['group'=>$group,'bases'=>$bases])
            </div>
        </div>
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary">
                    @foreach ($bases as $base)
                    <li class="nav-item mx-auto">
                        <a class="nav-link @if($base->index==$index) active @endif" href="#pill{{$base->index}}" data-toggle="tab">{{$base->name}}</a>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content tab-space pb-0">
                    @foreach ($bases as $base)
                    <div class="tab-pane @if($base->index==$index) active @endif" id="pill{{$base->index}}">
                        @include('info.info.show.'.$base->getTemplate()->id, ['base'=>$base,'info'=>$base->info()])
                        @if(Auth::user()->hasGroup($group->id))
                        <div class="row">
                            <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('group.info.edit',[$group->id,$base->index])}}"><i class="material-icons">edit</i> 変更</a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @if(Auth::user()->hasGroup($group->id))
                <div class="row">
                    <a class="btn btn-primary btn-block" href="{{route('group.info_base.index',[$group->id])}}"><i class="material-icons">list</i> 情報編集</a>
                </div>
                @endif
            </div>
            
        </div>
        
    </div>
</div>
@endsection