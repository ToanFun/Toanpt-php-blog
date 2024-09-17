<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	use HasFactory;

	/**
	 * Set constant admin value
	 */
	const ROLE_ADMIN = 'admin';

	/**
	 * Set constant editor value
	 */
	const ROLE_EDITOR = 'editor';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillables = ['name'];
}
