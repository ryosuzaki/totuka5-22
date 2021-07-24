<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <h2>福祉</h2>

    <p class="h5 mt-4 mb-0">【持っている障害】</p>
    <input type="text" class="form-control" name="info[help1]" value="{{$base->info()->info['help1']}}">

    <p class="h5 mt-4 mb-0">【要介護認定】</p>
    <div>
        <input type="hidden" name="info[help2]" value="{{$base->info()->info['help2']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="要支援１">要支援１
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="要支援２">要支援２
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="要介護１">要介護１
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="要介護２">要介護２
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="要介護３">要介護３
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="要介護４以上">要介護４以上
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[help2]" value="">介護や障害等の申請はしていないが、日常生活には
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
        <input type="hidden" name="info[help8]" value="{{$base->info()->info['help8']}}">
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

</div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</form>    
