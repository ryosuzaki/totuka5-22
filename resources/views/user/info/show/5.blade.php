<div class="table-responsive">
    <table class="table text-nowrap">
        <tbody>
            <tr><td style="width: 30%">回答日時</td><td style="width: 70%">{{$base->info()->updated_at}}</td></tr>
            <tr><td>体温</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>最高血圧</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>最低血圧</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>体重</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>調子</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>食欲</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>お通じ</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>調子の悪い部分</td><td>{{$base->info()->info["comment"]}}</td></tr>
        </tbody>
    </table>
</div>
