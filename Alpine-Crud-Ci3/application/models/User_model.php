<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends Eloquent
{
	protected $table = "users";

	protected $fillable = [
		'name',
		'age',
		'email',
		'password',
		'city',
		'address',
		'gender',
		'skills'
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];
}
