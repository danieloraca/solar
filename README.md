
![alt text](https://github.com/danieloraca/solar/blob/main/Demo.png?raw=true)
## Installation
The application is using docker for serving an instance of MySQL database.
```yaml
$ docker-compose up -d
```

Then use the following commands to install the application dependencies.
```yaml
$ composer install
$ yarn install
```
Then the migrations need to be executed
```yaml
$ php bin/console doctrine:migrations:migrate
```
After that use
```yaml
$ symfony serve
```
to start the application locally.

If symfony is not installed, use
```yaml
$ curl -sS https://get.symfony.com/cli/installer | bash 
```

---
## Interface
1. Ability to add a new Solar System with `Name` and `Diameter`
2. After the solar system is added, there's possibility to add one or more stars to it. 
3. Once a star is added, the user can add planets belong to star with `name`, `mass` and `distance`.

## Default calculations
1. The mass of the solar system is calculated by adding the mass of all its child objects.

2. There are two options for diameter. Firstly, `Estimated Diameter` is calculated by doubling the furthest planet distance.
If there are more than one star, the diameters are taken into consideration when calculating the total diameter of the solar system.
   The other option for diameter is `Calculated Diameter` where the user can change the value of it.
---

## Command lines
Running tests using PHPUnit
```
$ make unit
```
Currently, there are several unit tests defined.

```
$ make analysis
```
Running static analysis using PHPStan
