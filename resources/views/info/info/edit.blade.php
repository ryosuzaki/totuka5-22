@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @include('info.info.edit.'.$base->getTemplate()->id, ['info' => $info])
            </div>
        </div>
    </div>
</div>
@endsection