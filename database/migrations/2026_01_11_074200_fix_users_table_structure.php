<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First, check if we need to add soft deletes
        if (!Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
        
        // Check if mobile_number column exists, if not add it
        if (!Schema::hasColumn('users', 'mobile_number')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('mobile_number')->nullable()->after('mobile');
            });
        }
        
        // Copy data from mobile to mobile_number if mobile_number is empty
        DB::statement("UPDATE users SET mobile_number = mobile WHERE mobile_number IS NULL OR mobile_number = ''");
        
        // Make mobile_number unique (only if there are no duplicates)
        // First, check for duplicates in mobile_number
        $duplicates = DB::table('users')
            ->select('mobile_number', DB::raw('COUNT(*) as count'))
            ->whereNotNull('mobile_number')
            ->where('mobile_number', '!=', '')
            ->groupBy('mobile_number')
            ->having('count', '>', 1)
            ->get();
            
        if ($duplicates->isEmpty()) {
            // No duplicates, we can add unique constraint
            Schema::table('users', function (Blueprint $table) {
                $table->string('mobile_number')->unique()->change();
            });
        } else {
            // There are duplicates, we need to fix them first
            foreach ($duplicates as $duplicate) {
                $users = DB::table('users')
                    ->where('mobile_number', $duplicate->mobile_number)
                    ->orderBy('id')
                    ->get();
                    
                // Keep first one as is, modify others
                $counter = 1;
                foreach ($users as $index => $user) {
                    if ($index > 0) {
                        $newMobileNumber = $duplicate->mobile_number . '_' . $counter;
                        DB::table('users')
                            ->where('id', $user->id)
                            ->update(['mobile_number' => $newMobileNumber]);
                        $counter++;
                    }
                }
            }
            
            // Now add unique constraint
            Schema::table('users', function (Blueprint $table) {
                $table->string('mobile_number')->unique()->change();
            });
        }
        
        // Add other missing columns
        $columnsToAdd = [
            'first_name' => 'string',
            'last_name' => 'string',
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
                Schema::table('users', function (Blueprint $table) use ($column, $type) {
                    if ($type === 'string') {
                        $table->string($column)->nullable();
                    } elseif ($type === 'text') {
                        $table->text($column)->nullable();
                    }
                });
            }
        }
        
        // Update existing users to have proper status
        DB::table('users')
            ->where(function($query) {
                $query->where('status', 'pending')
                      ->orWhereNull('status');
            })
            ->whereNotNull('email_verified_at')
            ->update(['status' => 'active']);
            
        // Set default status for users without status
        DB::table('users')
            ->whereNull('status')
            ->update(['status' => 'active']);
            
        // Ensure all users have type set
        DB::table('users')
            ->whereNull('type')
            ->update(['type' => 'customer']);
            
        // Copy name to first_name and last_name if they're empty
        DB::statement("UPDATE users SET first_name = TRIM(SUBSTRING_INDEX(name, ' ', 1)) WHERE first_name IS NULL OR first_name = ''");
        DB::statement("UPDATE users SET last_name = TRIM(SUBSTRING(name, LENGTH(TRIM(SUBSTRING_INDEX(name, ' ', 1))) + 2)) WHERE last_name IS NULL OR last_name = ''");
        
        // For users where last_name is still empty, set it to first_name
        DB::table('users')
            ->where(function($query) {
                $query->whereNull('last_name')
                      ->orWhere('last_name', '');
            })
            ->update(['last_name' => DB::raw('first_name')]);
    }

    public function down()
    {
        // We cannot safely rollback all changes, so we'll just remove unique constraint
        Schema::table('users', function (Blueprint $table) {
            // Drop unique index if exists
            $indexes = Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes('users');
            if (isset($indexes['users_mobile_number_unique'])) {
                $table->dropUnique(['mobile_number']);
            }
            
            // We won't drop columns as data might be lost
        });
    }
};