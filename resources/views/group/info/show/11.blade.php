<div class="table-responsive">
    <table class="table text-nowrap tablesorter" id="sorter{{$base->index}}">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th>避難状況 回答日時</th>
            <th>避難状況</th>
            <th>救助状況</th>
            <th>避難した場所</th>
            <th>位置情報</th>
            <th>コメント</th>
        </tr>
        </thead>
        <tbody>
            @php
            $users=$group->users()->get();
            @endphp
            @foreach ($users as $user)

            @php
            $info_base=$user->getInfoBaseByTemplate(6);
            @endphp

            @if($info_base->isNotEmpty())
            @php
            $info=$info_base->first()->info();
            $rescue=$info->info['rescue'];
            $rescue_group=$info->info['group'];
            @endphp
            <tr>
                <td>{{$user->name}}</td>
                
                <td>{{$info->info['last_answer']}}</td>
                <td>{{$info->info['evacuation']}}</td>
                <td>
                @if($rescue==config('kaigohack.rescue.rescue'))
                    @if($rescue_group==$group)
                    <a class="btn btn-danger btn-sm text-white m-0" href="{{route('group.user.unrescue',[$info->info['group']->id,$user->id])}}"><i class="material-icons">close</i> やめる</a>
                    <button type="button" data-toggle="modal" data-target="#rescued{{$user->id}}" class="btn btn-success btn-sm text-white m-0"><i class="material-icons">done</i> 完了</button>
                    <div class="modal fade" id="rescued{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="rescuedLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    本当に救助を完了しますか？
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                    <a class="btn btn-success text-white" href="{{route('group.user.rescued',[$info->info['group']->id,$user->id])}}">救助を完了</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>が救助中
                    @endif
                @elseif($rescue==config('kaigohack.rescue.unrescue'))
                <a class="btn btn-warning btn-sm text-white m-0" href="{{route('group.user.rescue',[$group->id,$user->id])}}">救助に向かう</a>
                @elseif($rescue==config('kaigohack.rescue.rescued'))
                <a href="{{route('group.show',$rescue_group->id)}}">{{$rescue_group->name}}</a>が救助済み
                @endif
                </td>
                <td>{{$info->info['shelter']}}</td>
                <td>{{$info->info["location"]["latitude"]}} {{$info->info["location"]["longitude"]}}</td>
                <td>{{$info->info['comment']}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

<script type="module">
    $(document).ready(function() { 
        $("#sorter{{$base->index}}").tablesorter();
    });
</script>