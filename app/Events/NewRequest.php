<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use DB;
use Auth;

class NewRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;
    public $reciever;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sender_id, $id)
    {
        $this->request = DB::select(DB::raw("SELECT * FROM users WHERE id IN 
            (SELECT user1_id FROM friends
             WHERE accepted = 0 AND user2_id = " . $sender_id . ")"
         ));

         $this->reciever = $id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Requests.'. $this->reciever);
    }

    public function broadcastWith()
    {
        return [
            'id' => Auth::user()->id,
            'name' => Auth::user()->name
        ];
    }
}
