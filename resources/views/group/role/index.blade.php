@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
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
                                    <td>{{$role->name}}</td>
                                    <td class="row">
                                    <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.user.create',$group->id)}}"><i class="material-icons">person_add</i>追加</a>
                                    @if($role->name!=$group->creator)
                                    <a class="btn btn-primary btn-sm btn-round text-white" href="{{route('group.role.edit',[$group->id,$role->id])}}"><i class="material-icons">edit</i>編集</a>
                                    <form action="{{route('group.role.destroy',[$group->id,$role->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-round btn-sm text-white"><i class="material-icons">remove_circle_outline</i>削除</button>
                                    </form>
                                    @endif
                                    <a class="btn btn-info btn-round btn-sm text-white" href="{{route('group.role.show',[$group->id,$role->id])}}">詳細<i class="material-icons">keyboard_arrow_right</i></a>
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
</div>
@endsection