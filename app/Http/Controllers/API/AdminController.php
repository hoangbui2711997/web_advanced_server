<?php

namespace App\Http\Controllers\API;

use App\Http\Services\AdminService;
use App\Models\Navigator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
	private $adminService;
    public function __construct(AdminService $adminService)
	{
		$this->adminService = $adminService;
	}

	public function addCategory(Request $request)
	{
		try {
			Log::warning($request->all());
			return response()->json($this->adminService->addCategory($request));
		} catch (\Exception $exception) {
			Log::info($exception);
			throw $exception;
		}
	}
}
