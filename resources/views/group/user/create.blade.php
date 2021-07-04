@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->getFormattedTypeName()}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$group->name}}</a></li>
                        <li class="breadcrumb-item"><a href="#">役割一覧</a></li>
                        <li class="breadcrumb-item"><a href="#">ユーザー一覧</a></li>
                        <li class="breadcrumb-item active" aria-current="page">招待</li>
                    </ol>
                </nav>
                <h3 class="text-center mb-4">ユーザーを招待</h3>


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
                        招待する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection