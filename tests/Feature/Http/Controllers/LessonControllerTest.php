<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LessonController
 */
final class LessonControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $lessons = Lesson::factory()->count(3)->create();

        $response = $this->get(route('lessons.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LessonController::class,
            'store',
            \App\Http\Requests\LessonStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $content = fake()->paragraphs(3, true);

        $response = $this->post(route('lessons.store'), [
            'name' => $name,
            'content' => $content,
        ]);

        $lessons = Lesson::query()
            ->where('name', $name)
            ->where('content', $content)
            ->get();
        $this->assertCount(1, $lessons);
        $lesson = $lessons->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get(route('lessons.show', $lesson));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LessonController::class,
            'update',
            \App\Http\Requests\LessonUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $lesson = Lesson::factory()->create();
        $name = fake()->name();
        $content = fake()->paragraphs(3, true);

        $response = $this->put(route('lessons.update', $lesson), [
            'name' => $name,
            'content' => $content,
        ]);

        $lesson->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $lesson->name);
        $this->assertEquals($content, $lesson->content);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $lesson = Lesson::factory()->create();

        $response = $this->delete(route('lessons.destroy', $lesson));

        $response->assertNoContent();

        $this->assertModelMissing($lesson);
    }
}
