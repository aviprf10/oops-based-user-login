<?php 
include "init.php";
if(count($_POST) > 0)
{
    $errors = User::action()->login($_POST);

    if(!is_array($errors))
    {
        header('Location:index.php');
        die;
    }
}
?>
<html>
<head>
  <title>Login form</title>
</head>
<style>
    form{
        margin:auto;
        margin-top: 20px;
        width: 100%;
        max-width: 300px;
        border-radius: 5px;
        border: solid thin #ccc;
        box-shadow: 0px 0px 10px #aaa;
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        padding:10px;
        position: relative;
    }

    input{
        position: relative;
        margin: auto;
        width: 100%;
        border-radius: 5px;
        border: solid thin #ccc;
        padding: 10px;
        margin-top:5px;
    }

    select{
        height: 41px;
        width: 300px;
        border: solid 1px #ccc;
        padding: 7px;
        border-radius: 5px;
    
    }

    .btn{
        padding:10px;
        border: none;
        background-color:lightskyblue;
        color:#fff;
        cursor:pointer;
        border-radius: 5px;
    }
</style>
<body>
    <form method="post">
        <h1>Login</h1><br>
        <div style="color:red; font-size:12px;"> 
        <?php 
            if(isset($errors) && is_array($errors))
            {
                foreach($errors as $error){
                    echo $error. "<br>";
                }
            }
        ?>
        </div>
        <input type="email" class="input" name="email" placeholder="Enter Email" value="<?=isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br><br>
        <input type="password" class="input" name="password" placeholder="Enter Password" value="<?=isset($_POST['password']) ? $_POST['password'] : ''; ?>"><br><br>
        <input class="btn" type="submit" value="Login"><br>
        <br style="clear: both">
    </form>
</body>

</html>