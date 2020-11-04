<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permission extends Model
{
	use Notifiable;

	protected $table = 'permissions';

	protected $primaryKey = 'id';

	protected $dates = [
		'created_at', 'updated_at', // 'deleted_at',
	];

	protected $fillable = [
		'name', 'slug', 'description', 'active',
	];

	protected $casts = [
		'active' => 'bool',
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'permission_user', 'permission_id', 'user_id');
	}
}
