<?php


namespace PortWallet\SDK\Traits;


use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator as jsonValidator;
use PortWallet\SDK\Exceptions\PortWalletClientException;

trait Validator
{
    public function validate(&$data, $name)
    {
        $validator = new jsonValidator;
        $validator->validate($data, (object)['$ref' => 'file://' . realpath(__DIR__ . "/../Schema/".$name.".json")], Constraint::CHECK_MODE_APPLY_DEFAULTS);

        if (!$validator->isValid()) {
            $error = $validator->getErrors()[0];

            throw new PortWalletClientException($error['property'] . ' ' . strtolower($error['message']), 422);
        }
    }
}
