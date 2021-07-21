<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')

<div>
  
    <h2>基本情報</h2>

    【氏名】
    <input type="text" class="form-control" name="info[you1]" value="">
    <div>【性別】
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[you2]" value="男">男
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[you2]" value="女">女
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <h4>【生年月日】</h4>
        <div>
            <div class="form-group">
                <input type="number" placeholder="year" class="form-control" name="info[you3]" value="">年
            </div>
            <div class="form-group">
                <input type="number" placeholder="month" class="form-control" name="info[you4]" value="">月
            </div>
            <div class="form-group">
                <input type="number" placeholder="day" class="form-control" name="info[you5]" value="">日


            </div>
        </div>【住所】
        <div class="form-group">
            <label for="input">郵便番号</label>
            <input type="text" class="form-control" name="info[you6]" value="">
        </div>
        <div class="form-group">
            <label for="input">番地まで</label>
            <input type="text" class="form-control" name="info[you7]" value="">
        </div>
        <div class="form-group">
            <label for="input">建物名・部屋番号</label>
            <input type="text" class="form-control" name="info[you8]" value="">
        </div>
    【電話番号】
        <div>

            <input type="tel" class="form-control" name="info[you9]" value="">

        </div>
        【位置情報サービス】
        <div class="form-check form-check-radio">
            <label class="form-check-label">    
                <input type="radio" class="form-check-input" name="info[you10]" value="ON">ON
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[you10]" value="OFF">OFF
                    <span class="circle">
                        <span class="check"></span>
                    </span>
            </label>
        </div>
    </div>
</div>
<div>
    <h2>住まい</h2>
    <div>【同居人の有無】
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[home1]" value="有">有
                <span class="circle">
                    <span class="check"></span>
            </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[home1]" value="無">無
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>【最寄りの避難場所】
    </div>
    <input type="text" class="form-control" name="info[home2]" value="">
</div>
     
<div class="form-group mb-0 mt-3">
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</div>

</form>
