<?php

    /**
     * It returns you the request url
     *
     * @return string
     */
    function url(){
        return $_GET['url']??"";
    }

    /**
     * It returns the arguments associated with a particular controller
     *
     * @return Array
     */
    function args(){
     
           $parts = explode("/",url());  
            return $parts;          
    }
   
    /**
     * Set Response Headers 
     *
     * @param [Associative Array] $args
     * @return void
     */
    function setHeader($args)
    {
        foreach($args as $arg_name => $arg_value)
        {   
            header("{$arg_name}:{$arg_value}");
        }
    }

    /**
     * It gets request body (json)
     *
     * @return Object
     */
    function request()
    {
        return json_decode(file_get_contents("php://input"));
    }

    /**
     * It converts an array in json and prints same
     *
     * @param [Array] $arr
     * @return void
     */
    function json($arr)
    {
        print_r(json_encode($arr));
    }