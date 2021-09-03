<p class="h4">避難所</p>
<p class="h2 mt-0">{{$group->name}}</p><a href="{{route("group.show",$group->id)}}" class="btn btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">launch</i>ページへ</a>
@php
$congestion_info=$group->getInfoByTemplate(config('kaigohack.shelter.group_congestion_info_template_id'));
@endphp
<p class="h3">混雑度：{{$congestion_info->info['degree']}}%</p>
<div class="progress">
    <div class="progress-bar" role="progressbar" style="width:{{$congestion_info->info['degree']}}%;background-color:{{$congestion_info->info['color']}};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
    </div>
</div>


@if(Auth::user()->hasExtraGroup($group->id,config('kaigohack.watch')))
<a href="{{route('group.unwatch',$group->id)}}" class="btn btn-primary btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">check</i>{{config('kaigohack.watch')}}中</a>
@else
<a href="{{route('group.watch',$group->id)}}" class="btn btn-outline-primary btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">check</i>{{config('kaigohack.watch')}}する</a>
@endif

<button id="guide_route" class="btn btn-info btn-round py-2 px-3"><i class="material-icons m-0" style="font-size: 1.5rem;">directions</i>経路案内</button>

            
            