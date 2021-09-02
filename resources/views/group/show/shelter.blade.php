@php
$role_name=config('kaigohack.watch');
@endphp
<div class="row">
    <div class="ml-auto">
        @if(Auth::user()->hasExtraGroup($group->id,$role_name))
        <a class="btn btn-primary btn-round btn-sm" href="{{route('group.unwatch',$group->id)}}"><i class="material-icons">check</i> {{$role_name}}中</a>
        @else
        <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.watch',$group->id)}}"><i class="material-icons">check</i> {{$role_name}}する</a>
        @endif
    </div>
</div>
<h3 class="text-center">{{$group->name}}</h3>
<h6 class="text-center">{{$group->countExtraUsers($role_name)}}人が{{$role_name}}中</h6>
    @php
    $degree=$group->getInfoByTemplate(config('kaigohack.shelter.group_congestion_info_template_id'))->info['degree'];
    $color=$group->getInfoByTemplate(config('kaigohack.shelter.group_congestion_info_template_id'))->info['color'];
    @endphp
    <div class="row"><p class="h5 mx-auto">混雑度：<strong>{{$degree}}%</strong></p></div>
    
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width:{{$degree}}%;background-color:{{$color}};" aria-valuenow={{$degree}} aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>