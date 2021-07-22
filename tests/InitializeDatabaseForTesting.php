<?php

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Tests\CreatesApplication;

class InitializeDatabaseForTesting extends TestCase
{
    use CreatesApplication;

    /** @test */
    public function it_seeds_the_database()
    {
        Artisan::call('migrate:fresh --seed');

        //You can make assertions here to check if the database is set up the way you wanted it. E.g.:
        $this->assertTrue(Permission::where('name', 'accessAdminPanel')->exists());
    }
}
