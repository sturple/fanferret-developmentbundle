# FanFerret Development Bundle

## Installation


** Install With Composer **

```json
{
    "repositories" : [
        {
            "type" : "git",
            "url" : "https://github.com/sturple/fanferret-developmentbundle"
        }
    ],    
   "require": {
       "sturpe/fanferret-developmentbundle": "dev-master"
   }
}

```

and then execute

```json
$ composer update
```


## Configuration

**Add to ```app/AppKernal.php``` file**

```php
class AppKernel extends Kernel
{
    if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
        ...
        $bundles[] =  new FanFerret\DevelopmentBundle\FanFerretDevelopmentBundle();


    }
}
```

**Add to routes_dev.yml**

```yaml
fan_ferret_development:
    resource: "@FanFerretDevelopmentBundle/Resources/config/routing.yml"
    prefix:   /dev/
```
