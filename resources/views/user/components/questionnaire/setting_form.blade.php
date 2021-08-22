@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">アンケート設定</h3>

                <form action="{{route('user.questionnaire.setting',$base->id)}}" method="post">
                    @csrf

                    <div>                    
                        <p>回答しない項目</p>
    
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="feeling" @if(in_array("feeling", $info->info["not_use_items"])) checked @endif>
                                調子を回答しない
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="syokuyoku" @if(in_array("syokuyoku", $info->info["not_use_items"])) checked @endif>
                                食欲を回答しない
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 mt-5">
                        <button type="submit" class="btn btn-primary btn-block">
                        設定
                        </button>
                    </div>
                </form>        

            </div>
        </div>
    </div>
</div>
@endsection