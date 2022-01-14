<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Order;
use Pusher\Pusher;

class AlertController extends Controller
{
    public function notification()
    {
       
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        $pusher = new Pusher(
           '5d7a7bf83bad04f4b324',
           '3df70f2ba8311e8a6acf',
           '1330362',
            $options
        );

        $data['message'] = 'Hi you got a new notification';
        $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);
    }
}
