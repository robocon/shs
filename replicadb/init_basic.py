# Python mysql connect
# https://www.w3schools.com/python/python_mysql_getstarted.asp

# Python  call system command
# https://www.digitalocean.com/community/tutorials/python-system-command-os-subprocess-call

# Python try and exception
# https://dev.mysql.com/doc/connector-python/en/connector-python-api-errors-error.html

import mysql.connector
import os
import subprocess
import sys
import json
from subprocess import Popen
import config as conf

# runno
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=runno --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=runno"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# inputm
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=inputm --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=inputm"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# menulst
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=menulst --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=menulst"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# menu_user
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=menu_user --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=menu_user"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# doctor
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=doctor --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=doctor"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# druglst
p = Popen("download_default_data.bat", cwd=r"D:/docker/www/sm3dev/replicadb")
stdout, stderr = p.communicate()

p = Popen("import_default_data.bat", cwd=r"D:/docker/www/sm3dev/replicadb")
stdout, stderr = p.communicate()

# labcare
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=labcare --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=labcare"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# icdthai
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=icdthai --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=icdthai"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# icd10
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+conf.SOURCE_HOST_DB+" --source-user="+conf.SOURCE_USER+" --source-password="+conf.SOURCE_PASS+" --source-table=icd10 --sink-connect=jdbc:mysql://"+conf.SINK_HOST_DB+" --sink-user="+conf.SINK_USER+" --sink-password="+conf.SINK_PASS+" --sink-table=icd10"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')