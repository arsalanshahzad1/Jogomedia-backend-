<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockchainUser extends Model
{
    use HasFactory;
    
    protected $table = 'blockchain_users';

    protected $fillable = [
        'user_address',
        'token_sale',
        'eth_amount',
        'usdt_amount',
        'status',
        'round_1',
        'round_2',
        'round_3',
        'round_4',
        'round_5'
    ];

    // public function table()
    // {
    //     return $this->belongsTo(Table::class, 'table_id', 'id');
    // }
}
