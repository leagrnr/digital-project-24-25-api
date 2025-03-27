<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Compagny;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CompagnyController
 */
final class CompagnyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $compagnies = Compagny::factory()->count(3)->create();

        $response = $this->get(route('compagnies.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompagnyController::class,
            'store',
            \App\Http\Requests\CompagnyStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $logo = fake()->word();
        $siret = fake()->word();
        $mail_manager = fake()->word();
        $telephone_manager = fake()->word();
        $adresse_siege = fake()->word();

        $response = $this->post(route('compagnies.store'), [
            'name' => $name,
            'logo' => $logo,
            'siret' => $siret,
            'mail_manager' => $mail_manager,
            'telephone_manager' => $telephone_manager,
            'adresse_siege' => $adresse_siege,
        ]);

        $compagnies = Compagny::query()
            ->where('name', $name)
            ->where('logo', $logo)
            ->where('siret', $siret)
            ->where('mail_manager', $mail_manager)
            ->where('telephone_manager', $telephone_manager)
            ->where('adresse_siege', $adresse_siege)
            ->get();
        $this->assertCount(1, $compagnies);
        $compagny = $compagnies->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $compagny = Compagny::factory()->create();

        $response = $this->get(route('compagnies.show', $compagny));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompagnyController::class,
            'update',
            \App\Http\Requests\CompagnyUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $compagny = Compagny::factory()->create();
        $name = fake()->name();
        $logo = fake()->word();
        $siret = fake()->word();
        $mail_manager = fake()->word();
        $telephone_manager = fake()->word();
        $adresse_siege = fake()->word();

        $response = $this->put(route('compagnies.update', $compagny), [
            'name' => $name,
            'logo' => $logo,
            'siret' => $siret,
            'mail_manager' => $mail_manager,
            'telephone_manager' => $telephone_manager,
            'adresse_siege' => $adresse_siege,
        ]);

        $compagny->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $compagny->name);
        $this->assertEquals($logo, $compagny->logo);
        $this->assertEquals($siret, $compagny->siret);
        $this->assertEquals($mail_manager, $compagny->mail_manager);
        $this->assertEquals($telephone_manager, $compagny->telephone_manager);
        $this->assertEquals($adresse_siege, $compagny->adresse_siege);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $compagny = Compagny::factory()->create();

        $response = $this->delete(route('compagnies.destroy', $compagny));

        $response->assertNoContent();

        $this->assertModelMissing($compagny);
    }
}
