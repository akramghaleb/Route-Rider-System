<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CreatedUpdatedBy;

    protected $guarded=[];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function trip_customers()
    {
        return $this->hasMany(TripCustomer::class);
    }
}
