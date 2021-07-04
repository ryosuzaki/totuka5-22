<input type="hidden" name="type" value="{{$type}}">
<input id="name" type="text" class="form-control d-none" name="name" value="danger_spot">
<input id="password" type="text" class="form-control d-none" name="password" value="password{{Auth::id()}}">
<input id="password-confirm" type="text" class="form-control d-none" name="password_confirmation" value="password{{Auth::id()}}">
<div class="form-group row mb-0">
    <button type="submit" class="btn btn-primary btn-block">
    危険地点投稿
    </button>
</div>
