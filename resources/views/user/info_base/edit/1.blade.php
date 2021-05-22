<form method="POST" action="{{ route('user.info_base.info.update',[$user->id,$info->id]) }}">
    @csrf
    @method('PUT')
    ///ここにユーザ情報を登録するフォームを書く
    //例    
    <div class="form-group row">
        <label for="name">適当に入力</label>
        <input id="name" type="text" class="form-control" name="info[name]" value="" required　autofocus>
    </div> 
    //例ここまで      
    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary btn-block">
            登録
        </button>
    </div>
</form>