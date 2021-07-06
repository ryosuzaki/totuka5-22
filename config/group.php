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

];
