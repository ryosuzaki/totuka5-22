@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('user.info.edit',$base) }}
            <div class="card-body">
                <h3 class="text-center mb-4">{{$base->name}}の{{$base->getTemplate()->edit['name']}}</h3>


                <form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
                    @csrf
                    @method('PUT')
                    @include('user.info.edit.'.$base->getTemplate()->id, ['info' => $info])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection