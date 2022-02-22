<?php

namespace InfyOm\GeneratorBuilder\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class BuilderGenerateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'modelName'   => 'required',
            'fields'      => 'required',
            'commandType' => 'required',
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param array $errors
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        $messages = implode(' ', array_flatten($errors));

        return Response::json($messages, 400);
    }
}
