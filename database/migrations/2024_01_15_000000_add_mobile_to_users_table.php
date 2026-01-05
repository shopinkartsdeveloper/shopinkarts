<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ✅ मोबाइल फील्ड जोड़ें (unique और nullable)
            $table->string('mobile', 15)->unique()->nullable()->after('email');
            
            // ✅ मोबाइल वेरिफिकेशन के लिए
            $table->timestamp('mobile_verified_at')->nullable()->after('email_verified_at');
            
            // ✅ यूजर टाइप (optional, role-based के लिए)
            $table->enum('type', ['admin', 'seller', 'manufacturer', 'customer'])->default('customer')->after('mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'mobile_verified_at', 'type']);
        });
    }
};