<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Item extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'quantity', 'cost', 'lower_limit'];
    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
