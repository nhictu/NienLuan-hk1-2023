<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'prd_id';
    protected $fillable = ['prd_name', 'prd_unit', 'prd_inputprice', 'prd_saleprice', 'prd_desc'];


    public function input_detail()
    {
        return $this->hasMany(Input_detail::class);
    }
    // public function sale_detail()
    // {
    //     return $this->hasMany(Sale_detail::class);
    // }
    use HasFactory;
}