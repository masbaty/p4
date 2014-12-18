# Project 4: Video Game Collection

## Live URL
<http://p4.masbaty.me>

## Description
This application allows the user to manage a list of owned video games and progress in each of them. The user creates an account and then can add games to a list in which each item is tied to their user ID. The user can also edit and delete items on the list.

## Demo
My demo can be found at:
http://www.screencast.com/t/3COIJtQiPmnk

## Details for Instructor/TA
This project has been tested in the following browsers: Chrome, Firefox, and Internet Explorer.

## Outside Code
Bootstrap is used for extra styling. It is linked to with the following URL: 
//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css

I used the Laravel Debugbar found here:
https://packagist.org/packages/barryvdh/laravel-debugbar

I also installed Pre found here:
https://packagist.org/packages/paste/pre

## Challenges Encountered
While I was outlining ideas for this project, I realized that it would be difficult to enforce data accuracy across multiple users if they all had access to the games table. Possible solutions would be:
- Having a pre-existing database of every video game ever made.
- Hiring people to act as moderators to enforce data accuracy.
- Making data accuracy a community effort in a way similar to how Wikipedia does it.
All of these methods are not feasible for this project, but if this were a real application with real users I would need to consider the possiblity of users disagreeing on how a game's title should be abbreviated.

I encountered issues calling fields in the pivot table. Since there is a different syntax and different functions involved in handling pivot tables, it took me a while to get the correct code to call fields and save them.

At one point I encountered a major issue with Composer. It failed to update due to memory constraints and then my entire application stopped working. After some research, I tried increasing the memory allocated to scripts, but Composer still failed to update. Then I tried power cycling my server, and Composer started working again. I was reminded of the important first step in trying to fix something computer-related: turn it off and turn it back on. It's amazing how often that works.

## Future Plans
Given more time and resources to work on this site, I would implement more features such as search functionality and a games database that can be shared by all viewers. I would also improve the look of the site.