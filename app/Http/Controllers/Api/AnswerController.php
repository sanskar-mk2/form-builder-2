<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerCollection;
use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AnswerCollection(Answer::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Pre-validation
        $validated = $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'data' => 'required|array',
        ]);

        $survey = Survey::find($validated['survey_id']);

        // Make sure all fields are present
        $fields = array_column($survey->contents, 'name');
        $data = array_keys($validated['data']);
        $diff = array_diff($fields, $data);
        if (count($diff) > 0) {
            return response()->json([
                'message' => 'Missing/Invalid Fields: ' . implode(', ', $diff),
            ], 422);
        }


        // Validate All Fields In Survey
        foreach ($survey->contents as $field) {
            if ($field->type === "text" || $field->type === "description") {
                if ($field->required) {
                    $request->validate([
                        "data.{$field->name}" => 'required|string',
                    ]);
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|string',
                    ]);
                }
            } elseif (
                $field->type === "select" ||
                $field->type === "radio" ||
                $field->type === "likert" ||
                $field->type === "image_singleselect"
            ) {
                if ($field->required) {
                    // make sure the required string is in
                    // array_column($field->options, 'value')
                    $request->validate([
                        "data.{$field->name}" => 'required|string|in:' . implode(',', array_column($field->options, 'value')),
                    ]);
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|string|in:' . implode(',', array_column($field->options, 'value')),
                    ]);
                }
            } elseif (
                $field->type === "checkbox" ||
                $field->type === "image_multiselect"

            ) {
                if ($field->required) {
                    $request->validate([
                        "data.{$field->name}" => 'required|array',
                        "data.{$field->name}.*" => 'required|string|in:' . implode(',', array_column($field->options, 'value')),
                    ]);
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|array',
                        "data.{$field->name}.*" => 'nullable|string|in:' . implode(',', array_column($field->options, 'value')),
                    ]);
                }
            } elseif ($field->type === "continuous_sum") {
                if ($field->required) {
                    $request->validate([
                        "data.{$field->name}" => 'required|array',
                    ]);
                    foreach ($field->questions as $question) {
                        $request->validate([
                            "data.{$field->name}.{$question->name}" => 'required|numeric',
                        ]);
                    }
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|array',
                    ]);
                    foreach ($field->questions as $question) {
                        $request->validate([
                            "data.{$field->name}.{$question->name}" => 'nullable|numeric',
                        ]);
                    }
                }
            } elseif (
                $field->type === "textbox_list" ||
                $field->type === "radio_grid" ||
                $field->type === "likert_grid"
            ) {
                if ($field->required) {
                    $request->validate([
                        "data.{$field->name}" => 'required|array',
                    ]);
                    foreach ($field->questions as $question) {
                        $request->validate([
                            "data.{$field->name}.{$question->name}" => 'required|string',
                        ]);
                    }
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|array',
                    ]);
                    foreach ($field->questions as $question) {
                        $request->validate([
                            "data.{$field->name}.{$question->name}" => 'nullable|string',
                        ]);
                    }
                }
            } elseif ($field->type === "drag_and_drop_ranking") {
                if ($field->required) {
                    $request->validate([
                        "data.{$field->name}" => 'required|array|size:' . count($field->options),
                    ]);
                    // all of options->value are inside the array
                    $request->validate([
                        "data.{$field->name}.*" => 'required|string|in:' . implode(',', array_column($field->options, 'value'))
                    ]);
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|array|size:' . count($field->options),
                    ]);
                    $request->validate([
                        "data.{$field->name}.*" => 'nullable|string|in:' . implode(',', array_column($field->options, 'value'))
                    ]);
                }
            } elseif ($field->type === "date_picker") {
                if ($field->required) {
                    $request->validate([
                        "data.{$field->name}" => 'required|date|after_or_equal:' . $field->min . '|before_or_equal:' . $field->max,
                    ]);
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|date|after_or_equal:' . $field->min . '|before_or_equal:' . $field->max,
                    ]);
                }
            } elseif ($field->type === "checkbox_grid") {
                if ($field->required) {
                    $request->validate([
                        "data.{$field->name}" => 'required|array',
                    ]);
                    foreach ($field->questions as $question) {
                        $request->validate([
                            "data.{$field->name}.{$question->name}" => 'required|array',
                            "data.{$field->name}.{$question->name}.*" => 'required|string|in:' . implode(',', array_column($field->options, 'value')),
                        ]);
                    }
                } else {
                    $request->validate([
                        "data.{$field->name}" => 'nullable|array',
                    ]);
                    foreach ($field->questions as $question) {
                        $request->validate([
                            "data.{$field->name}.{$question->name}" => 'nullable|array',
                            "data.{$field->name}.{$question->name}.*" => 'nullable|string|in:' . implode(',', array_column($field->options, 'value')),
                        ]);
                    }
                }
            } elseif ($field->type === "slider") {
                $request->validate([
                    "data.{$field->name}" => 'required|numeric|between:' . $field->min . ',' . $field->max . '|multiple_of:' . $field->step,
                ]);
            } elseif ($field->type === "slider_list") {
                $request->validate([
                    "data.{$field->name}" => 'required|array',
                ]);
                foreach ($field->questions as $question) {
                    $request->validate([
                        "data.{$field->name}.{$question->name}" => 'required|numeric|between:' . $field->min . ',' . $field->max . '|multiple_of:' . $field->step,
                    ]);
                }
            }
        }

        $answer = $survey->answers()->create([
            'survey_id' => $survey->id,
            'contents' => json_encode($request->data),
        ]);

        $answer->ip()->create(['ip' => $request->ip()]);

        return response()->json([
            'message' => 'success',
            'data' => $answer,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function mobileAnswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'survey_id' => 'required|exists:surveys,id',
            'data' => 'required|array',
        ]);
        if ($validator->failed()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
                'data' => $validator->messages()
            ], 422);
        }
        $validatorType = Validator::make($request->data, [
            '*.type' => 'required|in:text,description,select,radio,likert,image_singleselect,checkbox,image_multiselect,continuous_sum,textbox_list,radio_grid,likert_grid,drag_and_drop_ranking,date_picker,checkbox_grid,slider',
        ]);
        if ($validatorType->failed()) {
            return response()->json([
                'status' => false,
                'message' => $validatorType->messages()->first(),
                'data' => $validatorType->messages()
            ], 422);
        }
        $data = (object) collect($request->data)->mapWithKeys(function ($value,$key){
           if (array_key_exists('answer',$value)){
               if ($value['type']==="textbox_list"){
                   $option = (object) collect($value['answer'])->mapWithKeys(function ($v,$k){
                       if (array_key_exists('answer',$v)){
                           return [
                               $v['name'] => $v['answer']
                           ];
                       }
                       return [
                           $v['name'] => null
                       ];
                   });
                   return [
                       $value['name'] => (object)collect($option)->filter(function($value, $key) {
                           return  $value != null;
                       })->toArray()
                   ];
               }
               return [
                   $value['name'] => $value['answer']
               ];
           }
           return [
               $value['name'] => null
           ];
        })->toArray();
        $filter = (object)collect($data)->filter(function($value, $key) {
            return  $value != null;
        })->toArray();
        $survey = Survey::find($request->survey_id);
        $answer = $survey->answers()->create([
            'survey_id' => $survey->id,
            'contents' => json_encode($filter),
        ]);
        $answer->ip()->create(['ip' => $request->ip()]);
        return response()->json([
            'message' => 'success',
            'data' => $answer,
        ]);
    }
}
