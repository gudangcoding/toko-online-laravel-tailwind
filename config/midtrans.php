<?php

return [
    'server_key'    => env('MIDTRANS_SERVER_KEY', ''),
    'client_key'    => env('MIDTRANS_CLIENT_KEY', ''),
    'snap_url'      => env('MIDTRANS_SNAP_URL', 'https://app.midtrans.com/snap/snap.js'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', true),
];
