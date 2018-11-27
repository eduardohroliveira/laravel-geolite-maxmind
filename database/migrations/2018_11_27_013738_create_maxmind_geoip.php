<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaxmindGeoip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maxmind_geoip', function (Blueprint $table) {
            $table->increments('id');
            $table->string ( 'notation_ip_range_lower' );
            $table->string ( 'notation_ip_range_upper' );
            $table->bigInteger ( 'ip_range_lower' );
            $table->bigInteger ( 'ip_range_upper' );
            $table->string ( 'country_code' );
            $table->string ( 'country_name' );
            $table->timestamps();

            $table->unique(['ip_range_lower', 'ip_range_upper']);
            $table->index('country_code');
        });
   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maxmind_geoip');
    }
}
