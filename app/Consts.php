<?php


namespace App;


class Consts
{
	public static $UPLOAD_PATH = '/public/';
	public static $VERBS = ['POST', 'PUT', 'DELETE', 'GET'];
	public static $POST = 'POST';
	public static $PUT = 'PUT';
	public static $DELETE = 'DELETE';
	public static $GET = 'GET|HEAD';

	public static $VARIATION_TYPE_SMALL = 'small';
	public static $VARIATION_TYPE_DELUXE = 'medium';
	public static $VARIATION_TYPE_PREMIUM = 'premium';

	public static $COLLECTION_SIZES = ['standard', 'deluxe', 'premium'];
	public static $COLLECTION_VASE_SIZES = ['small', 'medium', 'large'];
	public static $COLLECTION_QUANTITY = [1, 2, 3];

	public static $COLLECTION_EXTRAS = ['mylar balloons', 'stuffed animal', 'chocolates'];
}
