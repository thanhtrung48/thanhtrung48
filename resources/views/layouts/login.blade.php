<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="username">
        <input 
        spellcheck="false"
        type="text"
        placeholder="Username"
        ankeyup="handleChange(event)"
        ankeydown="handleStartTyping()"
        />
        <div id="spinner" class="spinner"></div>
    </div>
    <div id="alert" class="alert">Username already exists</div>
    <script type="text/javascript" src="main.js"> </script>
        
</body>
</html>