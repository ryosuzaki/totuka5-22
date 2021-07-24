<h2>医療</h2>
<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">平熱</td><td style="width: 70%">{{$base->info()->info["care1"]}}℃</td></tr>		
		<tr><td>身長</td><td>{{$base->info()->info["care2"]}}cm</td></tr>		
		<tr><td>体重</td><td>{{$base->info()->info["care3"]}}kg</td></tr>		
		<tr><th>薬の使用状況</th><td></td></tr>
		<tr><td>アレルギー歴</td><td>{{$base->info()->info["care4"]}}</td></tr>	
		<tr><td>既往歴</td><td>{{$base->info()->info["care5"]}}</td></tr>				
		<tr><td>手術歴</td><td>{{$base->info()->info["care6"]}}</td></tr>				
		<tr><td>かかりつけの病院</td><td>{{$base->info()->info["care7"]}}</td></tr>	
	</table>
</div>
