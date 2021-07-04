@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('user.group.update',[$group->id])}}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <select class="form-control selectpicker h4" data-style="btn btn-link" name="role_id">
                            @foreach($group->roles()->get() as $role)
                            <option value="{{$role->id}}">{{$role->role_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="form-group">
                        <label for="password">パスワード</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group mb-0">
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