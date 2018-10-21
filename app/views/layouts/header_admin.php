<?php
    use engine\base\View;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  
  <?=View::getMeta(); ?>

  <link rel="preload" rel="preload" href="/css/main.min.css" as="style" onload="this.rel='stylesheet'">
</head>
<body>
    <div class="wrapper">
    <header id="header">
        <h1 role="banner">Admin panel</h1>
    </header>