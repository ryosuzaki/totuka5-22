<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <h2>医療</h2>
        <div>【平熱】
            <input type="control" class="form-control" name="info[care1]" value="" placeholder="℃">℃
        </div>
        <div>【身長】
            <input type="control" class="form-control" name="info[care2]" value="" placeholder="cm">cm
        </div>
        <div>【体重】
             <input type="control" class="form-control" name="info[care3]" value="" placeholder="kg">kg
         </div>
        【使用中の薬】
        <input type="text" class="form-control" name="info[care4]" value="">
         【アレルギー歴】
        <input type="text" class="form-control" name="info[care5]" value="">
        【既往歴】
        <input type="text" class="form-control" name="info[care6]" value="">
        【手術歴】
        <input type="text" class="form-control" name="info[care7]" value="">
        【かかりつけ医】
        <input type="text" class="form-control" name="info[care8]" value=""><br>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</form>
