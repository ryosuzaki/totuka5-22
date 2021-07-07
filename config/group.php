<?php

return [
    //
    'unique_name'=>'group',
    //
    'creator'=>'作成者',
    //
    'role'=>[
        'group'=>['update','delete'],
        'group_info_bases'=>['viewAny','create','update','delete'],
        'group_info'=>['view','update'],
        'group_roles'=>['viewAny','create','update','delete'],
        'group_users'=>['permission','view','invite','remove'],
    ],

    //
    'rescue'=>[
        'rescue'=>'救助中',
        'unrescue'=>'救助者がいません',
        'rescued'=>'救助完了',
    ],

    //
    'like'=>'いいね',
    'watch'=>'ウォッチ',
];
