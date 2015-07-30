ALTER TABLE php35_goods ADD sort_num tinyint(3) unsigned not null default '100' comment '排序的数字，越小越靠前';
ALTER TABLE php35_goods ADD INDEX sort_num(sort_num);