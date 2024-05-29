<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;

class UsersChart extends BarChartWidget
{
    //protected static ?string $heading = 'Contacts';
    public function getHeading(): string
    {
        return __('user.labels');
    }

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $users = User::select('created_at')->get()->groupby(function ($users){
           return  Carbon::parse($users->created_at)->format('F');
        });
        $quantities = [];
        foreach ($users as $user=>$value){
            array_push($quantities , $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' => __('widgets.Contact_messages'),
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
            'labels' => $users->keys(),
        ];
    }
}
