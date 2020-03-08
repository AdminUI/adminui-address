Create a clean Laravel Install

Create a database connection and update the .env file

add to composer.json

if running in production from a remote server:
````
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/southcoastweb/adminui"
        }
    ],
    "require": {
        "southcoastweb/adminui": "dev-master"
    },
````

 or in local development:
 (where the package is stored outside of laravel in a packages folder)
 Alter 'Url' path accordingly
````
 "repositories": [
        {
            "type" : "path",
            "url": "~/code/packages/admin-ui",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
        "southcoastweb/adminui": "dev-master"
    },
````
Now run a composer update.

You are now setup and ready to run a setup

Go to : <domain>/adminui/setup

This will create all databases, seed them with some base navigation, setup permissions etc..

This will copy some config files across to update if needed.

It will also copy a basic dashboard across for you to customise. (Most addon packages come with addtional widgets)

### Added feature

Email error reporting via squareboat/sneaker.
This will automatically install on composer.

Add exception capturing to `app/Exceptions/Handler.php`:

```php
public function report(Exception $exception)
{
    app('sneaker')->captureException($exception);

    parent::report($exception);
}
```

Add this line to the .env file

For sending emails when an exception occurs set `SNEAKER_SILENT=false` in your `.env` file.
