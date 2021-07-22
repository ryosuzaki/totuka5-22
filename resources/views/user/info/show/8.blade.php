<h2>家族情報</h2>
<div class="table-responsive">
    <table class="table text-nowrap">
		<tr><td style="width: 30%">氏名</td><td style="width: 70%">{{$base->info()->info["fami1"]}}</td></tr>	
		<tr><td>性別</td><td>{{$base->info()->info["fami2"]}}</td></tr>			
		<tr><td>年齢</td><td>{{$base->info()->info["fami3"]}}歳</td></tr>		
		<tr><td>続柄</td><td>{{$base->info()->info["fami4"]}}</td></tr>		
		<tr><td>住所</td><td>〒{{$base->info()->info["fami5"]}}　{{$base->info()->info["fami6"]}}{{$base->info()->info["fami7"]}}</td></tr>	
		<tr><td>電話番号</td><td>{{$base->info()->info["fami8"]}}</td></tr>		
		<tr><td>メールアドレス</td><td>{{$base->info()->info["fami9"]}}</td></tr>		
	</table>
</div>
