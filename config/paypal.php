<?php

return array(
    'client_id' => 'AWdeqF0UaZjxCMW0Og1t1aI1SfV0hV405-k_67AvlHM4tZw827-lO7kwZbLCur8BBrXT8SgpPpmDazpq',
    'secret' => 'ECbpu6f9L5Glyp4Gaa_vsi2-gidVRtucfAMoNao0mkbMH7T_5KW2L9Jt5_PEi75-m8OitGu2V8utEMB4',

    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
);