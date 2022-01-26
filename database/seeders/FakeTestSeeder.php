<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Client;
use App\Models\Company;
use App\Models\Place;
use Illuminate\Database\Seeder;

class FakeTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();

        if (!app()->environment('local')) {
            $output->writeln('<error>Разрешено запускать только на локальной машине...</error>');
            die();
        }

        $output->writeln('<info>Началось наполнение фейковыми данными...</info>');

        $companies = Company::factory(3)->create();

        for ($i = 0; $i < 100; $i++) {

            $buildings = Building::factory()->create();

            Client::factory(100)->create()->each(function ($client) use ($companies, $buildings) {
                Place::factory(rand(1, 2))->create([
                    'company_id' => $companies->random()->id,
                    'building_id' => $buildings->id,
                    'client_id' => $client->id,
                ]);
            });
        }
    }
}
