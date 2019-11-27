# Allegro Rest-Api
> This package help with integration yours app with allegro rest api

## Table of contents
* [Ready](#ready)
* [In Progress](#in-progress)
* [Technologies](#technologies)


## Ready
* Authorization

## In Progress
* Orders Allegro

## Technologies
* PHP    - version 7.2.3
## Authorization
  Authorization is very simple you must just declarate:
  ```php
    use AllegroApi\Allegro
  ```
  then for set connection use:
  ```php
        Allegro::setConnection(string $clientId, string $clientSecret, string $redirectUrl)
  ```
   All this arguments you can get from [RestApiAllegro](https://apps.developer.allegro.pl/new),after register your app you will get that data
## Contact
Created by [@ReqqQ](https://github.com/ReqqQ) - feel free to contact me!
