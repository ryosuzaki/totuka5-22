<div class="table-responsive">
    <table class="table text-nowrap">
        <tbody>
            <tr><td style="width: 30%">回答日時</td><td style="width: 70%">{{$base->info()->updated_at}}</td></tr>
            <tr><td>体調</td><td>{{$base->info()->info["main"]}}</td></tr>
            <tr><td>コメント</td><td>{{$base->info()->info["comment"]}}</td></tr>
        </tbody>
    </table>
</div>
