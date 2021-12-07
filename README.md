<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<p align="center"><a href="https://cdnlogo.com/logo/twitter-icon_498.html"><img src="https://cdn.cdnlogo.com/logos/t/96/twitter-icon.svg" width="150"></a></p>


## Twitter Historgram


- [Chartisan/Charts](https://github.com/Chartisan/Charts). Package used for histogram rendering engine
- [atymic/twitter](https://github.com/atymic/twitter). Helper package used for twitter api call.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Project structure

###Controllers
Two controllers are created 
- SearchController [app/Http/Controllers/SearchConrtoller.php] : Handles the search for request and converts the username to user id.
- TwitterController [app/Http/Controllers/TwitterController.php] : Makes api call to twitter to get user tweets. Then process the data to get most hours user active on twitter.
then build the history chart using Chartisan/Charts package and send data to render in view.

##Views

3 Layouts are crated
- base [resources/views/layouts/base.blade.php] : Base template which is a index page or parent page layout.<br><br>
- search [resources/views/search.blade.php] : search template contains search form where username can be submitted to generate the histogram result<br><br>
- twittergraph [resources/views/twittergraph.blade.php] : twittergraph template which renders histogram graph and also extends the search template within.<br><br>

###API Info and consumption of endpoint
In this project Twitter API v2 endpoint is used. 
Tweet result is obtained using the following api endpoint:
https://developer.twitter.com/en/docs/twitter-api/tweets/timelines/api-reference/get-users-id-tweets

