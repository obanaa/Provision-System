<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 19.07.16
 * Time: 10:48
 */

namespace Page;


class InfobizzerMainPage
{

    public static $signInLink = '//*[@id="navMenu"]/ul/li[6]/a';

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

}