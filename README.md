# Minimal Slim 3 REST Skeleton

This is a minimal skeleton project for Slim 3 for REST APIs. Environment based configuration, Multiple Routes file for organization and usage of ControllerAction and Model classes.
Based on [akrabat's slim3-skeleton](https://github.com/akrabat/slim3-skeleton).


## Adding routes

create a file `app/src/Routes/*.routes.php`

## Environment Based config

`app/src/Settings/ENVIRONMENTNAME.settings.php` 

Default environment is `local`.

### Adding Environment Variable to your VirtualHost

```SetEnv APPLICATION_ENV "production"```


