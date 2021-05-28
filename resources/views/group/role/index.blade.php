@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$group}} <br>
                    @foreach ($roles as $role)
                    {{$role}} <br>
                    @endforeach

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ランク</th>
                                <th>役割名</th>
                                <th>アクション</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->rank}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                    <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.user.create',$group)}}"><i class="material-icons">person_add</i>追加</a>
                                    @if($role->rank!=0)
                                    <a class="btn btn-primary btn-sm btn-round text-white" href="{{route('group.role.edit',[$group,$role])}}"><i class="material-icons">edit</i>編集</a>
                                    <a class="btn btn-danger btn-round btn-sm text-white" href="{{route('group.role.destroy',[$group,$role])}}"><i class="material-icons">remove_circle_outline</i>削除</a>
                                    @endif
                                    <a class="btn btn-info btn-round btn-sm text-white" href="{{route('group.role.show',[$group,$role])}}">詳細<i class="material-icons">keyboard_arrow_right</i></a>
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