<?php

namespace App\Models;

use App\Enums\ReservationStatusEnum;
use App\Services\Reservation\V1\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicycle extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'inventory', 'is_active'];

    protected $appends = ['active_inventory'];

    public function scopeActive(Builder $builder): void
    {
        $builder->where('is_active', true);
    }

    public function getActiveInventoryAttribute()
    {
        $date = \request()->query('date') ?? Carbon::now()->toDateString();
        return (new Inventory($this))->Inventory($date);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
