<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
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
            </div>
            <div class="form-check form-check-radio">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="info[fami2]" value="女">女
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </div>
        <div>【年齢】
            <input type="control" class="form-control" name="info[fami3]" value="">
        </div>
        <div>【続柄】
            <input type="text" class="form-control" name="info[fami4]" value="">
        </div>
        <div>【住所】
            <div class="form-group">
                <label for="input">郵便番号</label>
                <input type="text" class="form-control" name="info[fami5]" value="">
            </div>
            <div class="form-group">
                <label for="input">番地まで</label>
                <input type="text" class="form-control" name="info[fami6]" value="">
            </div>
            <div class="form-group">
                <label for="input">建物名・部屋番号</label>
                <input type="text" class="form-control" name="info[fami7]" value="">
               </div>
        </div>【電話番号】
        <input type="tel" class="form-control" name="info[fami8]" value=""><br>
        【メールアドレス】
        <input type="email" class="form-control" name="info[fami9]" id="exampleFormControlInput1" placeholder="name@example.com"><br>
    </div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</div>

</form>