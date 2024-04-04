# The Description:
This is the simple core for URL shortener written with PHP. It uses MySQL to store data, working URL rewrite engine to beautify links and CGI technology to run.

# The Server:
I'm using Apache2 with rewrite mode enabled. You can use your favorite server, but that may need some changes to the code or to the server configuration.
For my case I'm using this *.htaccess* file:
```
DirectoryIndex index.html

RewriteEngine on
RewriteCond %{REQUEST_URI} !^/index\.html$
RewriteCond %{REQUEST_URI} !^(.+)\.php$
RewriteRule (.+) /l.php?s=$1 [L]
```

# How to run:
If it's OK with the web server, you should create the database named shortener and the user with an access to this database on your MySQL server. You can name your database another way. Just put all connection data to the *shared.php* file. After that please run *setuper.php*. It will create necessary tables. Warning! If there already will be such tables in the database, their content will be lost forever and they will be created as described in the _setuper.php_. Be careful.
The next step - is to set the correct path to cgi scripts. I've put them in the root directory that is not secure, but comfortable. If it's the production server - please edit _index.html_ and **25th** line in the _shortener.php_ file. 
After that you may use _shorter.php_ freely. The example how to use it is the _index.html_ file. That's a simple file created just to show functionality.

# The Counter:
Each page counts how many times it was accessed. By default it counts even failed attempts. To switch this option off change the count_fail option at the config table to the value another than **'1'**. To see counter result run _counts.php_.
