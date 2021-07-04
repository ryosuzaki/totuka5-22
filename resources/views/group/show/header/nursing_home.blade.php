<div class="row">
    <div class="ml-auto">
        @if(Auth::user()->hasGroup($group->id))
        <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.role.index',$group->id)}}"><i class="material-icons">assignment_ind</i>　役割</a>
        <a class="btn btn-info btn-sm btn-round text-white" href="{{route('group.user.index',$group->id)}}"><i class="material-icons">groups</i>　参加者</a>
        <a class="btn btn-primary text-white btn-round btn-sm">参加中</a>
        @endif
    </div>
</div>
<h3 class="text-center">{{$group->name}}</h3>
            