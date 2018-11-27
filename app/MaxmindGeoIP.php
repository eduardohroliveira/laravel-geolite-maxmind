<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaxmindGeoIP extends Model
{
    protected $table = 'maxmind_geoip';
    public $timestamps = false;

    /**
     * Custom query to return first ocurrence of country 
     * associated with the input IP (if exists)
     *
     * @param  mixed $IP IP address to be searched on database
     *
     * @return mixed Collection of table records (in this case, only the first row)
     */
    public static function getCountryByIP($IP) 
    {
        return DB::table('maxmind_geoip as info')
            ->select('info.country_code', 'info.country_name')
            ->whereRaw("INET_ATON('{$IP}') between ip_range_lower and ip_range_upper")
            ->first();
    }
}
