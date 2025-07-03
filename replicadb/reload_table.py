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
SOURCE_HOST = cfg["SOURCE_HOST_DB"]
SOURCE_DB = cfg["SOURCE_DB"]
SOURCE_USER = cfg["SOURCE_USER"]
SOURCE_PASS = cfg["SOURCE_PASS"]
SOURCE_PORT = cfg["SOURCE_PORT"]

SINK_HOST_DB = cfg["SINK_HOST_DB"]+":"+cfg["SINK_PORT"]+"/"+cfg["SINK_DB"]
SINK_HOST = cfg["SINK_HOST_DB"]
SINK_DB = cfg["SINK_DB"]
SINK_USER = cfg["SINK_USER"]
SINK_PASS = cfg["SINK_PASS"]
SINK_PORT = cfg["SINK_PORT"]

# try:
#     mydbServer = mysql.connector.connect(
#         host=SOURCE_HOST,
#         user=SOURCE_USER,
#         password=SOURCE_PASS,
#         database=SOURCE_DB,
#         port=SOURCE_PORT
#     )
#     server131 = mydbServer.cursor(dictionary=True) # dictionary=True ตอนเรียกใช้ใน for จะสามารถเรียกเป็นแบบ fieldname ได้
# except mysql.connector.Error as err:
#     print("Something went wrong: {}".format(err))

try:
    mydb = mysql.connector.connect(
        host=cfg["SINK_HOST_DB"],
        user=cfg["SINK_USER"],
        password=cfg["SINK_PASS"],
        database=cfg["SINK_DB"],
        port=cfg["SINK_PORT"]
    )
    localHostCursor = mydb.cursor(dictionary=True) # dictionary=True ตอนเรียกใช้ใน for จะสามารถเรียกเป็นแบบ fieldname ได้
except mysql.connector.Error as err:
    print("Something went wrong: {}".format(err))

# setGlobal = localHostCursor.execute("SET GLOBAL local_infile=1")
# print('MYSQL Global : '+str(setGlobal)+'\n')



#### EXPORT ออกมาจากเซิฟเวอร์ 
#### !!! ถ้าแก้เงื่อนไข WHERE ของ server131 ต้องตามไปแก้ใน cmd ด้วย
# server131.execute("SELECT `row_id` AS `latest_id` FROM `dgprofile` WHERE `date` >= '2568-02-01 00:00:00' ORDER BY `row_id` ASC LIMIT 1")
# myresult = server131.fetchone()
# row_id = str(myresult["latest_id"])

# print("EXPORT FROM MAIN",'\n')
# cmd = "mysqldump --no-defaults --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user="+SOURCE_USER+" --port="+SOURCE_PORT+" --password="+SOURCE_PASS+" --host="+SOURCE_HOST+" --where=\"date >= '2568-02-01 00:00:00' \" --default-character-set=utf8 "+SOURCE_DB+" dgprofile > temp/dgprofile.sql"
# os.system(cmd)

# #### ล้างข้อมูลใน Localhost ก่อน
# localHostCursor.execute("TRUNCATE TABLE dgprofile")

# #### จากนั้น impaort ข้อมูลกลับเข้าไป
# print("IMPORT TO LOCAL",'\n')
# cmd = "mysql -u "+SINK_USER+" -p"+SINK_PASS+" -h "+SINK_HOST+" -P "+SINK_PORT+" "+SINK_DB+" < temp/dgprofile.sql"
# os.system(cmd)
# # ####


# cmd = "replicadb --mode=complete -j=1 --fetch-size 100 --verbose false --source-connect=jdbc:mysql://"+SOURCE_HOST_DB+" --source-user="+SOURCE_USER+" --source-password="+SOURCE_PASS+" --source-table=dgprofile --source-where=\"row_id>"+row_id+"\" --sink-connect=jdbc:mysql://"+SINK_HOST_DB+" --sink-user="+SINK_USER+" --sink-password="+SINK_PASS+" --sink-table=dgprofile --sink-disable-truncate true"
# print("  REPLICADB COMMAND : ", str(cmd),'\n')
# returned_value = subprocess.call(str(cmd), shell=True)  # returns the exit code in unix
# print('returned value:', returned_value,'\n')

