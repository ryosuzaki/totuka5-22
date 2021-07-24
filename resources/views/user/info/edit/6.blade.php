<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')


    <div>
        <div class="form-check form-check-radio m-4">
        <label class="form-check-label" style="transform:scale(1.5);">
            <input class="form-check-input btn-check" type="radio" name="info[main]" value="元気"> 元気
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>

        <div class="form-check form-check-radio m-4">
        <label class="form-check-label" style="transform:scale(1.5);">
            <input class="form-check-input" type="radio" name="info[main]" value="普通"> 普通
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>

        <div class="form-check form-check-radio m-4">
        <label class="form-check-label" style="transform:scale(1.5);">
            <input class="form-check-input" type="radio" name="info[main]" value="不調"> 不調
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>
    </div>

    <div class="form-group mb-0 mt-3">
        <button type="submit" class="btn btn-primary btn-block">
            回答
        </button>
    </div>

</form>
