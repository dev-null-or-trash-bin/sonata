<?php
namespace Via\Bundle\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @author thoffmann
 *
 */
class ParametersParser
{
    public function parse(array $parameters, Request $request)
    {
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $parameters[$key] = $this->parse($value, $request);
            }

            if (is_string($value) && 0 === strpos($value, '$')) {
                $parameters[$key] = $request->get(substr($value, 1));
            }
        }

        return $parameters;
    }
}
