# 这是很久以前做的一个进销存的系统，建表语句我就增加到下面了
-- cms.chuku definition

CREATE TABLE `chuku` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kehumingcheng` varchar(64) DEFAULT NULL,
  `riqi` datetime DEFAULT NULL,
  `jitai` varchar(32) DEFAULT NULL,
  `mingcheng` varchar(255) DEFAULT NULL,
  `guige` varchar(10) DEFAULT NULL,
  `dengji` varchar(10) DEFAULT NULL,
  `jianshu` double(15,0) DEFAULT NULL,
  `dingzhong` double(15,2) DEFAULT NULL,
  `zhongliang` double(15,2) DEFAULT NULL,
  `danjia` double(15,2) DEFAULT NULL,
  `jine` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1731 DEFAULT CHARSET=utf8;
-- cms.ruku definition

CREATE TABLE `ruku` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `riqi` datetime DEFAULT NULL,
  `jitai` varchar(32) DEFAULT NULL,
  `pihao` varchar(32) DEFAULT NULL,
  `mingcheng` varchar(255) DEFAULT NULL,
  `guige` varchar(10) DEFAULT NULL,
  `dengji` varchar(10) DEFAULT NULL,
  `jianshu` double(15,0) DEFAULT NULL,
  `dingzhong` double(15,2) DEFAULT NULL,
  `zhongliang` double(15,2) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4453 DEFAULT CHARSET=utf8;
-- cms.jiecun definition

CREATE TABLE `jiecun` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jitai` varchar(32) DEFAULT NULL,
  `guige` varchar(32) DEFAULT NULL,
  `mingcheng` varchar(255) DEFAULT NULL,
  `dengji` varchar(10) DEFAULT NULL,
  `riqi` date DEFAULT NULL,
  `dingzhong` double(15,2) DEFAULT NULL,
  `jianshu` double(15,0) DEFAULT NULL,
  `zhongliang` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8;
-- cms.report definition

CREATE TABLE `report` (
  `jitai` varchar(32) DEFAULT NULL,
  `guige` varchar(32) DEFAULT NULL,
  `mingcheng` varchar(255) DEFAULT NULL,
  `dengji` varchar(10) DEFAULT NULL,
  `riqi` date DEFAULT NULL,
  `dingzhong` double(15,2) DEFAULT NULL,
  `rukujianshu` double(15,0) DEFAULT NULL,
  `rukuzhongliang` double(15,2) DEFAULT NULL,
  `chukujianshu` double(15,0) DEFAULT NULL,
  `chukuzhongliang` double(15,2) DEFAULT NULL,
  UNIQUE KEY `jitai` (`jitai`,`guige`,`mingcheng`,`dengji`,`riqi`,`dingzhong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create or replace
algorithm = UNDEFINED view `chukuhuizong` as
select
    concat(substr(`chuku`.`riqi`, 1, 7), '-01') as `riqi`,
    `chuku`.`mingcheng` as `mingcheng`,
    `chuku`.`guige` as `guige`,
    `chuku`.`dengji` as `dengji`,
    `chuku`.`dingzhong` as `dingzhong`,
    `chuku`.`jitai` as `jitai`,
    sum(`chuku`.`jianshu`) as `jianshu`,
    sum(`chuku`.`zhongliang`) as `zhongliang`
from
    `chuku`
group by
    concat(substr(`chuku`.`riqi`, 1, 7), '-01'),
    `chuku`.`mingcheng`,
    `chuku`.`guige`,
    `chuku`.`dengji`,
    `chuku`.`dingzhong`,
    `chuku`.`jitai`;

-- cms.jinxiaocunhuizong source

create or replace
algorithm = UNDEFINED view `jinxiaocunhuizong` as
select
    `r1`.`riqi` as `riqi`,
    `r1`.`mingcheng` as `mingcheng`,
    `r1`.`guige` as `guige`,
    `r1`.`dengji` as `dengji`,
    `r1`.`dingzhong` as `dingzhong`,
    `r1`.`jitai` as `jitai`,
    `r1`.`jianshu` as `rukujianshu`,
    `r1`.`zhongliang` as `rukuzhongliang`,
    `c1`.`jianshu` as `chukujianshu`,
    `c1`.`zhongliang` as `chukuzhongliang`
from
    (`rukuhuizong` `r1`
left join `chukuhuizong` `c1` on
    (((`r1`.`dengji` = `c1`.`dengji`)
        and (`r1`.`dingzhong` = `c1`.`dingzhong`)
            and (`r1`.`guige` = `c1`.`guige`)
                and (`r1`.`jitai` = `c1`.`jitai`)
                    and (`r1`.`mingcheng` = `c1`.`mingcheng`)
                        and (`r1`.`riqi` = `c1`.`riqi`))))
union
select
    `c2`.`riqi` as `riqi`,
    `c2`.`mingcheng` as `mingcheng`,
    `c2`.`guige` as `guige`,
    `c2`.`dengji` as `dengji`,
    `c2`.`dingzhong` as `dingzhong`,
    `c2`.`jitai` as `jitai`,
    `r2`.`jianshu` as `rukujianshu`,
    `r2`.`zhongliang` as `rukuzhongliang`,
    `c2`.`jianshu` as `chukujianshu`,
    `c2`.`zhongliang` as `chukuzhongliang`
from
    (`chukuhuizong` `c2`
left join `rukuhuizong` `r2` on
    (((`r2`.`dengji` = `c2`.`dengji`)
        and (`r2`.`dingzhong` = `c2`.`dingzhong`)
            and (`r2`.`guige` = `c2`.`guige`)
                and (`r2`.`jitai` = `c2`.`jitai`)
                    and (`r2`.`mingcheng` = `c2`.`mingcheng`)
                        and (`r2`.`riqi` = `c2`.`riqi`))));
                        
-- cms.rukuhuizong source

create or replace
algorithm = UNDEFINED view `rukuhuizong` as
select
    concat(substr(`ruku`.`riqi`, 1, 7), '-01') as `riqi`,
    `ruku`.`mingcheng` as `mingcheng`,
    `ruku`.`guige` as `guige`,
    `ruku`.`dengji` as `dengji`,
    `ruku`.`dingzhong` as `dingzhong`,
    `ruku`.`jitai` as `jitai`,
    sum(`ruku`.`jianshu`) as `jianshu`,
    sum(`ruku`.`zhongliang`) as `zhongliang`
from
    `ruku`
group by
    concat(substr(`ruku`.`riqi`, 1, 7), '-01'),
    `ruku`.`mingcheng`,
    `ruku`.`guige`,
    `ruku`.`dengji`,
    `ruku`.`dingzhong`,
    `ruku`.`jitai`;


