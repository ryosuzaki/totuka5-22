<h2>福祉</h2>
<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">障害の有無</td><td style="width: 70%">{{$base->info()->info["help1"]}}</td></tr>		
		<tr><td>要支援・要介護認定</td><td>{{$base->info()->info["help2"]}}</td></tr>			
		<tr><td>介護者の有無と続柄</td><td>{{$base->info()->info["help3"]}}({{$base->info()->info["help4"]}})</td></tr>		
		<tr><td>介護サービスの有無</td><td>{{$base->info()->info["help5"]}}</td></tr>		
		<tr><td>サービス内容</td><td>{{$base->info()->info["help6"]}}</td></tr>		
		<tr><td>利用サービス施設名称</td><td>{{$base->info()->info["help7"]}}</td></tr>	
		<tr><td>在宅酸素療法</td><td>{{$base->info()->info["help8"]}}</td></tr>		
		<tr><td>介助者</td><td>{{$base->info()->info["help9"]}}</td></tr>			
	</table>
</div>
<h2>住まい</h2>	
<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">同居人の有無</td><td style="width: 70%">{{$base->info()->info["home1"]}}</td></tr>			
		<tr><td>最寄りの避難場所</td><td>{{$base->info()->info["home2"]}}</td></tr>	
	</table>
</div>
