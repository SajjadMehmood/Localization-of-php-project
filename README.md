# Localization-of-php-project
Localization of php project with the help of pot/po/mo files
pO.PHP FILES CREATE POT FILE AND PO FILE OF CHOSED LANGUAGE
index.php have methode to call the lnaguage change and replace of text 
po file auto generates the dirictory structure
for complete detail read the article
LOCALIZATION OF A WEBPAGE/WEBSITE WITH POT/PO/MO FILES

Wouldn’t it be nice if you could create local language versions of your web app for all your international users? gettext, an open source internationalization and localization system makes it possible. It works with multiple languages, including PHP, and makes the entire translation process easy to manage and maintain.

In this blog, we will learn how to install, set up and create simple translations using PHP gettext.

WHAT WE NEED?

a.    GETTEXT (GNU)

b.    PHP FILES

c.     PO EDITOR (PO EDIT OR ANY ELSE)

d.    CLI

WHAT IS GETTEXT?

In the early 1990s, as computing became truly global, programmers realized the importance of creating multi-lingual versions of their software. This was more than a translation problem; it was a coding nightmare. Programmers often had to create multiple copies of the same code to serve up different versions of the website in local languages.

To remedy this problem, Sun Microsystems developed a system called gettext in the 1990s. A few years later, the GNU Project released GNU gettext, which was an open source implementation of Sun’s gettext system.

Using gettext is relatively simple in principle. It involves modifying the original English source code to include the gettext (string) function. Gettext then returns a local language of the specified string stored in an external file.

Over the years, gettext has been implemented in several languages, including C++, C#, ASP.net, Perl, Ruby, and of course, PHP. It is now the standard internationalization (shortened to i18n – i-18 letters-n) system across languages.

Creating a Portable Object Template file (POT)

xgettext is a command line program that extracts translatable strings from given input files. It parses the code recognizing the gettext functions used in it, and extracts the strings in the variables passed to those functions. Besides PHP, it can be used to extract strings from many other programming languages: C, C++, ObjectiveC, PO, Shell, Python, Lisp, EmacsLisp, librep, Scheme, Smalltalk, Java, JavaProperties, C#, awk, YCP, Tcl, Perl, GCC-source, NXStringTable, RST, Glade [2].

To extract all translatable strings from all PHP files in the project directory, change to that directory and execute the xgettext command:

//decalartion of variables

$DOMAIN="project_tag"

$POT="$DOMAIN.pot"

$LANGS="en_US ru_RU"

$SOURCES="*.php"



# Create template

echo "Creating POT"

rm -f $POT //checking if pot exist then del it

xgettext  --language=PHP --from-code=UTF-8 --output=$POT  --default-domain=$DOMAIN $SOURCES //command to get pot file

$POT -->output file name

$domain --> your project name or any thing

$Sources-->your input php file

We can also add

--copyright-holder="Company naem" \

 --package-name="Project Name" \

 --package-version="1.0" \

 --msgid-bugs-address="translations@company.com" \

--sort-output \

--keyword=__ \

Portable Object files

