<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoHomeModel extends Model
{
    use HasFactory;
    public $table ='seo_home';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
