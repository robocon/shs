#!/bin/bash

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 druglst > /var/www/html/dump_druglst.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/dump_druglst.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 drugslip > /var/www/html/dump_drugslip.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/dump_drugslip.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 labcare > /var/www/html/dump_labcare.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/dump_labcare.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 inputm > /var/www/html/inputm.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/inputm.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 menulst > /var/www/html/menulst.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/menulst.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 menu_user > /var/www/html/menu_user.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/menu_user.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 doctor > /var/www/html/doctor.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/doctor.sql

/usr/bin/mysqldump --user=sm3db_user --port=3306 --password=sm3dbPassword --host=192.168.131.240 --default-character-set=utf8 --extended-insert=FALSE  sm3db-utf8 bed > /var/www/html/bed.sql \
&& /bin/sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/MyISAM/InnoDB/g; s/COMMENT '.\+'/,/g; s/COMMENT='.\+'/;/g' /var/www/html/bed.sql