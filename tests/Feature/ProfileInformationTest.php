<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @coversNothing
 */
class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function testProfileInformationCanBeUpdated()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/profile-information', [
            'name'  => 'Test Name',
            'email' => 'test@example.com',
        ]);

        $this->assertSame('Test Name', $user->fresh()->name);
        $this->assertSame('test@example.com', $user->fresh()->email);
    }
}
