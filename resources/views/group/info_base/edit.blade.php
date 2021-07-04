@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">


                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->getFormattedTypeName()}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->name}}</a></li>
                        <li class="breadcrumb-item"><a href="#">情報一覧</a></li>
                        <li class="breadcrumb-item active" aria-current="page">変更</li>
                    </ol>
                </nav>
                <h3 class="text-center mb-4">情報変更</h3>


                <form method="POST" action="{{route('group.info_base.update',[$group->id,$base->id])}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">情報名</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$base->name}}" required autofocus>
                    </div> 

                    <div class="form-check">
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
                        変更
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection