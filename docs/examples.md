# Examples

## Table of Contents

- [Full Example](#Full-Example)
- [HTML output](#HTML-output)

## Simplest way to use ci4bs4table

Start with the controller.
To convert dates and numbers we need this two helpers.

```php
<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use Rakoitde\Ci4bs4table\Table;

class TableController extends BaseController
{

    protected $helpers = ['date','number'];

    public function index()
    {

        $table = new Table('App\Models\UserModel');

        $data = [
            'table'   => $table,
        ];

        return view('TableTest', $data);

    }   

}
```

In the TableTest view, we need the search inline form which we can place in a bootstrap navbar.
```php
<?= $table->getSearchInlineForm() ?>
```
Next step is to parse the table.
```php
<?= $table->parse() ?>
```
For the filter functionalities import the javascript view
```php
<?= $this->include('Rakoitde\Ci4bs4table\Views\ci4bs4table_js') ?>
```

Full view excample
```php 
<!-- Content -->
<?= $this->section('content') ?>
<!-- ################ Start: Content ################ --> 

<!-- Start: Header -->
<nav class="navbar navbar-expand-lg navbar-light border-bottom px-0">
  <h1 class="h2">Ci4bs4table:  <span class="text-secondary">Test</span></h1>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto">

    </ul>

    <?= $table->getSearchInlineForm() ?>

  </div>
</nav>
<!-- End: Header -->

<!-- Start: Table -->
<?= $table->parse() ?>
<!-- End: Table -->


<!-- ################ Stop: Content ################ -->
<?= $this->endSection() ?>


<!-- Custom JS -->
<?= $this->section('custom_js') ?>

<?= $this->include('Rakoitde\Ci4bs4table\Views\ci4bs4table_js') ?>

<?= $this->endSection() ?>
```

## Table

In CodeIgniter 4 Controller

### Table instance
```php
$table = new Table('App\Models\UserModel');
// or
$model = new \App\Models\UserModel;
$table = new Table($model);

```

### Table ID
By default, ci4bs4table use the table name of the model as table id.
We can change this.

```php
$table->Id("tableid");
```

### Table Caption
Adds a table caption. If pagination is enabled, more than one caption is shown.
```php
$table->Caption("Table Caption");
```

### Table Classes
```php
$table->addClass("myclass");             // myclass 
$table->addClass("myclass1 myclass2");   // myclass1 myclass2 
```

### Bootstrap Table Classes
```php
$table->Small();       // table-sm
$table->Dark();        // table-dark
$table->Light();       // table-light
$table->Striped();     // table-striped
$table->Bordered();    // table-bordered
$table->Borderless();  // table-borderless
$table->Hover();       // table-hover
```

### Codeigniter Uri
By default, ci4bs4table use the current uri of the page.
We can change this.
```php
// https://your.site.com/table
$table->Uri('table');
```

## Table Columns

If no column adds manually, all field are added as columns.

### Add all Columns manually

```php
$table->addColumns();
```

### Add a Column

```php
$table->addColumn("table_fieldname");
```

### Select a Column

```php
$table->Column("table_fieldname");

```
After that we can do changes on the column

### Remove a Column

```php
$table->addColumns();
$table->removeColumn("not_needed_fieldname");

```

### Align a Column
```php
$table->addColumn("align_right_fieldname")->Right();
$table->addColumn("align_center_fieldname")->Center();
```

### Set Column Label

```php
$table->addColumn('id')->Label("#");
```

### Set Options

With options we can replace values in filter checkboxes and in cells.

```php
$table = new Table('App\Models\UserModel');
// Options
$options["enabled"] = ["1"=>"Yes","0"=>"No"];
$options["surname"] = ["Ralf"=>" R-A-L-F "];
$table->Options($options);
```

### Replace default value with custom html code


```php
$table->addColumn()->Html('<button class="btn btn-sm btn-primary" type="button">Edit {id}</button>');
$table->addColumn()->Html('<button class="btn btn-sm btn-danger" type="submit">Remove {id}</button>');
```

### Replace default value with icons based on condition

In this excample we use Bootstrap icons.

```php
    $table->addColumns();
    $table->Column("enabled")->Icon('check-lg',["{enabled}","==","1"],'text-success');
    $table->Column("enabled")->Icon('x-lg',    ["{enabled}","==","0"],'text-danger' );
    // or
    $table->addColumn('enabled')
        ->Icon('check-lg',["{enabled}","==","1"],'text-success')
        ->Icon('x-lg',["{enabled}","==","0"],'text-danger');
```

## Sort

As default, all fields are marked as sortable. In config file we can change the default on false.

### Make Table Column Sortable
To make a table column sortable, you must set the sorted field.

```php
$table->Column("enabled")->Sort();
```

## Filter

### Make Table Column Filterable
As default, all fields are marked as filterable. In config file we can change the default on false.

```php
$table->Column("enabled")->Filter("checkbox");
```
