<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 * @package App
 */
class Booking extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bookings';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];
}
