<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //

    public function subscriptions() { return $this->hasMany(Subscription::class); }
}
