<?php

namespace App\Http\Controllers\API;

use App\Http\Services\CommonService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
	private $commonService;
    public function __construct(CommonService $commonService)
	{
		$this->commonService = $commonService;
	}

	public function getNavigators()
	{
		return $this->commonService->getNavigators();
	}

	public function getCategories()
	{
		return $this->commonService->getCategories();
	}
}
