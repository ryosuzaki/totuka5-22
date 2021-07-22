<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <div>
    <h2>家族情報(代表者)</h2>
        <p class="h5 mt-4 mb-0">【氏名】</p>
        <input type="text" class="form-control" name="info[fami1]" value="{{$base->info()->info["fami1"]}}">
        <p class="h5 mt-4 mb-0">【性別】</p>
        <div>
            <input type="hidden" name="info[fami2]" value="">
           <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="info[fami2]" value="男性">男性
                    <span class="circle">
                        <span class="check"></span>
            　      </span>
                </label>
            </div>
            <div class="form-check form-check-radio form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="info[fami2]" value="女性">女性
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
        </div>
        <p class="h5 mt-4 mb-0">【年齢】</p>
        <div>
            <input type="number" class="form-control" name="info[fami3]" value="{{$base->info()->info["fami3"]}}">
        </div>
        <p class="h5 mt-4 mb-0">【続柄】</p>
        <div>
            <input type="text" class="form-control" name="info[fami4]" value="{{$base->info()->info["fami4"]}}">
        </div>
        <p class="h5 mt-4 mb-0">【住所】</p>
        <div>
            <div class="form-group">
                <label for="input">郵便番号</label>
                <input type="text" class="form-control" name="info[fami5]" value="{{$base->info()->info["fami5"]}}">
            </div>
            <div class="form-group">
                <label for="input">番地まで</label>
                <input type="text" class="form-control" name="info[fami6]" value="{{$base->info()->info["fami6"]}}">
            </div>
            <div class="form-group">
                <label for="input">建物名・部屋番号</label>
                <input type="text" class="form-control" name="info[fami7]" value="{{$base->info()->info["fami7"]}}">
               </div>
        </div>
        <p class="h5 mt-4 mb-0">【電話番号】</p>
        <input type="tel" class="form-control" name="info[fami8]" value="{{$base->info()->info["fami8"]}}"><br>
        <p class="h5 mt-4 mb-0">【メールアドレス】</p>
        <input type="email" class="form-control" name="info[fami9]" id="exampleFormControlInput1" placeholder="name@example.com" value="{{$base->info()->info["fami9"]}}"><br>
    </div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</div>

</form>