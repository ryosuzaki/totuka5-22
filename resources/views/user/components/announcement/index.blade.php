@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">お知らせ</h3>
                <a class="btn btn-success btn-sm btn-round text-white" href="{{route('announcement.markAsReadAll')}}"><i class="material-icons">mark_email_read</i> 全て既読にする</a>
                



                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>送信元</th>
                                <th>タイトル</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $announcement)
                            <tr>
                                <td class="text-danger">@if($announcement->read_at==null)<i class="material-icons">priority_high</i>@endif</td>
                                <td><a href="{{route('group.show',$announcement->data['model']['id'])}}">{{$announcement->data['model']['name']}}</a></td>
                                <td><a href="{{route('announcement.show',$announcement->id)}}">{{$announcement->data['announcement']['title']}}</a></td>
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