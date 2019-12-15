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
    function array_collapse()
    {
        return [];
    }
}

if (! function_exists('array_first')) {
    /**
     *
     * @return mixed
     */
    function array_first()
    {
        return NULL;
    }
}
