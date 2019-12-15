<?php

if (! function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  array  $array
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        if (is_null($key) || trim($key) == '') {
            return $array;
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !isset($array[$segment])) {
                return value($default);
            }

            $array = $array[$segment];
        }

        return $array;
    }
}

if (! function_exists('array_collapse')) {
    /**
     *
     * @return array
     */
    function array_collapse(array $source)
    {
        $results = [];
        //array_walk_recursive($source, function ($item, $key) use (&$results){
        array_walk($source, function ($item, $key) use (&$results){
            $results = is_array($item) ? array_merge($results, $item) : $results;
        });
        return $results;
    }
}

if (! function_exists('array_first')) {
    /**
     *
     * @return mixed
     */
    function array_first(array $source, callable $callback, $default = null)
    {
        foreach ($source as $k => $v) {
            if (call_user_func_array($callback, [$k, $v])) {
                return $v;
            }
        }
        return $default;
    }
}
