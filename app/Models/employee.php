<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
	use Notifiable;

	protected $primaryKey = 'id_employee';
	protected $fillable = [
		'fname',
		'lname',
		'username',
		'phone',
		'email',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	//table name
	protected $table = 'employee';

	//save without time
	public $timestamps = false;
}
