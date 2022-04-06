# dcms
A Dental Clinic Management System (DCMS) for a dental centre with clinics in major cities across Canada

Create a file named envvars.php and add this line of code

`<?php
$password="YOUR PASSWORD";
?>`

and replace your password with the password of your PostgreSQL user.

For Windows users:

Change the name of your PHP folder to 'php'.

Open the file "php.ini" in your PHP folder and find the lines 
`;extension=pdo_pgsql
;extension=pdo_sqlite
;extension=pgsql`

and remove all the ";".

Then, find the file "httpd.conf" in the "Apache24/conf" folder. At the end of the file, add the code block `LoadFile "C:\php\libpq.dll"`