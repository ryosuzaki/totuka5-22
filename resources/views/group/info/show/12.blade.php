<div class="table-responsive">
    <table class="table text-nowrap tablesorter" id="sorter{{$base->index}}">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th>健康状態 回答日時</th>
            <th>健康状態</th>
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