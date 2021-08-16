@extends('template')

@section('content')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#announcementModal">
  Launch demo modal
</button>


<div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="card-text h5">送信元：<a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></p>
                <p class="h3 font-weight-bold">{{$announcement->title}}</p>
                <p class="card-text h5" style="white-space:pre-line;">{{$announcement->content}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>

<script type="module">

</script>

@endsection