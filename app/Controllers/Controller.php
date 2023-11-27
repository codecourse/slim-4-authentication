<?php

namespace App\Controllers;

use Valitron\Validator;
use App\Exceptions\ValidationException;
use Psr\Http\Message\ServerRequestInterface;

class Controller
{
    public function validate(ServerRequestInterface $request, array $rules = [])
    {
        $validator = new Validator(
            $params = $request->getParsedBody()
        );

        $validator->mapFieldsRules($rules);

        if (!$validator->validate()) {
            throw new ValidationException(
                $validator->errors(),
                $request->getUri()->getPath()
            );
        }

        return $params;
    }
}
