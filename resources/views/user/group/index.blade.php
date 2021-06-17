@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @php
                    $types=$user->groupTypes();
                    @endphp
                    @if($types)
                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                        @foreach($types as $type)
                        <li class="nav-item mx-auto">
                            <a class="nav-link @if($types[0]==$type)active @endif" href="#{{$type->name}}" data-toggle="tab">{{$type->formatted_name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="tab-content tab-space">
                        @foreach($types as $type)
                        <div class="tab-pane @if($types[0]==$type)active @endif" id="{{$type->name}}">
                        @include('user.group.index.'.$type->name, ['user'=>$user,'groups' => $user->groupsHaveType($type->name)])
                        </div>
                        @endforeach
                    </div>
                    @else
                    <h4>参加しているグループはありません</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection