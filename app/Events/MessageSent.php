<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	protected $id;
	public $created_at;
	public $user_id;
	public $message;

	/**
	 * Create a new event instance.
	 *
	 * @param $id
	 * @param $conversation
	 */
	public function __construct($id, $conversation)
	{
		$this->id = $id;
		$this->created_at = $conversation->created_at;
		$this->user_id = $conversation->user_id;
		$this->message = $conversation->message;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn()
	{
		return new PrivateChannel("App.Chat.Conservation.{$this->id}");
	}
}
