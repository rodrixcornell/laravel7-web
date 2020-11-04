<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
	use Notifiable;

	protected $table = 'roles';

	protected $primaryKey = 'id';

	protected $dates = [
		'created_at', 'updated_at', // 'deleted_at',
	];

	protected $fillable = [
		'name', 'slug', 'description', 'active', 'level',
	];

	protected $casts = [
		'active' => 'bool',
		'level' => 'int',
		'created_at' => 'datetime:Y-m-d H:i:s',
		'updated_at' => 'datetime:Y-m-d H:i:s',
	];

	public function users()
	{
		return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
	}
}
