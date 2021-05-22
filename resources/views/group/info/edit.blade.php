@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('group.info_base.edit.'.$info->id, ['group'=>$group,'info' => $info])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection