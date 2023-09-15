<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Component;

class ComponentsCSVUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;
    /**
     * Create a new job instance.
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        foreach ($this->data as $component) {
            $component_csv_data = array_combine($this->header, $component);
            // dd($comp);
            if(empty($component_csv_data['artnr'])) {
                continue;
            }

            $comp = Component::find($component_csv_data['artnr']);

            if (empty($comp)) {
                Component::firstOrCreate([
                    'component_id' => $component_csv_data['artnr'],
                    'description' => $component_csv_data['omschrijving'],
                    'courant' => $component_csv_data['courant'],
                    'unit_price' => $this->floatConvertedPriceString($component_csv_data['stukprijs']),
                    'lt' => $component_csv_data['lt'],
                ]);
            }

           //TODO: Link component to suppliers (NAAM column)
        }
    }

    private function floatConvertedPriceString($string) {
        $string = str_replace('€', '', $string);

        $string = str_replace(',', '.', $string);

        return $string;
    }
}
