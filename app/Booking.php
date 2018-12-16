<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'first', 'last', 'phone', 'email', 'user_id', 'tattoo_size', 'description', 'location', 'color_preference', 'tattoo_style', 'budget'
    ];

    /**
     * Get the prefered artist/user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
  
}
