<div class="table-responsive">
    <table class="table text-nowrap">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th>メールアドレス</th>
            <th>回答日時</th>
            <th>健康状態</th>
            <th>救助状況</th>
            <th>アクション</th>
        </tr>
        </thead>
        <tbody>
            
            @foreach ($users as $user)
            <tr>
                <td><a href="{{route('group.user.show',[$group->id,$user->id,$role->index])}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>


                @php
                $exist=$user->getInfoBaseByTemplate(5)->isNotEmpty();
                if ($exist){
                    $info=$user->getInfoBaseByTemplate(5)->first()->info();
                }
                @endphp
                @if($exist)
                <td>{{($info->updated_at)}}</td>
                <td>{{$info->info['main']}}</td>
                @else
                <td></td><td></td>
                @endif


                @php
                $exist=$user->getInfoBaseByTemplate(6)->isNotEmpty();
                if ($exist){
                    $info=$user->getInfoBaseByTemplate(6)->first()->info();
                    $rescue=$info->info['rescue'];
                    $rescue_group=$info->info['group'];
                }
                @endphp
                @if($exist)
                <td>
                @if($rescue==config('group.rescue.rescue'))
                    @if($rescue_group==$group)
                    <a class="btn btn-danger btn-round btn-sm text-white m-0" href="{{route('group.user.unrescue',[$info->info['group']->id,$user->id])}}">救助をやめる</a>
                    <a class="btn btn-success btn-round btn-sm text-white m-0" href="{{route('group.user.rescued',[$info->info['group']->id,$user->id])}}">救助が完了</a>
                    @else
                    <a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>が救助中
                    @endif
                @elseif($rescue==config('group.rescue.unrescue'))
                <a class="btn btn-warning btn-round btn-sm text-white m-0" href="{{route('group.user.rescue',[$group->id,$user->id])}}">救助に向かう</a>
                @elseif($rescue==config('group.rescue.rescued'))
                <a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>が救助済み
                @endif
                </td>
                @else
                <td></td>
                @endif

                <td class="row pt-1">
                @if($role->index!=0)
                
                    <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger btn-round btn-sm text-white m-0"><i class="material-icons">logout</i> 退出</button>
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    本当にユーザーを退出させますか？
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                    <form action="{{route('group.user.destroy',[$group->id,$user->id,$role->index])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger text-white">退出させる</button>
                                    </form>
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