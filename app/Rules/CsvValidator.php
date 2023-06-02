<?php

namespace App\Rules;

use App\Models\Training;
use App\Models\LearningSpecialty;
use App\Models\Unit;
use App\Traits\CsvFIleupload;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CsvValidator implements Rule
{
    use CsvFIleupload;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $rules;
    public $csvdata;
    public $errors = [];

    public function __construct($rules)
    {
        $this->rules = $rules;
        $this->errors = [];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!file_exists($value) || !is_readable($value)) {
            return false;
        }
        $csvData = $this->getCsvAsArray($value);

        $errors = [];
        foreach ($csvData as $rowIndex => $csvValues) {

            $validator = Validator::make($csvValues, $this->rules);
            if (!empty($this->headingRow)) {
                $validator->setAttributeNames($this->headingRow);
            }
            if ($validator->fails()) {
                $errors[$rowIndex] = $validator->messages()->toArray();
            }
        }
        $this->errors = $errors;

        return count($this->errors) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = '';
        foreach ($this->errors as $key => $error) {
            foreach ($error as $field => $value) {

                if ($field == 'Training') {

                    $training = Training::get()->pluck('id')->toArray();
                    for ($i=0; $i < count($value) ; $i++) {
                        $message .= 'The ' . $value[$i] . ' entered is not correct please select from any of these training - ' . implode(',', $training);
                    }

                }else if($field == 'LS'){
                    $ls = LearningSpecialty::get()->pluck('id')->toArray();
                    for ($i=0; $i < count($value) ; $i++) {
                        $message .= 'The ' . $value[$i] . ' entered is not correct please select from any of these learning specialty - ' . implode(',', $ls);
                    }
                }else if($field == 'Units'){
                    $units = Unit::where('ls_id',$value)->get()->pluck('id')->toArray();
                    for ($i=0; $i < count($value) ; $i++) {
                        $message .= 'The ' . $value[$i] . ' entered is not correct please select from any of these unit - ' . implode(',', $units);
                    }
                } else {
                    foreach ($value as $val) {
                        if (strlen($message) > 0) {
                            $message .= ', ' . str_replace('.', '', $val) . ' at ' . ($key + 2);
                        } else {
                            $message .= str_replace('.', '', $val) . ' at ' . ($key + 2);
                        }
                    }
                }
            }
        }

        return strlen($message) > 0 ? $message : 'This file have some incorrect values';
    }
}
