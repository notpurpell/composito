# Composito

Composito is a small package that gives eloquent models the ability to have composite primary keys through a trait.

## Installation

You can install `composito` using [Composer](https://getcomposer.org/).

```
composer require notpurpell/composito
```

## Usage

To add the composite primary key functionality to your eloquent model you must:
1. Use the `HasCompositePrimaryKey` trait.
2. Specify the composite primary key using the `$primaryKey` property.
3. Set the `$incrementing` property to false.

```
use Composito\Traits\HasCompositePrimaryKey;

class MyModel extends Eloquent
{
    use HasCompositePrimaryKey;
    
    /**
     * Indicates if the IDs are auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    /**
     * The composite primary key of the model.
     * @var array
     */
    protected $primaryKey = [ "primary_one", "primary_two" ];

    ...
}
```

Then, you can use the `create()`, `save()`, `update()`, and `delete()` methods normally.

Support for other methods such as the `find()` method is coming soon.

## Tests
The package contains some tests that can be run via [phpunit](https://phpunit.readthedocs.io/en/8.5/).
```
./vendor/bin/phpunit
```

## Credits
* [Joe Karam](https://github.com/joekaram)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.