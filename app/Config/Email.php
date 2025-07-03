<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'developernimisha212@gmail.com';
    public string $fromName   = 'Meesho Delivery Application';
    public string $recipients = 'nimishajamesvichattu@gmail.com';

    public string $userAgent = 'CodeIgniter';

    // Use 'smtp' instead of 'mail'
    public string $protocol = 'smtp';

    // Remove or ignore mailPath, as you're using SMTP
    // public string $mailPath = '/usr/sbin/sendmail';

    // SMTP Server Hostname
    public string $SMTPHost = 'smtp.gmail.com';

    // SMTP Username (use the Gmail address)
    public string $SMTPUser = 'developernimisha212@gmail.com';

    // Use the App Password generated from Gmail
    public string $SMTPPass = 'rwtx cdla obmp wpfz';  // Make sure this is your Gmail App Password

    // SMTP Port (587 for TLS)
    public int $SMTPPort = 587;

    // SMTP Timeout (in seconds)
    public int $SMTPTimeout = 5;

    // Keep SMTP connection alive
    public bool $SMTPKeepAlive = false;

    // Use TLS encryption
    public string $SMTPCrypto = 'tls';

    // Enable word-wrap
    public bool $wordWrap = true;

    // Character count to wrap at
    public int $wrapChars = 76;

    // Set mail type to HTML
    public $mailType = 'html';

    // Character set (utf-8, iso-8859-1, etc.)
    public string $charset = 'UTF-8';

    // Disable email address validation (optional)
    public bool $validate = false;

    // Set email priority (normal = 3)
    public int $priority = 3;

    // Newline character for emails
    public string $CRLF = "\r\n";

    // Newline character for emails (RFC 822 compliant)
    public string $newline = "\r\n";

    // Disable BCC Batch Mode (optional)
    public bool $BCCBatchMode = false;

    // Set the number of emails in each BCC batch (optional)
    public int $BCCBatchSize = 200;

    // Disable DSN notifications from the server (optional)
    public bool $DSN = false;
}
