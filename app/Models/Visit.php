<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_number',
        'visitor_number',
        'host_name',
        'visitor_name',
        'visitor_email',
        'host_id',
    ];
}
