<?php

return [

    'roles' => [
        'direction'         => 'Direction',
        'direction_ARH'      => 'Direction_ARH',
        'direction_C'       => 'Direction_C',
        'direction_FC'      => 'Direction_FC',
        'direction_MAC'       => 'Direction_MAC',
        'direction_all'     => 'Direction|Direction_ARH|Direction_C|Direction_FC|Direction_MAC|ITMMS', 
        'direction_all_cs'  => ['Direction', 'Direction_ARH', 'Direction_C', 'Direction_FC', 'Direction_MAC', 'ITMMS'],// comma-separeted
        'smarchand'         => 'SuperMarchand',
        'marchand'          => 'Marchand',
        'client'            => 'Client',
        'assure'            => 'Assuré',
        'beneficiaire'      => 'Bénéficiaire',
        'nsia'              => 'Nsia',
        'nsia1'             => 'Nsia1',
        'nsia2'             => 'Nsia2',
        'nsia_all'          => 'Nsia|Nsia1|Nsia2|ITNSIA',
        'nsia_all_cs'       => ['Nsia', 'Nsia1', 'Nsia2', 'ITNSIA'],
        'working_users_all' => 'Direction|Direction_ARH|Direction_C|Direction_FC|Direction_MAC|ITMMS|SuperMarchand|Marchand|Nsia|Nsia1|Nsia2|ITNSIA',
        'working_users_cs'  => ['Direction', 'Direction_ARH', 'Direction_C', 'Direction_FC', 'Direction_MAC', 'ITMMS', 'SuperMarchand', 'Marchand', 'Nsia', 'Nsia1', 'Nsia2', 'ITNSIA'],
        'simple_users_cs'   => ['Client', 'Assuré', 'Bénéficiaire'],
        'all'               => 'Direction|Direction_ARH|Direction_C|Direction_FC|Direction_MAC|ITMMS|SuperMarchand|Marchand|Client|Assuré|Bénéficiaire|Nsia|Nsia1|Nsia2|ITMMS|ITNSIA',
        'it_all_cs'         => ['ITMMS', 'ITNSIA'],
        'it_all'            => 'ITMMS|ITNSIA',
        'ITMMS'             => 'ITMMS',
        'ITNSIA'            => 'ITNSIA',
    ],

    //'Direction', 'Direction_ARH', 'Direction_C', 'Direction_FC', 'Direction_MAC', 'ITMMS', 
    //'SuperMarchand', 'Marchand', 'Client', 'Assuré', 'Bénéficiaire',
    //'Nsia', 'Nsia1', 'Nsia2', 'ITNSIA', 


    'points' => [
        'coefficient' => 10,
    ],


];