<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;

$pindex    = max(1, intval($_GPC['page']));
$psize     = 20;
$condition = ' and o.uniacid=:uniacid and o.status>=1';
$params    = array(
    ':uniacid' => $_W['uniacid']
);
if (empty($starttime) || empty($endtime)) {
    $starttime = strtotime('-1 month');
    $endtime   = time();
}
if (!empty($_GPC['datetime'])) {
    $starttime = strtotime($_GPC['datetime']['start']);
    $endtime   = strtotime($_GPC['datetime']['end']);
    if (!empty($_GPC['searchtime'])) {
        $condition .= " AND o.createtime >= :starttime AND o.createtime <= :endtime ";
        $params[':starttime'] = $starttime;
        $params[':endtime']   = $endtime;
    }
}
if (!empty($_GPC['realname'])) {
    $condition .= " and m.realname like :realname";
    $params[':realname'] = "%{$_GPC['realname']}%";
}
if (!empty($_GPC['addressname'])) {
    $condition .= " and a.realname like :addressname";
    $params[':addressname'] = "%{$_GPC['addressname']}%";
}
if (!empty($_GPC['ordersn'])) {
    $condition .= " and o.ordersn like :ordersn";
    $params[':ordersn'] = "%{$_GPC['ordersn']}%";
}
$sql = "select o.id,o.ordersn,o.price,o.goodsprice, o.dispatchprice,o.createtime, o.paytype, a.realname as addressname,m.realname from " . tablename('eshop_order') . ' o ' . " left join " . tablename('eshop_member') . " m on o.openid = m.openid " . " left join " . tablename('eshop_member_address') . " a on a.id = o.addressid " . " where 1 {$condition} ";
if (empty($_GPC['export'])) {
    $sql .= "LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
}
$list = pdo_fetchall($sql, $params);
foreach ($list as &$row) {
    $row['ordersn'] = $row['ordersn'] . " ";
    $row['goods']   = pdo_fetchall("SELECT g.thumb,og.price,og.total,og.realprice,g.title,og.optionname from " . tablename('eshop_order_goods') . " og" . " left join " . tablename('eshop_goods') . " g on g.id=og.goodsid  " . " where og.uniacid = :uniacid and og.orderid=:orderid order by og.createtime  desc ", array(
        ':uniacid' => $_W['uniacid'],
        ':orderid' => $row['id']
    ));
    $totalmoney += $row['price'];
}
unset($row);
$totalcount = $total = pdo_fetchcolumn("select count(*) from " . tablename('eshop_order') . ' o ' . " left join " . tablename('eshop_member') . " m on o.openid = m.openid " . " left join " . tablename('eshop_member_address') . " a on a.id = o.addressid " . " where 1 {$condition}", $params);
$pager      = pagination($total, $pindex, $psize);
if ($_GPC['export'] == 1) {
    $list[] = array(
        'data' => '????????????',
        'count' => $totalcount
    );
    $list[] = array(
        'data' => '????????????',
        'count' => $totalmoney
    );
    foreach ($list as &$row) {
        if ($row['paytype'] == 1) {
            $row['paytype'] = '????????????';
        } else if ($row['paytype'] == 11) {
            $row['paytype'] = '????????????';
        } else if ($row['paytype'] == 21) {
            $row['paytype'] = '????????????';
        } else if ($row['paytype'] == 22) {
            $row['paytype'] = '???????????????';
        } else if ($row['paytype'] == 23) {
            $row['paytype'] = '????????????';
        } else if ($row['paytype'] == 3) {
            $row['paytype'] = '????????????';
        }
        $row['createtime'] = date('Y-m-d H:i', $row['createtime']);
    }
    unset($row);
    m('excel')->export($list, array(
        "title" => "????????????-" . date('Y-m-d-H-i', time()),
        "columns" => array(
            array(
                'title' => '?????????',
                'field' => 'ordersn',
                'width' => 24
            ),
            array(
                'title' => '?????????',
                'field' => 'price',
                'width' => 12
            ),
            array(
                'title' => '????????????',
                'field' => 'goodsprice',
                'width' => 12
            ),
            array(
                'title' => '??????',
                'field' => 'dispatchprice',
                'width' => 12
            ),
            array(
                'title' => '????????????',
                'field' => 'paytype',
                'width' => 12
            ),
            array(
                'title' => '?????????',
                'field' => 'realname',
                'width' => 12
            ),
            array(
                'title' => '?????????',
                'field' => 'addressname',
                'width' => 12
            ),
            array(
                'title' => '????????????',
                'field' => 'createtime',
                'width' => 24
            )
        )
    ));
}
include $this->template('order');
exit;