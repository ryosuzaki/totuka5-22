@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                {{ Breadcrumbs::render('group.create',$type) }}
                @include('group.create.'.$type->name,['type'=>$type])
            </div>
        </div>
    </div>
</div>
@endsection
