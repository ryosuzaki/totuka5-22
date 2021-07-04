<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th>メールアドレス</th>
            <th>回答日時</th>
            <th>健康状態</th>
            <th>アクション</th>
        </tr>
        </thead>
        <tbody>
            
            @foreach ($users as $user)
            @php
            $exist=$user->getInfoBaseByTemplate(5)->isNotEmpty();
            if ($exist){
                $info=$user->getInfoBaseByTemplate(5)->first()->info();
            }
            @endphp
            <tr>
                <td><a href="{{route('group.user.show',[$group->id,$user->id,$role->index])}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                @if($exist)
                <td>{{($info->updated_at)}}</td>
                <td>{{$info->info['main']}}</td>
                @else
                <td></td><td></td>
                @endif
                <td class="row pt-1">
                @if($role->index!=0)
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
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>