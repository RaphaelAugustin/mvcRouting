<?php
/**
 * Created by PhpStorm.
 * User: TaF
 * Date: 07/05/2015
 * Time: 09:31
 */

namespace Taf\Controllers;


use Symfony\Component\Yaml\Yaml;
use Taf\Model\UserManager;


class AbstractBaseController {



    public function getConnection() {
        $config = new \Doctrine\DBAL\Configuration();

        $connectionParams = Yaml::parse("../../config/config.yml");


        return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }

    protected function getUserManager() {
        return new UserManager($this->getConnection());
    }
}