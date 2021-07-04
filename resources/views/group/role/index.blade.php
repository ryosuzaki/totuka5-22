@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">


            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                    <li class="breadcrumb-item"><a href="#">{{$group->getFormattedTypeName()}}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{$group->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">役割一覧</li>
                </ol>
            </nav>
            <h3 class="text-center mb-4">役割一覧</h3>


            <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.role.create',$group->id)}}"><i class="material-icons">add</i>追加</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>役割名</th>
                            <th>アクション</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->role_name}}</td>
                                <td class="row">
                                <a class="btn btn-primary btn-sm btn-round text-white" href="{{route('group.role.edit',[$group->id,$role->index])}}"><i class="material-icons">edit</i> 変更</a>
                                @if($role->index!=0)
                                <a class="btn btn-warning btn-sm btn-round text-white" href="{{route('group.permission.edit',[$group->id,$role->index])}}"><i class="material-icons">lock_open</i> 権限</a>
                                <a class="btn btn-info btn-round btn-sm text-white" href="{{route('group.user.index',[$group->id,$role->index])}}"><i class="material-icons">groups</i> ユーザ</a>
                                <form action="{{route('group.role.destroy',[$group->id,$role->index])}}" method="post">
                                @csrf
                                @method('delete')

                                <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger btn-round btn-sm text-white"><i class="material-icons">remove_circle_outline</i> 削除</button>
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                本当に役割を削除しますか？
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                                <button type="submit" class="btn btn-danger text-white">削除する</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                @endif
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