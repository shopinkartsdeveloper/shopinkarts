<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }
            
            // Add missing columns if they don't exist
            $columnsToAdd = [
                'first_name' => 'string',
                'last_name' => 'string',
                'mobile_number' => 'string',
                'whatsapp_number' => 'string',
                'firm_name' => 'string',
                'gst_number' => 'string',
                'shop_name' => 'string',
                'company_name' => 'string',
                'status' => 'string',
                'profile_image' => 'string',
                'address' => 'text',
                'city' => 'string',
                'state' => 'string',
                'pincode' => 'string',
                'country' => 'string'
            ];
            
            foreach ($columnsToAdd as $column => $type) {
                if (!Schema::hasColumn('users', $column)) {
                    if ($type === 'string') {
                        $table->string($column)->nullable();
                    } elseif ($type === 'text') {
                        $table->text($column)->nullable();
                    }
                }
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};