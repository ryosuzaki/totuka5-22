<form method="POST" action="{{ route('group.store_with_location',$type) }}">
    @csrf

    <p class="h3 text-center">危険地点</p>
    <div class="my-5">
        @foreach(config('kaigohack.danger_spot.name') as $name)
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


        <div class="form-check my-5">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="set_location">
                現在地を地点に設定
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    
        <input type="hidden" name="latitude">
        <input type="hidden" name="longitude">
        <script type="module">
            $(function(){

                $("#set_location").change(function() {
                    if($(this).prop('checked')){
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                            (position) => {
                                $('input[name="latitude"]').val(position.coords.latitude); 
                                $('input[name="longitude"]').val(position.coords.longitude); 
                            });
                        }
                    }else{
                        $('input[name="latitude"]').val(null); 
                        $('input[name="longitude"]').val(null); 
                    }
                });
            })
        </script>
    </div>

    

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        登録
        </button>
    </div>
</form>