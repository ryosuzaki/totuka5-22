<div class="table-responsive">
    <table class="table text-nowrap">
        <tbody>
            @php
            $info=$base->info()->info;
            @endphp
            <tr><td style="width: 30%">回答日時</td><td style="width: 70%">{{$base->info()->updated_at}}</td></tr>
            <tr><td>調子</td><td>{{$info["feeling"]}}</td></tr>
            <tr><td>食欲</td><td>{{$info["syokuyoku"]}}</td></tr>
            <tr><td>お通じ</td><td>{{$info["otuzi"]}}</td></tr>
            <tr><td>体温</td><td>{{$info["taion"]}} ℃</td></tr>
            <tr><td>体重</td><td>{{$info["taiju"]}} kg</td></tr>
            <tr><td>最高血圧</td><td>{{$info["ketuatu_saikou"]}} mmHg</td></tr>
            <tr><td>最低血圧</td><td>{{$info["ketuatu_saitei"]}} mmHg</td></tr>
            <tr><td>症状</td><td>
                @foreach($info["warui_bui"] as $bui)
                {{$bui}}
                @endforeach
            <br></td></tr>
            <tr><td>コメント</td><td>{{$info["comment"]}}</td></tr>
        </tbody>
    </table>
</div>
<div class="row">
    <a class="btn btn-primary btn-block mx-auto" href="{{route('user.questionnaire.setting_form',$base->id)}}"><i class="material-icons">settings</i> アンケート設定</a>
</div>

