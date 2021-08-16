@php
$degree=substr($base->info()->info['degree'], 0, -1);
@endphp
<p class="h5 mb-0">混雑度：</p>
<p class="h2 font-weight-bold mt-0
@if($degree=='25')text-success
@elseif($degree=='50')text-info
@elseif($degree=='75')text-warning
@elseif($degree=='100')text-danger
@endif
">{{$degree}}%</p>

<p class="h5 mt-4">混雑詳細：</p>
<p class="h4" style="white-space:pre-line;">{{$info->info['detail']}}</p>
