<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sl_id';
    protected $fillable = ['sl_vat', 'sl_note', 'sl_name', 'sl_phone', 'sl_addr', 'sl_date', 'sl_status', 'ImportStatus'];

    public function sale_detail()
    {
        return $this->hasMany(Sale_detail::class);
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
    use HasFactory;
}
