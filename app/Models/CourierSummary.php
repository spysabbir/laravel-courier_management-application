<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierSummary extends Model
{
    use HasFactory;
    protected $guarded= [];

    function relationtosenderbranch(){
        return $this->hasOne(Branch::class, 'id', 'sender_branch_id');
    }
    function relationtoreceiverbranch(){
        return $this->hasOne(Branch::class, 'id', 'receiver_branch_id');
    }
}
