<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;

$type = intval($_GPC['type']);
$id   = intval($_GPC['couponid']);
if (!empty($id)) {
    $coupon = pdo_fetch('SELECT * FROM ' . tablename('eshop_coupon') . ' WHERE id=:id and uniacid=:uniacid ', array(
        ':id' => $id,
        ':uniacid' => $_W['uniacid']
    ));
    if (empty($coupon)) {
        message('未找到优惠券!', '', 'error');
    }
}
if (checksubmit('submit')) {
    $class1 = intval($_GPC['send1']);
    $plog   = '';
    if ($class1 == 1) {
        $openids = explode(",", trim($_GPC['send_openid']));
        $plog    = "发放优惠券 ID: {$id} 方式: 指定 OPENID 人数: " . count($openids);
    } elseif ($class1 == 2) {
        $where = '';
        if (!empty($_GPC['send_level'])) {
            $where .= " and level =" . intval($_GPC['send_level']);
        }
        $members = pdo_fetchall("SELECT openid FROM " . tablename('eshop_member') . " WHERE uniacid = '{$_W['uniacid']}'" . $where, array(), 'openid');
        if (!empty($value1)) {
            $levelname = pdo_fetchcolumn('select levelname from ' . tablename('eshop_member_level') . ' where id=:id limit 1', array(
                ':id' => $value1
            ));
        } else {
            $levelname = "全部";
        }
        $openids = array_keys($members);
        $plog    = "发放优惠券 ID: {$id} 方式: 等级-{$levelname} 人数: " . count($member);
    } elseif ($class1 == 3) {
        $where = '';
        if (!empty($_GPC['send_group'])) {
            $where .= " and groupid =" . intval($_GPC['send_group']);
        }
        $members = pdo_fetchall("SELECT openid FROM " . tablename('eshop_member') . " WHERE uniacid = '{$_W['uniacid']}'" . $where, array(), 'openid');
        if (!empty($_GPC['send_group'])) {
            $groupname = pdo_fetchcolumn('select groupname from ' . tablename('eshop_member_group') . ' where id=:id limit 1', array(
                ':id' => $value1
            ));
        } else {
            $groupname = "全部分组";
        }
        $openids = array_keys($members);
        $plog    = "发放优惠券 ID: {$id}  方式: 分组-{$groupname} 人数: " . count($member);
    } elseif ($class1 == 4) {
        $members = pdo_fetchall("SELECT openid FROM " . tablename('eshop_member') . " WHERE uniacid = '{$_W['uniacid']}'" . $where, array(), 'openid');
        $openids = array_keys($members);
        $plog    = "发放优惠券 ID: {$id}  方式: 全部会员  分组:{$groupname} 人数: " . count($member);
    } elseif ($class1 == 5) {
        $where = '';
        if (!empty($_GPC['send_agentlevel'])) {
            $where .= " and agentlevel =" . intval($_GPC['send_agentlevel']);
        }
        $members = pdo_fetchall("SELECT openid FROM " . tablename('eshop_member') . " WHERE uniacid = '{$_W['uniacid']}' and isagent=1 and status=1 " . $where, array(), 'openid');
        if ($value1 != '') {
            $levelname = pdo_fetchcolumn('select levelname from ' . tablename('eshop_commission_level') . ' where id=:id limit 1', array(
                ':id' => $value1
            ));
        } else {
            $levelname = "全部";
        }
        $openids = array_keys($members);
        $plog    = "发放优惠券 ID: {$id}  方式: 分销商-{$levelname} 人数: " . count($member);
    }
    $mopenids = array();
    foreach ($openids as $openid) {
        $mopenids[] = "'" . str_replace("'", "''", $openid) . "'";
    }
    if (empty($mopenids)) {
        message('未找到发送的会员!', '', 'error');
    }
    $members = pdo_fetchall('select id,openid,nickname from ' . tablename('eshop_member') . ' where openid in (' . implode(',', $mopenids) . ") and uniacid={$_W['uniacid']}");
    if (empty($members)) {
        message('未找到发送的会员!', '', 'error');
    }
    if ($coupon['total'] != -1) {
        $last = m('coupon')->get_last_count($id);
        if ($last <= 0) {
            message('优惠券数量不足,无法发放!', '', 'error');
        }
        $need = count($members) - $last;
        if ($need > 0) {
            message("优惠券数量不足,请补充 {$need} 张优惠券才能发放!", '', 'error');
        }
    }

    $send_total = intval($_GPC['send_total']);
    $send_total <= 0 && $send_total = 1;
    $account = m('common')->getAccount();

    $time    = time();
    foreach ($members as $m) {
        for ($i = 1; $i <= $send_total; $i++) {
            $log = array(
                'uniacid' => $_W['uniacid'],
                'openid' => $m['openid'],
                'logno' => m('common')->createNO('coupon_log', 'logno', 'CC'),
                'couponid' => $id,
                'status' => 1,
                'paystatus' => -1,
                'creditstatus' => -1,
                'createtime' => $time,
                'getfrom' => 0
            );
            pdo_insert('eshop_coupon_log', $log);
            $logid = pdo_insertid();
            $data  = array(
                'uniacid' => $_W['uniacid'],
                'openid' => $m['openid'],
                'couponid' => $id,
                'gettype' => 0,
                'gettime' => $time,
                'senduid' => $_W['uid']
            );
            pdo_insert('eshop_coupon_data', $data);
        }
    }
    message('优惠券发放成功!', $this->createWebUrl('coupon/coupon'), 'success');
}
$list  = pdo_fetchall("SELECT * FROM " . tablename('eshop_member_level') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY level asc");
$list2 = pdo_fetchall("SELECT * FROM " . tablename('eshop_member_group') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id asc");
$list3 = pdo_fetchall("SELECT * FROM " . tablename('eshop_commission_level') . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id asc");

include $this->template('send');