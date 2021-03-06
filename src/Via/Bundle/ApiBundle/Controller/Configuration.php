<?php
namespace Via\Bundle\ApiBundle\Controller;

use Doctrine\Common\Inflector\Inflector;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Util\Debug;
/**
 * Resource controller configuration.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class Configuration
{
    protected $parameters;

    /**
     * Current request.
     *
     * @var Request
     */
    protected $request;

    public function __construct()
    {
        $this->parameters = array();
    }

    public function load(Request $request)
    {
        $this->request = $request;

        $parameters = $request->attributes->get('_via', array());
        $parser = new ParametersParser();

        $parameters = $parser->parse($parameters, $request);

        $this->parameters = $parameters;
    }

    public function isApiRequest()
    {
        return 'html' !== $this->request->getRequestFormat();
    }

    public function getRedirectRoute($name)
    {
        $redirect = $this->get('redirect');

        if (null === $redirect) {
            return $this->getRouteName($name);
        }

        if (is_array($redirect)) {
            return $redirect['route'];
        }

        return $redirect;
    }

    public function getRedirectParameters()
    {
        $redirect = $this->get('redirect');

        if (null === $redirect || !is_array($redirect)) {
            return array();
        }

        return $redirect['parameters'];
    }

    public function getLimit()
    {
        $limit = $this->get('limit', 10);

        if (false === $limit) {
            return null;
        }

        return (int) $limit;
    }

    public function isPaginated()
    {
        return (Boolean) $this->get('paginate', true);
    }

    public function getPaginationMaxPerPage()
    {
        return (int) $this->get('paginate', 10);
    }

    public function isFilterable()
    {
        return (Boolean) $this->get('filterable', false);
    }

    public function getCriteria()
    {
        $defaultCriteria = $this->get('criteria', array());

        if ($this->isFilterable()) {
            return array_merge($defaultCriteria, $this->request->get('criteria', array()));
        }

        return $defaultCriteria;
    }

    public function isSortable()
    {
        return (Boolean) $this->get('sortable', false);
    }

    public function getSorting()
    {
        $defaultSorting = $this->get('sorting', array());

        if ($this->isSortable()) {
            return array_merge($defaultSorting, $this->request->get('sorting', array()));
        }

        return $defaultSorting;
    }

    public function getMethod($default)
    {
        return $this->get('method', $default);
    }

    public function getArguments(array $default = array())
    {
        return $this->get('arguments', $default);
    }

    public function getFlashMessage($message = null)
    {
        $message = sprintf('%s.%s.%s', $this->bundlePrefix, $this->resourceName, $message);

        return $this->get('flash', $message);
    }

    protected function get($parameter, $default = null)
    {
        return isset($this->parameters[$parameter]) ? $this->parameters[$parameter] : $default;
    }
}
