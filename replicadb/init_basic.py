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

json_data_file = open("config.json", "r")
data = json.load(json_data_file)
json_data_file.close()

cfg = data['mysql']

SOURCE_HOST_DB = cfg["SOURCE_HOST_DB"]+"/"+cfg["SOURCE_DB"]
SOURCE_USER = cfg["SOURCE_USER"]
SOURCE_PASS = cfg["SOURCE_PASS"]

SINK_HOST_DB = cfg["SINK_HOST_DB"]+":"+cfg["SINK_PORT"]+"/"+cfg["SINK_DB"]
SINK_USER = cfg["SINK_USER"]
SINK_PASS = cfg["SINK_PASS"]
SINK_PORT = cfg["SINK_PORT"]

try:
    mydb = mysql.connector.connect(
        host=cfg["SINK_HOST_DB"],
        user=cfg["SINK_USER"],
        password=cfg["SINK_PASS"],
        database=cfg["SINK_DB"],
        port=cfg["SINK_PORT"]
    )
    mycursor = mydb.cursor(dictionary=True) # dictionary=True ตอนเรียกใช้ใน for จะสามารถเรียกเป็นแบบ fieldname ได้
except mysql.connector.Error as err:
    print("Something went wrong: {}".format(err))

setGlobal = mycursor.execute("SET GLOBAL local_infile=1")
print('MYSQL Global : '+str(setGlobal)+'\n')

# runno
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=runno --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=runno"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# inputm
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=inputm --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=inputm"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# menulst
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=menulst --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=menulst"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# menu_user
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=menu_user --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=menu_user"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# doctor
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=doctor --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=doctor"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# druglst
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=druglst --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=druglst"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# labcare
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=labcare --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=labcare"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')