<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\QuestionController
 */
final class QuestionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $questions = Question::factory()->count(3)->create();

        $response = $this->get(route('questions.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuestionController::class,
            'store',
            \App\Http\Requests\QuestionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $question = fake()->word();

        $response = $this->post(route('questions.store'), [
            'question' => $question,
        ]);

        $questions = Question::query()
            ->where('question', $question)
            ->get();
        $this->assertCount(1, $questions);
        $question = $questions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $question = Question::factory()->create();

        $response = $this->get(route('questions.show', $question));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuestionController::class,
            'update',
            \App\Http\Requests\QuestionUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $question = Question::factory()->create();
        $question = fake()->word();

        $response = $this->put(route('questions.update', $question), [
            'question' => $question,
        ]);

        $question->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($question, $question->question);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $question = Question::factory()->create();

        $response = $this->delete(route('questions.destroy', $question));

        $response->assertNoContent();

        $this->assertModelMissing($question);
    }
}
