<?php

/**
 * Class Shop_Page_WP_Authenticate_License
 * verify license key for advanced features
 */
class Shop_Page_WP_Authenticate_License
{
    /**
     * @return boolean
     */
    public static function authenticate()
    {
        /**
         * 1. Check if the license key has been hardcoded into the list of white-listed keys?
         * Not sure if this will be a security vulnerability, but probably not since I don't need to save anything in plain text. So just hardcode an array of encrypted hashes to verify against the entered key.
         * 2. If key doesn't exist there, then I can query the API to get it. And this probably won't be necessary since you can hardcode something like 1000 keys into the plugin.
         */
        return true;
        //return false;
    }
}
