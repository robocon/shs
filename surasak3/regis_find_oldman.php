<?php 
/*
ทะเบียนหัวหน้าแสดงเมือง จะเอา ครอบครัว/กำลังพล ผู้สูงอายุ
select *, CAST(SUBSTRING(`age`,1,2) AS UNSIGNED) as `age`
from opday 
where thidate like '2565-03%' 
and typeservice like 'TS01%' 
and CAST(SUBSTRING(`age`,1,2) AS UNSIGNED) >= 60 
*/