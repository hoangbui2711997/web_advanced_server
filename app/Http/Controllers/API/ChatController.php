<?php

namespace App\Http\Controllers\API;

use App\Consts;
use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\EmployeeConversation;
use App\Models\UserConversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    //
	public function getMessages(Request $request)
	{
		$limit = $request->input('limit', Consts::$PER_PAGE);
		$id = \Auth::id();
		$conversationId = Conversation::where('user_id', $id)->first()->id;

		$builder = UserConversation::with('user')->where('user_id', $id)
			->union(
				EmployeeConversation::with('user')->where('conversation_id', $conversationId)
					->selectRaw("message, employee_id, 'employee' as type, created_at")
			)
			->selectRaw("message, user_id, 'user' as type, created_at");
		$sqlQuery = $builder->toSql();
		return DB::table(DB::raw("($sqlQuery) as temp"))->mergeBindings($builder->getQuery())
			->orderBy('created_at', 'desc')
			->paginate($limit);
	}

	public function sendMessage(Request $request)
	{
		$message = $request->input('message');
		$id = $request->input('id');
		$user = new UserConversation([
			'user_id' => \Auth::id(),
			'message' => $message
		]);
		$user->save();
		Log::warning($user);
		MessageSent::dispatch($id, $user);

		return 'ok';
	}
}
