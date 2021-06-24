@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @php
                $types=$user->groupTypes();
                $exist_request=$user->groupsRequestJoin()->get()->isNotEmpty();
                @endphp
                @if($types)
                <ul class="nav nav-pills nav-pills-primary" role="tablist">

                    @if($exist_request)
                    <li class="nav-item mx-auto">
                        <a class="nav-link active" href="#join_request" data-toggle="tab">参加リクエスト</a>
                    </li>
                    @endif

                    @foreach($types as $type)
                    <li class="nav-item mx-auto">
                        <a class="nav-link @if($types[0]==$type&&!$exist_request)active @endif" href="#{{$type->name}}" data-toggle="tab">{{$type->formatted_name}}</a>
                    </li>
                    @endforeach
                </ul>
                
                <div class="tab-content tab-space">


                    @if($exist_request)
                    <div class="tab-pane active" id="join_request">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>種類</th>
                                    <th>名前</th>
                                    <th>役割</th>
                                    <th>アクション</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->groupsRequestJoin()->get() as $group)
                                    <tr>
                                        <td>{{$group->getType()->formatted_name}}</td>
                                        <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                                        <td>{{$group->getRole($group->pivot->role_id)->role_name}}</td>                                    
                                        <td class="p-1">
                                        <a class="btn btn-success btn-sm btn-round text-white" href="{{route('user.group.accept_join_request',$group->id)}}"><i class="material-icons">login</i></a>
                                        <a class="btn btn-danger btn-sm btn-round text-white" href="{{route('user.group.denied_join_request',$group->id)}}"><i class="material-icons">close</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif



                    @foreach($types as $type)
                    <div class="tab-pane @if($types[0]==$type&&!$exist_request)active @endif" id="{{$type->name}}">
                    @include('user.group.index.'.$type->name, ['user'=>$user,'groups' => $user->groupsHaveType($type->id)])
                    </div>
                    @endforeach
                </div>
                @else
                <h4>参加しているグループはありません</h4>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection