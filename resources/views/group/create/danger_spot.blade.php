@foreach(config('kaigohack.danger_spot.name') as $name)
<div class="form-check form-check-radio form-check-inline">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="name" value="{{$name}}">
        {{$name}}
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
@endforeach
<div class="form-group mb-0">
    <button type="submit" class="btn btn-primary btn-block">
    危険地点投稿
    </button>
</div>
