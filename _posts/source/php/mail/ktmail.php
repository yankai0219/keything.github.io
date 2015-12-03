<?php
class KTMail
{
    const UTF8_PREFIX  = '=?UTF-8?B?';
    const UTF8_POSTFIX = '?=';
    const RN = "\r\n";
    /**
     * @param from: who send this mail
     * @param to: who receive this mail
     * @param subject: the title of mail
     * @param body: the content of mail
     * @param attachment_fname: the file name of attachement
     * @param attachment_fdata: the file content of attachment
     * @return true if send succeed, FALSE otherwise
     * TODO if attachment_fname is chinese, it will be messay code.
     */
    public static function sendWithAttach($from, $to, $subject, $body, $attachment_fname, $attachment_fdata)
    {
        // a random string 
        $semi_rand = md5(time()); 
        $mime_boundary = '==Mime_Multipart_Boundary_x' . $semi_rand . 'x';
        $part_boundary = '==Part_Multipart_Boundary_x' . $semi_rand . 'x';

        // header 
        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: multipart/mixed; boundary=' . $mime_boundary;
        $headers[] = 'From: ' . $from;
        $headers_raw = implode(self::RN, $headers);

        // Message Body
        $msg = [];
        $msg[] = '--' . $mime_boundary;
        $msg[] = 'Content-Transfer-Encoding: base64' . self::RN;
        $msg[] =  chunk_split(base64_encode($body));

        // Attachment
        $msg[] = '--' . $mime_boundary;
        $msg[] = 'X-Attachment-Id: ' . rand(1000, 99999);
        $msg[] = 'Content-Transfer-Encoding: base64';
        $msg[] = 'Content-Type: application/octet-stream;' . ' name="' . $attachment_fname . '"';
        $msg[] = 'Content-Disposition: attachment; filename="'. $attachment_fname . '"' . self::RN;
        $msg[] = chunk_split(base64_encode($attachment_fdata));
        $msg[] = '--' . $mime_boundary . '--';

        $msg_raw = implode(self::RN, $msg);
        error_log($msg_raw, 3, '/tmp/sendmail.log');

        $real_subject = self::UTF8_PREFIX . base64_encode($subject) . self::UTF8_POSTFIX;

        return mail($to, $real_subject, $msg_raw, $headers_raw);
    }
    public function sendWithHtml($from, $to, $subject, $body)
    {
        // header 
        $headers = array();
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = 'From: ' . $from;
        $headers_raw = implode(self::RN, $headers);

        // Message Body
        $real_subject = self::UTF8_PREFIX . base64_encode($subject) . self::UTF8_POSTFIX;
        $msg_raw = $body;

        return mail($to, $real_subject, $msg_raw, $headers_raw);
    }
}
