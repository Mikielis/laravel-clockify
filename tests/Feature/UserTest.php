<?php

namespace Tests\Feature;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User can be created
     */
    public function test_can_create_user_account()
    {
        $number = User::factory()->count(1)->make()->count();
        $this->assertEquals(1, $number);
    }

    /**
     * Cannot duplicate user's email
     */
    public function test_cannot_duplicate_email()
    {
        $this->runDatabaseMigrations();

        $response = DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // First user successfully created
        $this->assertIsBool($response);

        try {
            DB::table('users')->insert(
                [
                    'name' => Str::random(10),
                    'email' => 'test@gmail.com',
                    'password' => Hash::make('password'),
                ]
            );
        } catch (QueryException $e) {
            // Second user could not be created because of duplicated email address - expected SQL error 23000
            $this->assertEquals(23000, $e->getCode());
        }
    }
}
