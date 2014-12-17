<!DOCTYPE html>
<html>
<head>
	<title>@yield("title","Project 3")</title>
	<meta charset="utf-8">
	<link rel="stylesheet" 
		href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" 
		type="text/css" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" />

	@yield("head")


</head>
<body>
	<div class="content">

		@if(Session::get('flash_message'))
			<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif


		<nav>
			<ul>
				@if(Auth::check())
					<li><a href='/'>Home</a></li>
					<li><a href='/game'>All Games</a></li>
					<li><a href='/game/create'>Add New Game</a></li>
					<li><a href='/logout'>Log Out {{ Auth::user()->email; }}</a></li>
				@else
					<li><a href='/signup'>Sign up</a> or <a href='/login'>Log In</a></li>
				@endif
			</ul>
		</nav>

		@yield("content")

		<br />
		<a href='https://github.com/masbaty/p4/tree/master/backlog'>Github</a>

	</div>
</body>
</html>