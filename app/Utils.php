<?php


namespace App;


use Illuminate\Support\Str;

class Utils
{
	public static $image = [];

	public static function getVerb($url)
	{
		$verbs = [];
		if (!Str::contains($url, Consts::$VERBS)) {
			return '';
		}

		if (Str::contains($url, Consts::$POST)) {
			$verbs[] = Consts::$POST;
		}
		if (Str::contains($url, Consts::$GET)) {
			$verbs[] = Consts::$GET;
		}
		if (Str::contains($url, Consts::$PUT)) {
			$verbs[] = Consts::$PUT;
		}
		if (Str::contains($url, Consts::$DELETE)) {
			$verbs[] = Consts::$DELETE;
		}

		return $verbs;
	}

	public static function loadImageFromStore()
	{
		if (empty(self::$image)) {
			self::$image = explode("\n", file_get_contents(storage_path('/file_name')));
		}
	}

	/**
	 * Escape special characters for a LIKE query.
	 *
	 * @param string $value
	 * @param string $char
	 *
	 * @return string
	 */
	public static function escapeLike(string $value, string $char = '\\'): string
	{
		return str_replace(
			[$char, '%', '_'],
			[$char.$char, $char.'%', $char.'_'],
			$value
		);
	}
}
