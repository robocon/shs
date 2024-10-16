# Python mysql connect
# https://www.w3schools.com/python/python_mysql_getstarted.asp

# Python  call system command
# https://www.digitalocean.com/community/tutorials/python-system-command-os-subprocess-call

# Python try and exception
# https://dev.mysql.com/doc/connector-python/en/connector-python-api-errors-error.html

# Replication Your DB With ReplicaDB
# https://github.com/osalvador/ReplicaDB

import mysql.connector
import os
import subprocess
import sys
import config as cfg

SOURCE_HOST_DB = cfg.mysql["SOURCE_HOST_DB"]+"/"+cfg.mysql["SOURCE_DB"]
SOURCE_USER = cfg.mysql["SOURCE_USER"]
SOURCE_PASS = cfg.mysql["SOURCE_PASS"]

SINK_HOST_DB = cfg.mysql["SINK_HOST_DB"]+"/"+cfg.mysql["SINK_DB"]
SINK_USER = cfg.mysql["SINK_USER"]
SINK_PASS = cfg.mysql["SINK_PASS"]

try:
    mydb = mysql.connector.connect(
        host=cfg.mysql["SINK_DB"],
        user=cfg.mysql["SINK_USER"],
        password=cfg.mysql["SINK_PASS"],
        database=cfg.mysql["SINK_DB"]
    )
    mycursor = mydb.cursor(dictionary=True) # dictionary=True ตอนเรียกใช้ใน for จะสามารถเรียกเป็นแบบ fieldname ได้
except mysql.connector.Error as err:
    print("Something went wrong: {}".format(err))

setGlobal = mycursor.execute("SET GLOBAL local_infile=1")
print('MYSQL Global : '+str(setGlobal)+'\n')

# hypertension_clinic
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=hypertension_clinic --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=hypertension_clinic"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')


# hypertension_history
cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=hypertension_history --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=hypertension_history"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')


# opd
mycursor.execute("SELECT `row_id` AS latest_id FROM opd ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=opd --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=opd --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')


# opcard
mycursor.execute("SELECT `row_id` AS latest_id FROM opcard ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=opcard --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=opcard --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# patdata
mycursor.execute("SELECT `row_id` AS latest_id FROM patdata ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=patdata --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=patdata --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')

# depart
mycursor.execute("SELECT `row_id` AS latest_id FROM depart ORDER BY row_id DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=depart --source-where=\"row_id>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=depart --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')


# resulthead
mycursor.execute("SELECT `autonumber` AS latest_id FROM resulthead ORDER BY autonumber DESC LIMIT 1")
myresult = mycursor.fetchone()
latest_id = str(myresult["latest_id"])

cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=resulthead --source-where=\"autonumber>"+latest_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=resulthead --sink-disable-truncate true"
print("  REPLICADB COMMAND : ", str(cmd),'\n')
returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
print('returned value:', returned_value,'\n')