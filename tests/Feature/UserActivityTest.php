<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\UserActivityRepositoryInterface;
use App\Repositories\UserActivityRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login;

class UserActivityTest extends TestCase
{
    use DatabaseMigrations;

    protected static array $activityTypes;

    protected static $setUpHasRunOnce = false;

    protected UserRepositoryInterface $userRepository;

    protected UserActivityRepositoryInterface $userActivityRepository;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        // Migrate DB only once - prevent doing this before each test
        if (!static::$setUpHasRunOnce) {
            $this->runDatabaseMigrations();
            static::$setUpHasRunOnce = true;
            static::$activityTypes = UserActivityRepository::$types;
        }

        // Get user repository
        $this->userRepository = $this->app->make(UserRepositoryInterface::class);

        // Get UserActivityRepositoryInterface
        $this->userActivityRepository = $this->app->make(UserActivityRepositoryInterface::class);
    }

    /**
     * The application does not log seen pages by unauthenticated user
     * @return void
     */
    public function test_unknown_user_cannot_log_seen_page(): void
    {
        // Trigger page open
        $this->get(route('home'))->assertStatus(302);
        $lastActivity = $this->userActivityRepository->getLast();

        $this->assertNull($lastActivity);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return void
     */
    private function createUser(string $name, string $email, string $password): void
    {
        // Create a new account
        $this->userRepository->addGoogleUser($name, $email, Hash::make($password));
    }

    /**
     * @param $email
     * @return mixed
     */
    private function getUser($email): User|null
    {
        Event::fake(Login::class);
        return $this->userRepository->getGoogleUser($email);
    }
}
