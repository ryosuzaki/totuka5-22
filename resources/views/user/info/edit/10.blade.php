<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <h2>福祉</h2>

    【障害の有無】
    <input type="text" class="form-control" name="info[help1]" value="">

    <div>
        【要介護認定】
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="有">有
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="無">無
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>
    
    【介護者の有無】
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help3]" value="有">有
            <span class="circle">
                <span class="check"></span>
        　  </span>
        </label>
    </div>
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help3]" value="無">無
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>

    【介護者との続柄】
    <input type="text" class="form-control" name="info[help4]" value="">

    【介護サービスの有無】
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help5]" value="有">有
            <span class="circle">
                <span class="check"></span>
        　  </span>
        </label>
    </div>
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help5]" value="無">無
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>

    【サービス内容】
    <input type="text" class="form-control" name="info[help6]" value="">

    【利用サービス施設名称】
    <input type="text" class="form-control" name="info[help7]" value="">

    【在宅酸素療法】
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help8]" value="有">有
            <span class="circle">
                <span class="check"></span>
        　  </span>
        </label>
    </div>
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help8]" value="無">無
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>

    【介助者の有無】
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help9]" value="有">有
            <span class="circle">
                <span class="check"></span>
        　  </span>
        </label>
    </div>
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[help9]" value="無">無
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>

    <h2>使用するアプリ内容</h2>
    【平常時安否確認】
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[use1]" value="利用する">利用する
            <span class="circle">
                <span class="check"></span>
        　  </span>
        </label>
    </div>
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[use1]" value="利用しない">利用しない
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>

    【災害時安否確認】<div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[use2]" value="通常版">通常版
            <span class="circle">
                <span class="check"></span>
        　  </span>
        </label>
    </div>
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[use2]" value="短縮版">短縮版
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>

    【健康管理】<div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[use3]" value="利用する">利用する
            <span class="circle">
                <span class="check"></span>
        　  </span>
        </label>
    </div>
    <div class="form-check form-check-radio">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="info[use3]" value="利用しない">利用しない
            <span class="circle">
                <span class="check"></span>
            </span>
        </label>
    </div>
</div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</form>    
