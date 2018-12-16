<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingArtist extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'booking_artists';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
     'id', 'name', 'active'
  ];
}
