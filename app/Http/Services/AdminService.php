<?php


namespace App\Http\Services;


use App\Consts;
use App\Models\Navigator;
use Illuminate\Http\Request;

class AdminService
{

	public function addCategory(Request $request)
	{
		$params = $request->only(['parent_id', 'level', 'title', 'order', 'link']);
		if ($request->hasFile('file')) {
			$icon = $request->file('file');
			$path = public_path() . Consts::$UPLOAD_PATH;
			$icon->move($path, $icon->getClientOriginalName());
			data_set($params, 'icon', Consts::$UPLOAD_PATH.$icon->getClientOriginalName());
		}

		return Navigator::insert($params);
	}
}
