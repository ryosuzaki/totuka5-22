<?php

return [
    //
    'unique_name'=>'group',
    //
    'creator'=>'作成者',
    //
    'role'=>[
        'namespace'=>'App\Models\Components\Role',
        
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
        'user_info_template_id'=>6,
        'group_info_template_id'=>11,
    ],

    //
    'shelter'=>[
        'group_info_template_id'=>2,
    ],

    //
    'like'=>'いいね',
    'watch'=>'ウォッチ',

    //
    'announcement'=>[
        'table'=>[
            'announcement'=>'announcement',
            'announcement_user'=>'announcement_user',
        ]
    ],

    'danger_spot'=>[
        'name'=>['土砂崩れ','水没','倒壊','その他'],
    ],

    'info'=>[
        'template'=>[
            
        ],

    ]
];
