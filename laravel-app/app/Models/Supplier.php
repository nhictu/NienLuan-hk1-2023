<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'sp_id';
    protected $fillable = ['sp_name', 'sp_contact', 'sp_phone', 'sp_addr'];

    public function input()
    {
        return $this->hasMany(Input::class);
    }
    use HasFactory;
}
