<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripCustomer extends Model
{
    use HasFactory;
    use CreatedUpdatedBy;

    protected $guarded=[];
}
