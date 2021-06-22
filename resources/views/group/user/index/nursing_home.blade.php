@extends('template')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h5>{{App\Models\Group\Group::groupType($group->type)}}</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ユーザー名</th>
                            <th>メールアドレス</th>
                            <th>役割</th>
                            <th>アクション</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td><a href="{{route('group.user.show',[$group->id,$user->id])}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->groupRole($group)->name}}</td>
                                <td class="p-1">
                                <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.user.edit',[$group->id,$user->id])}}"><i class="material-icons">edit</i></a>

                                <a class="btn btn-danger btn-round btn-sm text-white" data-toggle="modal" data-target="#{{$user->id}}"><i class="material-icons">logout</i></a>
                                <div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$user->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        本当に退出させますか？
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                        <a class="btn btn-danger text-white" href="{{route('group.user.destroy',[$group->id,$user->id])}}">退出させる</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection