@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.info_base.create',[$group->id])}}"><i class="material-icons">add</i> 追加</a>
                <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>テンプレート</th>
                                <th>名前</th>
                                <th>公開</th>
                                <th>アクション</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($bases as $base)
                                <tr>
                                    <td><a href="{{route('info_template.show',$base->infoTemplate()->first()->id)}}">{{$base->infoTemplate()->first()->name}}</a></td>
                                    <td>{{$base->name}}</td> 
                                    <td>@if($base->available)　一般公開　@else　権限を持つユーザーのみ　@endif</td>                              
                                    <td class="row p-1">
                                    <a class="btn btn-primary btn-sm btn-round text-white" href="{{route('group.info_base.edit',[$group->id,$base->id])}}"><i class="material-icons">edit</i> 編集</a>
                                    <form action="{{route('group.info_base.destroy',[$group->id,$base->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger btn-round btn-sm text-white"><i class="material-icons">remove_circle_outline</i> 削除</button>
                                        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        本当に削除しますか？
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                                        <button type="submit" class="btn btn-danger text-white">削除する</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection