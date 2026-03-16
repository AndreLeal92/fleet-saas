<?php

class Tenant {

    private static $company_id = null;

    public static function set($company_id)
    {
        self::$company_id = $company_id;
    }

    public static function id()
    {
        if (self::$company_id === null) {
            throw new Exception("Tenant não definido.");
        }

        return self::$company_id;
    }

}