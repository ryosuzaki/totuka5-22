<div class="table-responsive">
    <table class="table text-nowrap">
        <tbody>
            @php
            $info=$base->info()->info;
            @endphp
            <tr><td>バージョン</td><td>@if($info["is_long"]) 完全版 @else 短縮版 @endif</td></tr>
            <tr><td style="width: 30%">回答日時</td><td style="width: 70%">{{$base->info()->updated_at}}</td></tr>
            <tr><td>調子</td><td>{{$info["feeling"]}}</td></tr>
            @if($info["is_long"])
            <tr><td>食欲</td><td></td></tr>
            <tr><td>お通じ</td><td></td></tr>
            <tr><td>体温</td><td></td></tr>
            <tr><td>体重</td><td></td></tr>
            <tr><td>最高血圧</td><td></td></tr>
            <tr><td>最低血圧</td><td></td></tr>
            @endif
            <tr><td>コメント</td><td>{{$info["comment"]}}</td></tr>
        </tbody>
    </table>
</div>
