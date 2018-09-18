<?php
// Include I18N support
require_once("lib/streams.php");
require_once("lib/gettext.php");


$locale_lang= $_GET['lang'];
$locale_file = new FileReader("locale/$locale_lang/LC_MESSAGES/messages.mo");
$locale_fetch = new gettext_reader($locale_file);

function __($text){
    global $locale_fetch;
    return $locale_fetch->translate($text);
}
?>



<h1><?php echo __("Hello World!"), "<br>";?></h1>
<h3><?php echo __("Testing Translation...");?></h3>

<h1><?php echo _("Hello World!"), "<br>";?></h1>
<h3><?php echo _("Testing Translation...");?></h3>