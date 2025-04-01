<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Quizz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\QuizzController
 */
final class QuizzControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $quizz = Quizz::factory()->count(3)->create();

        $response = $this->get(route('quizz.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizzController::class,
            'store',
            \App\Http\Requests\QuizzStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = fake()->sentence(4);

        $response = $this->post(route('quizz.store'), [
            'title' => $title,
        ]);

        $quizz = Quizz::query()
            ->where('title', $title)
            ->get();
        $this->assertCount(1, $quizz);
        $quizz = $quizz->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $quizz = Quizz::factory()->create();

        $response = $this->get(route('quizz.show', $quizz));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizzController::class,
            'update',
            \App\Http\Requests\QuizzUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $quizz = Quizz::factory()->create();
        $title = fake()->sentence(4);

        $response = $this->put(route('quizz.update', $quizz), [
            'title' => $title,
        ]);

        $quizz->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $quizz->title);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $quizz = Quizz::factory()->create();

        $response = $this->delete(route('quizz.destroy', $quizz));

        $response->assertNoContent();

        $this->assertModelMissing($quizz);
    }
}
