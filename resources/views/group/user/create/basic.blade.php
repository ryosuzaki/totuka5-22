@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$group}}
                    {{$roles[0]}}
                    <form method="POST" action="{{ route('group.group_member.store',$group->id) }}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection