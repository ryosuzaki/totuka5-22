@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$group}}
                    {{$members[0]}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection