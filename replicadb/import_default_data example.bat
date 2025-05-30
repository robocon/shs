@ECHO OFF

SET CURRENT_PATH=%~dp0
SET MYSQL_SERVICE=_PATH_\_TO_\_YOUR_\_MYSQL_\bin
SET MYSQLDUMP=%MYSQL_SERVICE%\mysql.exe

echo ---- START IMPORT MYSQL ----
echo MYSQL PATH: %MYSQLDUMP%

%MYSQLDUMP% -u root -p1234 -h localhost -P 3306 my_database < mysql_file_for_import.sql
echo ---- END IMPORT MYSQL ----
