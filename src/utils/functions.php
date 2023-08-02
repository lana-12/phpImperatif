<?php

/**
 * Sort by alpha order
 * @param array $users
 * @param string $sort
 * @param string $order
 * @return array
 */
function sortAlpha(&$users, $sort, $order)
{
    //Check params
    // dump('sort : ' .$sort);
    // dump('order : '.$order);
    $cmp = function ($a, $b) use ($sort, $order) {
        if ($order === 'asc') return strcmp($a[$sort], $b[$sort]);
        else return strcmp($b[$sort], $a[$sort]);
    };
    // sorts multi-dimensional arrays
    usort($users, $cmp);
}


/**
 * Retrieves order based on what has already been clicked via $_GET
 * @return array 
 */
function getSortOrder()
{
    $sorts = [
        "firstname" => "asc",
        "lastname" => "asc",
        "email" => "asc"
    ];

    // Checking the sort and order keys in the querystring
    if (isset($_GET["sort"])) {
        if (isset($_GET["order"])) {
            $sorts[$_GET["sort"]] = $_GET["order"] === "asc" ? "desc" : "asc";
        }
    }
    return $sorts;
}


/**
 * makes var_dump more readable
 * @param variable
 * @return void
 */
function dump($variable)
{
    echo '
        <pre>';

            var_dump($variable);
    echo 
        '</pre>';
}
