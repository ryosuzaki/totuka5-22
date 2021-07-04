@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('user.setting') }}">
                    @csrf
                    @foreach($types as $type)
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="types[]" value="{{$type->id}}">
                            {{$type->formatted_name}}
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    @endforeach

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                        登録
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection