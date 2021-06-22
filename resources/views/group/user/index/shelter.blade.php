@extends('template')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                
                <h5>{{$group->name}}</h5>
                <a href="{{route('group.user.create',$group->id)}}">create</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ユーザー名</th>
                            <th>役割</th>
                            <th>アクション</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            @php
                            $users=$group->usersHaveRole($role->id);
                            @endphp
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$role->name}}</td>
                                    <td class="p-1"><a href="{{route('group.user.edit',[$group->id,$user->id])}}">edit</a></td>
                                </tr>
                                @endforeach
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection