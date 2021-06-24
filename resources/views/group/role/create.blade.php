@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="{{ route('group.role.store',$group->id) }}">
        @csrf
            <div class="card">
                <div class="card-body">
                    
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm">パスワードを再入力</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>   
                    
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">権限の設定</h4>
                    
                    
                    
                    <div>
                        <input class="all-selected" type="checkbox" name="permissions[]" value="group.*">
                        <div class="permissions">
                            <p class="h5">{{$group->getType()->formatted_name}}</p>
                            <div class="form-check">
                                <label class="form-check-label col-12">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group.update">
                                    {{$group->getType()->formatted_name}}の編集
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label col-12">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group.delete">
                                    {{$group->getType()->formatted_name}}の削除
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        

                        <input class="all-selected" type="checkbox" name="permissions[]" value="group_info_bases.*">
                        <div class="permissions">
                            <p class="h5 mt-5">情報</p>
                            <div class="form-check">
                                <label class="form-check-label col-12">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_bases.create">
                                    情報の追加
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label col-12">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_bases.delete">
                                    情報の削除
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        


                        <input class="all-selected" type="checkbox" name="permissions[]" value="group_info_base.*">
                        <div class="permissions">
                            @foreach($group->infoBases()->get() as $base)
                            <input class="all-selected" type="checkbox" name="permissions[]" value="group_info_base.{{$base->index}}.*">
                            <div class="permissions">
                                <p class="h5 mt-4">{{$base->name}}</p>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_base.{{$base->index}}.view">
                                        {{$base->name}}の閲覧
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_base.{{$base->index}}.update">
                                        {{$base->name}}の編集
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>



                        <input class="all-selected" type="checkbox" name="permissions[]" value="group_roles.*">
                        <div class="permissions">
                            <p class="h5 mt-5">役割</p>
                            <div class="form-check">
                                <label class="form-check-label col-12">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group_roles.viewAny">
                                    役割の閲覧
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label col-12">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group_roles.create">
                                    役割の追加
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label col-12">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group_roles.delete">
                                    役割の削除
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>




                        <input class="all-selected" type="checkbox" name="permissions[]" value="group_role.*">
                        <div class="permissions">
                            @foreach($group->roles()->get() as $role)
                            @if($role->role_name!=$group->creator)
                            <input class="all-selected" type="checkbox" name="permissions[]" value="group_role.{{$role->index}}.*">
                            <div class="permissions">
                                <p class="h5 mt-4">{{$role->role_name}}</p>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_role.{{$role->index}}.update">
                                        {{$role->role_name}}の編集
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_role.{{$role->index}}.viewUsers">
                                        {{$role->role_name}}を持つユーザーの閲覧
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_role.{{$role->index}}.inviteUser">
                                        {{$role->role_name}}に招待する
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_role.{{$role->index}}.removeUser">
                                        {{$role->role_name}}から退会させる
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row mt-5 mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                役割更新
                            </button>
                        </div>
                    </div>
                    
                    
                    <script type="module">
                    $(function() {
                        $("input[name='permissions[]'].all-selected").addClass("d-none");
                        $("input[name='permissions[]']").on('change', function() {
                        if ($(this).closest('div.permissions').find("input[name='permissions[]']").length == $(this).closest('div.permissions').find("input[name='permissions[]']:checked").length) {
                            $(this).closest('div.permissions').prev("input[name='permissions[]'].all-selected").prop('checked', true).change();
                        } else {
                            $(this).closest('div.permissions').prev("input[name='permissions[]'].all-selected").prop('checked', false).change();
                        }
                        });
                    });
                    </script>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
