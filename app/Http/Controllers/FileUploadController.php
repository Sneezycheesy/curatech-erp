<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ComponentsCSVUploadJob;

class FileUploadController extends Controller
{
    function separateBySemicolon($chunk) {
        return str_getcsv($chunk, ';');
    }
    //
    public function uploadComponentsCSV(Request $request) {
        $request->validate([
            'file' => 'required|mimes:csv,txt,vnd.ms-excel',
        ]);

        if ($request->has('file')) {

            $csv = file($request->file);
            // REMOVE BOM FROM CSV FILE [ Something that gets added by Excel automatically when exporting/opening as csv file ]
            $csv = preg_replace('/\x{FEFF}/u', '', $csv);

            $chunks = array_chunk($csv, 1000);
            $header = [];

            foreach($chunks as $key => $chunk) {
                $data = array_map(function ($chunk) { return str_getcsv($chunk, ';');}, $chunk);
                if ($key == 0) {
                    $header = array_map(function($head) { return strtolower(trim($head)); }, $data[0]);
                    unset($data[0]);
                }
                // dd($data, $header);
                ComponentsCSVUploadJob::dispatch($data, $header);
            }

        }
        return redirect(route('components'));
    }
}