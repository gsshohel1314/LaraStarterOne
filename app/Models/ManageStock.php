<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageStock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const STOCK_IN = 'in';
    public const STOCK_OUT = 'out';

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
