@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('group.info.edit',$group,$base->index) }}
            <div class="card-body">
                <h3 class="text-center mb-4">{{$base->name}}の変更</h3>

                <form method="POST" action="{{ route('group.info.update',[$group->id,$index]) }}">
                    @csrf
                    @method('PUT')
                    @include('info.info.edit.'.$base->getTemplate()->id, ['info' => $info])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection