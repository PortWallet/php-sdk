<?php


namespace PortWallet\SDK\Traits;


use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator as jsonValidator;

trait Validator
{
    public function validate(&$data, $name)
    {
        $validator = new jsonValidator;
        $validator->validate($data, (object)['$ref' => 'file://' . realpath(__DIR__ . "/../Schema/".$name.".json")], Constraint::CHECK_MODE_APPLY_DEFAULTS);

        return $validator;
    }

    /**
     * Errors extractions
     *
     * @param [type] $explanation
     * @return array
     */
    public function commonError($explanation)
    {
        $response = [
            'error' => [
                'cause' => "INVALID_REQUEST",
                'explanation' => $explanation,
            ],
            'result' => 'ERROR',
        ];
        if (is_array($explanation)) {
            $response['error']['explanation'] = sprintf("%s field has error it's %s", $explanation[0]['property'], $explanation[0]['message']);
            $response['error']['property'] = $explanation[0]['property'];
        }
        return $response;
    }
}
