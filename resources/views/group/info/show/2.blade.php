@php
$degree=$info->info['degree'];
$color=$info->info['color'];
@endphp
<p class="h5 mb-0">混雑度：</p>
<p class="h2 font-weight-bold mt-0" style="color:{{$color}};">{{$degree}}%</p>

<p class="h5 mt-4">混雑詳細：</p>
<p class="h4" style="white-space:pre-line;">{{$info->info['detail']}}</p>
