<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')

<div>
  
    <h2>基本情報</h2>

    <p class="h5 mt-4 mb-0">【氏名】</p>
    <input type="text" class="form-control" name="info[you1]" value="{{$base->info()->info['you1']}}">
    <p class="h5 mt-4 mb-0">【性別】</p>{{$base->info()->info['you2']}}
    <div>
        <input type="hidden" name="info[you2]" value="{{$base->info()->info['you2']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[you2]" value="男性">男性
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[you2]" value="女性">女性
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[fami2]" value="その他">その他
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <p class="h5 mt-4 mb-0">【生年月日】</p>
        <div>
            <div class="form-group row">
                <input type="number" placeholder="year" class="form-control" name="info[you3]" value="{{$base->info()->info['you3']}}">年
            </div>
            <div class="form-group row">
                <input type="number" placeholder="month" class="form-control" name="info[you4]" value="{{$base->info()->info['you4']}}">月
            </div>
            <div class="form-group row">
                <input type="number" placeholder="day" class="form-control" name="info[you5]" value="{{$base->info()->info['you5']}}">日


            </div>
        </div>
        <p class="h5 mt-4 mb-0">【住所】</p>
        <div class="form-group col-md-6">
            <label for="input">郵便番号</label>
            <input type="text" class="form-control" name="info[you6]" value="{{$base->info()->info['you6']}}">
        </div>
        <div class="form-group col-md-6">
            <label for="input">番地まで</label>
            <input type="text" class="form-control" name="info[you7]" value="{{$base->info()->info['you7']}}">
        </div>
        <div class="form-group col-md-6">
            <label for="input">建物名・部屋番号</label>
            <input type="text" class="form-control" name="info[you8]" value="{{$base->info()->info['you8']}}">
        </div>
        <p class="h5 mt-4 mb-0">【電話番号】</p>
        <div>

            <input type="tel" class="form-control" name="info[you9]" value="{{$base->info()->info['you9']}}">

        </div>
        <p class="h5 mt-4 mb-0">【位置情報サービス】</p>
        <div>
            <input type="hidden" name="info[you10]" value="{{$base->info()->info['you10']}}">
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
</div>
<div>
    <h2>住まい</h2>
    <p class="h5 mt-4 mb-0">【同居人の有無】</p>
    <div>
        <input type="hidden" name="info[home1]" value="{{$base->info()->info['home1']}}">       
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
        </div>
    </div>
    <p class="h5 mt-4 mb-0">【最寄りの避難場所】</p>
    <input type="text" class="form-control" name="info[home2]" value="{{$base->info()->info['home2']}}">
</div>
     
<div class="form-group row mb-0">
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</div>

</form>
