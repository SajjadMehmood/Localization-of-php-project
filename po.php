<?php
session_start();
?>
<body >
<!--for to slelect the language to creat po  file-->
<form action="#" method="post">
    <select name="Country" id="Country">
        <option name="en_US"  value="en_US" >English</option>
        <option name="de_DE"  value="de_DE">German</option>
        <option name="ps_PK"  value="ps_PK">Pashto</option>
        <option name="ar_EG"  value="ar_EG">Arabic (egypt)</option>
        <option name="ur_PK"  value="ur_PK">Urdu</option>
        <option name="fr_FR"  value="fr_FR">Spanish</option>
    </select>
    <input type="submit" name="submit" value="gET po fIEL" />
</form>



<?php

    //get value on submit
    if(isset($_POST['submit'])){

    // Storing Selected Value In Variable
    $selected_val = $_POST['Country'];

    //get base path of project
    $basePath = __DIR__;

    //route to local folder inside our project
    $outPutPath = $basePath.'/locale/';
    $lang = $selected_val;
    $lastFolder ="/LC_MESSAGES";
    $domain = 'myPHPApp';

    // create path for our language folder inside
    $langPODirPath = $outPutPath.$lang.$lastFolder;
    $DOMAIN="project_tag";


    //get all php files in current project folder
    foreach (glob("*.php") as $filename) {

         // get all php file in loop and creat pot file of same name
        //if we want to put our company name in pot file
        //--copyright-holder='Company-name' --package-name='Project-Name' --package-version='1.0' --msgid-bugs-address='company@mail.com' --language=PHP --sort-output  --keyword=__
        $cmd_pot = "xgettext --keyword=_e --from-code=UTF-8 --output=$filename.pot --default-domain=$DOMAIN  $filename";

         // create pot files of all php file
//         exec('mkdir' .$filename);
         print_r($filename);
//		 echo ($cmd_pot)."<br>";
    }

    //merge all pot file into one
    $merge_pot='copy *.pot merge.pot';
    exec($merge_pot);

    //delete all pot files except the merge one
    //$del_pot="for %i in (*.pot) do if not %i == merge.pot del %i";
    //exec($del_pot);



    // explode the full path
    $tags = explode('/' ,$langPODirPath);
    $mkDir = "";
    // die($outputPath);
    foreach($tags as $t) {
        $mkDir = $mkDir . $t . "/";
        // make one directory join one other for the next directory to make
//        echo '"' . $mkDir . '"'."<br />";
        // this will show the directory created each time
        if (!is_dir($mkDir)) {
            // check if directory exist or not
            mkdir($mkDir, 0777);
            // if not exist then make the directory
        }
    }



    //check the file exist or not
    $filename=$langPODirPath.'/messages.po'; //if file exist it provides downlaod link


    if (file_exists($filename)) {
        echo "You Already have a po file do u want to create and other one";
        echo "<a href='".$filename."' target='_blank'>Download po file</a>"."<br>";
        echo "to uplaod compiled file<a href=upload.php>Click here </a>";

    }



    else {
        $cmd_po="msginit --no-translator --locale=$lang.UTF-8 --output-file=$langPODirPath/messages.po --input=merge.pot";
        exec($cmd_po);
        echo "po file or language $lang generated". "<a href='$filename'>"."Click here"."</a>" ."to download the file";
        echo "to uplaod compiled file<a href=upload.php>Click here </a>";

    }

}

//////////////////////upload file
?>
</body>
