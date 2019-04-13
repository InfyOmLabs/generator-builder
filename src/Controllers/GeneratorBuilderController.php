<?php

namespace InfyOm\GeneratorBuilder\Controllers;

use App\Http\Controllers\Controller;
use Artisan;
use File;
use Illuminate\Support\Collection;
use InfyOm\GeneratorBuilder\Requests\BuilderGenerateRequest;
use Illuminate\Http\UploadedFile;
use Response;
use Request;

class GeneratorBuilderController extends Controller
{
    public function builder()
    {
        return view(config('infyom.generator_builder.views.builder'));
    }
    
    public function fieldTemplate()
    {
        return view(config('infyom.generator_builder.views.field-template'));
    }

    public function generate(BuilderGenerateRequest $request)
    {
        $data = $request->all();

        // Validate fields
        if (isset($data['fields'])) {
            $this->validateFields($data['fields']);
        }

        $res = Artisan::call($data['commandType'], [
            'model' => $data['modelName'],
            '--jsonFromGUI' => json_encode($data)
        ]);

        return Response::json("Files created successfully");
    }

    public function rollback()
    {
        $data = Request::all();
        $input = [
            'model' => $data['modelName'],
            'type'  => $data['commandType'],
        ];

        if (!empty($data['prefix'])) {
            $input['--prefix'] = $data['prefix'];
        }

        Artisan::call('infyom:rollback', $input);

        return Response::json(['message' => 'Files rollback successfully'], 200);
    }

    public function generateFromFile()
    {
        $data = Request::all();

        /** @var UploadedFile $file */
        $file = $data['schemaFile'];
        $filePath = $file->getRealPath();
        $extension = $file->getClientOriginalExtension(); // getting file extension
        if ($extension != 'json') {
            throw new \Exception('Schema file must be Json');
        }

        Artisan::call($data['commandType'], [
            'model'        => $data['modelName'],
            '--fieldsFile' => $filePath,
            '--skip'       => 'forceMigrate',
        ]);

        return Response::json(['message' => 'Files created successfully'], 200);
    }

    private function validateFields($fields)
    {
        $fieldsGroupBy = collect($fields)->groupBy(function ($item) {
            return strtolower($item['name']);
        });

        $duplicateFields = $fieldsGroupBy->filter(function (Collection $groups) {
            return $groups->count() > 1;
        });
        if (count($duplicateFields)) {
            throw new \Exception('Duplicate fields are not allowed');
        }

        return true;
    }

//    public function availableSchema()
//    {
//        $schemaFolder = config('infyom.laravel_generator.path.schema_files', base_path('resources/model_schemas/'));
//
//        if (!File::exists($schemaFolder)) {
//            return [];
//        }
//
//        $files = File::allFiles($schemaFolder);
//
//        $modelNames = [];
//
//        foreach ($files as $file) {
//            if(File::extension($file) == "json") {
//                $modelNames[] = File::name($file);
//            }
//        }
//
//        return Response::json($modelNames);
//    }
//
//    public function retrieveSchema($schema)
//    {
//        $schemaFolder = config('infyom.laravel_generator.path.schema_files', base_path('resources/model_schemas/'));
//
//        $filePath = $schemaFolder . $schema . ".json";
//
//        if (!File::exists($filePath)) {
//            return Response::json('not found', 402);
//        }
//
//        return Response::json(json_decode(File::get($filePath)));
//    }
}