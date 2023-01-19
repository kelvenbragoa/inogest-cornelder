<?php

namespace App\Console\Commands;

use App\Models\Availability as ModelsAvailability;
use App\Models\Equipment;
use Illuminate\Console\Command;

class Availability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'availability:hour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command insert the availability of the equipment hourly in the table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       foreach(Equipment::all() as $item){
        ModelsAvailability::create([
            'equipment_id' => $item->id,
            'type_equipment_id'=> $item->type_equipment_id,
            'destination_id'=> $item->destination_id,
            'area_id'=> $item->area_id,
            'status'=> $item->status,

        ]);
       }
    }
}
