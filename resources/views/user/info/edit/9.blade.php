<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <h2>医療</h2>
        <div><p class="h5 mt-4 mb-0">【平熱】℃</p>
            <input type="control" class="form-control" name="info[care1]" value="{{$base->info()->info['care1']}}" placeholder="℃">
        </div>
        <div><p class="h5 mt-4 mb-0">【身長】cm</p>
            <input type="control" class="form-control" name="info[care2]" value="{{$base->info()->info['care2']}}" placeholder="cm">
        </div>
        <div><p class="h5 mt-4 mb-0">【体重】kg</p>
             <input type="control" class="form-control" name="info[care3]" value="{{$base->info()->info['care3']}}" placeholder="kg">
         </div>
         <p class="h5 mt-4 mb-0">【使用中の薬】</p>
        <input type="text" class="form-control" name="info[care4]" value="{{$base->info()->info['care4']}}">
        <p class="h5 mt-4 mb-0">【アレルギー歴】</p>
        <input type="text" class="form-control" name="info[care5]" value="{{$base->info()->info['care5']}}">
        <p class="h5 mt-4 mb-0">【既往歴】</p>
        <input type="text" class="form-control" name="info[care6]" value="{{$base->info()->info['care6']}}">
        <p class="h5 mt-4 mb-0">【手術歴】</p>
        <input type="text" class="form-control" name="info[care7]" value="{{$base->info()->info['care7']}}">
        <p class="h5 mt-4 mb-0">【かかりつけ医】</p>
        <input type="text" class="form-control" name="info[care8]" value="{{$base->info()->info['care8']}}"><br>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">
        登録
    </button>
</form>
