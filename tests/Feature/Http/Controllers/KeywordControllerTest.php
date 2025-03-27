<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KeywordController
 */
final class KeywordControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $keywords = Keyword::factory()->count(3)->create();

        $response = $this->get(route('keywords.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KeywordController::class,
            'store',
            \App\Http\Requests\KeywordStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $keyword = fake()->word();

        $response = $this->post(route('keywords.store'), [
            'keyword' => $keyword,
        ]);

        $keywords = Keyword::query()
            ->where('keyword', $keyword)
            ->get();
        $this->assertCount(1, $keywords);
        $keyword = $keywords->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $keyword = Keyword::factory()->create();

        $response = $this->get(route('keywords.show', $keyword));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KeywordController::class,
            'update',
            \App\Http\Requests\KeywordUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $keyword = Keyword::factory()->create();
        $keyword = fake()->word();

        $response = $this->put(route('keywords.update', $keyword), [
            'keyword' => $keyword,
        ]);

        $keyword->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($keyword, $keyword->keyword);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $keyword = Keyword::factory()->create();

        $response = $this->delete(route('keywords.destroy', $keyword));

        $response->assertNoContent();

        $this->assertModelMissing($keyword);
    }
}
