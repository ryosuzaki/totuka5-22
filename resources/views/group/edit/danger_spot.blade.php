@foreach(['土砂崩れ','洪水','火災'] as $name)
<div class="form-check form-check-radio">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="name" value="土砂崩れ" @if($group->name==$name) checked @endif>
        {{$name}}
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
@endforeach