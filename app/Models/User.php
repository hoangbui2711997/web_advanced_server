<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Storage;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'activation_token', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
		'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * @var array
     */
	public function cart()
	{
		return $this->belongsToMany(ProductVariation::class, 'cart_user')
			->withPivot('quantity')
			->withTimestamps();
	}

	public function addresses()
	{
		return $this->hasMany(Address::class);
	}
//
//    protected $appends = ['avatar_url'];
//
//    public function getAvatarUrlAttribute()
//    {
//        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
//    }
}
