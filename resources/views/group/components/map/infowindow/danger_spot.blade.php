<div class="d-flex justify-content-between"><h4 class="">危険地点</h4><div class=""><a href="{{route("group.create",$group->getType())}}" class="btn btn-success btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">add_location_alt</i>新規登録</a></div></div>

<p class="h2 mt-0">{{$group->name}}</p>
<a href="{{route("group.show",$group->id)}}" class="btn btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">launch</i>ページへ</a>
@php
$role_name=config('kaigohack.like');
$imgs=$group->getImgs();
@endphp
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i=0;$i<count($imgs);$i++)
        <li data-target="#carousel" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach($imgs as $img)
        <div class="carousel-item @if($imgs[0]==$img) active @endif">
            <img class="d-block w-100" src="{{$img->getUrl()}}">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<a class="btn btn-warning py-2 px-3" href=""><i class="material-icons m-0" style="font-size: 1.5rem;">campaign</i>通報</a>
@if(Auth::user()->hasGroup($group->id))
<a class="btn btn-outline-primary btn-round py-2 px-3 text-primary"><i class="material-icons m-0" style="font-size: 1.5rem;">thumb_up_off_alt</i>{{$group->countExtraUsers($role_name)}}</a>
@elseif(Auth::user()->hasExtraGroup($group->id,$role_name))
<a href="{{route('group.unlike',$group->id)}}" class="btn btn-primary btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">thumb_up_off_alt</i>{{$group->countExtraUsers($role_name)}}</a>
@else
<a href="{{route('group.like',$group->id)}}" class="btn btn-outline-primary btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">thumb_up_off_alt</i>{{$group->countExtraUsers($role_name)}}</a>
@endif

