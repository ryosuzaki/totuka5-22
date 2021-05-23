@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="text-center">{{$group->name}}</h3>
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
                    <div class="tab-content tab-space  pb-0">
                        @foreach ($infos as $info)
                        <div class="tab-pane @if($infos[0]==$info) active @endif" id="pill{{$info->id}}">
                            @include('group.info_base.show.'.$info->id, ['info'=>$info])
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

