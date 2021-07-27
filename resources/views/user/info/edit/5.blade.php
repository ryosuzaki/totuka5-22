<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')

    <div class="form-check my-5">
        <label class="form-check-label">
            <input type="hidden" name="info[is_long]" value="1">
            <input class="form-check-input" type="checkbox" name="info[is_long]" value="0" @if(!$base->info()->info["is_long"]) checked @endif>
            短縮バージョンを使う
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
        </label>
    </div>

    <script type="module">
    $(document).ready(function() {
        $('input[name="info[is_long]"][type="checkbox"]').change(function() {
            if($(this).prop('checked')){
                $('#short_version').removeClass('d-none');
                $('#long_version').addClass('d-none');
            }else{
                $('#short_version').addClass('d-none');
                $('#long_version').removeClass('d-none');
            }
        });
    });
    </script>

    <div id="short_version">
        <label>今日の体調</label>
        <div>
            <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input btn-check" type="radio" name="info[feeling]" value="良い"> 良い
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
            </div>

            <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="info[feeling]" value="普通" checked> 普通
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
            </div>

            <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="info[feeling]" value="悪い"> 悪い
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
            </div>
        </div>

        <div class="form-group mt-4">
            <label for="comment">コメント</label>
            <textarea class="form-control" id="comment" name="info[comment]" rows="5"></textarea>
        </div>
    </div>


    <div id="long_version">
    
    </div>
    
    

    <div class="form-group mb-0 mt-3">
        <button type="submit" class="btn btn-primary btn-block">
            回答
        </button>
    </div>

</form>
