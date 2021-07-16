@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">お知らせ</h3>
                

                <h4 class="card-title">{{$announcement->data['announcement']['title']}}</h4>
                <p class="card-text">{{$announcement->data['announcement']['content']}}</p>
    
                
                

            </div>
        </div>
    </div>
</div>
@endsection