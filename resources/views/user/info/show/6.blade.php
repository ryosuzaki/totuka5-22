<div class="table-responsive">
	<table class="table text-nowrap"> 
		<tr><td style="width: 30%">救助状況</td><td style="width: 70%">{{$base->info()->info["rescue"]}}</td></tr>			
		<tr><td>救助者</td><td>{{optional($base->info()->info["group"])->name}}</td></tr>
	</table>
</div>