############################################################################################################
# diag
print("EXPORT FROM MAIN : diag",'\n')
cmd = "mysqldump --no-defaults --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user="+SOURCE_USER+" --port="+SOURCE_PORT+" --password="+SOURCE_PASS+" --host="+SOURCE_HOST+" --where=\"svdaate_en >= '2025-01-01' \" --default-character-set=utf8 "+SOURCE_DB+" diag > temp/diag.sql"
os.system(cmd)

localHostCursor.execute("TRUNCATE TABLE diag")

print("IMPORT TO LOCAL : diag",'\n')
cmd = "mysql -u "+SINK_USER+" -p"+SINK_PASS+" -h "+SINK_HOST+" -P "+SINK_PORT+" "+SINK_DB+" < temp/diag.sql"
os.system(cmd)
os.remove("temp/diag.sql")


############################################################################################################
# opd
print("EXPORT FROM MAIN : opd",'\n')
cmd = "mysqldump --no-defaults --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user="+SOURCE_USER+" --port="+SOURCE_PORT+" --password="+SOURCE_PASS+" --host="+SOURCE_HOST+" --where=\"thidate >= '2568-01-01 00:00:00' \" --default-character-set=utf8 "+SOURCE_DB+" opd > temp/opd.sql"
os.system(cmd)

localHostCursor.execute("TRUNCATE TABLE opd")

print("IMPORT TO LOCAL : opd",'\n')
cmd = "mysql -u "+SINK_USER+" -p"+SINK_PASS+" -h "+SINK_HOST+" -P "+SINK_PORT+" "+SINK_DB+" < temp/opd.sql"
os.system(cmd)
os.remove("temp/opd.sql")


############################################################################################################
# patdata
print("EXPORT FROM MAIN : patdata",'\n')
cmd = "mysqldump --no-defaults --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user="+SOURCE_USER+" --port="+SOURCE_PORT+" --password="+SOURCE_PASS+" --host="+SOURCE_HOST+" --where=\"date >= '2568-01-01 00:00:00' \" --default-character-set=utf8 "+SOURCE_DB+" patdata > temp/patdata.sql"
os.system(cmd)

localHostCursor.execute("TRUNCATE TABLE patdata")

print("IMPORT TO LOCAL : patdata",'\n')
cmd = "mysql -u "+SINK_USER+" -p"+SINK_PASS+" -h "+SINK_HOST+" -P "+SINK_PORT+" "+SINK_DB+" < temp/patdata.sql"
os.system(cmd)
os.remove("temp/patdata.sql")


############################################################################################################
# resulthead
print("EXPORT FROM MAIN : resulthead",'\n')
cmd = "mysqldump --no-defaults --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user="+SOURCE_USER+" --port="+SOURCE_PORT+" --password="+SOURCE_PASS+" --host="+SOURCE_HOST+" --where=\"orderdate >= '2025-01-01 00:00:00' \" --default-character-set=utf8 "+SOURCE_DB+" resulthead > temp/resulthead.sql"
os.system(cmd)

localHostCursor.execute("TRUNCATE TABLE resulthead")

print("IMPORT TO LOCAL : resulthead",'\n')
cmd = "mysql -u "+SINK_USER+" -p"+SINK_PASS+" -h "+SINK_HOST+" -P "+SINK_PORT+" "+SINK_DB+" < temp/resulthead.sql"
os.system(cmd)
os.remove("temp/resulthead.sql")


############################################################
# resultdetail
print("EXPORT FROM MAIN : resultdetail",'\n')
cmd = "mysqldump --no-defaults --no-create-info --single-transaction --skip-add-locks --skip-triggers --skip-comments --skip-disable-keys --extended-insert=FALSE --user="+SOURCE_USER+" --port="+SOURCE_PORT+" --password="+SOURCE_PASS+" --host="+SOURCE_HOST+" --where=\"authorisedate >= '2025-01-01 00:00:00' \" --default-character-set=utf8 "+SOURCE_DB+" resultdetail > temp/resultdetail.sql"
os.system(cmd)

localHostCursor.execute("TRUNCATE TABLE resultdetail")

print("IMPORT TO LOCAL : resultdetail",'\n')
cmd = "mysql -u "+SINK_USER+" -p"+SINK_PASS+" -h "+SINK_HOST+" -P "+SINK_PORT+" "+SINK_DB+" < temp/resultdetail.sql"
os.system(cmd)
os.remove("temp/resultdetail.sql")