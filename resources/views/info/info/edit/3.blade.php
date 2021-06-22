<form method="POST" action="{{ route('info_base.info.update',$base->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="info">詳細情報</label>
        <textarea class="form-control" id="info" name="info[detail]" rows="5">{{$info->info['detail']}}</textarea>
    </div>

    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary btn-block">
            登録
        </button>
    </div>
</form>
