<?php
include ('ktmail.php');
$from = 'local@a.cn';
$to = 'your-email';
$subject = 'keything.net';
$body = 'keything.net';
$attachment_fname = 'keything.txt';
$attachment_fdata = 'keything';
$attach_res = KTMail::sendWithAttach($from, $to, $subject, $body, $attachment_fname, $attachment_fdata);
echo 'attach_res = ' . var_export($attach_res, true)."\n";

$html_body = '
    <html>
        <head> keything </head>
        <body> 
            keything body 
            <table border="1">
                <tr>
                    <td>row 1, cell 1</td>
                    <td>row 1, cell 2</td>
                </tr>
                <tr>
                    <td>row 2, cell 1</td>
                    <td>row 2, cell 2</td>
                </tr>
            </table>
        </body>
        </head>
    </html>
    ';
$html_res = KTMail::sendWithHtml($from, $to, $subject, $html_body);
echo 'html_res = ' . var_export($html_res, true)."\n";
