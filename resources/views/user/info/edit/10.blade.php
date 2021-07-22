<form method="POST" action="{{ route('info_base.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <h2>福祉</h2>

    <p class="h5 mt-4 mb-0">【障害有り無し】</p>
    <input type="text" class="form-control" name="info[help1]" value="{{$base->info()->info['help1']}}">

    <p class="h5 mt-4 mb-0">【要介護認定】</p>
    <div>
        <input type="hidden" name="info[help2]" value="{{$base->info()->info['help2']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>
    
    <p class="h5 mt-4 mb-0">【介護者の有無】</p>
    <div>
        <input type="hidden" name="info[help3]" value="{{$base->info()->info['help3']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help3]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help3]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <p class="h5 mt-4 mb-0">【介護者との続柄】</p>
    <input type="text" class="form-control" name="info[help4]" value="{{$base->info()->info['help4']}}">

    <p class="h5 mt-4 mb-0">【介護サービスの有無】</p>
    <div>
        <input type="hidden" name="info[help5]" value="{{$base->info()->info['help5']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help5]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help5]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <p class="h5 mt-4 mb-0">【サービス内容】</p>
    <input type="text" class="form-control" name="info[help6]" value="{{$base->info()->info['help6']}}">

    <p class="h5 mt-4 mb-0">【利用サービス施設名称】</p>
    <input type="text" class="form-control" name="info[help7]" value="{{$base->info()->info['help7']}}">

    <p class="h5 mt-4 mb-0">【在宅酸素療法】</p>
    <div>
        <input type="hidden" name="info[help]" value="{{$base->info()->info['help8']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help8]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help8]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <p class="h5 mt-4 mb-0">【介助者の有無】</p>
    <div>
        <input type="hidden" name="info[help9]" value="{{$base->info()->info['help9']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help9]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help9]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <h2>使用するアプリ内容</h2>
    <p class="h5 mt-4 mb-0">【平常時安否確認】</p>
    <div>
        <input type="hidden" name="info[use1]" value="{{$base->info()->info['use1']}}">
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
    </div>

    <p class="h5 mt-4 mb-0">【災害時安否確認】</p>
    <div>
        <input type="hidden" name="info[use2]" value="{{$base->info()->info['use2']}}">
        <div class="form-check form-check-radio">
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
    </div>

    <p class="h5 mt-4 mb-0">【健康管理】</p>
    <div>
        <input type="hidden" name="info[use3]" value="{{$base->info()->info['use3']}}">
        <div class="form-check form-check-radio">
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
</div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</form>    
