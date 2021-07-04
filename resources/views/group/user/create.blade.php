@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5>{{$group->getFormattedTypeName()}} {{$group->name}}</h5>

                <div class="form-group">
                    <select class="form-control selectpicker h4" data-style="btn btn-link" id="role-link">
                        @foreach($group->roles()->get() as $r)
                        <option value="{{route('group.user.create',[$group->id,$r->index])}}"@if($role==$r) selected @endif>{{$r->role_name}}</option>
                        @endforeach
                    </select>
                </div>

                <script type="module">
                    document.getElementById("role-link").onchange = function() {
                        window.location.href = this.value;
                    };
                </script>

                <form method="POST" action="{{ route('group.user.store',[$group->id,$role->index]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">招待するメールアドレス</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
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