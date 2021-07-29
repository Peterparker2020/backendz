<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'expertise',
        'address',
        'contact'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Asset', 'name', 'id');
    }
}
