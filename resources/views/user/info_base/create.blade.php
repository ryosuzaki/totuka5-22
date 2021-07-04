@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('user.info_base.store') }}">
                    @csrf

                    @include('info.info_template.create',['templates'=>$templates])

                    <div class="form-group row mb-0">
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