@php
$role_name=App\Http\Controllers\Group\WatchController::$name;
@endphp
<div class="row">
    <h5 class="mt-1">避難所</h5>
    <div class="ml-auto">
        @if(Auth::user()->hasGroup($group->id))
        <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.role.index',$group->id)}}"><i class="material-icons">assignment_ind</i>　役割</a>
        <a class="btn btn-info btn-sm btn-round text-white" href="{{route('group.user.index',$group->id)}}"><i class="material-icons">groups</i>　参加者</a><a class="btn btn-primary text-white btn-round btn-sm">参加中</a>
        @elseif(Auth::user()->hasExtraGroup($group->id,$role_name))
        <a class="btn btn-primary btn-round btn-sm" href="{{route('group.unwatch',$group->id)}}">ウォッチ中</a>
        @else
        <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.watch',$group->id)}}">ウォッチする</a>
        @endif
    </div>
</div>
<h3 class="text-center">{{$group->name}}</h3>
<h6 class="text-center">{{$group->countExtraUsers($role_name)}}人がウォッチ中</h6>
    @php
    info($group->getInfoBaseByTemplate(2)->first());
    $degree=substr($group->getInfoByTemplate(2)->first()->info['degree'], 0, -1);
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