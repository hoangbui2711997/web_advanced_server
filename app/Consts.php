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

	public static $DECORATIONS = [
		'products' => 'name',
		'product_variations' => 'color',
		'product_extra_variations' => 'amount',
		'vases' => 'name',
		'vase_variations' => 'size',
	];

	public static $MORPHS = [
		'products',
		'product_variations',
		'product_extra_variations',
		'vases',
		'vase_variations',
	];

	public static $MORPH_PRODUCTS = 'products';
	public static $MORPH_PRODUCT_VARIATIONS = 'product_variations';
	public static $MORPH_PRODUCT_EXTRA_VARIATIONS = 'product_extra_variations';
	public static $MORPH_VASES = 'vases';
	public static $MORPH_VASE_VARIATIONS = 'vase_variations';

	public static $ROLE_ADMIN = 1;
	public static $ROLE_MANAGER = 2;
	public static $ROLE_EMPLOYEE = 3;
	public static $ROLE_USER = 4;

	public static $INVOICE_STATUS_CREATED = 'created';
	public static $INVOICE_STATUS_ORDERING = 'ordering';
	public static $INVOICE_STATUS_ORDERED = 'ordered';
	public static $INVOICE_STATUS_NEED_PAY = 'need_pay';
	public static $INVOICE_STATUS_CANCELED = 'canceled';
	public static $INVOICE_STATUS_SUCCESS = 'success';

	public static $INVOICE_STATUSES = [
		'created',
		'ordering',
		'ordered',
		'need_pay',
		'canceled',
		'success',
	];

	public static $PER_PAGE = 10;
	public static $THREAT_HOLD = 3;
}
