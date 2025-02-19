#!/bin/bash
/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opcard > /var/www/html/sm3/testcrondump/hl_opcard.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_opcard.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 drugreact > /var/www/html/sm3/testcrondump/hl_drugreact.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_drugreact.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 druglst > /var/www/html/sm3/testcrondump/hl_druglst.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_druglst.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 drugrx --where="date >= '2562-01-01 00:00:00'" > /var/www/html/sm3/testcrondump/hl_drugrx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_drugrx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opday > /var/www/html/sm3/testcrondump/hl_opday.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_opday.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opday2 > /var/www/html/sm3/testcrondump/hl_opday2.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_opday2.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opd --where="thidate >= '2562-01-01 00:00:00'" > /var/www/html/sm3/testcrondump/hl_opd.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_opd.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 patdata --where="date >= '2562-01-01 00:00:00'" > /var/www/html/sm3/testcrondump/hl_patdata.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_patdata.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 diag --where="regisdate_en >= '2019-01-01 00:00:00'" > /var/www/html/sm3/testcrondump/hl_diag.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_diag.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 orderhead > /var/www/html/sm3/testcrondump/hl_orderhead.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_orderhead.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 orderdetail > /var/www/html/sm3/testcrondump/hl_orderdetail.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_orderdetail.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 resulthead --where="orderdate >= '2019-01-01 00:00:00'" > /var/www/html/sm3/testcrondump/hl_resulthead.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_resulthead.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 resultdetail --where="authorisedate >= '2019-01-01 00:00:00'" > /var/www/html/sm3/testcrondump/hl_resultdetail.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_resultdetail.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 tmtlab > /var/www/html/sm3/testcrondump/hl_tmtlab.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_tmtlab.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 labcare > /var/www/html/sm3/testcrondump/hl_labcare.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_labcare.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 trauma > /var/www/html/sm3/testcrondump/hl_trauma.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_trauma.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ipicd9cm > /var/www/html/sm3/testcrondump/hl_ipicd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_ipicd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opicd9cm > /var/www/html/sm3/testcrondump/hl_opicd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_opicd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 icd9cm > /var/www/html/sm3/testcrondump/hl_icd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_icd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ipcard > /var/www/html/sm3/testcrondump/hl_ipcard.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' hl_ipcard.sql

###############  below is not in heallink  #############################################################################

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 depart > /var/www/html/sm3/testcrondump/depart.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' depart.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opacc > /var/www/html/sm3/testcrondump/opacc.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' opacc.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ddrugrx > /var/www/html/sm3/testcrondump/ddrugrx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' ddrugrx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 dphardep > /var/www/html/sm3/testcrondump/dphardep.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' dphardep.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 phardep > /var/www/html/sm3/testcrondump/phardep.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' phardep.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 appoint > /var/www/html/sm3/testcrondump/appoint.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' appoint.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 appoint_lab > /var/www/html/sm3/testcrondump/appoint_lab.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' appoint_lab.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 ipacc > /var/www/html/sm3/testcrondump/ipacc.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' ipacc.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 food > /var/www/html/sm3/testcrondump/food.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' food.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 opicd9cm > /var/www/html/sm3/testcrondump/opicd9cm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' opicd9cm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbpassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=false  sm3db-utf8 dgprofile > /var/www/html/sm3/testcrondump/dgprofile.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/myisam/innodb/g; s/comment '.\+'/,/g; s/comment='.\+'/;/g' dgprofile.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 stktranx > /var/www/html/sm3/testcrondump/stktranx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' stktranx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 digital_opcard > /var/www/html/sm3/testcrondump/digital_opcard.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' digital_opcard.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xray_stat > /var/www/html/sm3/testcrondump/xray_stat.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xray_stat.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xray_doctor > /var/www/html/sm3/testcrondump/xray_doctor.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xray_doctor.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xrayno > /var/www/html/sm3/testcrondump/xrayno.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xrayno.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 poitems > /var/www/html/sm3/testcrondump/poitems.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' poitems.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 med_scan > /var/www/html/sm3/testcrondump/med_scan.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' med_scan.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 ipmonrep > /var/www/html/sm3/testcrondump/ipmonrep.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' ipmonrep.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 billtranx > /var/www/html/sm3/testcrondump/billtranx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' billtranx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 out_result_chkup > /var/www/html/sm3/testcrondump/out_result_chkup.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' out_result_chkup.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 drugreact > /var/www/html/sm3/testcrondump/drugreact.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' drugreact.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 diabetes_clinic_history > /var/www/html/sm3/testcrondump/diabetes_clinic_history.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' diabetes_clinic_history.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 diabetes_clinic > /var/www/html/sm3/testcrondump/diabetes_clinic.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' diabetes_clinic.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 hba1c_bs > /var/www/html/sm3/testcrondump/hba1c_bs.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' hba1c_bs.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 accrued > /var/www/html/sm3/testcrondump/accrued.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' accrued.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xxxxx > /var/www/html/sm3/testcrondump/xxxxx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xxxxx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xxxxx > /var/www/html/sm3/testcrondump/xxxxx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xxxxx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xxxxx > /var/www/html/sm3/testcrondump/xxxxx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xxxxx.sql
