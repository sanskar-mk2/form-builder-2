<?php

namespace Database\Factories;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id = Survey::all()->random()->id;

        return [
            'survey_id' => $id,
            'contents' => $this->get_contents($id),
        ];
    }

    public function _for(int $id)
    {
        return $this->state(function (array $attributes) use ($id) {

            return [
                'survey_id' => $id,
                'contents' => $this->get_contents($id),
            ];
        });
    }

    private function get_contents(int $id)
    {
        $survey = Survey::find($id);
        $contents = [];
        foreach ($survey->contents as $content) {

            if ($content->type == 'text') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->realTextBetween(8, 32);
                } else {
                    $contents[$content->name] = "";
                }
            } else if ($content->type == 'description') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->realTextBetween(32, 256);
                } else {
                    $contents[$content->name] = "";
                }
            } else if ($content->type == 'select' || $content->type == 'radio') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->randomElement(array_column($content->options, 'value'));
                } else {
                    $contents[$content->name] = "";
                }
            } else if ($content->type == 'checkbox') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->randomElements(array_column($content->options, 'value'), rand(1, count($content->options)));
                } else {
                    $contents[$content->name] = [];
                }
            }
        }
        return json_encode($contents);
    }
}
