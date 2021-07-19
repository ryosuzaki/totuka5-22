@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('user.announcement.index') }}
            <div class="card-body">
                <h3 class="text-center mb-4">お知らせ</h3>
                <a class="btn btn-success btn-sm btn-round text-white" href="{{route('user.announcement.markAsReadAll')}}"><i class="material-icons">mark_email_read</i> 全て既読にする</a>
                


                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 10%"></th>
                                <th style="width: 30%">送信元</th>
                                <th style="width: 50%">タイトル</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $announcement)
                            <tr>
                                <td>
                                    @if($announcement->read_at==null)<i class="material-icons text-warning">mark_email_unread</i>
                                    @else<i class="material-icons text-success">mark_email_read</i>
                                    @endif
                                </td>
                                <td><a href="{{route('group.show',$announcement->data['model']['id'])}}">{{$announcement->data['model']['name']}}</a></td>
                                <td><a href="{{route('user.announcement.show',$announcement->id)}}">{{$announcement->data['announcement']['title']}}</a></td>
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