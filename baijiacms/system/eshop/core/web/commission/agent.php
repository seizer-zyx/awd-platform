<?php


global $_W, $_GPC;
$this_model=m('commission');
$set=globalSetting('commission');
$agentlevels = $this_model->getLevels();
$operation   = empty($_GPC['op']) ? 'display' : $_GPC['op'];
if ($operation == 'display') {
    $level     = $set['level'];
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $params    = array();
    $condition = '';
 
    if (!empty($_GPC['realname'])) {
        $_GPC['realname'] = trim($_GPC['realname']);
        $condition .= ' and ( dm.realname like :realname or dm.nickname like :realname or dm.mobile like :realname or dm.openid=:ropenid)';
        $params[':realname'] = "%{$_GPC['realname']}%";
        $params[':ropenid'] = "{$_GPC['realname']}";
    }
    if ($_GPC['parentid'] == '0') {
        $condition .= ' and dm.agentid=0';
    } else if (!empty($_GPC['parentname'])) {
        $_GPC['parentname'] = trim($_GPC['parentname']);
        $condition .= ' and ( p.mobile like :parentname or p.nickname like :parentname or p.realname like :parentname or p.openid=:parentopenid)';
        $params[':parentname'] = "%{$_GPC['parentname']}%";
        $params[':parentopenid'] = "{$_GPC['parentname']}";
    }
    if (empty($starttime) || empty($endtime)) {
        $starttime = strtotime('-1 month');
        $endtime   = time();
    }
    if (!empty($_GPC['time'])) {
        $starttime = strtotime($_GPC['time']['start']);
        $endtime   = strtotime($_GPC['time']['end']);
        if ($_GPC['searchtime'] == '1') {
            $condition .= " AND dm.agenttime >= :starttime AND dm.agenttime <= :endtime ";
            $params[':starttime'] = $starttime;
            $params[':endtime']   = $endtime;
        }
    }
    if (!empty($_GPC['agentlevel'])) {
        $condition .= ' and dm.agentlevel=' . intval($_GPC['agentlevel']);
    }
    if ($_GPC['status'] != '') {
        $condition .= ' and dm.status=' . intval($_GPC['status']);
    }
    if ($_GPC['agentblack'] != '') {
        $condition .= ' and dm.agentblack=' . intval($_GPC['agentblack']);
    }
    $sql = "select dm.*,dm.nickname,dm.avatar,l.levelname,p.nickname as parentname,p.avatar as parentavatar from " . tablename('eshop_member') . " dm " . " left join " . tablename('eshop_member') . " p on p.id = dm.agentid " . " left join " . tablename('eshop_commission_level') . " l on l.id = dm.agentlevel" . " where dm.uniacid = " . $_W['uniacid'] . " and dm.isagent =1  {$condition} ORDER BY dm.agenttime desc";
    if (empty($_GPC['export'])) {
        $sql .= " limit " . ($pindex - 1) * $psize . ',' . $psize;
    }
    $list  = pdo_fetchall($sql, $params);
    $total = pdo_fetchcolumn("select count(dm.id) from" . tablename('eshop_member') . " dm  " . " left join " . tablename('eshop_member') . " p on p.id = dm.agentid ". " where dm.uniacid =" . $_W['uniacid'] . " and dm.isagent =1 {$condition}", $params);
    foreach ($list as &$row) {
        $info              = $this_model->getInfo($row['openid'], array(
            'total',
            'pay'
        ));
        $row['levelcount'] = $info['agentcount'];
        if ($level >= 1) {
            $row['level1'] = $info['level1'];
        }
        if ($level >= 2) {
            $row['level2'] = $info['level2'];
        }
        if ($level >= 3) {
            $row['level3'] = $info['level3'];
        }
        $row['credit1']          = m('member')->getCredit($row['openid'], 'credit1');
        $row['credit2']          = m('member')->getCredit($row['openid'], 'credit2');
        $row['commission_total'] = $info['commission_total'];
        $row['commission_pay']   = $info['commission_pay'];
    }
    unset($row);
    if ($_GPC['export'] == '1') {
        foreach ($list as &$row) {
            $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            $row['agentime']   = empty($row['agenttime']) ? '' : date('Y-m-d H:i', $row['agentime']);
            $row['groupname']  = empty($row['groupname']) ? '?????????' : $row['groupname'];
            $row['levelname']  = empty($row['levelname']) ? '????????????' : $row['levelname'];
            $row['parentname'] = empty($row['parentname']) ? '??????' : "[" . $row['agentid'] . "]" . $row['parentname'];
            $row['statusstr']  = empty($row['status']) ? '' : "??????";
        }
        unset($row);
        m('excel')->export($list, array(
            "title" => "???????????????-" . date('Y-m-d-H-i', time()),
            "columns" => array(
                array(
                    'title' => 'ID',
                    'field' => 'id',
                    'width' => 12
                ),
                array(
                    'title' => '??????',
                    'field' => 'nickname',
                    'width' => 12
                ),
                array(
                    'title' => '??????',
                    'field' => 'realname',
                    'width' => 12
                ),
                array(
                    'title' => '?????????',
                    'field' => 'mobile',
                    'width' => 12
                ),
                array(
                    'title' => '?????????',
                    'field' => 'weixin',
                    'width' => 12
                ),
                array(
                    'title' => '?????????',
                    'field' => 'parentname',
                    'width' => 12
                ),
                array(
                    'title' => '???????????????',
                    'field' => 'levelname',
                    'width' => 12
                ),
                array(
                    'title' => '?????????',
                    'field' => 'clickcount',
                    'width' => 12
                ),
                array(
                    'title' => '?????????????????????',
                    'field' => 'levelcount',
                    'width' => 12
                ),
                array(
                    'title' => '????????????????????????',
                    'field' => 'level1',
                    'width' => 12
                ),
                array(
                    'title' => '????????????????????????',
                    'field' => 'level2',
                    'width' => 12
                ),
                array(
                    'title' => '????????????????????????',
                    'field' => 'level3',
                    'width' => 12
                ),
                array(
                    'title' => '????????????',
                    'field' => 'commission_total',
                    'width' => 12
                ),
                array(
                    'title' => '????????????',
                    'field' => 'commission_pay',
                    'width' => 12
                ),
                array(
                    'title' => '????????????',
                    'field' => 'createtime',
                    'width' => 12
                ),
                array(
                    'title' => '?????????????????????',
                    'field' => 'createtime',
                    'width' => 12
                ),
                array(
                    'title' => '????????????',
                    'field' => 'createtime',
                    'width' => 12
                )
            )
        ));
    }
    $pager = pagination($total, $pindex, $psize);
} else if ($operation == 'detail') {
    $id     = intval($_GPC['id']);
    $member = $this_model->getInfo($id, array(
        'total',
        'pay'
    ));
    if (checksubmit('submit')) {
        $data = is_array($_GPC['data']) ? $_GPC['data'] : array();
        if (empty($_GPC['oldstatus']) && $data['status'] == 1) {
            $time              = time();
            $data['agenttime'] = time();
            $this_model->sendMessage($member['openid'], array(
                'nickname' => $member['nickname'],
                'agenttime' => $time
            ), TM_COMMISSION_BECOME);
        }
     //   if (empty($_GPC['oldagentblack']) && $data['agentblack'] == 1) {
      //      $data['agentblack'] = 1;
       //     $data['status']     = 0;
        //    $data['isagent']    = 1;
        //}
       	if (!empty($data['isagent'])) {
       		$data['status']=1;
       		
      	if (empty($member['isagent'])) {
			       		 $this_model->sendMessage($member['openid'], array(
			        'nickname' => $member['nickname'],
			        'agenttime' => time()
			    ), TM_COMMISSION_BECOME);
			    if (!empty($member['agentid'])) {
			        $this_model->upgradeLevelByAgent($member['agentid']);
			    }
       	}
       	}else
       	{
       		$data['status']=0;
       	}
        $is_update_member_mobile=	update_member_mobile($member['openid'],$data['mobile']);
       	  	   	 if( $is_update_member_mobile==-1)
            {
                     message($data['mobile']."????????????????????????????????????");
           }
       	unset($data['mobile']);
        pdo_update('eshop_member', $data, array(
            'id' => $id,
            'uniacid' => $_W['uniacid']
        ));
        if (empty($_GPC['oldstatus']) && $data['status'] == 1) {
            if (!empty($member['agentid'])) {
                $this_model->upgradeLevelByAgent($member['agentid']);
            }
        }
        message('????????????!', $this->createWebUrl('commission/agent'), 'success');
    }
    $member['base_member'] = mysqld_select("SELECT * FROM ".table('base_member')." where  openid=:openid and beid=:beid  limit 1", array(':beid'=> $_W['uniacid'],':openid' =>  $member['openid']));
			
 
} else if ($operation == 'delete') {
    $id     = intval($_GPC['id']);
    $member = pdo_fetch("select * from " . tablename('eshop_member') . " where uniacid=:uniacid and id=:id limit 1 ", array(
        ':uniacid' => $_W['uniacid'],
        ':id' => $id
    ));
    if (empty($member)) {
        message('?????????????????????????????????????????????!', $this->createWebUrl('commission/agent'), 'error');
    }
    $agentcount = pdo_fetchcolumn('select count(*) from ' . tablename('eshop_member') . ' where  uniacid=:uniacid and agentid=:agentid limit 1 ', array(
        ':uniacid' => $_W['uniacid'],
        ':agentid' => $id
    ));
    if ($agentcount > 0) {
        message('??????????????????????????????????????????????????????!', '', 'error');
    }
    pdo_update('eshop_member', array(
        'isagent' => 0,
        'status' => 0
    ), array(
        'id' => $_GPC['id']
    ));
    message('???????????????', $this->createWebUrl('commission/agent'), 'success');
} else if ($operation == 'agentblack') {
    $id     = intval($_GPC['id']);
    $member = pdo_fetch("select * from " . tablename('eshop_member') . " where uniacid=:uniacid and id=:id limit 1 ", array(
        ':uniacid' => $_W['uniacid'],
        ':id' => $id
    ));
    if (empty($member)) {
        message('???????????????????????????????????????!', $this->createWebUrl('commission/agent'), 'error');
    }
    $black = intval($_GPC['black']);
    if (!empty($black)) {
        pdo_update('eshop_member', array(
            'isagent' => 1,
            'status' => 0,
            'agentblack' => 1
        ), array(
            'id' => $_GPC['id']
        ));
       message('????????????????????????', $this->createWebUrl('commission/agent'), 'success');
    } else {
        pdo_update('eshop_member', array(
            'isagent' => 1,
            'status' => 1,
            'agentblack' => 0
        ), array(
            'id' => $_GPC['id']
        ));
        message('????????????????????????', $this->createWebUrl('commission/agent'), 'success');
    }
} else if ($operation == 'user') {
    $level     = intval($_GPC['level']);
    $agentid   = intval($_GPC['id']);
    $member    = $this_model->getInfo($agentid);
    $total     = $member['agentcount'];
    $level1    = $member['level1'];
    $level2    = $member['level2'];
    $level3    = $member['level3'];
    $level11   = pdo_fetchcolumn('select count(*) from ' . tablename('eshop_member') . ' where isagent=0 and agentid=:agentid and uniacid=:uniacid limit 1', array(
        ':agentid' => $agentid,
        ':uniacid' => $_W['uniacid']
    ));
    $condition = '';
    $params    = array();
    if (empty($level)) {
        $condition = " and ( dm.agentid={$member['id']}";
        if ($level1 > 0) {
            $condition .= " or  dm.agentid in( " . implode(',', array_keys($member['level1_agentids'])) . ")";
        }
        if ($level2 > 0) {
            $condition .= " or  dm.agentid in( " . implode(',', array_keys($member['level2_agentids'])) . ")";
        }
        $condition .= ' )';
        $hasagent = true;
    } else if ($level == 1) {
        if ($level1 > 0) {
            $condition = " and dm.agentid={$member['id']}";
            $hasagent  = true;
        }
    } else if ($level == 2) {
        if ($level2 > 0) {
            $condition = " and dm.agentid in( " . implode(',', array_keys($member['level1_agentids'])) . ")";
            $hasagent  = true;
        }
    } else if ($level == 3) {
        if ($level3 > 0) {
            $condition = " and dm.agentid in( " . implode(',', array_keys($member['level2_agentids'])) . ")";
            $hasagent  = true;
        }
    }
    if (!empty($_GPC['realname'])) {
        $_GPC['realname'] = trim($_GPC['realname']);
        $condition .= ' and ( dm.realname like :realname or dm.nickname like :realname or dm.mobile like :realname and dm.openid=:ropenid)';
        $params[':realname'] = "%{$_GPC['realname']}%";
        $params[':ropenid'] = "{$_GPC['realname']}";
    }
    if ($_GPC['isagent'] != '') {
        $condition .= ' and dm.isagent=' . intval($_GPC['isagent']);
    }
    if ($_GPC['status'] != '') {
        $condition .= ' and dm.status=' . intval($_GPC['status']);
    }
    if (empty($starttime) || empty($endtime)) {
        $starttime = strtotime('-1 month');
        $endtime   = time();
    }
    if (!empty($_GPC['agentlevel'])) {
        $condition .= ' and dm.agentlevel=' . intval($_GPC['agentlevel']);
    }
    if ($_GPC['parentid'] == '0') {
        $condition .= ' and dm.agentid=0';
    } else if (!empty($_GPC['parentname'])) {
        $_GPC['parentname'] = trim($_GPC['parentname']);
        $condition .= ' and ( p.mobile like :parentname or p.nickname like :parentname or p.realname like :parentname)';
        $params[':parentname'] = "%{$_GPC['parentname']}%";
    }

    if ($_GPC['agentblack'] != '') {
        $condition .= ' and dm.agentblack=' . intval($_GPC['agentblack']);
    }
    $pindex = max(1, intval($_GPC['page']));
    $psize  = 20;
    $list   = array();
    if ($hasagent) {
        $total = pdo_fetchcolumn("select count(dm.id) from" . tablename('eshop_member') . " dm " . " left join " . tablename('eshop_member') . " p on p.id = dm.agentid " ." where dm.uniacid =" . $_W['uniacid'] . "  {$condition}", $params);
        $list  = pdo_fetchall("select dm.*,p.nickname as parentname,p.avatar as parentavatar  from " . tablename('eshop_member') . " dm " . " left join " . tablename('eshop_member') . " p on p.id = dm.agentid " . " where dm.uniacid = " . $_W['uniacid'] . "  {$condition}   ORDER BY dm.agenttime desc limit " . ($pindex - 1) * $psize . ',' . $psize, $params);
        $pager = pagination($total, $pindex, $psize);
        foreach ($list as &$row) {
            $info              = $this_model->getInfo($row['openid'], array(
                'total',
                'pay'
            ));
            $row['levelcount'] = $info['agentcount'];
            if ($set['level'] >= 1) {
                $row['level1'] = $info['level1'];
            }
            if ($set['level'] >= 2) {
                $row['level2'] = $info['level2'];
            }
            if ($set['level'] >= 3) {
                $row['level3'] = $info['level3'];
            }
            $row['credit1']          = m('member')->getCredit($row['openid'], 'credit1');
            $row['credit2']          = m('member')->getCredit($row['openid'], 'credit2');
            $row['commission_total'] = $info['commission_total'];
            $row['commission_pay']   = $info['commission_pay'];
            if ($row['agentid'] == $member['id']) {
                $row['level'] = 1;
            } else if (in_array($row['agentid'], array_keys($member['level1_agentids']))) {
                $row['level'] = 2;
            } else if (in_array($row['agentid'], array_keys($member['level2_agentids']))) {
                $row['level'] = 3;
            }
        }
    }
    unset($row);
    
    include $this->template('agent_user');
    exit;
} else if ($operation == 'query') {
    $kwd      = trim($_GPC['keyword']);
    $wechatid = intval($_GPC['wechatid']);
    if (empty($wechatid)) {
        $wechatid = $_W['uniacid'];
    }
    $params             = array();
    $params[':uniacid'] = $wechatid;
    $condition          = " and uniacid=:uniacid and isagent=1 and status=1";
    if (!empty($kwd)) {
        $condition .= " AND ( `nickname` LIKE :keyword or `realname` LIKE :keyword or `mobile` LIKE :keyword )";
        $params[':keyword'] = "%{$kwd}%";
    }
    if (!empty($_GPC['selfid'])) {
        $condition .= " and id<>" . intval($_GPC['selfid']);
    }
    $ds = pdo_fetchall('SELECT id,avatar,nickname,openid,realname,mobile FROM ' . tablename('eshop_member') . " WHERE 1 {$condition} order by createtime desc", $params);
    include $this->template('query');
    exit;
} else if ($operation == 'check') {
    $id     = intval($_GPC['id']);
    $member = $this_model->getInfo($id, array(
        'total',
        'pay'
    ));
    if (empty($member)) {
        message('??????????????????????????????????????????', '', 'error');
    }
    if ($member['isagent'] == 1 && $member['status'] == 1) {
        message('???????????????????????????????????????????????????!', '', 'error');
    }
   
    $time = time();
    pdo_update('eshop_member', array(
        'status' => 1,
        'agenttime' => $time
    ), array(
        'id' => $member['id'],
        'uniacid' => $_W['uniacid']
    ));
    $this_model->sendMessage($member['openid'], array(
        'nickname' => $member['nickname'],
        'agenttime' => $time
    ), TM_COMMISSION_BECOME);
    if (!empty($member['agentid'])) {
        $this_model->upgradeLevelByAgent($member['agentid']);
    }
    message('?????????????????????!', $this->createWebUrl('commission/agent'), 'success');
}

include $this->template('agent');