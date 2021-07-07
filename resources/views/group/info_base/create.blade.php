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
                        <li class="breadcrumb-item"><a href="#">情報</a></li>
                        <li class="breadcrumb-item active" aria-current="page">追加</li>
                    </ol>
                </nav>
                <h3 class="text-center mb-4">追加</h3>


                <form method="POST" action="{{ route('group.info_base.store',$group->id) }}">
                    @csrf

                    @include('info.info_template.create',['templates'=>$templates])

                    <div class="form-group mb-0 mt-4">
                        <button type="submit" class="btn btn-primary btn-block">
                        追加
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection