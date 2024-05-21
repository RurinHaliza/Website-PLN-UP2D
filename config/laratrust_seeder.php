<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'operator' => [
            'bebanharian' => 'c,r,u,d',
            'bebanbulanan' => 'c,r,u,d',
            'bebanmingguan' => 'c,r,u,d',
            'tabeltrafo' => 'c,r,u,d',
            'tabelpenyulang' => 'c,r,u,d',
            'tabelup3' => 'c,r,u,d',
        ],
        'ValidatorOpsis' => [
            'bebanharian' => 'c,r,u,d',
            'bebanbulanan' => 'c,r,u,d',
            'bebanmingguan' => 'c,r,u,d',
            'tabeltrafo' => 'c,r,u,d',
            'tabelpenyulang' => 'c,r,u,d',
            'tabelup3' => 'c,r,u,d',
        ],
        'ValidatorFasop' => [
            'bebanharian' => 'c,r,u,d',
            'bebanbulanan' => 'c,r,u,d',
            'bebanmingguan' => 'c,r,u,d',
            'tabeltrafo' => 'c,r,u,d',
            'tabelpenyulang' => 'c,r,u,d',
            'tabelup3' => 'c,r,u,d',
        ],
        'EditorOpsis' => [
            'bebanharian' => 'c,r,u,d',
            'bebanbulanan' => 'c,r,u,d',
            'bebanmingguan' => 'c,r,u,d',
            'tabeltrafo' => 'c,r,u,d',
            'tabelpenyulang' => 'c,r,u,d',
            'tabelup3' => 'c,r,u,d',
        ],
        'Visitor' => [
            'bebanharian' => 'r',
            'bebanbulanan' => 'r',
            'bebanmingguan' => 'r',
            'tabeltrafo' => 'r',
            'tabelpenyulang' => 'r',
            'tabelup3' => 'r',
        ],
        'Administrator' => [
            'bebanharian' => 'c,r,u,d',
            'bebanbulanan' => 'c,r,u,d',
            'bebanmingguan' => 'c,r,u,d',
            'tabeltrafo' => 'c,r,u,d',
            'tabelpenyulang' => 'c,r,u,d',
            'tabelup3' => 'c,r,u,d',
        ],
        'Manager' => [
            'bebanharian' => 'c,r,u,d',
            'bebanbulanan' => 'c,r,u,d',
            'bebanmingguan' => 'c,r,u,d',
            'tabeltrafo' => 'c,r,u,d',
            'tabelpenyulang' => 'c,r,u,d',
            'tabelup3' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
