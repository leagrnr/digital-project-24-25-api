<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Compagny;
use App\Models\Keyword;
use App\Models\Lesson;
use App\Models\LessonReading;
use App\Models\Question;
use App\Models\Quizz;
use App\Models\Reply;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $companies = Compagny::factory()->count(5)->create();

        $companies->each(function ($company) {
            User::factory(5)->create([
                'id_compagnie' => $company->id
            ]);
        });

        $categories = Category::factory(5)->create();

        $categories->each(function ($category) {
            $lessons = Lesson::factory(5)->create([
                'id_categorie' => $category->id
            ]);

            $lessons->each(function ($lesson) {

                $users = User::inRandomOrder()->take(25)->get();

                $users->each(function ($user) use ($lesson) {
                    LessonReading::factory()->create([
                        'id_lesson' => $lesson->id,
                        'id_user' => $user->id
                    ]);
                });

                // Créer 5 mots-clés pour chaque leçon
                Keyword::factory(5)->create([
                    'id_lesson' => $lesson->id
                ]);
            });
        });

        $quizz = Quizz::factory(5)->create();
        $quizz->each(function ($quiz) {
            // Utiliser la factory de Question au lieu de Quizz pour les questions
            $questions = Question::factory(5)->create([
                'id_quizz' => $quiz->id
            ]);

            $questions->each(function ($question) {
                $users = User::inRandomOrder()->take(3)->get();
                $users->each(function ($user) use ($question) {
                    Reply::factory()->create([
                        'id_question' => $question->id,
                        'id_user' => $user->id
                    ]);
                });
            });
        });
    }
}
