@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
            @foreach ($groups as $group)
                {{$group}}
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
