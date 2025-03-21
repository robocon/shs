@ECHO OFF

SET CURRENT_PATH=%~dp0
SET MYSQL_SERVICE=_PATH_\_TO_\_YOUR_\_MYSQL_\bin
SET MYSQLDUMP=%MYSQL_SERVICE%\mysqldump.exe

echo ---- START EXPORT MYSQL ----
echo MYSQL PATH: %MYSQLDUMP%

%MYSQLDUMP% --no-defaults --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user=root --port=3306 --password=1234 --host=_HOSTNAME_ --default-character-set=utf8 my_database mysql_table_for_export > %CURRENT_PATH%default_data.sql
echo ---- END EXPORT MYSQL ----
