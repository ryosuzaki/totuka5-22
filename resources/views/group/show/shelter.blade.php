@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <h5>避難所</h5>
                        <div class="ml-auto">
                            @if(Auth::user()->hasGroupRole($group->id,'ウォッチャー'))
                            <a class="btn btn-primary btn-round btn-sm" href="{{route('group.unwatch',$group->id)}}">ウォッチ中</a>
                            @elseif(Auth::user()->hasGroup($group->id))
                            <a class="btn btn-primary text-white btn-round btn-sm">参加中</a>
                            @else
                            <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.watch',$group->id)}}">ウォッチする</a>
                            @endif
                        </div>

                    </div>
                    <h3 class="text-center">{{$group->name}}</h3>
                    <h6 class="text-center">{{$group->usersHaveRole('ウォッチャー')->count()}}人がウォッチ中</h6>
                        @php
                        $degree=substr($group->info(2)->info['degree'], 0, -1);
                        @endphp
                        <div class="row"><p class="h5 mx-auto">混雑度：<strong>{{$degree}}%</strong></p></div>
                        
                        <div class="progress">
                            <div class="progress-bar 
                            @if($degree=='25')bg-success
                            @elseif($degree=='50')bg-info
                            @elseif($degree=='75')bg-warning
                            @elseif($degree=='100')bg-danger
                            @endif
                            " role="progressbar" style="width:{{$degree}}%" aria-valuenow={{$degree}} aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                </div>
            </div>
            <div class="card mt-0">
                <div class="card-body">
                    <ul class="nav nav-pills nav-pills-primary">
                        @foreach ($bases as $base)
                        <li class="nav-item mx-auto">
                            <a class="nav-link @if($base->index==$index) active @endif" @if($base->index!=$index) href="{{route('group.show',[$group->id,$base->index])}}"@endif>{{$base->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content tab-space pb-0">
                        <div class="tab-pane active">
                            @php
                            $base=$group->getInfoBaseByIndex($index);
                            @endphp
                            @include('info.info.show.'.$base->getTemplate()->id, ['base'=>$base,'info'=>$base->info()])
                            <div class="row">
                                <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('info_base.info.edit',$base->id)}}">変更</a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
