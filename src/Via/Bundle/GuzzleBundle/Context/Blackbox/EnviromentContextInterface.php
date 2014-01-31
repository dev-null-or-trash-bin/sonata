<?php
namespace Via\Bundle\GuzzleBundle\Context\Blackbox;

interface EnviromentContextInterface
{
    public function getDefaultEnviroment();
    public function getEnviroment();
    public function setEnviroment($enviroment);
}