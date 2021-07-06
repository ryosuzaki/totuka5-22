@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mt-0">
            
            <div class="card-body">
                
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item"><a href="#">{{Auth::user()->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">グループ一覧</li>
                    </ol>
                </nav>
                <h3 class="text-center mb-4">グループ一覧</h3>

                @php
                $types=$user->groupTypes();
                $groups=$user->groups()->get();
                $exist_request=$user->groupsRequestJoin()->get()->isNotEmpty();
                $exist_extra=$user->extraGroups()->get()->isNotEmpty();
                @endphp
                @if($types)
                <ul class="nav nav-pills nav-pills-primary" role="tablist">

                    @if($exist_request)
                    <li class="nav-item mx-auto">
                        <a class="nav-link active" href="#join_request" data-toggle="tab">参加リクエスト</a>
                    </li>
                    @endif
                    
                    <li class="nav-item mx-auto">
                        <a class="nav-link @if(!$exist_request)active @endif" href="#group" data-toggle="tab">参加グループ</a>
                    </li>

                    @if($exist_extra)
                    <li class="nav-item mx-auto">
                        <a class="nav-link" href="#extra" data-toggle="tab">アクセスしたグループ</a>
                    </li>
                    @endif

                </ul>
                
                <div class="tab-content tab-space">


                    @if($exist_request)
                    <div class="tab-pane active" id="join_request">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
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
                                        <a class="btn btn-success btn-sm btn-round text-white" href="{{route('user.group.accept_join_request',$group->id)}}"><i class="material-icons">login</i> 参加する</a>
                                        <a class="btn btn-danger btn-sm btn-round text-white" href="{{route('user.group.denied_join_request',$group->id)}}"><i class="material-icons">close</i> 参加しない</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif



                    <div class="tab-pane @if(!$exist_request)active @endif" id="group">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>
                                    <th>種類</th>
                                    <th>名前</th>
                                    <th>役割</th>
                                    <th>アクション</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($groups as $group)
                                    @php
                                    $role=$user->getRoleByGroup($group->id);
                                    @endphp
                                    <tr>
                                        <td>{{$group->getFormattedTypeName()}}</td>
                                        <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                                        <td>{{$role->role_name}}</td>                                     
                                        <td class="p-1">
                                        @if($role->index!=0)
                                        <a class="btn btn-primary btn-sm btn-round text-white" href="{{route('user.group.edit',[$group->id])}}"><i class="material-icons">autorenew</i> 変更</a>
                                        <a class="btn btn-danger btn-round btn-sm text-white" data-toggle="modal" data-target="#{{$group->id}}"><i class="material-icons">logout</i> 退出</a>
                                        <div class="modal fade" id="{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$group->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-body">
                                                    本当に退出しますか？
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                                    <a class="btn btn-danger text-white" href="{{route('user.group.destroy',$group->id)}}">退出する</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    @if($exist_extra)
                    <div class="tab-pane" id="extra">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>
                                    <th>種類</th>
                                    <th>名前</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->extraGroups()->get() as $group)
                                    <tr>
                                        <td>{{$group->getFormattedTypeName()}}</td>
                                        <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                                        <td>{{$group->pivot->name}}</td>                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

        
                </div>
                @else
                <h4>参加しているグループはありません</h4>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection