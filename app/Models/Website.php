<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'url', 'is_up'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
