La folle agence
=============

A Symfony 2.8 project created on October 12, 2016, 10:44 am.<br />
The config of database and email is in the file parameters.yml, the path of this file is app/config.

###Mysql

if your mysql version is 5.7, and you may have problem of compatibily with Doctrine.
For resolve it, you have to add a line in mysqld.cnf file. <br />
The access path to find the file is :
etc/mysqld/mysql.conf.d/mysqld.cnf <br />
You have to add at the end of file : sql-mode=""

###Change password

- Go to the file directory app/config
- Open the file parameters.yml with a text editor
    <pre>parameters:
             ...
             admin_password: your crypted password
             ...
    </pre>
- Delete content of line password
- Type this command in the console : <br />
    <pre>php app/console security:encode-password</pre>
- Type your new password
- Copy the password encoded
- Paste it in the line password

##Captcha Google 
- Go to google recaptcha
- Follow the instructions
- Take public key and private key
- Go to the file directory app/config
- Open the file parameters.yml with a text editor
<pre>parameters:
             ...
             captcha_secret_private1: your key private
             captcha_secret_public1: your key public
             ...
</pre>
- For the second key you must make a new recaptcha
<pre>parameters:
             ...
             captcha_secret_private2: your key private
             captcha_secret_public2: your key public
             ...
</pre>

          
    


