@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{$group}} <br>
                    {{$bases[0]}} <br>
                    {{$infos[0]}} <br>
                    <a href="{{route('group.edit',$group->id)}}">group edit</a>
                    <a href="{{route('group.create')}}"> create</a>
                    <a href="{{route('group.show',$group->id)}}"> show</a><br>
                    <a href="{{route('group.group_member.index',$group->id)}}">member index</a>//要検討
                    <a href="{{route('group.group_member.create',$group->id)}}"> create</a><br>//要検討
                    <a href="{{route('group.group_role.index',$group->id)}}">role index</a>//要検討
                    <a href="{{route('group.group_role.create',$group->id)}}">create</a>
                    <a href="{{route('group_role.edit',1)}}">edit</a>
                    <a href="{{route('group_role.show',1)}}">show</a><br>

                    <a href="{{route('group.info_base.group_info.create',[$group->id,$bases[0]->id])}}">info create</a>

                    <a href="{{route('group_info.edit',$infos[0]->id)}}"> edit</a><br>
                    <a href="{{route('group_info_base.index')}}"> info_base index</a>
                    <a href="{{route('group_info_base.create')}}">create</a>
                    <a href="{{route('group_info_base.edit',$bases[0]->id)}}">edit</a>

                    <br>
                    <br>

                    <a href="{{route('user.show',Auth::id())}}">user show</a>
                    <a href="{{route('user.edit',Auth::id())}}"> edit</a> <br>

                    <a href="{{route('user_info.edit',Auth::id())}}">user_info edit</a><br>
                    <a href="{{route('user_info_base.index')}}"> user_info_base index</a> 
                    <a href="{{route('user_info_base.create')}}">create</a>
                    <a href="{{route('user_info_base.edit',1)}}">edit</a>
                    <a href="{{route('user_info_base.show',1)}}">show</a>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
