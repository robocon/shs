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

json_data_file = open("config.json", "r")
data = json.load(json_data_file)
json_data_file.close()

cfg = data['mysql']

SOURCE_HOST_DB = cfg["SOURCE_HOST_DB"]+"/"+cfg["SOURCE_DB"]
SOURCE_USER = cfg["SOURCE_USER"]
SOURCE_PASS = cfg["SOURCE_PASS"]
SOURCE_HOST = cfg["SOURCE_HOST_DB"]
SOURCE_DB = cfg["SOURCE_DB"]

SINK_HOST_DB = cfg["SINK_HOST_DB"]+":"+cfg["SINK_PORT"]+"/"+cfg["SINK_DB"]
SINK_USER = cfg["SINK_USER"]
SINK_PASS = cfg["SINK_PASS"]
SINK_HOST = cfg["SINK_HOST_DB"]
SINK_DB  = cfg["SINK_DB"]
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

# bed
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=bed --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=bed"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# drugreact
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=drugreact --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=drugreact"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# dt_rechallenge
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=dt_rechallenge --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=dt_rechallenge"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# ipcard
mycursor.execute("SELECT `row_id` AS latest_id FROM ipcard ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=ipcard --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=ipcard --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# dgprofile
# mycursor.execute("SELECT `row_id` AS latest_id FROM dgprofile ORDER BY row_id DESC LIMIT 1")
# myresult = mycursor.fetchone()
# latest_id = str(myresult["latest_id"])

# cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=dgprofile --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=dgprofile --sink-disable-truncate true"
# print("  REPLICADB COMMAND : ", str(cmd),'\n')
# returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
# print('returned value:', returned_value,'\n')

# drugreact_group
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=drugreact_group --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=drugreact_group"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# drugreact_group_list
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=drugreact_group_list --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=drugreact_group_list"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# druglst
# cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=druglst --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=druglst"
# print("  REPLICADB COMMAND : ", str(cmd),'\n')
# returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
# print('returned value:', returned_value,'\n')

# p = Popen("download_default_data.bat", cwd=r"D:/docker/www/sm3dev/replicadb")
# stdout, stderr = p.communicate()

# p = Popen("import_default_data.bat", cwd=r"D:/docker/www/sm3dev/replicadb")
# stdout, stderr = p.communicate()

# drug_interaction
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=drug_interaction --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=drug_interaction"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# dt_rechallenge
# cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=dt_rechallenge --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=dt_rechallenge"
# print("  REPLICADB COMMAND : ", str(cmd),'\n')
# returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
# print('returned value:', returned_value,'\n')

# opcard
mycursor.execute("SELECT `row_id` AS latest_id FROM opcard ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=opcard --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=opcard --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')