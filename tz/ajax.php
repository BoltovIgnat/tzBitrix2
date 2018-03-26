<?
    mail("uncelpeter@gmail.com", "Тема", "На сайте оформлена заявка от пользователя\n Имя пользователя:"+$_POST[name]+"\n телефон:"+$_POST[telefon]+"\n сообщение:"+$_POST[message]); 
    
    $ip=$_SERVER['REMOTE_ADDR'];

    $fp = fopen("file.txt", "a"); 
    
    $mytext = "\r\n |"+$_POST[name]+"|"+$_POST[telefon]+"|"+$_POST[message]+"|"+$ip; 
    $test = fwrite($fp, $mytext); 
    fclose($fp);
    
    $connect=mysql_pconnect ("localhost","root","");
    
    $db="edu";
    mysql_select_db ( $db );
    $query = "INSERT INTO dannye VALUES ('".$_POST[name]."', '".$_POST[telefon]."', '".$_POST[message]."', '".$ip."')";
    $result = mysql_query ( $query );
    
    mysql_close ( $connect);

    print_r("Ваше письмо отправлено. Мы свяжемся с вами в течение суток.");
    
?>