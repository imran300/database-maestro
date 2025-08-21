<?php

namespace Tests\Feature;

use Tests\TestCase;

class DatabasePerformanceTest extends TestCase
{
    public function test_database_performance_page_displays_metrics(): void
    {
        $response = $this->get('/database/performance');

        $response->assertStatus(200);
        $response->assertSee('Query Performance');
        $response->assertSee('Connection Usage');
        $response->assertViewHas('queryTime');
        $response->assertViewHas('connectionUsage');
    }
}
