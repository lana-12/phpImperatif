<?php

function postLog()
{
    if(isset($_POST['email'])  && isset($_POST['password']) ){
        echo $_POST['email'];
        echo $_POST['password'];
    }
}