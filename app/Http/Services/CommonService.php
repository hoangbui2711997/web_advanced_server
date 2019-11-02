<?php


namespace App\Http\Services;


use App\Models\Navigator;

class CommonService
{

	public function getNavigators()
	{
		return Navigator::whereNull('parent_id')->orderBy('order')->paginate(3);
	}

	public function getCategories()
	{
		return Navigator::where('level', '<=', 2)->distinct('title')->get();
	}
}
