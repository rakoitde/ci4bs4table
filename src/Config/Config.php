<?php

namespace Rakoitde\Ci4bs4table\Config;

/**
 * This class describes the default ci4table configuration.
 */
class Config
{
    /**
     * sets table size to small
     */
    public bool $small = true;

    /**
     * table striped
     */
    public bool $striped = true;

    /**
     * table hoover
     */
    public bool $hover = true;

    /**
     * table is sortable
     */
    public bool $sortable = true;

    /**
     * table is filterable
     */
    public bool $filterable = true;

    /**
     * paginate table
     */
    public bool $paginate = true;

    /**
     * prefix for all sort vars
     */
    public string $sortvar = '_sort';

    /**
     * prefix for the search var
     */
    public string $searchvar = '_search';

    /**
     * prefix for all filter vars
     */
    public string $filtervar = '_filter';

    /**
     * prefix for the perpage var
     */
    public string $perpagevar = '_perpage';

    /**
     * options for the per page size select
     */
    public array $perpage_sizes = [10, 15, 20, 25, 50, 100, 200, 500];

    /**
     * default per page size
     */
    public int $perpage = 15;

    /**
     * default formats for field types
     */
    public array $format = ['date' => 'd.m.Y',       // 01.01.2021
        'datetime'                 => 'd.m.Y H:i:s', // 01.01.2021 12:30:00
        'decimal'                  => '2',           // precision 123,45
        'float'                    => '2',           // precision 123,45
        'currency'                 => 'EUR',         // 1.234,56 €
    ];

    /**
     * default options for field types
     */
    public array $options = [
        'checkbox' => ['1' => 'Ja', '0' => 'Nein'],
    ];

    /**
     * used template config
     */
    public string $templatename = 'TemplateBS4';
}
