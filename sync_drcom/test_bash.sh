#!/bin/bash
for i in {1..30}
do
   /var/www/html/sm3_drcom/sync_drcom/test_sync_vn.php
   /var/www/html/sm3_drcom/sync_drcom/test_sync_vs.php
   sleep 2
done