@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb" role="navigation" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->getFormattedTypeName()}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$base->name}}の変更</li>
                    </ol>
                </nav>

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