<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
</head>
<body>
	<div id="app">
        <example></example>

        <passport-clients></passport-clients>
		<passport-authorized-clients></passport-authorized-clients>
		<passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
<script src="{{ asset('public/js/app.js') }}" type="text/javascript"></script>
</body>
</html>