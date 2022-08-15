<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock', 'size', 'code'];

    public function sales(){
        return $this->hasMany(SaleItem::class)->orderBy('created_at', 'desc');
    }
}
