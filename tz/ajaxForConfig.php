<?
    $fp = fopen("config.php", "a"); 
    
    $mytext = "<?
    return array(
            'color' => '"+$_POST[color]+"',
            'font' => '"+$_POST[font]+"',    
        );
    ?>"; 
    $test = fwrite($fp, $mytext); 
    fclose($fp);
?>