# Python mysql connect
# https://www.w3schools.com/python/python_mysql_getstarted.asp
# Installation
#$> pip install mysql-connector-python
# Upgrade
#$> pip install mysql-connector-python --upgrade

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

print('\n UPDATE runno opday dphardep phardep ddrugrx drugrx \n')

# opday
mycursor.execute("SELECT `row_id` AS latest_id FROM opday ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=opday --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=opday --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')


# dphardep
mycursor.execute("SELECT `row_id` AS latest_id FROM dphardep ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=dphardep --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=dphardep --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# phardep
mycursor.execute("SELECT `row_id` AS latest_id FROM phardep ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=phardep --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=phardep --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# ddrugrx
mycursor.execute("SELECT `row_id` AS latest_id FROM ddrugrx ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=ddrugrx --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=ddrugrx --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# drugrx
mycursor.execute("SELECT `row_id` AS latest_id FROM drugrx ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=drugrx --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=drugrx --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')