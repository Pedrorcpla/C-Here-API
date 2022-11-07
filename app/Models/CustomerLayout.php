<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerLayout extends Model
{
    public $timestamps = false;
    
    protected $table = 'tb_customer_layout';

    protected $fillable = ['id', 'cd_background', 'cd_fontColor', 'cd_backgroundSecondary', 'id_customer'];
}