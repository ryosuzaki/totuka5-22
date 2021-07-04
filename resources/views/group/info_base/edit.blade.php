@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('group.info_base.update',[$group->id,$base->id])}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label for="name">情報名</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$base->name}}" required autofocus>
                    </div> 

                    <div class="form-check row">
                        <label class="form-check-label">
                            <input type="hidden" name="available" value="0">
                            <input class="form-check-input" type="checkbox" name="available" value="1" @if($base->available) checked @endif>
                            一般に公開する
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                        情報更新
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection