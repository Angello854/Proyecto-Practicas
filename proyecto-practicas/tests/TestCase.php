<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        if (env('APP_ENV') !== 'testing') {
            exit("❌ ABORTADO: Estás fuera del entorno de pruebas. Test cancelado para proteger tu base de datos.\n");
        }

        parent::setUp();
    }
}
