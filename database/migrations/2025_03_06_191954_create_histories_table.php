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
            Schema::create('histories', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('dt');
                $table->string('weather');
                $table->string('style');
                $table->string('userid');
                $table->string('outerid')->nullable();
                $table->string('shirtid');
                $table->string('pantid')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('histories');
        }
    };
