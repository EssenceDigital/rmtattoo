<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'booking_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'booking_id', 'src'
    ]; 
    /**
     * Get the booking the image belongs to
     */
    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }    
}
