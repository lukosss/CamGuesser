# CamGuesser
This is my project for Kilo Health Academy. CamGuesser is a mini game, the objective is to try to guess what place of the world the webcam is located in.
The player will be presented with a randomly selected camera every time, and to make it easier, will have four answers to choose from. If the player
is guessing correctly, they will get more points. If they make any mistakes, the score will be reduced.

*Disclaimer! The game is in very early stages of development. You may experience some bugs.*

## Frameworks Used

1. [Laravel](https://laravel.com/) Backend.
2. [Vue.js](https://vuejs.org/) Frontend.

### WindyApi

The Largest repository of webcams worldwide - [WindyApi](https://api.windy.com/webcams).

## Instructions

Setup:

First, make sure You are in the CamGuesser main folder (```CamGuesser/CamGuesser```) and run ```composer install``` to download all the dependencies.
To do that, You will need [Composer](https://getcomposer.org/).

Then make a copy of [.env.example](/CamGuesser/.env.example) and rename it to .env. Inside the new .env, at the bottom of the file, you will need to put in Your WindyApi key. 
E.g. WINDY_API_KEY="YourApiKeyHere"

Usage:

1. To run this page in browser use ```php artisan serve``` terminal command.

2. To run tests use ```php artisan test``` terminal command.