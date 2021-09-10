<form method="POST" action="{{ route('group.store_with_location',$type) }}">
    @csrf

    <p class="h3 text-center">危険地点</p>
    <p class="text-center">あなたのいる場所の状況を教えてください。<br>登録すると現在地が共有されます。</p>
    <div class="my-5">
        @foreach(config('kaigohack.danger_spot.spot_names') as $name)
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="name" value="{{$name}}">
                {{$name}}
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        @endforeach
    
        <input type="hidden" name="latitude">
        <input type="hidden" name="longitude">
        <script type="module">
            $(function(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                    (position) => {
                        $('input[name="latitude"]').val(position.coords.latitude); 
                        $('input[name="longitude"]').val(position.coords.longitude); 
                    });
                }
            })
        </script>
    </div>

    

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        登録
        </button>
    </div>
</form>