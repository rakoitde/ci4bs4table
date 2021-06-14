<?php

namespace Rakoitde\Ci4bs4table\Config;

class Config
{

    /*
    |--------------------------------------------------------------------------
    | Bootstrap Small Table
    |--------------------------------------------------------------------------
    |
    | To use the Bootstrap Small Table, set this variable to "sm", otherwise
    | set this variable to ""
    |
    */
	public string $size = "sm";

    /*
    |--------------------------------------------------------------------------
    | Method to get the requested variables
    |--------------------------------------------------------------------------
    |
    | Set this variable to "get" or "post". But Post are actually not tested
    |
    */
    public string $method = "get";

    /*
    |--------------------------------------------------------------------------
    | Sort
    |--------------------------------------------------------------------------
    |
    | Set the sort variable which holds the selected sorts
    |
    */
    public string $sortvar = "_sort";

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    |
    | Set the search variable is used in a fulltext search field
    |
    */
    public string $searchvar = "_search";

    /*
    |--------------------------------------------------------------------------
    | Filter
    |--------------------------------------------------------------------------
    |
    | Set the filter variable which holds the selected filters
    |
    */
    public string $filtervar = "_filter";

    /*
    |--------------------------------------------------------------------------
    | Per Page Pagination Variable
    |--------------------------------------------------------------------------
    |
    | Set the perpage variable which holds the selected per page size
    |
    */
    public string $perpagevar = "_perpage";

    /*
    |--------------------------------------------------------------------------
    | Per Page Pagination Value
    |--------------------------------------------------------------------------
    |
    | Set the default per page size
    |
    */
    public int $perpage = 15;

    /*
    |--------------------------------------------------------------------------
    | Icontag
    |--------------------------------------------------------------------------
    |
    | Define the icon-tag template. {icon} holds the icon class and {class} additional
    | classes like "text-warning" color.
    |
    */
    public string $icontag = '<i class="bi bi-{icon}{class}"></i>';

    /*
    |--------------------------------------------------------------------------
    | Format
    |--------------------------------------------------------------------------
    |
    | Define the default format for different type of data.
    |
    */
    public array $format = ["date"     => "d.m.Y",       # 01.01.2021
                            "datetime" => "d.m.Y H:i:s", # 01.01.2021 12:30:00
                            "number"   => "2",           # precision 123,45
                            "currency" => "EUR",         # 1.234,56 €
                        ];

}
