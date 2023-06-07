<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CsvValidator;

class TraineeImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'upload_csv'        => ['mimes:csv,txt,xls,xlsx', new CsvValidator([
                'Name'         => 'required',
                'Gender'        => ['required', 'in:Male,Female'],
                'Training Program'=> ['required', 'exists:trainings,id'],
                'Location'      => 'required',
                // 'LS'            => ['required', 'exists:learning_specialties,id'],
                // 'Units'         => ['required', 'exists:units,id'],
                'University'    => 'required|string',
                'Start Date'    => 'required',
                'End Date'      => 'required',
            ])],
        ];
    }

    public function attributes()
    {
        return  [
            'upload_csv' => 'upload excel',
        ];
    }
}
