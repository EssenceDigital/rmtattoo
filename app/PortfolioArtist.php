<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioArtist extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'portfolio_artists';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
     'id', 'name', 'active'
  ];
}
