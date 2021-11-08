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
	public string $size = "";

    public bool $striped = true;

    public bool $hover = true;

    /*
    |--------------------------------------------------------------------------
    | Method to get the requested variables
    |--------------------------------------------------------------------------
    |
    | Set this variable to "get" or "post". But Post are actually not tested
    |
    */
    public string $method = "get";


    public bool $sortable = true;


    public bool $filterable = true;


    public bool $paginate = true;

    /*
    |--------------------------------------------------------------------------
    | Sort
    |--------------------------------------------------------------------------
    |
    | Set the sort variable which holds the selected sorts
    |
    */
    public string $sortvar = "_sort_";

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    |
    | Set the search variable is used in a fulltext search field
    |
    */
    public string $searchvar = "_search_";

    /*
    |--------------------------------------------------------------------------
    | Filter
    |--------------------------------------------------------------------------
    |
    | Set the filter variable which holds the selected filters
    |
    */
    public string $filtervar = "_filter_";

    /*
    |--------------------------------------------------------------------------
    | Per Page Pagination Variable
    |--------------------------------------------------------------------------
    |
    | Set the perpage variable which holds the selected per page size
    |
    */
    public string $perpagevar = "_perpage_";


    public array $perpage_sizes = [10,15,20,25,50,100,200,500];

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
                            "decimal"  => "2",           # precision 123,45
                            "float"    => "2",           # precision 123,45
                            "currency" => "EUR",         # 1.234,56 €
                        ];

    public array $options = [
        'checkbox' => ['1' => 'Ja', '0' => 'Nein'],
    ];  

    /*
    |--------------------------------------------------------------------------
    | Directionicon
    |--------------------------------------------------------------------------
    |
    | Define the default Icons for the sort directions.
    |
    */
    public array $directionicon = [
                ''=>'', 
                'asc'=>'<i class="bi bi-sort-down-alt"></i>', 
                'desc'=>'<i class="bi bi-sort-up"></i>'
        ];


    public string $templatename = 'TemplateBS4';

}
