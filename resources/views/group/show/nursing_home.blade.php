@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="text-center">{{$group->name}}</h3>
                </div>
            </div>
            <div class="card mt-0">
                <div class="card-body">
                    <ul class="nav nav-pills nav-pills-primary">
                        @foreach ($bases as $base)
                        <li class="nav-item mx-auto">
                            <a class="nav-link @if($base->index==$index) active @endif" @if($base->index!=$index) href="{{route('group.show',[$group->id,$base->index])}}"@endif>{{$base->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content tab-space  pb-0">
                        <div class="tab-pane active">
                            @php
                            $base=$group->getInfoBaseByIndex($index);
                            @endphp
                            @include('info.info.show.'.$base->getTemplate()->id, ['base'=>$base,'info'=>$base->info()])
                            <div class="row">
                                <a class="btn btn-outline-primary btn-block mx-auto" href="{{route('info_base.info.edit',[$base->id])}}">変更</a>
                            </div> 
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

