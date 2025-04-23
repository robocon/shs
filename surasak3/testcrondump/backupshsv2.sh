#!/bin/bash
/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opcard > /var/www/html/hl_opcard.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_opcard.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 drugreact > /var/www/html/hl_drugreact.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_drugreact.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 druglst > /var/www/html/hl_druglst.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_druglst.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 drugrx --where="date >= '2562-01-01 00:00:00'" > /var/www/html/hl_drugrx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_drugrx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opday > /var/www/html/hl_opday.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_opday.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opday2 > /var/www/html/hl_opday2.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_opday2.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opd --where="thidate >= '2562-01-01 00:00:00'" > /var/www/html/hl_opd.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_opd.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 patdata --where="date >= '2562-01-01 00:00:00'" > /var/www/html/hl_patdata.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_patdata.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 diag --where="regisdate_en >= '2019-01-01 00:00:00'" > /var/www/html/hl_diag.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_diag.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 orderhead > /var/www/html/hl_orderhead.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_orderhead.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 orderdetail > /var/www/html/hl_orderdetail.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_orderdetail.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 resulthead --where="orderdate >= '2019-01-01 00:00:00'" > /var/www/html/hl_resulthead.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_resulthead.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 resultdetail --where="authorisedate >= '2019-01-01 00:00:00'" > /var/www/html/hl_resultdetail.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_resultdetail.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 tmtlab > /var/www/html/hl_tmtlab.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_tmtlab.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 labcare > /var/www/html/hl_labcare.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_labcare.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 trauma > /var/www/html/hl_trauma.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_trauma.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ipicd9cm > /var/www/html/hl_ipicd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_ipicd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opicd9cm > /var/www/html/hl_opicd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_opicd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 icd9cm > /var/www/html/hl_icd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_icd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ipcard > /var/www/html/hl_ipcard.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/hl_ipcard.sql

###############  below is not in heallink  #############################################################################

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 depart > /var/www/html/depart.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/depart.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opacc > /var/www/html/opacc.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/opacc.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ddrugrx > /var/www/html/ddrugrx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/ddrugrx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 dphardep > /var/www/html/dphardep.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/dphardep.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 phardep > /var/www/html/phardep.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/phardep.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 appoint > /var/www/html/appoint.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/appoint.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 appoint_lab > /var/www/html/appoint_lab.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/appoint_lab.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ipacc > /var/www/html/ipacc.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/ipacc.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 food > /var/www/html/food.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/food.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opicd9cm > /var/www/html/opicd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/opicd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 dgprofile > /var/www/html/dgprofile.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' /var/www/html/dgprofile.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 stktranx > /var/www/html/stktranx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/stktranx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 digital_opcard > /var/www/html/digital_opcard.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/digital_opcard.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xray_stat > /var/www/html/xray_stat.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/xray_stat.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xray_doctor > /var/www/html/xray_doctor.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/xray_doctor.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xrayno > /var/www/html/xrayno.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/xrayno.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 poitems > /var/www/html/poitems.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/poitems.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 med_scan > /var/www/html/med_scan.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/med_scan.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 ipmonrep > /var/www/html/ipmonrep.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/ipmonrep.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 billtranx > /var/www/html/billtranx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/billtranx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 out_result_chkup > /var/www/html/out_result_chkup.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/out_result_chkup.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 drugreact > /var/www/html/drugreact.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/drugreact.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 diabetes_clinic_history > /var/www/html/diabetes_clinic_history.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/diabetes_clinic_history.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 diabetes_clinic > /var/www/html/diabetes_clinic.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/diabetes_clinic.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 hba1c_bs > /var/www/html/hba1c_bs.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/hba1c_bs.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 accrued > /var/www/html/accrued.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/accrued.sql