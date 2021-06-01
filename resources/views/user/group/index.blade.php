@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    
                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                        @foreach($user->groupTypes() as $type)
                        <li class="nav-item mx-auto">
                            <a class="nav-link @if($user->groupTypes()[0]==$type)active @endif" href="#{{$type}}" data-toggle="tab">{{App\Models\Group\Group::groupType($type)}}</a>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="tab-content tab-space">
                        @foreach($user->groupTypes() as $type)
                        <div class="tab-pane @if($user->groupTypes()[0]==$type)active @endif" id="{{$type}}">
                        @include('user.group.index.'.$type, ['user'=>$user,'groups' => $user->groupsHaveType($type)])
                        </div>
                        @endforeach
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>
@endsection