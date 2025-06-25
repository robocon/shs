#!/usr/bin/env python
import mysql.connector
import json

# Readme
# https://martin-thoma.com/configuration-files-in-python/#python-configuration-file

json_data_file = open("config.json", "r")
data = json.load(json_data_file)
json_data_file.close()

cfg = data['mysql']

SOURCE_HOST_DB = cfg["SOURCE_HOST_DB"]+"/"+cfg["SOURCE_DB"]
SOURCE_HOST = cfg["SOURCE_HOST_DB"]
SOURCE_DB = cfg["SOURCE_DB"]
SOURCE_USER = cfg["SOURCE_USER"]
SOURCE_PASS = cfg["SOURCE_PASS"]
SOURCE_PORT = cfg["SOURCE_PORT"]

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