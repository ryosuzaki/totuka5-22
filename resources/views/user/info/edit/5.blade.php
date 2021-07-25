<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')

    <label>今日の体調</label>
    <div>
        <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input class="form-check-input btn-check" type="radio" name="info[main]" value="良い"> 良い
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>

        <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="info[main]" value="普通" checked> 普通
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>

        <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="info[main]" value="悪い"> 悪い
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
        </div>
    </div>
    
    <div class="form-group mt-3">
        <label for="comment">コメント</label>
        <textarea class="form-control" id="comment" name="info[comment]" rows="5"></textarea>
    </div>


    <div class="form-group mb-0 mt-3">
        <button type="submit" class="btn btn-primary btn-block">
            回答
        </button>
    </div>

</form>
