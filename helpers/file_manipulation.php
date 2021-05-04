<?php
function read_file()
{
    $messages           = [];
    $index              = 0;
    $fileName           = 'temp/notification.txt';

    if (file_exists($fileName)) {
        $notificationFile   = fopen($fileName, 'r');
        while ($message = fgets($notificationFile)) {
            $messages[$index]    = $message;
            $index++;
        }
        fclose($notificationFile);
        unlink($fileName);
        return $messages;
    }
    return;
}


function write_file($messages)
{
    $fileName           = 'temp/notification.txt';
    $notificationFile   = fopen($fileName, 'w') or die('Unable to open the file!!!');

    foreach ($messages as $key => $message) {
        fwrite($notificationFile, "{$message} \n");
    }
    fclose($notificationFile);
}
