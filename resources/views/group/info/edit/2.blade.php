<form method="POST" action="{{ route('group.info.update',[$group->id,$index]) }}">
    @csrf
    @method('PUT')


    <div class="form-group">
        <label for="degree">混雑度</label>
        <input id="degree" type="text" class="form-control-plaintext form-control-lg" name="info[degree]" value="" readonly>
    </div> 

    <div id="slider" class="slider mb-5"></div>


    <div class="form-group">
        <label for="detail">詳細情報</label>
        <textarea class="form-control" id="detail" name="info[detail]" rows="5">{{$info->info['detail']}}</textarea>
    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        変更
        </button>
    </div>
    
</form>


<script type="module">
var slider = document.getElementById('slider');
var input = document.getElementById('degree');
noUiSlider.create(slider, {
    start: 50,
    behaviour: 'snap',
    connect: [true, false],
    step: 25,
    range: {
        'min': 0,
        'max': 100
    },
    /*pips: {
        mode: 'count',
        values: 5,
        density: 5
    }*/
});
slider.noUiSlider.on('update', function( values,handle) {
    input.value = parseInt(values[handle])+"%";
});
</script>
