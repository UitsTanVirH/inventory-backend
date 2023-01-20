<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'quantity', 'cost', 'status'];

    // public $timestamps = false;
    // protected $dateFormat = 'U';
    protected $dateFormat = 'Y/m/d H:i:s';

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
