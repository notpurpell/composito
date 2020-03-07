<?php

namespace Composito\Test;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use PHPUnit\Framework\TestCase as BaseTest;

abstract class TestCase extends BaseTest
{
    /**
     * Setup the test.
     * @return void
     */
    public function setUp(): void
    {
        $this->setUpDatabaseConnection();
        $this->createFooDatabase();
    }

    /**
     * Set up the database connection.
     * @return void
     */
    public function setUpDatabaseConnection(): void
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'sqlite',
            'host'      => 'localhost',
            'database'  => ':memory:',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     * Create the foo database.
     * @return void
     */
    protected function createFooDatabase(): void
    {
        Capsule::schema()
            ->create('foos', function (Blueprint $table) {
                $table->unsignedBigInteger("primary_one");
                $table->unsignedBigInteger("primary_two");
                $table->string("text");
                $table->primary([ "primary_one", "primary_two" ]);
                $table->timestamps();
            });

        Foo::insert($this->generateDummyData());
    }

    /**
     * Generate dummy data.
     * @return array
     */
    protected function generateDummyData(): array
    {
        $data = [];

        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 2; $j++) {
                $data[] = [
                    "primary_one" => $i,
                    "primary_two" => $j,
                    "text" => "text_" . $i . "_" . $j
                ];
            }
        }

        return $data;
    }
}