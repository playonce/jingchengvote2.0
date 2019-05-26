-- ���ݱ���

CREATE DATABASE IF NOT EXISTS `jingChengVote`;
USE `jingChengVote`;
-- ����Ա��
DROP TABLE IF EXISTS `vote_admin`;
CREATE TABLE `vote_admin`(
`id` tinyint unsigned auto_increment key,
`username` varchar(20) not null unique,
`password` char(32) not null
)DEFAULT CHARSET=gbk;

-- �����
DROP TABLE IF EXISTS `vote_cate`;
CREATE TABLE `vote_cate`(
`id` smallint unsigned auto_increment key,
`cName` varchar(50) unique
)DEFAULT CHARSET=gbk;


-- �ӷ����
DROP TABLE IF EXISTS `vote_suncate`;
CREATE TABLE `vote_suncate`(
`id` int unsigned auto_increment key,
`ckey` varchar(5)  not null,
`sName` varchar(50) not null,
check(ckey in('dw','ps','fl'))
)DEFAULT CHARSET=gbk;



-- ��Ʒ��
DROP TABLE IF EXISTS `vote_pro`;
CREATE TABLE `vote_pro`(
`id` int unsigned auto_increment primary key,
`aName` varchar(20) not null,
`college` varchar(20) not null,
`pName` varchar(50) not null ,
`pSn` varchar(50) not null,
`pDesc` text,
`pubTime` int unsigned not null,
`cId` smallint unsigned not null,
`sunId` smallint unsigned not null,
pVote int unsigned default 0,
UNIQUE KEY Name (pName,cID,sunId)  
)DEFAULT CHARSET=gbk;



-- ����
DROP TABLE IF EXISTS `vote_album`;
CREATE TABLE `vote_album`(
`id` int unsigned auto_increment key,
`pid` int unsigned not null,
`albumPath` varchar(50) not null,
`Path` VARCHAR (50)
)DEFAULT CHARSET=gbk;



-- ip��
DROP TABLE IF EXISTS `vote_ip`;
CREATE TABLE `vote_ip`(
iid int unsigned auto_increment key,
id int unsigned,
ip varchar(50)  not null,
foreign key(id) references vote_suncate(id)
);

--ipʱ���
DROP TABLE IF EXISTS `vote_iptime`;
CREATE TABLE `vote_iptime`(
iid  int unsigned  primary key not null,
id int unsigned,
ip varchar(50)  not null,
ttimes datetime not null,
foreign key(iid) references vote_ip(iid),
foreign key(id) references vote_suncate(id)
);


--������
--����֮ǰ
DROP TRIGGER IF EXISTS t_beforeinsert_on_ip;
DELIMITER $
CREATE TRIGGER t_beforeinsert_on_ip 
BEFORE INSERT ON vote_ip
FOR EACH ROW
BEGIN
     delete from vote_iptime where timestampdiff(SECOND,ttimes,now())>600;
	 
END $
DELIMITER ;
--����֮��
DROP TRIGGER IF EXISTS t_afterinsert_on_ip;
DELIMITER $
CREATE TRIGGER t_afterinsert_on_ip 
AFTER INSERT ON vote_ip
FOR EACH ROW
BEGIN
	if not exists(select * from vote_iptime where ip=new.ip and id=new.id)
		then insert into vote_iptime values(new.iid,new.id,new.ip,now());
	end if;
END $
DELIMITER ;

--���Բ���

 insert into vote_ip(id,ip) values(1,'173.168.1.1');
 
-- ���ֱ����

-- �����
alter table vote_pro add column pCate varchar(20) not null after pSn;
alter table vote_admin add column aNum varchar(20) not null after password;
alter table vote_pro add column pVote int unsigned after sunId;

-- ɾ����
alter table vote_pro drop column pCate;

-- �����Ĭ��
alter table vote_admin alter column aNum set default 0;

-- ɾ���ֶ�
delete from vote_admin where username = 'yang';
delete from vote_admin where username = 'admin';

-- �������
insert into vote_admin(username,password) values('admin','c393b0852203400895f6ebcaea335ccd'); 

-- �޸�����
update vote_admin set id=4 where username=admin3;

-- ������������ֵ
alter table vote_admin auto_increment = 4;

-- ��ձ����ݣ��ͷſռ�
truncate vote_admin;

-- �޸��ֶα����ʽ
 ALTER TABLE vote_cate CHANGE cName cName VARCHAR(50) CHARACTER SET gbk  NOT NULL;
 ALTER TABLE vote_pro CHANGE pubTime pubTime int unsigned  CHARACTER SET gbk  NOT NULL;
 
-- ɾ���ֶ�Ψһ��
 alter table vote_suncate drop index sName;
 
 --�޸�����
 alter table vote_suncate modify sName varchar(50);