<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReplyController
 */
final class ReplyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $replies = Reply::factory()->count(3)->create();

        $response = $this->get(route('replies.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReplyController::class,
            'store',
            \App\Http\Requests\ReplyStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $id_user = fake()->numberBetween(-10000, 10000);
        $id_question = fake()->numberBetween(-10000, 10000);
        $score = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('replies.store'), [
            'id_user' => $id_user,
            'id_question' => $id_question,
            'score' => $score,
        ]);

        $replies = Reply::query()
            ->where('id_user', $id_user)
            ->where('id_question', $id_question)
            ->where('score', $score)
            ->get();
        $this->assertCount(1, $replies);
        $reply = $replies->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $reply = Reply::factory()->create();

        $response = $this->get(route('replies.show', $reply));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReplyController::class,
            'update',
            \App\Http\Requests\ReplyUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $reply = Reply::factory()->create();
        $id_user = fake()->numberBetween(-10000, 10000);
        $id_question = fake()->numberBetween(-10000, 10000);
        $score = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('replies.update', $reply), [
            'id_user' => $id_user,
            'id_question' => $id_question,
            'score' => $score,
        ]);

        $reply->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($id_user, $reply->id_user);
        $this->assertEquals($id_question, $reply->id_question);
        $this->assertEquals($score, $reply->score);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $reply = Reply::factory()->create();

        $response = $this->delete(route('replies.destroy', $reply));

        $response->assertNoContent();

        $this->assertModelMissing($reply);
    }
}
