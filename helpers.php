<?php

if (!function_exists('get_function_position')) {
	function get_function_position ($callback) {
		try {
			$func = new ReflectionFunction($callback);
			$filename = $func->getFileName();
			$start_line = $func->getStartLine() - 1;
			\Illuminate\Support\Facades\Log::warning("file name: $filename , start line: $start_line !!!");
		} catch (ReflectionException $e) {
		}
	}
}
