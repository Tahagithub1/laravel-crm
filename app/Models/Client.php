<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'photo',
        'linkedin',
        'active',
        'title',
        'company',
        'role',
        'company_website',
        'business_details',
        'business_type',
        'company_size',
        'temperature',
        'notes',
        'referrals'
    ];
}
