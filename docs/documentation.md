# Documentation

## Table of Contents

- [New Chart](#New-Chart)
- [Chart Types](#Chart-Types)
- [Add Data](#Add-Data)
- [Format Charts](#Format-Charts)

## New Chart

### Used Namespaces

```php
use Rakoitde\ChartJs\Chart;
use Rakoitde\ChartJs\Data\Dataset;
```

### Create new Chart

```php
$chart = new Chart();
$chart->Data()->Labels(['January', 'February', 'March', 'April' ,'Juni', 'Juli', 'August', 'September']);

$dataset = new Dataset();
$dataset->Label('Count');
$dataset->Data([450, 45, 550, 50, 450, 60, 550, 55]);

$chart->Data()->Dataset($dataset);
```

### Print out new Chart

```php
$chart->toHtml();
$chart->toJs();
```

## Chart Types

```php
$chart = new Chart();

# Bar (default)
$chart->type = 'bar';
#or
$chart->asBar();

# Line
$chart->type = 'line';
#or
$chart->asLine();

# Other
$chart->type = 'pie';
```

## Add Data

### Add Dataset

```php
$dataset = new Dataset();
$dataset->Label('Count');
$dataset->Data([450, 45, 550, 50, 450, 60, 550, 55]);
$chart->Data()->Dataset($dataset);
```

Set BackgroundColors, BorderColors and BorderWidth on dataset

```php
$dataset = new Dataset();
$dataset->Data([450, 50, 550, 50, 450, 50, 550, 50]);
# predefined BackgroundColors
$dataset->BackgroundColor($chart->Data()->BackgroundColors());
# predefined BorderColors
$dataset->BorderColor($chart->Data()->BorderColors());
# or single Color
$dataset->BorderColor('lightgrey');
$dataset->BorderWidth(1);
```

### Add Datasets

```php
$dataset = new Dataset();
$dataset->Label('Count');
$dataset->Data([450, 45, 550, 50, 450, 60, 550, 55]);
$datasets[] = $dataset;

$dataset = new Dataset();
$dataset->Label('Sum');
$dataset->Data([50, 450, 60, 550, 450, 45, 550, 55]);
$datasets[] = $dataset;

$chart->Data()->Datasets($datasets);
```

### Add Pivot Data

```php
$keys = ['Title', 'January', 'February', 'March', 'April' ,'Juni', 'Juli', 'August', 'September'];
$pivot[] = array_combine($keys, ['Bar 1', 50, 200, 35, 500, 550, 50, 450, 50]);
$pivot[] = array_combine($keys, ['Bar 2', 450, 50, 550, 50, 50, 200, 35, 500]);
$pivot[] = array_combine($keys, ['Bar 3', 50, 200, 35, 500, 550, 50, 50, 200]);
$pivot[] = array_combine($keys, ['Bar 4', 450, 50, 550, 50, 450, 50, 550, 50]);

$chart->PivotData($pivot);
```

Pivot Array

```php
Array
(
    [0] => Array
        (
            [Title] => Bar 1
            [January] => 50
            [February] => 200
            [March] => 35
            [April] => 500
            [Juni] => 550
            [Juli] => 50
            [August] => 450
            [September] => 50
        )

    [1] => Array
        (
            [Title] => Bar 2
            [January] => 450
            [February] => 50
            [March] => 550
            [April] => 50
            [Juni] => 50
            [Juli] => 200
            [August] => 35
            [September] => 500
        )

    [2] => Array
        (
            [Title] => Bar 3
            [January] => 50
            [February] => 200
            [March] => 35
            [April] => 500
            [Juni] => 550
            [Juli] => 50
            [August] => 50
            [September] => 200
        )

    [3] => Array
        (
            [Title] => Bar 4
            [January] => 450
            [February] => 50
            [March] => 550
            [April] => 50
            [Juni] => 450
            [Juli] => 50
            [August] => 550
            [September] => 50
        )

)
```

## Format Charts

### Disable Legend

This excample hides the Legend.

```php
$chart->Options()->Legend()->Display(false);
```

### Stacked

Line and Bar charts can be configured into stacked area charts

```php
$chart->Stacked();
```

### Begin at zero

Scale will include 0 if it is not already included

```php
$chart->BeginAtZero();
```

### Change Dataset Type

Change type of dataset 3 to 'line'

```php
$chart->Data()->Datasets()[3]->Type('line');
```

### Show or hide line

This excample hide lines on Dataset 3

```php
$chart->Data()->Datasets()[3]->ShowLine(false);
```

### Disable bezier curves

```php
$chart->Options()->Elements()->Line()->Tension(0);
```

### Tooltip Mode

```php
$chart->TooltipMode(TooltipMode::INDEX);
# or
$chart->TooltipMode('index');
```

Predefined enumerations

```php
class TooltipMode
{
    const DATASET = 'dataset';
    const INDEX   = 'index';
    const NEAREST = 'nearest';
    const POINT   = 'point';
    const X       = 'x';
    const Y       = 'y';
}
```


