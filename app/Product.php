<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','sub_category_id','product_name','trade_name','finish','product_code','sort_description','description','weave','gsm','max_price','location','certificate','blend','length','width','height','image','user_id'];
}
