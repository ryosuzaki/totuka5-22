@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$group}}
                    {{$roles[0]}}
                    @php
                    $t=[];
                    foreach($roles as $role){
                        $t[]=$role->rank;
                    }
                    $ranks=array_diff(range(0,255),$t);
                    @endphp
                    
                    <form method="POST" action="{{ route('group.role.store',$group->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="rank">権限ランク</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" id="rank" name="rank">
                                @foreach($ranks as $rank)
                                <option value="{{$rank}}">{{$rank}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="name">役割名</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="password">パスワード</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm">パスワードを再入力</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                役割登録
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
