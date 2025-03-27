<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Anecdocte;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AnecdocteController
 */
final class AnecdocteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $anecdoctes = Anecdocte::factory()->count(3)->create();

        $response = $this->get(route('anecdoctes.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AnecdocteController::class,
            'store',
            \App\Http\Requests\AnecdocteStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);

        $response = $this->post(route('anecdoctes.store'), [
            'title' => $title,
            'content' => $content,
        ]);

        $anecdoctes = Anecdocte::query()
            ->where('title', $title)
            ->where('content', $content)
            ->get();
        $this->assertCount(1, $anecdoctes);
        $anecdocte = $anecdoctes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $anecdocte = Anecdocte::factory()->create();

        $response = $this->get(route('anecdoctes.show', $anecdocte));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AnecdocteController::class,
            'update',
            \App\Http\Requests\AnecdocteUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $anecdocte = Anecdocte::factory()->create();
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);

        $response = $this->put(route('anecdoctes.update', $anecdocte), [
            'title' => $title,
            'content' => $content,
        ]);

        $anecdocte->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $anecdocte->title);
        $this->assertEquals($content, $anecdocte->content);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $anecdocte = Anecdocte::factory()->create();

        $response = $this->delete(route('anecdoctes.destroy', $anecdocte));

        $response->assertNoContent();

        $this->assertModelMissing($anecdocte);
    }
}
