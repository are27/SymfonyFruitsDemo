*Requirements*

- Symfony
- Coposer
- Yarn
- npm

Should all be installed

*Setup*

Clone the repository to your local directory

Copy example.env to .env and set the related properties

Need to set:
- Database connection properties - tested with MariaDB but MySql should work the same
- Set up Mailer configuration
- Set From and To email addresses for the import notification

*note: mailer tested with SendGrid - but other mailers should work, but may need additional composer requirements - see [Symfony Mailer Docs](https://symfony.com/doc/current/mailer.html) for more information on how to set up your prefered mailer*


To get the dependencies run:

```composer update```

Followed by:

```yarn install```

And then

```npm i vue vue-loader vue-template-compiler vue-router```

Then run

```yarn encore dev-server```

Create the databse with

```php bin/console doctrine:database:create```

Then create the tables by running the migrations

```php bin/console doctrine:migrations:migrate```

Then populate the fruit information from the web service

```php bin/console app:fruits```

To verify Entities are defined properly run the unit tests

``` composer test```

Build the assets by running

```npm run dev```

And then start the symfony server

```symfony serve```

Visit the app at http://localhost:8000/

A list of fruit will be shown - these can be added to a favourites list and from there the favourites list can be viewed to see the nutritional information of the selected fruits
