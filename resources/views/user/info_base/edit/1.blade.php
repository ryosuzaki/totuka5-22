<form method="POST" action="{{ route('user.info_base.info.update',[$user->id,$info->id]) }}">
    @csrf
    @method('PUT')
    ///ここにユーザ情報を登録するフォームを書く
    //例    
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
                <div class="form-group row">
                    <input type="number" placeholder="year" class="form-control" name="info[you3]" value="">年
                </div>
                <div class="form-group row">
                    <input type="number" placeholder="month" class="form-control" name="info[you4]" value="">月
                </div>
                <div class="form-group row">
                    <input type="number" placeholder="day" class="form-control" name="info[you5]" value="">日


                </div>
            </div>【住所】
            <div class="form-group col-md-6">
                <label for="input">郵便番号</label>
                <input type="text" class="form-control" name="info[you6]" value="">
            </div>
            <div class="form-group col-md-6">
                <label for="input">番地まで</label>
                <input type="text" class="form-control" name="info[you7]" value="">
            </div>
            <div class="form-group col-md-6">
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
        <h2>家族情報(代表者)</h2>
        【氏名】
        <input type="text" class="form-control" name="info[fami1]" value="">
        <div>【性別】
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[fami2]" value="男">男
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="info[fami2]" value="女">女
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </div>
        <div>【年齢】
            <input type="number" class="form-number" name="info[fami3]" value="">
        </div>
        <div>【続柄】
            <input type="text" class="form-control" name="info[fami4]" value="">
        </div>
        <div>【住所】
            <div class="form-group col-md-6">
                <label for="input">郵便番号</label>
                <input type="text" class="form-control" name="info[fami5]" value="">
            </div>
            <div class="form-group col-md-6">
                <label for="input">番地まで</label>
                <input type="text" class="form-control" name="info[fami6]" value="">
            </div>
            <div class="form-group col-md-6">
                <label for="input">建物名・部屋番号</label>
                <input type="text" class="form-control" name="info[fami7]" value="">
            </div>
        </div>【電話番号】

        <div class="form-group">
        <input type="tel" class="form-control" name="info[fami8]" value="">
        </div>
        【メールアドレス】
        <div class="form-group">
        <input type="email" class="form-control" name="info[fami9]" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>

    </div>
    <div>
        <h2>住まい</h2>
        <div>【同居人の有無】
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="info[sumai1]" value="有">有
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="info[sumai1]" value="無">無
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>【最寄りの避難場所】
        </div>
        <input type="text" class="form-control" name="info[sumai2]" value="">
    </div>
    <div>
        <h2>医療</h2>
        <div>【平熱】
            <input type="number" class="form-number" name="info[iryou1]" value="" placeholder="℃">℃
        </div>
        <div>【身長】
            <input type="number" class="form-number" name="info[iryou2]" value="" placeholder="cm">cm
        </div>
        <div>【体重】
            <input type="number" class="form-number" name="info[iryou3]" value="" placeholder="kg">kg
        </div>
        【使用中の薬】
        <input type="text" class="form-control" name="info[iryou4]" value="">
        【アレルギー歴】
        <input type="text" class="form-control" name="info[iryou5]" value="">
        【既往歴】
        <input type="text" class="form-control" name="info[iryou6]" value="">
        【手術歴】
        <input type="text" class="form-control" name="info[iryou7]" value="">
        【かかりつけ医】
        <input type="text" class="form-control" name="info[iryou8]" value="">
    </div>
    <div>
        <h2>福祉</h2>
        【障害の有無】
        <input type="text" class="form-control" name="info[hukusi1]" value="">
        <div>【要介護認定】
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="info[hukusi2]" value="有">有
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="info[hukusi2]" value="無">無
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </div>【介護者の有無】
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi3]" value="有">有
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi3]" value="無">無
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>【介護者との続柄】
        <input type="text" class="form-control" name="info[hukusi4]" value="">
        【介護サービスの有無】<div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi5]" value="有">有
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi5]" value="無">無
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        【サービス内容】<input type="text" class="form-control" name="info[hukusi6]" value="">
        【利用サービス施設名称】<input type="text" class="form-control" name="info[hukusi7]" value="">
        【在宅酸素療法】<div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi8]" value="有">有
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi8]" value="無">無
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        【介助者の有無】<div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi9]" value="有">有
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[hukusi9]" value="無">無
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>
    <div>
        <h2>使用するアプリ内容</h2>
        【平常時安否確認】<div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[use1]" value="利用する">利用する
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
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
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[use3]" value="利用しない">利用しない
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    //例ここまで      
    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary btn-block">
            登録
        </button>
    </div>
</form>
