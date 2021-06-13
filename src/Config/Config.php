<?php

namespace Rakoitde\Ci4bs4table\Config;

class Config
{

	public string $size = "sm";

    public string $method = "get";

    public string $sortvar = "_sort";

    public string $searchvar = "_search";

    public string $filtervar = "_filter";

    public string $perpagevar = "_perpage";

    public int $perpage = 15;

    public string $icontag = '<i class="bi bi-{icon}{class}"></i>';

    public array $format = ["date"     => "d.m.Y",
                            "datetime" => "d.m.Y H:i:s"];

}
