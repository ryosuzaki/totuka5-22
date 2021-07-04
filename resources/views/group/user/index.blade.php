@extends('template')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <h5>{{$group->getFormattedTypeName()}}</h5>
                
                <div class="form-group">
                    <select class="form-control selectpicker h4" data-style="btn btn-link" id="role-link">
                        @foreach($group->roles()->get() as $r)
                        <option value="{{route('group.user.index',[$group->id,$r->index])}}"@if($role==$r) selected @endif>{{$r->role_name}}</option>
                        @endforeach
                    </select>
                </div>

                <script type="module">
                    document.getElementById("role-link").onchange = function() {
                        window.location.href = this.value;
                    };
                </script>
                <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.user.create',[$group->id,$role->index])}}"><i class="material-icons">person_add</i>追加</a>
                @php
                $users=$role->users()->get();
                @endphp
                
                @if(Illuminate\Support\Facades\View::exists('group.user.index.'.$group->getTypeName()))
                @include('group.user.index.'.$group->getTypeName(),['users'=>$users])
                @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ユーザー名</th>
                            <th>メールアドレス</th>
                            <th>アクション</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($users as $user)
                            <tr>
                                <td><a href="{{route('group.user.show',[$group->id,$user->id,$role->index])}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td class="row pt-1">
                                <form action="{{route('group.user.destroy',[$group->id,$user->id,$role->index])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger btn-round btn-sm text-white"><i class="material-icons">logout</i> 退出</button>
                                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    本当にユーザーを退出させますか？
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                                    <button type="submit" class="btn btn-danger text-white">退出させる</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection