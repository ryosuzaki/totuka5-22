<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>避難所名</th>
            <th>役割</th>
            <th>アクション</th>
        </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                <td>{{$user->groupRole($group)->name}}</td>                                    
                <td class="p-1"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>