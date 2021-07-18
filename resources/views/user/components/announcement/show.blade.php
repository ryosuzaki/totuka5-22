@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('user.announcement.show',$announcement) }}
            <div class="card-body">

                <p class="card-text h5">送信元：<a href="{{route('group.show',$announcement->data['model']['id'])}}">{{$announcement->data['model']['name']}}</a></p>
                <div class="text-center mb-3">
                    <h4 class="card-title">{{$announcement->data['announcement']['title']}}</h4>
                    <p class="card-text" style="white-space:pre-line;">{{$announcement->data['announcement']['content']}}</p>
                </div>
                

            </div>
        </div>
    </div>
</div>
@endsection