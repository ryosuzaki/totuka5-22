@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">ホーム</li>
                    </ol>
                </nav>
                <h3 class="text-center mb-4">ホーム</h3>
                <h2>使い方</h2>
                <h4><a href="{{route('home.group_type','shelter')}}">避難所</a></h4>
                <h4><a href="{{route('home.group_type','nursing_home')}}">介護事業者</a></h4>
                <h4><a href="{{route('home.group_type','danger_spot')}}">危険地点</a></h4>
            </div>
        </div>
    </div>
</div>
@endsection
