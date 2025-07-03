#!/usr/bin/env python
import os
import subprocess
import mysql.connector
import sys
import json
import config as conf

"""
change config this only
"""
conf.SOURCE_HOST = conf.cfg["SINK_HOST_DB"]
conf.SOURCE_DB = conf.cfg["SINK_DB"]
conf.SOURCE_USER = conf.cfg["SINK_USER"]
conf.SOURCE_PASS = conf.cfg["SINK_PASS"]
conf.SOURCE_PORT = conf.cfg["SINK_PORT"]

current_directory = os.getcwd()
print(current_directory,'\n')

EXPORT_FILENAME = "default.sql"

EXPORT_DIR = current_directory+"/temp/default.sql"
print(EXPORT_DIR,'\n')

MYSQL_SERVICE = "D:/docker/default_db/mysql-5.7.31-winx64/bin/"
print(MYSQL_SERVICE,'\n')

EXPORT_TABLE = "runno inputm menulst menu_user doctor labcare icdthai icd10 druglst"
print("EXPORT FROM MAIN : "+EXPORT_TABLE,'\n')

#command_parts = MYSQL_SERVICE+"mysqldump --no-defaults --skip-extended-insert --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user="+conf.SOURCE_USER+" --port="+conf.SOURCE_PORT+" --password="+conf.SOURCE_PASS+" --host="+conf.SOURCE_HOST+" --default-character-set=utf8 "+conf.SOURCE_DB+" "+EXPORT_TABLE+" > "+EXPORT_DIR
command_parts = MYSQL_SERVICE+"mysqldump --skip-triggers --skip-comments --user="+conf.SOURCE_USER+" --port="+conf.SOURCE_PORT+" --password="+conf.SOURCE_PASS+" --host="+conf.SOURCE_HOST+" --default-character-set=utf8 "+conf.SOURCE_DB+" "+EXPORT_TABLE+" > "+EXPORT_DIR
print(command_parts,'\n')

os.system(command_parts)