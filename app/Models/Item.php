<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['serial_number','product_type_id','is_sold'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

}
