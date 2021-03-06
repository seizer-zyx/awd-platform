<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;

$op      = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$groups  = m('member')->getGroups();
$levels  = m('member')->getLevels();
$uniacid = $_W['uniacid'];
if ($op == 'display') {
    $pindex = max(1, intval($_GPC['page']));
    $psize  = 20;
    $type   = intval($_GPC['type']);

    $condition = ' and log.uniacid=:uniacid and log.type=:type and log.money<>0';
    $params    = array(
        ':uniacid' => $_W['uniacid'],
        ':type' => $type
    );
    if (!empty($_GPC['realname'])) {
        $_GPC['realname'] = trim($_GPC['realname']);
        $condition .= ' and (m.realname like :realname or m.nickname like :realname or m.mobile like :realname or m.openid=:ropenid)';
        $params[':realname'] = "%{$_GPC['realname']}%";
         $params[':ropenid'] = "{$_GPC['realname']}";
    }
    if (!empty($_GPC['logno'])) {
        $_GPC['logno'] = trim($_GPC['logno']);
        $condition .= ' and log.logno like :logno';
        $params[':logno'] = "%{$_GPC['logno']}%";
    }
    if (empty($starttime) || empty($endtime)) {
        $starttime = strtotime('-1 month');
        $endtime   = time();
    }
    if (!empty($_GPC['time'])) {
        $starttime = strtotime($_GPC['time']['start']);
        $endtime   = strtotime($_GPC['time']['end']);
        if ($_GPC['searchtime'] == '1') {
            $condition .= " AND log.createtime >= :starttime AND log.createtime <= :endtime ";
            $params[':starttime'] = $starttime;
            $params[':endtime']   = $endtime;
        }
    }
    if (!empty($_GPC['level'])) {
        $condition .= ' and m.level=' . intval($_GPC['level']);
    }
    if (!empty($_GPC['groupid'])) {
        $condition .= ' and m.groupid=' . intval($_GPC['groupid']);
    }
    if (!empty($_GPC['rechargetype'])) {
        $_GPC['rechargetype'] = trim($_GPC['rechargetype']);
        $condition            .= " AND log.rechargetype=:rechargetype";
        if ($_GPC['rechargetype'] == 'system1') {
            $condition = " AND log.rechargetype='system' and log.money<0";
        }
        $params[':rechargetype'] = trim($_GPC['rechargetype']);
    }
    if ($_GPC['status'] != '') {
        $condition .= ' and log.status=' . intval($_GPC['status']);
    }
    $sql = "select log.id,m.id as mid, m.realname,m.avatar,m.weixin,log.logno,log.type,log.status,log.rechargetype,m.nickname,m.mobile,g.groupname,log.money,log.createtime,l.levelname from " . tablename('eshop_member_log') . " log " . " left join " . tablename('eshop_member') . " m on m.openid=log.openid" . " left join " . tablename('eshop_member_group') . " g on m.groupid=g.id" . " left join " . tablename('eshop_member_level') . " l on m.level =l.id" . " where 1 {$condition} ORDER BY log.createtime DESC ";
    if (empty($_GPC['export'])) {
        $sql .= "LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
    }
    $list = pdo_fetchall($sql, $params);
    if ($_GPC['export'] == 1) {
       
        foreach ($list as &$row) {
            $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
            $row['groupname']  = empty($row['groupname']) ? '?????????' : $row['groupname'];
            $row['levelname']  = empty($row['levelname']) ? '????????????' : $row['levelname'];
            if ($row['status'] == 0) {
                if ($row['type'] == 0) {
                    $row['status'] = "?????????";
                } else {
                    $row['status'] = "?????????";
                }
            } else if ($row['status'] == 1) {
                if ($row['type'] == 0) {
                    $row['status'] = "????????????";
                } else {
                    $row['status'] = "??????";
                }
            } else if ($row['status'] == -1) {
                if ($row['type'] == 0) {
                    $row['status'] = "";
                } else {
                    $row['status'] = "??????";
                }
            }
            if ($row['rechargetype'] == 'system') {
                $row['rechargetype'] = "??????";
            } else if ($row['rechargetype'] == 'wechat') {
                $row['rechargetype'] = "??????";
            } else if ($row['rechargetype'] == 'alipay') {
                $row['rechargetype'] = "?????????";
            }
        }
        unset($row);
        $columns = array(
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
                'title' => '????????????',
                'field' => 'levelname',
                'width' => 12
            ),
            array(
                'title' => '????????????',
                'field' => 'groupname',
                'width' => 12
            ),
            array(
                'title' => (empty($type) ? "????????????" : "????????????"),
                'field' => 'money',
                'width' => 12
            ),
            array(
                'title' => (empty($type) ? "????????????" : "??????????????????"),
                'field' => 'createtime',
                'width' => 12
            )
        );
        if (empty($_GPC['type'])) {
            $columns[] = array(
                'title' => "????????????",
                'field' => 'rechargetype',
                'width' => 12
            );
        }
        m('excel')->export($list, array(
            "title" => (empty($type) ? "??????????????????-" : "??????????????????") . date('Y-m-d-H-i', time()),
            "columns" => $columns
        ));
    }
    $total = pdo_fetchcolumn("select count(*) from " . tablename('eshop_member_log') . " log " . " left join " . tablename('eshop_member') . " m on m.openid=log.openid and m.uniacid= log.uniacid" . " left join " . tablename('eshop_member_group') . " g on m.groupid=g.id" . " left join " . tablename('eshop_member_level') . " l on m.level =l.id" . " where 1 {$condition} ", $params);
    $pager = pagination($total, $pindex, $psize);
} else if ($op == 'pay') {
    $id      = intval($_GPC['id']);
    $paytype = $_GPC['paytype'];
    $set     = globalSetting('shop');
    $log     = pdo_fetch('select * from ' . tablename('eshop_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(
        ':id' => $id,
        ':uniacid' => $uniacid
    ));
    if (empty($log)) {
        message('???????????????!', '', 'error');
    }
    $member = m('member')->getMember($log['openid']);
    if ($paytype == 'manual') {
        pdo_update('eshop_member_log', array(
            'status' => 1
        ), array(
            'id' => $id,
            'uniacid' => $uniacid
        ));
        m('notice')->sendMemberLogMessage($logid);
       message('??????????????????!', referer(), 'success');
    } else if ($paytype == 'refuse') {
        pdo_update('eshop_member_log', array(
            'status' => -1
        ), array(
            'id' => $id,
            'uniacid' => $uniacid
        ));
          member_gold($log['openid'],$log['money'],'addgold',$set['name'] . '??????????????????');
        
     
        m('notice')->sendMemberLogMessage($log['id']);
        message('????????????!', referer(), 'success');
    } else if ($paytype == 'refund') {
        if (!empty($log['type'])) {
            message('??????????????????: ???????????????!', '', 'error');
        }
        if ($log['rechargetype'] == 'system') {
            message('??????????????????: ????????????????????????!', '', 'error');
        }
        $current_credit = m('member')->getCredit($log['openid'], 'credit2');
        if ($log['money'] > $current_credit) {
            message('??????????????????: ?????????????????????????????????????????????!', '', 'error');
        }
        $out_refund_no = 'RR' . substr($log['logno'], 2);
        
        if (is_error($result)) {
            message('??????????????????: ' . $result['message'], '', 'error');
        }
        pdo_update('eshop_member_log', array(
            'status' => 3
        ), array(
            'id' => $id,
            'uniacid' => $uniacid
        ));
        
         member_gold($log['openid'],$log['money'],'usegold','????????????');
        m('notice')->sendMemberLogMessage($log['id']);
        message('????????????????????????!', referer(), 'success');
    } else {
        message('?????????????????????!', '', 'error');
    }
}

include $this->template('log');