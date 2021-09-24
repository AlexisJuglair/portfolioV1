<?php

$flag = false;
$error = "";

foreach ($_POST as $key => $value) 
{
    if(empty($value))
    {
        $flag = false;
        $error = $key;
        break;
    }
    else
    {
        if ($key == "email")
        {
            if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i",$value))
            {
                $flag = false;
                $error = $key;
                break;
            }
        }
        else 
        {
            $flag = true;
        }
        
    }
}

if ($flag)
{
    $monEmail = "alexis.juglair@gmail.com";

    $entetes = "MIME-Version: 1.0\r\n";
    $entetes .= "Content-type: text/html; charset=UTF-8\r\n";
    $entetes .= "From: ".$_POST['prenom']." ".$_POST['nom']." <".$_POST['email'].">\r\n";
    $entetes .= "Reply-To: ".$_POST['prenom']." ".$_POST['nom']." <".$_POST['email'].">\r\n";

    $email = $_POST['email']; 
    $sujet = '=?UTF-8?B?'.base64_encode($_POST['sujet']).'?=';
    $message = htmlentities($_POST['message'],ENT_QUOTES,"UTF-8");

    mail($monEmail,$sujet,nl2br($message),$entetes);

    print 1;
}
else
{
    print $error;
}

?>