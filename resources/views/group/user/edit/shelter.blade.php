@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                
                <h5>{{$group->name}}</h5>
                {{$user}}
            </div>
        </div>
    </div>
</div>
@endsection