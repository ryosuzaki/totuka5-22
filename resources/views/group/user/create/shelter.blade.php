@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>避難所 {{$group->name}}</h4>
                    <form method="POST" action="{{ route('group.user.join_request',$group->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">ユーザーID</label>
                            <input id="user_id" type="number" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required autofocus>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">役割</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" id="role" name="role_id">
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->rank}}  {{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                            ユーザーに参加リクエストを送る
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection