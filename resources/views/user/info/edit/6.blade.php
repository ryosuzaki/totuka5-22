<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')

    @php
    $info=$base->info()->info;
    @endphp
    <input type="hidden" name="info[rescue]" value="{{$info['rescue']}}">
    <input type="hidden" name="info[group]" value="{{$info['group']}}">
    <input type="hidden" name="info[rescuer]" value="{{$info['rescuer']}}">
    <input type="hidden" name="info[last_answer]" value="{{now()}}">
    <div>
        <label>避難状況</label>
        <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input class="form-check-input btn-check" type="radio" name="info[evacuation]" value="避難済み"> 避難済み
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>

        <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="info[evacuation]" value="避難中" checked> 避難中
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>

        <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="info[evacuation]" value="要救助"> 要救助
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>
    </div>

    <div class="form-group mt-4">
        <label for="shelter">避難した場所</label>
        <input id="shelter" type="text" class="form-control form-control-lg" name="info[shelter]" value="{{$info['shelter']}}">
    </div>

    <input type="hidden" name="info[location][latitude]" id="latitude">
    <input type="hidden" name="info[location][longitude]" id="longitude">
    <div class="form-check my-4">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" id="send_location">
            現在地の位置情報を送る
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
        </label>
    </div>
    <script type="module">
        $(function(){
            $('#send_location').change(function() {
                if($(this).prop('checked')){
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                        (position) => {
                            $('#latitude').val(position.coords.latitude); 
                            $('#longitude').val(position.coords.longitude); 
                        });
                    }
                }else{
                    $('#latitude').val(''); 
                    $('#longitude').val('');
                }
            })
        })
    </script>

    <div class="form-group mt-4">
        <label for="comment">コメント</label>
        <textarea class="form-control" id="comment" name="info[comment]" rows="5"></textarea>
    </div>

    <div class="form-group mb-0 mt-4">
        <button type="submit" class="btn btn-primary btn-block">
            回答
        </button>
    </div>

</form>
