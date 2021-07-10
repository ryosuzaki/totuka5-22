@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                {{ Breadcrumbs::render('group.create',$type) }}
                <form method="POST" action="{{ route('group.store') }}">
                    @csrf
                    @include('group.create.'.$type->name,['type'=>$type])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
