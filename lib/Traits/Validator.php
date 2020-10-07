<?php


namespace PortWallet\Traits;


use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator as jsonValidator;
use PortWallet\Exceptions\PortWalletClientException;

trait Validator
{
    public function validate(&$data, $name)
    {
        $json = json_decode(json_encode($data));
        $validator = new jsonValidator;
        $validator->validate($json, (object)['$ref' => 'file://' . realpath(__DIR__ . "/../Schema/" . $name . ".json")], Constraint::CHECK_MODE_APPLY_DEFAULTS);

        if (!$validator->isValid()) {
            $error = $validator->getErrors()[0];

            throw new PortWalletClientException($error['property'] . ' ' . strtolower($error['message']), 422);
        }
    }
}
