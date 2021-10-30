# Templates

A simple template manager to replace placeholders inside strings.

## Usage

### Creating a Placeholder

First, you may need to create a Placeholder, it gives you a `$tag` property and a `value()` method to set up.

The `$tag` is the placeholder that will be replaced by the result of the `value()` method.

```php    
// MyCustomPlaceholder.php

use LorenzoMilesi\Templates\Placeholder;

class MyCustomPlaceholder extends Placeholder
{
    protected static string $tag = '[custom]';

    public static function value() : string
    {
        return 'yey';
    }
}
```

### Using Placeholders in Templates

Then, anywhere should you need it, you may create a Template instance that will be responsible for transforming a given content by replacing every defined placeholders by their values.

```php
use LorenzoMilesi\Templates\Template;

// Load the template with given content and placeholders to replace
$template = Template::load('placeholders will be replaced, [custom]')
        ->addPlaceholder(MyCustomPlacehoder::up());
        
// This will return : "placeholders will be replaced, yey"
$template->__toString();
```

### PlaceholderFactory

Sometimes you do not want to create a custom placeholder in a class file, consequently, we created a PlaceholderFactory to setup anonymous placeholder classes on the fly:

```php
use LorenzoMilesi\Templates\Template;
use LorenzoMilesi\Templates\PlaceholderFactory;

$datePlaceholder = PlaceholderFactory::build('[date]', \Carbon\Carbon::today()->format('Y-m-d'));

Template::load('Today date is [date]')
    ->addPlaceholder($datePlaceholder);
```

So far, so good, you may add several placeholders and build successful template's replacement systems:

```php
use LorenzoMilesi\Templates\Template;
use LorenzoMilesi\Templates\PlaceholderFactory;

$datePlaceholder = PlaceholderFactory::build('[date]', \Carbon\Carbon::today()->format('Y-m-d'));

$userPlaceholder = PlaceholderFactory::build('[username]', auth()->user()->getName());

$teamPlaceholder = PlaceholderFactory::build('[teamname]', auth()->user()->team()->getName);

Template::load('Hello [username], we\'re on [date] and you joined [teamname] :)')
    ->addPlaceholder($datePlaceholder)
    ->addPlaceholder($userPlaceholder)
    ->addPlaceholder($teamPlaceholder);
```

### Some other things

You're free to define any format for placeholders:

```php
use LorenzoMilesi\Templates\Template;
use LorenzoMilesi\Templates\PlaceholderFactory;

$datePlaceholder = PlaceholderFactory::build('{date}', \Carbon\Carbon::today()->format('Y-m-d'));

Template::load('this will replace {date} but not [date]')
    ->addPlaceholder($datePlaceholder);
```

When you define placeholders on a Template, order matters:

```php
use LorenzoMilesi\Templates\Template;
use LorenzoMilesi\Templates\PlaceholderFactory;

$dateOne = PlaceholderFactory::build('{date}', \Carbon\Carbon::today()->format('Y-m-d'));

$dateTwo = PlaceholderFactory::build('{date}', \Carbon\Carbon::yesterday()->format('Y-m-d'));

/**
 * Given that $dateOne and $dateTwo replace the same tag,
 * Only $dateOne will work here, since it will replace
 * the tag before $dayTwo.
 */
Template::load('This is {date}')
    ->addPlaceholder($dateOne)
    ->addPlaceholder($dateTwo);
```

Lastly you may create placeholder switches:


```php
use LorenzoMilesi\Templates\Template;
use LorenzoMilesi\Templates\PlaceholderFactory;

$condition = rand(0, 1);

$conditionalTag = PlaceholderFactory::build('[condition]', $condition ? '[today]' : '[yesterday]');

$todayPlaceholder = PlaceholderFactory::build('[today]', \Carbon\Carbon::today()->format('Y-m-d'));

$yesterdayPlaceholder = PlaceholderFactory::build('[yesterday]', \Carbon\Carbon::yesterday()->format('Y-m-d'));

/**
 * This will use today or yesterday tag given a condition
 */
Template::load('This is [condition]')
    ->addPlaceholder($conditionalTag)
    ->addPlaceholder($todayPlaceholder)
    ->addPlaceholder($yesterdayPlaceholder);
```

## Licence

This package is delivered to you for free under the MIT Licence.