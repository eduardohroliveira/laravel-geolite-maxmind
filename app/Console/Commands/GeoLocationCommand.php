<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Zipper;
use App\MaxmindGeoIP;

class GeoLocationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geolocation:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update geo location data from GeoLite Country database file';

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
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Updating...');

        // Perform update
        if ($result = $this->update()) {
            $this->info($result);
        } else {
            $this->error('Update failed!');
        }
    }

     /**
     * Update function for service.
     *
     * @return string
     * @throws Exception
     */
    private function update()
    {
        // Get settings
        $url = env('GEOLITE_URL');
        $path = env('GEOLITE_LOCAL_PATH');
        $fileName = env('GEOLITE_FILENAME');

        $this->comment('Checking='.$url);
        // Get header response
        $headers = get_headers($url);
        //check if request is working
        if (substr($headers[0], 9, 3) != '200') {
            throw new Exception('Unable to download database. ('. substr($headers[0], 13) .')');
        }

        $this->comment('Downloading...');
        
        // Download zipped database to a system temp file
        $tmpFile = tempnam(sys_get_temp_dir(), 'geolite.maxmind');
        file_put_contents($tmpFile, fopen($url, 'r'));
        
        // Unzip and save database
        Zipper::make($tmpFile)->extractTo($path);
        
        // Remove temp file
        @unlink($tmpFile);
        
        $this->comment('File saved. Cleaning up database...');

        //truncate table before insert
        MaxmindGeoIP::truncate();

        $this->comment('Database cleaned.');
        $this->comment('Updating local database..');

        if (($handle = fopen ( $path.$fileName, 'r' )) !== FALSE) {
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {

                //print_r($data);die();
                $csv_data = new MaxmindGeoIP ();
                $csv_data->notation_ip_range_lower = $data [0];
                $csv_data->notation_ip_range_upper = $data [1];
                $csv_data->ip_range_lower = $data [2];
                $csv_data->ip_range_upper = $data [3];
                $csv_data->country_code = $data [4];
                $csv_data->country_name = $data [5];
                $csv_data->save ();
            }
            fclose ( $handle );
        }
        $this->comment('Local database updated!');

        return "Database updated.";
    }
}
