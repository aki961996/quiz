<?php

namespace Database\Seeders;

use App\Models\QuizType;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run()
    {
        
        $artsType = QuizType::create([
            'name' => 'Arts & Literature',
            'description' => 'Questions about art, books, poetry, and literary works'
        ]);
        
        $historyType = QuizType::create([
            'name' => 'History',
            'description' => 'Historical events, dates, and important figures'
        ]);
        
        $filmType = QuizType::create([
            'name' => 'Film & TV',
            'description' => 'Movies, TV shows, actors, and entertainment'
        ]);
        
        $geographyType = QuizType::create([
            'name' => 'Geography',
            'description' => 'Countries, capitals, landmarks, and world knowledge'
        ]);
        
        $foodType = QuizType::create([
            'name' => 'Food & Drink',
            'description' => 'Cuisine, recipes, beverages, and culinary culture'
        ]);
        
        $generalType = QuizType::create([
            'name' => 'General Knowledge',
            'description' => 'Mixed topics and general trivia questions'
        ]);
        
        // Create sample quizzes for each type
        
        // Arts & Literature Quiz
        $artsQuiz = Quiz::create([
            'title' => 'Classic Literature Quiz',
            'description' => 'Test your knowledge of famous books and authors',
            'quiz_type_id' => $artsType->id,
            'time_limit' => 15,
            'questions_count' => 10,
            'is_active' => true
        ]);
        
        Question::create([
            'quiz_id' => $artsQuiz->id,
            'question' => 'Who wrote "Pride and Prejudice"?',
            'options' => ['Charlotte Brontë', 'Jane Austen', 'Emily Dickinson', 'Virginia Woolf'],
            'correct_answer' => 'Jane Austen',
            'time_limit' => 45
        ]);
        
        Question::create([
            'quiz_id' => $artsQuiz->id,
            'question' => 'Which painting is famous for the subject\'s mysterious smile?',
            'options' => ['The Starry Night', 'Mona Lisa', 'The Scream', 'Girl with a Pearl Earring'],
            'correct_answer' => 'Mona Lisa',
            'time_limit' => 45
        ]);
        
        // History Quiz
        $historyQuiz = Quiz::create([
            'title' => 'World History Basics',
            'description' => 'Important historical events and figures',
            'quiz_type_id' => $historyType->id,
            'time_limit' => 20,
            'questions_count' => 15,
            'is_active' => true
        ]);
        
        Question::create([
            'quiz_id' => $historyQuiz->id,
            'question' => 'In which year did World War II end?',
            'options' => ['1944', '1945', '1946', '1947'],
            'correct_answer' => '1945',
            'time_limit' => 30
        ]);
        
        Question::create([
            'quiz_id' => $historyQuiz->id,
            'question' => 'Who was the first President of the United States?',
            'options' => ['Thomas Jefferson', 'John Adams', 'George Washington', 'Benjamin Franklin'],
            'correct_answer' => 'George Washington',
            'time_limit' => 30
        ]);
        
        // Film & TV Quiz
        $filmQuiz = Quiz::create([
            'title' => 'Movie Trivia Challenge',
            'description' => 'Test your knowledge of films and television',
            'quiz_type_id' => $filmType->id,
            'time_limit' => 12,
            'questions_count' => 8,
            'is_active' => true
        ]);
        
        Question::create([
            'quiz_id' => $filmQuiz->id,
            'question' => 'Which movie won the Academy Award for Best Picture in 2020?',
            'options' => ['1917', 'Joker', 'Parasite', 'Once Upon a Time in Hollywood'],
            'correct_answer' => 'Parasite',
            'time_limit' => 40
        ]);
        
        // Geography Quiz
        $geoQuiz = Quiz::create([
            'title' => 'World Geography',
            'description' => 'Countries, capitals, and geographical features',
            'quiz_type_id' => $geographyType->id,
            'time_limit' => 18,
            'questions_count' => 12,
            'is_active' => true
        ]);
        
        Question::create([
            'quiz_id' => $geoQuiz->id,
            'question' => 'What is the capital of Australia?',
            'options' => ['Sydney', 'Melbourne', 'Canberra', 'Perth'],
            'correct_answer' => 'Canberra',
            'time_limit' => 35
        ]);
        
        Question::create([
            'quiz_id' => $geoQuiz->id,
            'question' => 'Which is the longest river in the world?',
            'options' => ['Amazon River', 'Nile River', 'Mississippi River', 'Yangtze River'],
            'correct_answer' => 'Nile River',
            'time_limit' => 35
        ]);
        
        // Food & Drink Quiz
        $foodQuiz = Quiz::create([
            'title' => 'Culinary Knowledge',
            'description' => 'Food, drinks, and cooking from around the world',
            'quiz_type_id' => $foodType->id,
            'time_limit' => 10,
            'questions_count' => 6,
            'is_active' => true
        ]);
        
        Question::create([
            'quiz_id' => $foodQuiz->id,
            'question' => 'Which country is famous for inventing pizza?',
            'options' => ['France', 'Greece', 'Italy', 'Spain'],
            'correct_answer' => 'Italy',
            'time_limit' => 30
        ]);
        
        Question::create([
            'quiz_id' => $foodQuiz->id,
            'question' => 'What is the main ingredient in guacamole?',
            'options' => ['Tomato', 'Avocado', 'Onion', 'Pepper'],
            'correct_answer' => 'Avocado',
            'time_limit' => 30
        ]);
        
        // General Knowledge Quiz
        $generalQuiz = Quiz::create([
            'title' => 'General Knowledge Challenge',
            'description' => 'Mixed questions from various topics',
            'quiz_type_id' => $generalType->id,
            'time_limit' => 25,
            'questions_count' => 20,
            'is_active' => true
        ]);
        
        Question::create([
            'quiz_id' => $generalQuiz->id,
            'question' => 'How many bones are there in an adult human body?',
            'options' => ['196', '206', '216', '226'],
            'correct_answer' => '206',
            'time_limit' => 40
        ]);
        
        Question::create([
            'quiz_id' => $generalQuiz->id,
            'question' => 'What is the largest planet in our solar system?',
            'options' => ['Saturn', 'Jupiter', 'Neptune', 'Uranus'],
            'correct_answer' => 'Jupiter',
            'time_limit' => 35
        ]);
        
        Question::create([
            'quiz_id' => $generalQuiz->id,
            'question' => 'In which year was the first iPhone released?',
            'options' => ['2006', '2007', '2008', '2009'],
            'correct_answer' => '2007',
            'time_limit' => 40
        ]);
    }
}