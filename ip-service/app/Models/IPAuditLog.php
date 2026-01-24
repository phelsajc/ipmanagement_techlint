<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPAuditLog extends Model
{
    use HasFactory;

    protected $table = 'ip_audit_logs';

    protected $fillable = ['ip_record_id', 'user_id', 'event', 'old_values', 'new_values'];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];
}
