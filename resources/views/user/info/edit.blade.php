@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('user.info_base.edit.'.$info->id, ['user'=>$user,'info' => $info])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection