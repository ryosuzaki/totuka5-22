@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="{{route('group.permission.update',[$group->id,$role->index])}}">
            @csrf
            {{ method_field('PUT') }}
            @php
            $permissions=$role->permissions()->pluck('name');
            @endphp
            <div class="card">
                <div class="card-body">


                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$group->getFormattedTypeName()}}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$group->name}}</a></li>
                            <li class="breadcrumb-item"><a href="#">役割一覧</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$role->role_name}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">権限変更</li>
                        </ol>
                    </nav>
                    <h3 class="text-center mb-4">権限変更</h3>


                    <div class="mx-5">
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
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_bases.update">
                                    情報の編集
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
                        


                        
                        <div class="permissions">
                            @foreach($group->infoBases()->where('available',false)->get() as $base)
                            <div class="permissions">
                                <p class="h5 mt-4">{{$base->name}}</p>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info.{{$base->index}}.view">
                                        {{$base->name}}の閲覧
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label col-12">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info.{{$base->index}}.update">
                                        {{$base->name}}の編集
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>



                        
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




                        
                        <div class="permissions">
                            @foreach($group->roles()->get() as $role)
                            @if($role->index!=0)
                            <div class="permissions">
                                <p class="h5 mt-4">{{$role->role_name}}</p>
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
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="group_role.{{$role->index}}.inviteAndRemoveUser">
                                        ユーザーの招待/退会
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-5 mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                    変更
                    </button>
                </div>


                <script type="module">
                $(function() { 
                    @foreach($permissions as $permission)
                    $("input[value='{{$permission}}']").prop('checked', true).change();
                    @endforeach            
                });
                </script>
            </div>


        </form>
    </div>
</div>
@endsection