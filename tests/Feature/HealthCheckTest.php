<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnOkAndHasCorrectStructure()
    {
        $response = $this->json('GET', '/api/healthcheck');
        $response->assertOk()
            ->assertJsonStructure(
                [
                    'status',
                ]
            );
    }
}
