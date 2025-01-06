#!/bin/bash

# date=$(date '+%Y-%m-%d')

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 druglst > /var/www/html/sm3/testcrondump/dump_druglst.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' dump_druglst.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 drugslip > /var/www/html/sm3/testcrondump/dump_drugslip.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' dump_drugslip.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 labcare > /var/www/html/sm3/testcrondump/dump_labcare.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' dump_labcare.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 inputm > /var/www/html/sm3/testcrondump/inputm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' inputm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 menulst > /var/www/html/sm3/testcrondump/menulst.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' menulst.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 menu_user > /var/www/html/sm3/testcrondump/menu_user.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' menu_user.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 doctor > /var/www/html/sm3/testcrondump/doctor.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' doctor.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 bed > /var/www/html/sm3/testcrondump/bed.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' bed.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xxxxx > /var/www/html/sm3/testcrondump/xxxxx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xxxxx.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 xxxxx > /var/www/html/sm3/testcrondump/xxxxx.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' xxxxx.sql
