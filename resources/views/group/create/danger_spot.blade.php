@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('group.store') }}">
                        @csrf
                        <input type="hidden" name="type" value="{{$type}}">
                        

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                            危険地点投稿
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
