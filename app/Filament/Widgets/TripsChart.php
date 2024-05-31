<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\Trip;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;

class TripsChart extends BarChartWidget
{
    use HasWidgetShield;
    //protected static ?string $heading = 'Contacts';
    public function getHeading(): string
    {
        return __('all.trip-labels');
    }

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = Trip::select('date_of_trip')->get()->groupby(function ($data){
           return  Carbon::parse($data->date_of_trip)->format('F');
        });
        $quantities = [];
        foreach ($data as $key=>$value){
            array_push($quantities , $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' => $this->getHeading(),
                    'data' => $quantities,
                    'backgroundColor' => [
                        'rgba(255,99,132,0.8)',
                        'rgba(255,159,64,0.8)',
                        'rgba(255,205,86,0.8)',
                        'rgba(75,192,192,0.8)',
                        'rgba(54,162,235,0.8)',
                        'rgba(153,102,255,0.8)',
                        'rgba(201,203,207,0.8)',
                    ],
                    'borderColor' =>[
                        'rgb(255,99,132)',
                        'rgb(255,159,64)',
                        'rgb(255,205,86)',
                        'rgb(75,192,192)',
                        'rgb(54,162,235)',
                        'rgb(153,102,255)',
                        'rgb(201,203,207)',
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => $data->keys(),
        ];
    }
}
