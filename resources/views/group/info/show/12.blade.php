<div class="table-responsive">
    <table class="table text-nowrap tablesorter" id="sorter{{$base->index}}">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th>健康状態 回答日時</th>
            <th>健康状態</th>
            <th>コメント</th>
            <th>食欲</th>
            <th>お通じ</th>
            <th>体温</th>
            <th>体重</th>
            <th>最高血圧</th>
            <th>最低血圧</th>
            <th>症状</th>
        </tr>
        </thead>
        <tbody>
            @php
            $users=$group->users()->get();
            @endphp

            @foreach ($users as $user)

            @php
            $info_base=$user->getInfoBaseByTemplate(5);
            @endphp

            @if($info_base->isNotEmpty())

            @php
            $info=$info_base->first()->info();
            @endphp

            <tr>
                <td>{{$user->name}}</td>

                <td>{{($info->updated_at)}}</td>
                <td>{{$info->info['feeling']}}</td>
                <td>{{$info->info["comment"]}}</td>
                @if($info->info["is_long"])
                <td>{{$info->info["syokuyoku"]}}</td>
                <td>{{$info->info["otuzi"]}}</td>
                <td>{{$info->info["taion"]}} ℃</td>
                <td>{{$info->info["taiju"]}} kg</td>
                <td>{{$info->info["ketuatu_saikou"]}} mmHg</td>
                <td>{{$info->info["ketuatu_saitei"]}} mmHg</td>
                <td>
                    @foreach($info->info["warui_bui"] as $bui)
                    {{$bui}}
                    @endforeach
                </td>
                @endif
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