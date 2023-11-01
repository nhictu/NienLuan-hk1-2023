<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventories extends Model
{
    protected $table = 'inventories';
    protected $primaryKey = 'iv_id';
    protected $fillable = ['iv_realexport', 'iv_export', 'iv_final', 'dt_id', 'prd_id', 'iv_saleprice', 'iv_inputprice'];


    // public function sale_detail()
    // {
    //     return $this->belongsTo(Sale_detail::class);
    // }
    public function input_detail()
    {
        return $this->belongsTo(Input_detail::class);
    }
    public function sale_details()
    {
        return $this->hasMany(Sale_detail::class);
    }
    use HasFactory;
}
