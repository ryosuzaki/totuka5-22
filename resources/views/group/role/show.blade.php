@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$group}}
                    {{$role}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
