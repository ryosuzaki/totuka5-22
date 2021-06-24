@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4>避難所 {{$group->name}}</h4>
                <form method="POST" action="{{ route('group.user.update',[$group->id,$user->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="role">役割</label>
                        <select class="form-control selectpicker" data-style="btn btn-link" id="role" name="role_id">
                            @foreach($roles as $role)
                            @if($role->role_name!=$group->creator)
                            <option value="{{$role->id}}">{{$role->role_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                        ユーザーに変更リクエストを送る
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection