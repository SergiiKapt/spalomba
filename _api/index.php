<?php

//require_once 'api/core/components/helpers.php';
//require_once 'index.html';

$domain = $_SERVER['SCRIPT_URI'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .wrp {
        margin: 0 auto;
        padding :10px;
        max-width: 1000px;
    }
    .request {
        display: block;
        font-size: 20px;
        font-weight: bold;
        padding: 5px 10px;
        margin: 0 5px;
        border: 1px solid;
        border-radius: 4px;
    }
    .get {
        background: rgba(73,204,144,.1);
        border-color: #49cc90;
    }
    .post {
        background: rgba(97,175,254,.1);
        border-color: #61affe;
    }
    .put {
        background: rgba(252,161,48,.1);
        border-color: #fca130;
    }
    .delete {
        border-color: #f93e3e;
        background: rgba(249,62,62,.1);
    }

    .data {
        background: #eee;
        padding: 10px;
    }
</style>
<body>
<div class="wrp">
<h3>login</h3>
<span class="request post">POST <?php echo $domain ?>api/login</span>
<p>Send data:</p>
<div class="data">
<pre>{
    "email":"user_email",
    "password":"user_password"

    //admin
    "email":"admin@admin.com",
    "password":"admin"

    //user
    "email":"qq@qq.qq",
    "password":"qqqqq"
}
</pre>
</div>
<br>
<h3>get all user</h3>
<span class="request get">GET <?php echo $domain ?>api/user</span>
<p>Send data:</p>
<div class="data">
<pre>{
    "token" : "login_token",
}
</pre>
</div>
<br>

<h3>get one user</h3>
<span class="request get">GET <?php echo $domain ?>api/user/{id}</span>
<p>Send data:</p>
<div class="data">
<pre>{
    "token" : "login_token",
}
</pre>
</div>
<br>
<h3>create user</h3>
<span class="request post">POST <?php echo $domain ?>api/user/{id}</span>
<p>Send data:</p>
<div class="data">
<pre>{
    "token" : "login_token",
    "email":"user_email",
    "password":"user_password",
    "confirm_pass":"confirm_pass",
    "first_name":"user_first_name",
    "last_name":"user_last_name",
    "info":"user_info",
}
</pre>
</div>
<br>
<h3>update user</h3>
<span class="request put">PUT <?php echo $domain ?>api/user/{id}</span>
<p>Send data:</p>
<div class="data">
<pre>{
    "token" : "login_token",
    "email":"user_email",
    "first_name":"user_first_name",
    "last_name":"user_last_name",
    "info":"user_info",
    //
    "password":"user_password",
    "confirm_pass":"confirm_pass",
}
</pre>
</div>
<br>

<h3>delete users</h3>
<span class="request delete">DELETE <?php echo $domain ?>api/user/{id}</span>
<p>Send data:</p>
<div class="data">
<pre>{
    "token" : "login_token",
}
</pre>
</div>
<br>
<br>
<br>
<hr>

<form action="<?php echo $domain ?>/api/user/" method="post">
<!--    <input type="hidden" name="_method" value="DELETE">-->
<!--    <input type="hidden" name="_method" value="PUT">-->
    <label> Email <br>
        <input type="email" name="email">
    </label>
    <br> <br>
    <label> password <br>

        <input type="password" name="password">
        <br> <br>
        <label> confirm_pass <br>

            <input type="password" name="confirm_pass">
        </label>

        <br> <br>
        <label> first_name <br>

            <input type="text" name="first_name">
        </label>

        <br> <br>
        <label> last_name <br>

            <input type="text" name="last_name">
        </label>

        <br> <br>
        <label> info <br>

            <textarea name="info"></textarea>
        </label>
        <br> <br>


        <button>Send</button>
</form>
</div>
</body>
</html>

