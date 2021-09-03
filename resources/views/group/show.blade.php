@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-3">

            {{ Breadcrumbs::render('group.show',$group) }}

            <div class="card-body">
            <div class="row">
                <div class="ml-auto">
                    @can('viewAny-group-roles',$group)
                    <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.role.index',$group->id)}}"><i class="material-icons">assignment_ind</i>　役割</a>
                    @endcan
                </div>
            </div>

            @if(Illuminate\Support\Facades\View::exists('group.show.'.$group->getTypeName()))
            @include('group.show.'.$type->name, ['group'=>$group,'bases'=>$bases])
            @else
            @endif

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

            @if($group->isLocationSet())
            <div>
                <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.location.show',$group->id)}}"><i class="material-icons">location_on</i> 地点を表示</a>
            </div>
            @else
            <div>
                <a class="btn btn-outline-default btn-round btn-sm disabled"><i class="material-icons">location_on</i> 地点未設定</a>
            </div>
            @endif
            </div>
            @endif
            @can('update',$group)
            <div class="row">
                <a class="btn btn-primary btn-block" href="{{route('group.edit',[$group->id])}}">変更/削除</a>
            </div>
            @endcan
            @endif

            </div>
        </div>

        <script type="module">
        function embed_info_view(type,url,embed_to){
            $.ajax({
                type:type, 
                url:url,
                dataType: 'html',
            })
            .done((response)=>{
                $(embed_to).html(response);
            })
            .fail((error)=>{
                console.log(error)
            })
        }
        $(function(){
            window.history.replaceState(null,null,"{{route('group.show',['group'=>$group,'index'=>$index])}}");
            embed_info_view("get","{{route('group.get_info',['group'=>$group,'index'=>$index])}}","#embed_info{{$index}}");
            @foreach ($bases as $base)
            $("a[href='#pill{{$base->index}}']").click(function(){
                window.history.replaceState(null,null,"{{route('group.show',['group'=>$group,'index'=>$base->index])}}");
                embed_info_view("get","{{route('group.get_info',['group'=>$group,'index'=>$base->index])}}","#embed_info{{$base->index}}");
            });
            @endforeach
        });
        </script>

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
                        <div id="embed_info{{$base->index}}"></div>
                        @can('update-group-info',[$group,$base->index])
                        @if(!empty($template->edit))
                        <div class="row">
                            <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('group.info.edit',[$group->id,$base->index])}}">{!! $template->edit['icon'] !!} {{$template->edit['name']}}</a>
                        </div>
                        @endif
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