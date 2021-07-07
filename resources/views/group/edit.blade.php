@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <nav aria-label="breadcrumb" role="navigation" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->getFormattedTypeName()}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">変更</li>
                    </ol>
                </nav>
                <h3 class="text-center mb-4">変更</h3>
                
                <form method="POST" action="{{route('group.update',$group->id)}}">
                    @csrf
                    {{ method_field('PUT') }}

                    @if(Illuminate\Support\Facades\View::exists('group.edit.'.$group->getTypeName()))
                    @include('group.edit.'.$group->getTypeName(),['group'=>$group])
                    @else
                    <div class="form-group">
                        <label for="name">グループ名</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$group->name}}" required autofocus>
                    </div>
                    @endif               
                    <div class="form-group mb-0 mt-4">
                        <button type="submit" class="btn btn-primary btn-block">
                        変更
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection