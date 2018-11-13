<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use DB;
use App\User;

class ConversationController extends Controller
{
    public function store()
    {
        $conversation = Conversation::create([
            'message' => request('message'),
            'group_id' => request('group_id'),
            'user_id' => auth()->user()->id,
        ]);
        
        broadcast(new NewMessage($conversation))->toOthers();
        

        return $conversation->load('user');
    }

    public function getMessage($id)
    {
        $conversation = DB::select(
            "select name, message, user_picture, user_picture_type from users 
            inner join conversations on user_id = users.id
            where group_id =".$id.";"
        );
    
        $conversations = collect($conversation);

        return $conversations;
    }
}
