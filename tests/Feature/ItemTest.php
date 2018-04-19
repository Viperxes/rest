<?php

namespace Viperxes\Rest\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;
use Viperxes\Rest\Models\Item;
use Viperxes\Rest\RestServiceProvider;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Get package providers.  At a minimum this is the package being tested, but also
     * would include packages upon which our package depends, e.g. Cartalyst/Sentry
     * In a normal app environment these would be added to the 'providers' array in
     * the config/app.php file.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            RestServiceProvider::class
        ];
    }

    /**
     * @test
     */
    public function testItemsAreListedCorrectly()
    {
        factory(Item::class)->create([
            'id' => 1,
            'name' => 'Produkt 1',
            'amount' => 4
        ]);

        factory(Item::class)->create([
            'id' => 2,
            'name' => 'Produkt 2',
            'amount' => 12
        ]);

        $this->json('GET', 'api/v1/items')
            ->assertStatus(200)
            ->assertJson([
                ['id' => 1, 'name' => 'Produkt 1', 'amount' => 4],
                ['id' => 2, 'name' => 'Produkt 2', 'amount' => 12]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'amount']
            ])
            ->assertJsonCount(2);
    }

    /**
     * @test
     */
    public function testItemsAreEqFilteredCorrectly()
    {
        factory(Item::class)->create([
            'id' => 1,
            'name' => 'Produkt 1',
            'amount' => 4
        ]);

        factory(Item::class)->create([
            'id' => 2,
            'name' => 'Produkt 2',
            'amount' => 12
        ]);

        $this->json('GET', 'api/v1/items?amount=eq:4')
            ->assertStatus(200)
            ->assertJson([
                ['id' => 1, 'name' => 'Produkt 1', 'amount' => 4]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'amount']
            ])
            ->assertJsonCount(1);
    }

    /**
     * @test
     */
    public function testItemsAreGtFilteredCorrectly()
    {
        factory(Item::class)->create([
            'id' => 1,
            'name' => 'Produkt 1',
            'amount' => 4
        ]);

        factory(Item::class)->create([
            'id' => 2,
            'name' => 'Produkt 2',
            'amount' => 12
        ]);

        factory(Item::class)->create([
            'id' => 3,
            'name' => 'Produkt 3',
            'amount' => 6
        ]);

        $this->json('GET', 'api/v1/items?amount=gt:6')
            ->assertStatus(200)
            ->assertJson([
                ['id' => 2, 'name' => 'Produkt 2', 'amount' => 12]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'amount']
            ])
            ->assertJsonCount(1);
    }

    /**
     * @test
     */
    public function testItemsAreGteFilteredCorrectly()
    {
        factory(Item::class)->create([
            'id' => 1,
            'name' => 'Produkt 1',
            'amount' => 4
        ]);

        factory(Item::class)->create([
            'id' => 2,
            'name' => 'Produkt 2',
            'amount' => 12
        ]);

        factory(Item::class)->create([
            'id' => 3,
            'name' => 'Produkt 3',
            'amount' => 6
        ]);

        $this->json('GET', 'api/v1/items?amount=gte:6')
            ->assertStatus(200)
            ->assertJson([
                ['id' => 2, 'name' => 'Produkt 2', 'amount' => 12],
                ['id' => 3, 'name' => 'Produkt 3', 'amount' => 6],
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'amount']
            ])
            ->assertJsonCount(2);
    }

    /**
     * @test
     */
    public function testItemsAreLtFilteredCorrectly()
    {
        factory(Item::class)->create([
            'id' => 1,
            'name' => 'Produkt 1',
            'amount' => 4
        ]);

        factory(Item::class)->create([
            'id' => 2,
            'name' => 'Produkt 2',
            'amount' => 12
        ]);

        factory(Item::class)->create([
            'id' => 3,
            'name' => 'Produkt 3',
            'amount' => 6
        ]);

        $this->json('GET', 'api/v1/items?amount=lt:6')
            ->assertStatus(200)
            ->assertJson([
                ['id' => 1, 'name' => 'Produkt 1', 'amount' => 4]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'amount']
            ])
            ->assertJsonCount(1);
    }

    public function testItemsAreLteFilteredCorrectly()
    {
        factory(Item::class)->create([
            'id' => 1,
            'name' => 'Produkt 1',
            'amount' => 4
        ]);

        factory(Item::class)->create([
            'id' => 2,
            'name' => 'Produkt 2',
            'amount' => 12
        ]);

        factory(Item::class)->create([
            'id' => 3,
            'name' => 'Produkt 3',
            'amount' => 6
        ]);

        $this->json('GET', 'api/v1/items?amount=lte:6')
            ->assertStatus(200)
            ->assertJson([
                ['id' => 1, 'name' => 'Produkt 1', 'amount' => 4],
                ['id' => 3, 'name' => 'Produkt 3', 'amount' => 6]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'amount']
            ])
            ->assertJsonCount(2);
    }

    /**
     * @test
     */
    public function testItemIsGetCorrectly()
    {
        factory(Item::class)->create([
            'id' => 3,
            'name' => 'Produkt 5',
            'amount' => 0
        ]);

        $this->json('GET', 'api/v1/items/3')
            ->assertStatus(200)
            ->assertJson([
                'id' => 3,
                'name' => 'Produkt 5',
                'amount' => 0
            ])
            ->assertJsonStructure([
                'id',
                'name',
                'amount'
            ]);
    }

    /**
     * @test
     */
    public function testItemIsCreatedCorrectly()
    {
        $payload = [
            'id' => 4,
            'name' => 'Produkt 7',
            'amount' => 6
        ];

        $this->json('POST', 'api/v1/items', $payload)
            ->assertStatus(201)
            ->assertJson($payload)
            ->assertJsonStructure([
                'id',
                'name',
                'amount'
            ]);
    }

    /**
     * @test
     */
    public function testItemIsUpdatedCorrectly()
    {
        factory(Item::class)->create([
            'id' => 5,
            'name' => 'Produkt 8',
            'amount' => 2
        ]);

        $payload = [
            'name' => 'Produkt X',
            'amount' => 15
        ];

        $this->json('PUT', 'api/v1/items/5', $payload)
            ->assertStatus(200)
            ->assertJson($payload)
            ->assertJsonStructure([
                'id',
                'name',
                'amount'
            ]);
    }

    /**
     * @test
     */
    public function testItemIsDeletedCorrectly()
    {
        factory(Item::class)->create([
            'id' => 5,
            'name' => 'Produkt 8',
            'amount' => 2
        ]);

        $this->json('DELETE', 'api/v1/items/5')
            ->assertStatus(204);
    }
}
