@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-3">

            {{ Breadcrumbs::render('group.show',$group) }}

            <div class="card-body">

            @include('group.show.header.'.$type->name, ['group'=>$group,'bases'=>$bases])
            
            @if(Auth::user()->hasGroup($group->id))
            @if($type->need_location)
            <div class="text-left row mt-4 mb-3">
            @can('update',$group)
            <form id="set_here" action="{{route('group.location.set_here',$group)}}" method="POST">
                @csrf
                <input type="hidden" name="latitude">
                <input type="hidden" name="longitude">
                <button type="submit" class="btn btn-outline-success btn-round btn-sm mr-2"><i class="material-icons">my_location</i> 現在地を地点に設定</button>
            </form>
            <script type="module">
                $(function(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                    (position) => {
                        $('input[name="latitude"]').val(position.coords.latitude); 
                        $('input[name="longitude"]').val(position.coords.longitude); 
                    });
                }
                })
            </script>
            @endcan
            <div>
                <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.location.show',$group->id)}}"><i class="material-icons">location_on</i> 地点を表示</a>
            </div>
            </div>
            @endif
            <div class="row">
                <a class="btn btn-primary btn-block" href="{{route('group.edit',[$group->id])}}">変更/削除</a>
            </div>
            @endif

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
                    @php
                    $template=$base->getTemplate();
                    @endphp
                    <div class="tab-pane @if($base->index==$index) active @endif" id="pill{{$base->index}}">
                        @include('group.info.show.'.$template->id, ['base'=>$base,'info'=>$base->info(),'group'=>$group])
                        @can('update-group-info',[$group,$base->index])
                        <div class="row">
                            <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('group.info.edit',[$group->id,$base->index])}}">{!! $template->edit['icon'] !!} {{$template->edit['name']}}</a>
                        </div>
                        @endcan
                    </div>
                    @endforeach
                </div>
                @can('viewAny-group-info-bases', $group)
                <div class="row">
                    <a class="btn btn-primary btn-block" href="{{route('group.info_base.index',[$group->id])}}"><i class="material-icons">list</i> 情報編集</a>
                </div>
                @endcan
            </div>
            
        </div>
        
    </div>
</div>
@endsection