@csrf
<div class="table-responsive">
    <table class="table text-nowrap">
        <tbody>
            @php
            $info=$base->info()->info;
            @endphp
            <tr><td style="width: 30%">回答日時</td><td style="width: 70%">{{$base->info()->updated_at}}</td></tr>
        </tbody>
    </table>
</div>
<div class="@if(in_array('feeling', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>調子<span style="float:right">＞</span></h4>
                <p style="color:white;">
                    <span style="background-color:blue;padding:5px">良い</span>
                    <span style="background-color:green;padding:5px">普通</span>
                    <span style="background-color:red;padding:5px">悪い</span>
                </p>
                <div id="calendar1"></div>
            </div>
        </div>
    </a>
</div>
<div class="@if(in_array('syokuyoku', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>食欲<span style="float:right">＞</span></h4>
                <p style="color:white;">
                    <span style="background-color:blue;padding:5px">良い</span>
                    <span style="background-color:green;padding:5px">普通</span>
                    <span style="background-color:red;padding:5px">悪い</span>
                </p>
                <div id="calendar2"></div>
            </div>
        </div>
    </a>
</div>
<div class="@if(in_array('otuzi', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>お通じ<span style="float:right">＞</span></h4>
                <p style="color:white;">
                    <span style="background-color:blue;padding:5px">形がない</span>
                    <span style="background-color:green;padding:5px">普通</span>
                    <span style="background-color:brown;padding:5px">固い</span>
                    <span style="background-color:red;padding:5px">出ない</span>
                </p>
                <div id="calendar3"></div>
            </div>
        </div>
    </a>
</div>
<div class="@if(in_array('taion', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>体温<span style="float:right">＞</span></h4>
                <div id="calendar6"></div>
            </div>
        </div>
    </a>
</div>
<div class="@if(in_array('taiju', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>体重(kg)<span style="float:right">＞</span></h4>
                <div id="calendar4"></div>
            </div>
        </div>
    </a>
</div>
<div class="@if(in_array('ketuatu', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>血圧(mmHg)<span style="float:right">＞</span></h4>
                <div id="calendar5"></div>
            </div>
        </div>
    </a>
</div>
<div class="@if(in_array('warui_bui', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>症状<span style="float:right">＞</span></h4>
                <div>                
                    @foreach($info["warui_bui"] as $bui)
                    {{$bui}}
                    @endforeach
                </div>
            </div>
        </div>
    </a>
</div>
<div class="@if(in_array('comment', $info['not_use_items'])) d-none @endif">
    <a href="">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <h4>コメント<span style="float:right">＞</span></h4>
                <div>                
                {{$info["comment"]}}
                </div>
            </div>
        </div>
    </a>
</div>


<div class="d-flex">
    <a class="btn btn-primary btn-block mx-auto" href="{{route('user.questionnaire.setting_form',$base->id)}}"><i class="material-icons">settings</i> アンケート設定</a>
</div>

<script>    //カレンダーの処理
    $(function(){
        const nowday = new Date();
        var week_day = [];
        function days(today){
            for(var i = 0; i < 7;i++){
                week_day[i] = today.getMonth() + 1 + "/" + today.getDate();
                today.setDate(today.getDate() - 1);
            }
        }
        var result = [""];
        // 初期表示
        days(nowday);

          //直近一週間の記録を入れる
        var condition_ary = [""];
        var food_ary = [""];
        var through_ary = [""];
        var weight_ary = [""];
        var blood_ary = [""];
        var temp_ary = [""];
        condition_ary[0] = "{{$info['feeling']}}";
        food_ary[0] = "{{$info['syokuyoku']}}";
        through_ary[0] = "{{$info['otuzi']}}";
        weight_ary[0] = "{{$info['taiju']}}";
        blood_ary[0] = "{{$info['ketuatu_saikou']}}/{{$info['ketuatu_saitei']}}";
        temp_ary[0] = "{{$info['taion']}}"
        condition();
        food();
        through();
        weight();
        blood();
        temp();

        function condition(){
            result = condition_ary;
            var calendar = createProcess();
            document.querySelector('#calendar1').innerHTML = calendar;
        }
        function food(){
            result = food_ary;
            var calendar = createProcess();
            document.querySelector('#calendar2').innerHTML = calendar;
        }
        function through(){
            result = through_ary;
            var calendar = createProcess();
            document.querySelector('#calendar3').innerHTML = calendar;
        }
        function weight(){
            result = weight_ary;
            var calendar = createProcess();
            document.querySelector('#calendar4').innerHTML = calendar;
        }
        function blood(){
            result = blood_ary;
            var calendar = createProcess();
            document.querySelector('#calendar5').innerHTML = calendar;
        }
        function temp(){
            result = temp_ary;
            var calendar = createProcess();
            document.querySelector('#calendar6').innerHTML = calendar;
        }

        // カレンダー作成
        function createProcess() {
            // 曜日
            var calendar = "<table border='1' height='50' width='400' style='background-color:white;'><tr>";
            var value = 0;
                
            for (var j = 0;j < 7;j++){
                calendar += "<td style='width: 14%'>" + week_day[j] + "</td>";
            }
            calendar += "</tr>";

            calendar += "<tr style='height:50%;'>";
            for (var j = 0; j < 7; j++) {
                value++;
                if(result[value-1] == "良い" || result[value-1] == "形がない"){
                    calendar += "<td style='background-color:blue; color:white;'></td>";
                }else if(result[value-1] == "普通"){
                    calendar += "<td style='background-color:green; color:white;'></td>";
                }else if(result[value-1] == "悪い" || result[value-1] == "出ない"){
                    calendar += "<td style='background-color:red; color:white;'></td>";
                }else if(result[value-1] == "固い"){
                    calendar += "<td style='background-color:brown; color:white;'></td>";
                }else if(result[value-1] == null){
                    calendar += "<td></td>";
                }else if(result[value-1] != "回答なし"){
                    calendar += "<td><strong>" + result[value-1] + "</strong></td>";
                }
            }
            calendar += "</tr>";

            return calendar;
        }
    });
</script>
