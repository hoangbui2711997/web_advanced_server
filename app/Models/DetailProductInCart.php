<?php

namespace App\Models;

use App\Consts;
use App\Custom\CustomModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DetailProductInCart extends CustomModel
{
	//
	protected $appends = ['information', 'extraName', 'extraUnit', 'productName'];
	protected $fillable = [
		'product_in_cart_id',
		'detail_morph_id',
		'detail_morph_type'
	];

	public function productInCart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(ProductInCart::class, 'product_in_cart_id');
	}

	public function getInformationAttribute()
	{
		return DB::table($this->detail_morph_type)->find($this->detail_morph_id);
	}

	public function getExtraNameAttribute()
	{
		if ($this->detail_morph_type === 'product_extra_variations') {
			return ProductExtraVariation::find($this->detail_morph_id)->productExtra->name;
		}

		return null;
	}

	public function getExtraUnitAttribute()
	{
		if ($this->detail_morph_type === 'product_extra_variations') {
			return ProductExtraVariation::find($this->detail_morph_id)->productExtra->unit->unit;
		}

		return null;
	}

	public function getProductNameAttribute()
	{
		if ($this->detail_morph_type === 'product_variations') {
			return ProductVariation::find($this->detail_morph_id)->product->name;
		}

		return null;
	}
}
