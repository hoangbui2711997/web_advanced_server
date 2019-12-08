<?php

namespace App\Models;

use App\Consts;
use Illuminate\Database\Eloquent\Builder;
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
        'name', 'email', 'password', 'active', 'activation_token', 'avatar', 'role_id'
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
	protected $dateFormat = 'Y-m-d H:i:s.u';
    /**
     * @var array
     */
//    protected $dates = ['deleted_at'];
    /**
     * @var array
     */
//	public function cart()
//	{
//		return $this->belongsToMany(ProductVariation::class, 'cart_user')
//			->withPivot('quantity')
//			->withTimestamps();
//	}

	public function addresses()
	{
		return $this->hasMany(Address::class);
	}

	public function cart()
	{
		return $this->hasMany(Cart::class);
	}
//
//    protected $appends = ['avatar_url'];
//
//    public function getAvatarUrlAttribute()
//    {
//        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
//    }

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'user_roles');
	}

	public function isUser(): bool
	{
		//        return $this->roles->where('role_id', Consts::$ROLE_USER)->count() > 0;
		return $this->roles()->where('role_id', Consts::$ROLE_USER)->count() > 0;
	}

	public function fromDateTime($value)
	{
		return empty($value) ? $value :
			substr(
				$this->asDateTime($value)->format(
					$this->getDateFormat()
				),
				0,
				(strlen($this->asDateTime($value)->format(
						$this->getDateFormat()
					)) - 3));
	}

	public function conversation()
	{
		return $this->hasOne(Conversation::class, 'user_id', 'id');
	}
}
