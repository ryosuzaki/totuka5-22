@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    @php
                    $imgs=$group->uploaded_files['img'];
                    @endphp
                    <div class="row"><h5>危険地点</h5></div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @for($i=0;$i<count($imgs);$i++)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                            @foreach($imgs as $img)
                            <div class="carousel-item @if($imgs[0]==$img) active @endif">
                                <img class="d-block w-100" src="{{ Storage::url($img)}}">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    
                    <form action="{{route('group.uploadImg',$group->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group form-file-upload form-file-multiple col-8">
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
                            <div class="col-4 pt-3">
                                <button type="submit" class="btn btn-primary mb-2 w-100">投稿</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
            <div class="card mt-0">
                <div class="card-body">
                    <ul class="nav nav-pills nav-pills-primary">
                        @foreach ($infos as $info)
                        <li class="nav-item mx-auto">
                            <a class="nav-link @if($infos[0]==$info) active @endif" href="#pill{{$info->id}}" data-toggle="tab">{{$info->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content tab-space  pb-0">
                        @foreach ($infos as $info)
                        <div class="tab-pane @if($infos[0]==$info) active @endif" id="pill{{$info->id}}">
                            @include('group.info_base.show.'.$info->id, ['info'=>$info])
                            <div class="row">
                                <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('group.info_base.info.edit',[$group->id,$info->id])}}">変更</a>
                            </div> 
                        </div>  
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

