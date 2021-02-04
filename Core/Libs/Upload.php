<?php

namespace Core\Libs;

class Upload
{
    // List of dangerous extensions, although these files can also be
    // sent by .zip or .rar files, it offers a little more secure environment.
    private $forbidden_extensions = array();

    // List of allowed extensions for upload
    private $allowed_extensions = array();

    // Uploaded file extension
    private $file_extension = "";

    // Uploaded file type
    private $file_type = "";

    function __construct()
    {
        // List of dangerous file types by OS
        $forbidden_mac = array("app", "command", "dmg");
        $forbidden_win = array("bat", "bin", "cmd", "com", "exe", "lnk", "msi", "pif", "scr");
        $forbidden_web = array("html", "js", "php", "phtml");
        $this->forbidden_extensions = array_merge($forbidden_win, $forbidden_mac, $forbidden_web);
    }

    public function perform($file, $destination_dir)
    {
        // code...
    }
}
