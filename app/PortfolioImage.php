<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portfolio_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	   'id', 'description', 'src'
    ];    
}