DROP TABLE IF EXISTS php35_goods;
CREATE TABLE php35_goods
(
	id mediumint(8) unsigned not null auto_increment,
	goods_name varchar(30) not null comment '商品名称',
	market_price decimal(10,2) not null comment '市场价格',
	shop_price decimal(10,2) not null comment '本店价格',
	logo varchar(150) not null default '' comment '原图片路径',
	sm_logo varchar(150) not null default '' comment '缩略图路径',
	is_on_sale tinyint(1) unsigned not null default '1' comment '是否上架，1：上架 0：下架',
	is_delete tinyint(1) unsigned not null default '0' comment '是否加入回收站，1：删除了 0：未删除',
	sort_num tinyint(3) unsigned not null default '100' comment '排序的数字，越小越靠前',
	goods_desc text comment '商品描述',
	primary key (id),
	key shop_price(shop_price),
	key is_on_sale(is_on_sale),
	key sort_num(sort_num),
	key is_delete(is_delete)
)engine=MyISAM default charset utf8;

DROP TABLE IF EXISTS php35_goods_pics;
CREATE TABLE php35_goods_pics
(
	id mediumint(8) unsigned not null auto_increment,
	image_url varchar(150) not null comment '原图路径',
	sm_image_url varchar(150) not null comment '缩略图路径',
	goods_id mediumint unsigned not null comment '商品id',
	primary key(id),
	key goods_id(goods_id)
)engine=MyISAM default charset utf8;















