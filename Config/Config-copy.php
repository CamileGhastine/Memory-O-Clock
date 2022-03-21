<?php

namespace Config;

/**
 * Configuration
 */
class Config
{
    /**
     * Database configuration
     *
     * @return array
     */
    public static function configDB()
    {
        return [
            'db_host' => 'localhost',
            'db_name' => 'memory',
            'db_user' => 'root',
            'db_pass' => ''
        ];
    }
}
