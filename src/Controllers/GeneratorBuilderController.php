<?php

namespace InfyOm\GeneratorBuilder\Controllers;

use App\Http\Controllers\Controller;
use Artisan;
use File;
use InfyOm\GeneratorBuilder\Requests\BuilderGenerateRequest;
use Response;

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

        $res = Artisan::call($data['commandType'], [
            'model' => $data['modelName'],
            '--jsonFromGUI' => json_encode($data)
        ]);

        return Response::json("Files created successfully");
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