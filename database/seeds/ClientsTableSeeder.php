<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['Ahmed', 'Hassan', 'Mahmoud'];
        foreach ($clients as $client) {
            \App\Client::create([
                'name' => $client,
                'phone' => '011122',
                'address' => 'assuit',
            ]);
        } //end of foreach
    } //end of run
}//end of seeder
