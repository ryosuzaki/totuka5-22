@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    @php
                    $rank=255;
                    @endphp
                    <div class="row">
                        <h5>避難所</h5>
                        <div class="ml-auto">
                            @if(Auth::user()->hasGroupRank($group,$rank))
                            <a class="btn btn-primary btn-round btn-sm" href="{{route('group.user.unfollow',[$group->id,Auth::id()])}}">フォロー中</a>
                            @elseif(Auth::user()->group($group->id))
                            <a class="btn btn-primary btn-round btn-sm text-white">参加中</a>
                            @else
                            <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.user.follow',[$group->id,Auth::id()])}}">フォローする</a>
                            @endif
                        </div>

                    </div>
                    <h3 class="text-center">{{$group->name}}</h3>
                    <h6 class="text-center">{{$group->usersHaveRank($rank)->count()}}人がフォロー中</h6>
                        @php
                        $degree=substr($infos[1]->pivot->info['degree'], 0, -1);
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
                        @foreach ($infos as $info)
                        <li class="nav-item mx-auto">
                            <a class="nav-link @if($infos[0]==$info) active @endif" href="#pill{{$info->id}}" data-toggle="tab">{{$info->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content tab-space pb-0">
                        @foreach ($infos as $info)
                        <div class="tab-pane @if($infos[0]==$info) active @endif" id="pill{{$info->id}}">
                            @include('group.info_base.show.'.$info->id, ['group'=>$group,'info'=>$info])
                            <div class="row">
                                <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('group.info_base.info.edit',[$group->id,$info->id])}}">変更</a>
                            </div> 
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
