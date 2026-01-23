<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    use HasFactory;
    protected $table = "ipaddress";
    protected $fillable = ['ip_address', 'title', 'comment', 'created_by'];
}
