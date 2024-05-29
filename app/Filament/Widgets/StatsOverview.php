<?php

namespace App\Filament\Widgets;

use App\Models\Trip;
use App\Models\TripCustomer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $activeTrips = Trip::whereDate('date_of_trip' ,'>', \Carbon\Carbon::today())->count();
        $totalChairs = Trip::whereDate('date_of_trip' ,'>', \Carbon\Carbon::today())->sum('vip_chairs') + Trip::whereDate('date_of_trip' ,'>', \Carbon\Carbon::today())->sum('customer_chairs');
        $RemainChairs = $totalChairs - TripCustomer::whereIn('trip_id' ,Trip::whereDate('date_of_trip' ,'>', \Carbon\Carbon::today())->get('id') )->sum('number_of_seats') ;

        return [
            Stat::make(__('all.ActiveTrip'), $activeTrips),
            Stat::make(__('all.TotalChairs'), $totalChairs),
            Stat::make(__('all.RemainingChairs'), $RemainChairs),
        ];
    }
}
