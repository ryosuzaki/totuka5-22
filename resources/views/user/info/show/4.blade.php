<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">性別</td><td style="width: 70%">{{$base->info()->info["you_sex"]}}</td></tr>			
		<tr><td>生年月日</td><td>{{$base->info()->info["you_year"]}}年  {{$base->info()->info["you_month"]}}月  {{$base->info()->info["you_day"]}}日</td></tr>	
		<tr><td>住所</td><td>〒{{$base->info()->info["you_post"]}}　　{{$base->info()->info["you_addr1"]}}{{$base->info()->info["you_addr2"]}}</td></tr>	
		<tr><td>電話番号</td><td>{{$base->info()->info["you_tel"]}}</td></tr>	
	</table>
</div>

