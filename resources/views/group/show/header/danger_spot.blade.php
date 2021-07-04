@php
$role_name=App\Http\Controllers\Group\LikeController::$name;
@endphp
<div class="row">
    <h5>危険地点　{{$group->name}}</h5>
    <div class="ml-auto">
        @if(Auth::user()->hasGroup($group->id))
        <a class="btn btn-primary btn-round btn-sm text-white">作成者</a>
        @elseif(Auth::user()->hasExtraGroup($group->id,$role_name))
        <a class="btn btn-primary btn-round btn-sm" href="{{route('group.unlike',$group->id)}}"><i class="material-icons">thumb_up_off_alt</i>{{$group->countExtraUsers($role_name)}}</a>
        <a class="btn btn-default btn-sm" href=""><i class="material-icons">campaign</i>通報</a>
        @else
        <a class="btn btn-outline-primary btn-round btn-sm" href="{{route('group.like',$group->id)}}"><i class="material-icons">thumb_up_off_alt</i>{{$group->countExtraUsers($role_name)}}</a>
        <a class="btn btn-default btn-sm" href=""><i class="material-icons">campaign</i>通報</a>
        @endif
    </div>
</div>

@php
$imgs=$group->getImgs();
@endphp
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i=0;$i<count($imgs);$i++)
        <li data-target="#carousel" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach($imgs as $img)
        <div class="carousel-item @if($imgs[0]==$img) active @endif">
            <img class="d-block w-100" src="{{$img->getUrl()}}">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<form action="{{route('group.uploadImg',$group->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group form-file-upload form-file-multiple col-6">
            <input type="file" name="img" multiple="" class="inputFileHidden">
            <div class="input-group">
                <input type="text" class="form-control inputFileVisible" placeholder="写真を選択">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-fab btn-round btn-primary">
                        <i class="material-icons">attach_file</i>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-6 pt-3">
            <button type="submit" class="btn btn-primary mb-2 w-100">投稿</button>
        </div>
    </div>
</form>

@if(Auth::user()->hasGroup($group->id))
<form action="{{route('group.deleteImg',$group->id)}}" method="post">
    @csrf
    @method('DELETE')
    <div class="form-row">
        <div class="form-group col-6">
            <select class="form-control selectpicker" data-style="btn btn-link" id="deleteImg" name="id">
                @for($i=0;$i<count($imgs);$i++)
                <option value="{{$imgs[$i]->id}}">左から{{$i+1}}枚目の写真</option>
                @endfor
            </select>
        </div>
        <div class="col-6">
            <button type="submit" class="btn btn-danger mb-2 w-100">削除</button>
        </div>
    </div>
</form>
@endif
