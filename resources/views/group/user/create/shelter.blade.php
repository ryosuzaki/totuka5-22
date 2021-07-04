@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4>避難所 {{$group->name}}</h4>
                <form method="POST" action="{{ route('group.user.store',$group->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">招待するメールアドレス</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">役割</label>
                        <select class="form-control selectpicker" data-style="btn btn-link" id="role" name="role_id">
                            @foreach($roles as $role)
                            @if($role->role_name!=config('group.creator'))
                            <option value="{{$role->id}}">{{$role->role_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                        参加リクエストを送る
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection