<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // The output
        //$output = new ConsoleOutput();

        //$output->write('Start creating users', true);

        // ----------------------------------------------------------------
        User::factory(10)->create();
        // ----------------------------------------------------------------
        //$output->write('Finished', true);
    }
}