PO files are plain text files that contain the translation. In addition to creating a PO file by xgettext, it can be created and edited by hand in a plain text editor. PO editors can be used as well (for details please check the further reading section.

A PO file can start with a header entry. Unlike the other entries, it does not contain any particular translation, but the details about the file itself. Some of the information included in the header contains:

o   Language

o   Content-Type

o   Content-Transfer-Encoding

o   Plural-Forms

The rest of the PO file is made up of the entries that hold the relation between an original un-translated string and its corresponding translation. All entries in a given PO file usually pertain to a single project, and all translations are expressed in a single target language.

Basic Syntax
The PO format is a plain text format, written in files with .po extension. A PO file contains a number of messages, partly independent text segments to be translated, which have been grouped into one file according to some logical division of what is being translated. For example, a standalone program will frequently have all its user interface messages in one PO file, and all documentation messages in another; or, user interface may be split into several PO files by major program modules, documentation split by chapters, etc. PO files are also called message catalogs.

Here is an excerpt from the middle of a PO file, showing three simple messages, which are un-translated:

#: index.php:38

msgid "Globular Clusters"

msgstr ""

⁠

#: index.php:39

msgid "Gaseous Nebulae"

msgstr ""

⁠

#: about-us.php:40

msgid "Planetary Nebulae"

msgstr ""

Each message contains the keyword msgid, which is followed by the original string (usually in English for software), wrapped in double quotes. The keyword msgstr denotes the string which to become the translation, also double-quoted. After you go through the PO file and add translations, these messages would read:

#: index.php:38

msgid "Globular Clusters"

msgstr "Globularna jata"

⁠

#: index.pho:39

msgid "Gaseous Nebulae"

msgstr "Gasne magline"

⁠

#: about-us.php:40

msgid "Planetary Nebulae"

msgstr "Planetarne magline"

Based on this example, translating a PO file looks rather simple, and for the most part it is. There exists, however, a number of details which you have to take into account from time to time, in order to produce translation of high quality. The rest of this chapter deals with such details.

As is usual with text formats, immediately something must be said about the text encoding of a PO file. While you could use encodings other than UTF-8 if no non-ASCII letters are used in the original text, you really should use UTF-8. The encoding is specified within the PO file itself, and by default it is

Leaving some messages in the PO file un-translated is technically not a problem. For every un-translated message, programs will typically show the original text to the user, so that not all information is lost. Format converters (such as used in intermediate static translations) may do the same, or decline to create the target file unless the PO file is translated fully or over a prescribed threshold. Of course, you should strive to have the PO files under your maintenance completely translated, in order for the users not to be faced with mixed original and translated text.

Source References
Each message in the previous example also contains the source reference comment, which is the line starting with #: above the msgid "..." line. It tells from which source file of the program code (or source document of any kind), and the line in that source file, the message has been extracted into the PO file. This piece of data may look strange at first--of what use is it to translators, to merit inclusion in the PO file? Since the PO format has been developed in context of free software, the source reference enables you to actually look up the message in the source file, when you need more context to translate a certain message. This does not require of you to be a programmer, as source code is frequently readable enough to infer the message context without actually understanding the code.

#: filename.php:45
msgid "Import Catalog"
msgstr ""
String Wrapping
When a message is long or contains some logical line-breaks, its original and translation strings may be wrapped in the PO file (with wrapping boundary usually at column 80), such as this:

#: file.php:96
msgid ""
"No INDI devices currently running. To run devices, please select devices "
"from the Device Manager in the devices menu."
msgstr ""
This wrapping is entirely invisible to the consumer of the PO file. PO processing tools introduce wrapping mostly as a convenience to translators who like to work on PO files with plain text editors. This means that you are free to wrap the translation (the msgstr string) in the same way, differently, or not to wrap it at all. You should only not forget to enclose each wrapped line in double quotes, same as it is done for msgid. For example, this translation of the previous message:

#: index.php:96
msgid ""
"No INDI devices (...)"
"(...) in the devices menu."
msgstr ""
"Nema INDI uređaja (...)"
"(...) u meniju uređaja."
is equivalent to this one:

#: index.php:96
msgid ""
"No INDI devices (...)"
"(...) in the devices menu."
msgstr "Nema INDI uređaja (...) u meniju uređaja."
Dedicated PO editors may even not show wrapping to the translator, or wrap lines on their own independently of the underlying PO file. Curiosly enough, most PO editors seem to follow the original wrapping, at least by default. At any rate, if you would like to have all strings non-wrapped (including msgid) or vice versa, there are command line tools to achieve this.

o   msgid – the untranslated string as it appears in the original program sources

o   msgstr – the translation of this string

The two strings are quoted in various ways in the PO file, using ” delimiters and \ escapes, but the translator does not really have to pay attention to the precise quoting format, as PO mode fully takes care of quoting.

DIRECTORY STRUCTURE FOR PO FILE 

FOLDER

--locale

-----en_US

----------LC_MESSAGES

In the above structure:

Test_Project is just the name of our example project. You can name this anything.
The Locale folder holds all translation files for different languages. You can name this anything as well, though Locale is the standard name.
The en_US holds language files for the English (United States) language. en_US is a standard two-part abbreviation for the English (US) language. The same for English (UK) is en_GB. You must name this folder exactly as the language you wish to translate the code in.
For example, if you wanted to hold translation for Colombian Spanish, you would name the folder es_CO. You can see a complete list of language codes here.
The LC_MESSAGES folder holds the actual translated messages. You must keep this folder name exactly the same for gettext to work.
CLI STRING

We can use following string to get po file of desired language from pot file



msginit --no-translator --locale=$LANG.UTF-8 --output-file=messages.po --input=$POT 


$LANG is the language for which we will get po file

--output-File= the name of output po file usually messages.po

$POT is the input(POT) file created in previous section

Machine Object files
Method 1
The translations are made available to the web server through the Machine Object files. In order to compile the PO files, a gettext library needs to be installed. Ubuntu/Debian and Fedora/CentOS/Redhat users can install the library from the repository using apt-get or yum respectively. For other Unix-like systems a copy of gettext can be obtained from www.gnu.org/s/gettext. Windows users can get it from gnuwin32.sourceforge.net/packages/gettext.htm. Some *-nix systems come with gettext pre-installed.

Note Skip The above step if u already have installed gettext (GNU)

Once you make sure gettext is present in your system, cd to a directory where you put the PO file (for example Locale/de/LC_MESSAGES) and execute:

msgfmt example.po -o message.mo
Repeat this for all files in all locale directories, and you’re all internationalized. You are now ready to use the translations to localize your website.

Method 2

       Use po edit to detect the string from po file and suggest translation and use that translation and compile that file manually from po edit compile option and save it with po file

HOW TO USE IT?

 

<?php
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



<body>

<h3><?php echo __("Testing Translation...");?></h3>
You can download gettext libraries from following link
