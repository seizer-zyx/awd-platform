<?php
if (!defined("IN_IA")) {
    print ("Access Denied");
}
global $_W, $_GPC;
$_GPC['cash']=0;
$shopset  = globalSetting('shop');
$sql      = 'SELECT * FROM ' . tablename('eshop_category') . ' WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC';
$category = pdo_fetchall($sql, array(
    ':uniacid' => $_W['uniacid']
), 'id');
$parent   = $children = array();
if (!empty($category)) {
    foreach ($category as $cid => $cate) {
        if (!empty($cate['parentid'])) {
            $children[$cate['parentid']][] = $cate;
        } else {
            $parent[$cate['id']] = $cate;
        }
    }
}
$pv        = p('virtual');

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == "change") {
    $id = intval($_GPC["id"]);
    if (empty($id)) {
        exit;
    }
    $type = trim($_GPC["type"]);
    $value = trim($_GPC["value"]);
    if (!in_array($type, array(
        "title",
        "marketprice",
        "total",
        "goodssn",
        "productsn"
    ))) {
        exit;
    }
    $goods = pdo_fetch("select id from " . tablename("eshop_goods") . " where id=:id and uniacid=:uniacid limit 1", array(
        ":uniacid" => $_W["uniacid"],
        ":id" => $id
    ));
    if (empty($goods)) {
        exit;
    }
    pdo_update("eshop_goods", array(
        $type => $value
    ) , array(
        "id" => $id
    ));
    exit;
} else if ($operation == "post") {
    $id = intval($_GPC['id']);

    $levels = m('member')->getLevels();
    $groups = m('member')->getGroups();
    if (!empty($id)) {
        $item = pdo_fetch("SELECT * FROM " . tablename('eshop_goods') . " WHERE id = :id", array(
            ':id' => $id
        ));
        $item['content']=preg_replace('/__ATTACHMENT__/',ATTACHMENT_WEBROOT, $item['content']);
        if (empty($item)) {
            message('抱歉，商品不存在或是已经删除！', '', 'error');
        }
        if($item['noticetype']!='')
        {
        $noticetype = explode(',', $item['noticetype']);
       	}
        $cates = explode(',', $item['ccates']);
        $discounts = json_decode($item['discounts'], true);
        $allspecs  = pdo_fetchall("select * from " . tablename('eshop_goods_spec') . " where goodsid=:id order by displayorder asc", array(
            ":id" => $id
        ));
        foreach ($allspecs as &$s) {
            $s['items'] = pdo_fetchall("select a.id,a.specid,a.title,a.thumb,a.show,a.displayorder,a.valueId,a.virtual,b.title as title2 from " . tablename('eshop_goods_spec_item') . " a left join " . tablename('eshop_virtual_type') . " b on b.id=a.virtual  where a.specid=:specid order by a.displayorder asc", array(
                ":specid" => $s['id']
            ));
        }
        unset($s);
     
        $piclist1 = unserialize($item['thumb_url']);
        $piclist  = array();
        if (is_array($piclist1)) {
            foreach ($piclist1 as $p) {
                $piclist[] = is_array($p) ? $p['attachment'] : $p;
            }
        }
        $html    = "";
        $options = pdo_fetchall("select * from " . tablename('eshop_goods_option') . " where goodsid=:id order by id asc", array(
            ':id' => $id
        ));
        $specs   = array();
        if (count($options) > 0) {
            $specitemids = explode("_", $options[0]['specs']);
            foreach ($specitemids as $itemid) {
                foreach ($allspecs as $ss) {
                    $items = $ss['items'];
                    foreach ($items as $it) {
                        if ($it['id'] == $itemid) {
                            $specs[] = $ss;
                            break;
                        }
                    }
                }
            }
            $html = '';
            $html .= '<table class="table table-bordered table-condensed">';
            $html .= '<thead>';
            $html .= '<tr class="active">';
            $len      = count($specs);
            $newlen   = 1;
            $h        = array();
            $rowspans = array();
            for ($i = 0; $i < $len; $i++) {
                $html .= "<th style='width:80px;'>" . $specs[$i]['title'] . "</th>";
                $itemlen = count($specs[$i]['items']);
                if ($itemlen <= 0) {
                    $itemlen = 1;
                }
                $newlen *= $itemlen;
                $h = array();
                for ($j = 0; $j < $newlen; $j++) {
                    $h[$i][$j] = array();
                }
                $l            = count($specs[$i]['items']);
                $rowspans[$i] = 1;
                for ($j = $i + 1; $j < $len; $j++) {
                    $rowspans[$i] *= count($specs[$j]['items']);
                }
            }
          
                $html .= '<th class="info" style="width:130px;"><div class=""><div style="padding-bottom:10px;text-align:center;font-size:16px;">库存</div><div class="input-group"><input type="text" class="form-control option_stock_all"  VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-hand-o-down" title="批量设置" onclick="setCol(\'option_stock\');"></a></span></div></div></th>';
                $html .= '<th class="success" style="width:150px;"><div class=""><div style="padding-bottom:10px;text-align:center;font-size:16px;">销售价格</div><div class="input-group"><input type="text" class="form-control option_marketprice_all"  VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-hand-o-down" title="批量设置" onclick="setCol(\'option_marketprice\');"></a></span></div></div></th>';
                $html .= '<th class="warning" style="width:150px;"><div class=""><div style="padding-bottom:10px;text-align:center;font-size:16px;">市场价格</div><div class="input-group"><input type="text" class="form-control option_productprice_all"  VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-hand-o-down" title="批量设置" onclick="setCol(\'option_productprice\');"></a></span></div></div></th>';
                $html .= '<th class="danger" style="width:150px;"><div class=""><div style="padding-bottom:10px;text-align:center;font-size:16px;">成本价格</div><div class="input-group"><input type="text" class="form-control option_costprice_all"  VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-hand-o-down" title="批量设置" onclick="setCol(\'option_costprice\');"></a></span></div></div></th>';
                $html .= '<th class="primary" style="width:150px;"><div class=""><div style="padding-bottom:10px;text-align:center;font-size:16px;">商品编码</div><div class="input-group"><input type="text" class="form-control option_goodssn_all"  VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-hand-o-down" title="批量设置" onclick="setCol(\'option_goodssn\');"></a></span></div></div></th>';
                $html .= '<th class="danger" style="width:150px;"><div class=""><div style="padding-bottom:10px;text-align:center;font-size:16px;">商品条码</div><div class="input-group"><input type="text" class="form-control option_productsn_all"  VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-hand-o-down" title="批量设置" onclick="setCol(\'option_productsn\');"></a></span></div></div></th>';
                $html .= '<th class="info" style="width:150px;"><div class=""><div style="padding-bottom:10px;text-align:center;font-size:16px;">重量（克）</div><div class="input-group"><input type="text" class="form-control option_weight_all"  VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-hand-o-down" title="批量设置" onclick="setCol(\'option_weight\');"></a></span></div></div></th>';
                $html .= '</tr></thead>';
            
            for ($m = 0; $m < $len; $m++) {
                $k   = 0;
                $kid = 0;
                $n   = 0;
                for ($j = 0; $j < $newlen; $j++) {
                    $rowspan = $rowspans[$m];
                    if ($j % $rowspan == 0) {
                        $h[$m][$j] = array(
                            "html" => "<td rowspan='" . $rowspan . "'>" . $specs[$m]['items'][$kid]['title'] . "</td>",
                            "id" => $specs[$m]['items'][$kid]['id']
                        );
                    } else {
                        $h[$m][$j] = array(
                            "html" => "",
                            "id" => $specs[$m]['items'][$kid]['id']
                        );
                    }
                    $n++;
                    if ($n == $rowspan) {
                        $kid++;
                        if ($kid > count($specs[$m]['items']) - 1) {
                            $kid = 0;
                        }
                        $n = 0;
                    }
                }
            }
            $hh = "";
            for ($i = 0; $i < $newlen; $i++) {
                $hh .= "<tr>";
                $ids = array();
                for ($j = 0; $j < $len; $j++) {
                    $hh .= $h[$j][$i]['html'];
                    $ids[] = $h[$j][$i]['id'];
                }
                $ids = implode("_", $ids);
                $val = array(
                    "id" => "",
                    "title" => "",
                    "stock" => "",
                    "costprice" => "",
                    "productprice" => "",
                    "marketprice" => "",
                    "weight" => "",
                    'virtual' => ''
                );
                foreach ($options as $o) {
                    if ($ids === $o['specs']) {
                        $val = array(
                            "id" => $o['id'],
                            "title" => $o['title'],
                            "stock" => $o['stock'],
                            "costprice" => $o['costprice'],
                            "productprice" => $o['productprice'],
                            "marketprice" => $o['marketprice'],
                            "goodssn" => $o['goodssn'],
                            "productsn" => $o['productsn'],
                            "weight" => $o['weight'],
                            'virtual' => $o['virtual']
                        );
                        break;
                    }
                }
                    $hh .= '<td class="info">';
                    $hh .= '<input name="option_stock_' . $ids . '[]"  type="text" class="form-control option_stock option_stock_' . $ids . '" value="' . $val['stock'] . '"/>';
                    $hh .= '<input name="option_id_' . $ids . '[]"  type="hidden" class="form-control option_id option_id_' . $ids . '" value="' . $val['id'] . '"/>';
                    $hh .= '<input name="option_ids[]"  type="hidden" class="form-control option_ids option_ids_' . $ids . '" value="' . $ids . '"/>';
                    $hh .= '<input name="option_title_' . $ids . '[]"  type="hidden" class="form-control option_title option_title_' . $ids . '" value="' . $val['title'] . '"/>';
                    $hh .= '<input name="option_virtual_' . $ids . '[]"  type="hidden" class="form-control option_title option_virtual_' . $ids . '" value="' . $val['virtual'] . '"/>';
                    $hh .= '</td>';
                    $hh .= '<td class="success"><input name="option_marketprice_' . $ids . '[]" type="text" class="form-control option_marketprice option_marketprice_' . $ids . '" value="' . $val['marketprice'] . '"/></td>';
                    $hh .= '<td class="warning"><input name="option_productprice_' . $ids . '[]" type="text" class="form-control option_productprice option_productprice_' . $ids . '" " value="' . $val['productprice'] . '"/></td>';
                    $hh .= '<td class="danger"><input name="option_costprice_' . $ids . '[]" type="text" class="form-control option_costprice option_costprice_' . $ids . '" " value="' . $val['costprice'] . '"/></td>';
                    $hh .= '<td class="primary"><input name="option_goodssn_' . $ids . '[]" type="text" class="form-control option_goodssn option_goodssn_' . $ids . '" " value="' . $val['goodssn'] . '"/></td>';
                    $hh .= '<td class="danger"><input name="option_productsn_' . $ids . '[]" type="text" class="form-control option_productsn option_productsn_' . $ids . '" " value="' . $val['productsn'] . '"/></td>';
                    $hh .= '<td class="info"><input name="option_weight_' . $ids . '[]" type="text" class="form-control option_weight option_weight_' . $ids . '" " value="' . $val['weight'] . '"/></td>';
                    $hh .= '</tr>';
              
            }
            $html .= $hh;
            $html .= "</table>";
        }
        if ($item['showlevels'] != '') {
            $item['showlevels'] = explode(',', $item['showlevels']);
        }
        if ($item['buylevels'] != '') {
            $item['buylevels'] = explode(',', $item['buylevels']);
        }
        if ($item['showgroups'] != '') {
            $item['showgroups'] = explode(',', $item['showgroups']);
        }
        if ($item['buygroups'] != '') {
            $item['buygroups'] = explode(',', $item['buygroups']);
        }
        $stores = array();
        if (!empty($item['storeids'])) {
            $stores = pdo_fetchall('select id,storename from ' . tablename('eshop_store') . ' where id in (' . $item['storeids'] . ' ) and uniacid=' . $_W['uniacid']);
        }
        if (!empty($item['noticeopenid'])) {
            $saler = m('member')->getMember($item['noticeopenid']);
        }
    }
    if (empty($category)) {
        message('抱歉，请您先添加商品分类！', $this->createWebUrl('shop/category', array(
            'op' => 'post'
        )), 'error');
    }
    $dispatch_data = pdo_fetchall("select * from".tablename("eshop_dispatch")."where uniacid =:uniacid and enabled = 1 order by displayorder desc",array(":uniacid"=>$_W["uniacid"])); 
   if (checksubmit("submit")) {

        if (empty($_GPC['goodsname'])) {
            message('请输入商品名称！');
        }
        if (empty($_GPC['category']['parentid'])) {
            message('请选择商品分类！');
        }
        if (empty($_GPC['thumbs'])) {
            $_GPC['thumbs'] = array();
        }
        $data    = array(
            'uniacid' => intval($_W['uniacid']),
            'displayorder' => intval($_GPC['displayorder']),
            'title' => trim($_GPC['goodsname']),
            'pcate' => intval($_GPC['category']['parentid']),
            'ccate' => intval($_GPC['category']['childid']),
            'tcate' => intval($_GPC['category']['thirdid']),
            'thumb' => save_media($_GPC['thumb']),
            'type' => intval($_GPC['type']),
            'isindex' => intval($_GPC['isindex']),
            'isrecommand' => intval($_GPC['isrecommand']),
            'ishot' => intval($_GPC['ishot']),
            'isnew' => intval($_GPC['isnew']),
            'isdiscount' => intval($_GPC['isdiscount']),
            'issendfree' => intval($_GPC['issendfree']),
            'isnodiscount' => intval($_GPC['isnodiscount']),
            'istime' => intval($_GPC['istime']),
            'timestart' => strtotime($_GPC['timestart']),
            'timeend' => strtotime($_GPC['timeend']),
            'description' => trim($_GPC['description']),
            'goodssn' => trim($_GPC['goodssn']),
            'unit' => trim($_GPC['unit']),
            'createtime' => TIMESTAMP,
            'total' => intval($_GPC['total']),
            'totalcnf' => intval($_GPC['totalcnf']),
            'marketprice' => $_GPC['marketprice'],
            'weight' => $_GPC['weight'],
            'costprice' => $_GPC['costprice'],
            'productprice' => trim($_GPC['productprice']),
            'productsn' => trim($_GPC['productsn']),
            'credit' => trim($_GPC['credit']),
            'maxbuy' => intval($_GPC['maxbuy']),
            'usermaxbuy' => intval($_GPC['usermaxbuy']),
            'hasoption' => intval($_GPC['hasoption']),
            'sales' => intval($_GPC['sales']),
            'share_icon' => trim($_GPC['share_icon']),
            'share_title' => trim($_GPC['share_title']),
            'cash' => intval($_GPC['cash']),
            'status' => intval($_GPC['status']),
            'showlevels' => is_array($_GPC['showlevels']) ? implode(",", $_GPC['showlevels']) : '',
            'buylevels' => is_array($_GPC['buylevels']) ? implode(",", $_GPC['buylevels']) : '',
            'showgroups' => is_array($_GPC['showgroups']) ? implode(",", $_GPC['showgroups']) : '',
            'buygroups' => is_array($_GPC['buygroups']) ? implode(",", $_GPC['buygroups']) : '',
            'isverify' => intval($_GPC['isverify']),
            'storeids' => is_array($_GPC['storeids']) ? implode(',', $_GPC['storeids']) : '',
            'noticeopenid' => trim($_GPC['noticeopenid']),
            'noticetype' => is_array($_GPC['noticetype']) ? implode(",", $_GPC['noticetype']) : '',
            'needfollow' => intval($_GPC['needfollow']),
            'followurl' => trim($_GPC['followurl']),
            'followtip' => trim($_GPC['followtip']),
            'deduct' => $_GPC['deduct'],
	    "manydeduct"=>$_GPC["manydeduct"],
	    "deduct2"=>0,
            'virtual' => intval($_GPC['type']) == 3 ? intval($_GPC['virtual']) : 0,
            'discounts' => is_array($_GPC['discounts']) ? json_encode($_GPC['discounts']) : array(),
			"ednum"=>intval($_GPC["ednum"]) ,
			"edareas"=>trim($_GPC["edareas"]) ,
			"edmoney"=>trim($_GPC["edmoney"]) 
        );
        $cateset = globalSetting('shop');
        $pcates  = array();
        $ccates  = array();
        $tcates  = array();
        if (is_array($_GPC['cates'])) {
            $postcates = $_GPC['cates'];
            foreach ($postcates as $pid) {
                    $ccate    = pdo_fetch('select id ,parentid from ' . tablename('eshop_category') . ' where id=:id and uniacid=:uniacid limit 1', array(
                        ':id' => $pid,
                        ':uniacid' => $_W['uniacid']
                    ));
                    $ccates[] = $ccate['id'];
                    $pcates[] = $ccate['parentid'];
            }
        }
        $data['pcates'] = implode(',', $pcates);
        $data['ccates'] = implode(',', $ccates);
        $data['tcates'] = implode(',', $tcates);
        $content        = htmlspecialchars_decode($_GPC['content']);
        preg_match_all("/<img.*?src=[\'| \"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg]?))[\'|\"].*?[\/]?>/", $content, $imgs);
        $images = array();
        if (isset($imgs[1])) {
            foreach ($imgs[1] as $img) {
                $im       = array(
                    "old" => $img,
                    "new" => save_media($img)
                );
                $images[] = $im;
            }
        }
        foreach ($images as $img) {
            $content = str_replace($img['old'], $img['new'], $content);
        }
        $data['content'] = $content;
      
            $cset = globalSetting('commission');
            if (!empty($cset['level'])) {
                $data['nocommission']     = intval($_GPC['nocommission']);
                $data['hascommission']    = intval($_GPC['hascommission']);
                $data['hidecommission']   = intval($_GPC['hidecommission']);
                $data['commission1_rate'] = $_GPC['commission1_rate'];
                $data['commission2_rate'] = $_GPC['commission2_rate'];
                $data['commission3_rate'] = $_GPC['commission3_rate'];
                $data['commission1_pay']  = $_GPC['commission1_pay'];
                $data['commission2_pay']  = $_GPC['commission2_pay'];
                $data['commission3_pay']  = $_GPC['commission3_pay'];
                $data['commission_thumb'] = save_media($_GPC['commission_thumb']);
            }
     
    
      $data["dispatchtype"] = intval($_GPC["dispatchtype"]);
      $data["dispatchprice"] = $_GPC["dispatchprice"];
      $data["dispatchid"] = $_GPC["dispatchid"];
        if ($data['total'] === -1) {
            $data['total']    = 0;
            $data['totalcnf'] = 2;
        }
        if (is_array($_GPC['thumbs'])) {
            $thumbs    = $_GPC['thumbs'];
            $thumb_url = array();
            foreach ($thumbs as $th) {
                $thumb_url[] = save_media($th);
            }
            $data['thumb_url'] = serialize($thumb_url);
        }
        if (empty($id)) {
            pdo_insert('eshop_goods', $data);
            $id = pdo_insertid();
         
        } else {
            unset($data['createtime']);
            pdo_update('eshop_goods', $data, array(
                'id' => $id
            ));
           
        }
        $totalstocks         = 0;
        $files       = $_FILES;
        $spec_ids    = $_POST['spec_id'];
        $spec_titles = $_POST['spec_title'];
        $specids     = array();
        $len         = count($spec_ids);
        $specids     = array();
        $spec_items  = array();
        for ($k = 0; $k < $len; $k++) {
            $spec_id     = "";
            $get_spec_id = $spec_ids[$k];
            $a           = array(
                "uniacid" => $_W['uniacid'],
                "goodsid" => $id,
                "displayorder" => $k,
                "title" => $spec_titles[$get_spec_id]
            );
            if (is_numeric($get_spec_id)) {
                pdo_update("eshop_goods_spec", $a, array(
                    "id" => $get_spec_id
                ));
                $spec_id = $get_spec_id;
            } else {
                pdo_insert('eshop_goods_spec', $a);
                $spec_id = pdo_insertid();
            }
            $spec_item_ids       = $_POST["spec_item_id_" . $get_spec_id];
            $spec_item_titles    = $_POST["spec_item_title_" . $get_spec_id];
            $spec_item_shows     = $_POST["spec_item_show_" . $get_spec_id];
            $spec_item_thumbs    = $_POST["spec_item_thumb_" . $get_spec_id];
            $spec_item_oldthumbs = $_POST["spec_item_oldthumb_" . $get_spec_id];
            $spec_item_virtuals  = $_POST["spec_item_virtual_" . $get_spec_id];
            $itemlen             = count($spec_item_ids);
            $itemids             = array();
            for ($n = 0; $n < $itemlen; $n++) {
                $item_id     = "";
                $get_item_id = $spec_item_ids[$n];
                $d           = array(
                    "uniacid" => $_W['uniacid'],
                    "specid" => $spec_id,
                    "displayorder" => $n,
                    "title" => $spec_item_titles[$n],
                    "show" => $spec_item_shows[$n],
                    "thumb" => save_media($spec_item_thumbs[$n]),
                    "virtual" => $data['type'] == 3 ? $spec_item_virtuals[$n] : 0
                );
                $f           = "spec_item_thumb_" . $get_item_id;
                if (is_numeric($get_item_id)) {
                    pdo_update("eshop_goods_spec_item", $d, array(
                        "id" => $get_item_id
                    ));
                    $item_id = $get_item_id;
                } else {
                    pdo_insert('eshop_goods_spec_item', $d);
                    $item_id = pdo_insertid();
                }
                $itemids[]    = $item_id;
                $d['get_id']  = $get_item_id;
                $d['id']      = $item_id;
                $spec_items[] = $d;
            }
            if (count($itemids) > 0) {
                pdo_query("delete from " . tablename('eshop_goods_spec_item') . " where uniacid={$_W['uniacid']} and specid=$spec_id and id not in (" . implode(",", $itemids) . ")");
            } else {
                pdo_query('delete from ' . tablename('eshop_goods_spec_item') . " where uniacid={$_W['uniacid']} and specid=$spec_id");
            }
            pdo_update('eshop_goods_spec', array(
                'content' => serialize($itemids)
            ), array(
                "id" => $spec_id
            ));
            $specids[] = $spec_id;
        }
        if (count($specids) > 0) {
            pdo_query("delete from " . tablename('eshop_goods_spec') . " where uniacid={$_W['uniacid']} and goodsid=$id and id not in (" . implode(",", $specids) . ")");
        } else {
            pdo_query('delete from ' . tablename('eshop_goods_spec') . " where uniacid={$_W['uniacid']} and goodsid=$id");
        }
        $option_idss          = $_POST['option_ids'];
        $option_productprices = $_POST['option_productprice'];
        $option_marketprices  = $_POST['option_marketprice'];
        $option_costprices    = $_POST['option_costprice'];
        $option_stocks        = $_POST['option_stock'];
        $option_weights       = $_POST['option_weight'];
        $option_goodssns      = $_POST['option_goodssn'];
        $option_productssns   = $_POST['option_productsn'];
        $len                  = count($option_idss);
        $optionids            = array();
        for ($k = 0; $k < $len; $k++) {
            $option_id     = "";
            $ids           = $option_idss[$k];
            $get_option_id = $_GPC['option_id_' . $ids][0];
            $idsarr        = explode("_", $ids);
            $newids        = array();
            foreach ($idsarr as $key => $ida) {
                foreach ($spec_items as $it) {
                    if ($it['get_id'] == $ida) {
                        $newids[] = $it['id'];
                        break;
                    }
                }
            }
            $newids = implode("_", $newids);
            $a      = array(
                "uniacid" => $_W['uniacid'],
                "title" => $_GPC['option_title_' . $ids][0],
                "productprice" => $_GPC['option_productprice_' . $ids][0],
                "costprice" => $_GPC['option_costprice_' . $ids][0],
                "marketprice" => $_GPC['option_marketprice_' . $ids][0],
                "stock" => $_GPC['option_stock_' . $ids][0],
                "weight" => $_GPC['option_weight_' . $ids][0],
                "goodssn" => $_GPC['option_goodssn_' . $ids][0],
                "productsn" => $_GPC['option_productsn_' . $ids][0],
                "goodsid" => $id,
                "specs" => $newids,
                'virtual' => $data['type'] == 3 ? $_GPC['option_virtual_' . $ids][0] : 0
            );
            $totalstocks += $a['stock'];
            if (empty($get_option_id)) {
                pdo_insert("eshop_goods_option", $a);
                $option_id = pdo_insertid();
            } else {
                pdo_update('eshop_goods_option', $a, array(
                    'id' => $get_option_id
                ));
                $option_id = $get_option_id;
            }
            $optionids[] = $option_id;
        }
        if (count($optionids) > 0) {
            pdo_query("delete from " . tablename('eshop_goods_option') . " where goodsid=$id and id not in ( " . implode(',', $optionids) . ")");
        } else {
            pdo_query('delete from ' . tablename('eshop_goods_option') . " where goodsid=$id");
        }
        if ($data['type'] == 3 ) {
            $pv->updateGoodsStock($id);
        } else {
            if (($totalstocks > 0) && ($data['totalcnf'] != 2)) {
                pdo_update("eshop_goods", array(
                    "total" => $totalstocks
                ), array(
                    "id" => $id
                ));
            }
        }
        message('商品更新成功！', $this->createWebUrl('shop/goods', array(
            'op' => 'post',
            'id' => $id
        )), 'success');
    }
 
        $com_set = globalSetting('commission');
 
 
        $virtual_types = pdo_fetchall("select * from " . tablename('eshop_virtual_type') . " where uniacid=:uniacid order by id asc", array(
            ":uniacid" => $_W['uniacid']
        ));

    $levels  = m('member')->getLevels();


 require_once WEB_ROOT . '/includes/lib/json/xml2json.php';;
 $file = ESHOP_AREA_XMLFILE;
 $content = file_get_contents($file);
  $json = xml2json::transformXmlStringToJson($content);
$areas = json_decode($json, true);

} elseif ($operation == 'display') {
	$_GPC['goodsfrom'] =empty($_GPC['goodsfrom'] )?'sale':$_GPC['goodsfrom'] ;
	$goodsfrom=$_GPC['goodsfrom'];

    if (!empty($_GPC['displayorder'])) {
    
        foreach ($_GPC['displayorder'] as $id => $displayorder) {
            pdo_update('eshop_goods', array(
                'displayorder' => $displayorder
            ), array(
                'id' => $id
            ));
        }
       
        message('商品排序更新成功！', $this->createWebUrl('shop/goods', array(
            'op' => 'display'
        )), 'success');
    }
    $pindex    = max(1, intval($_GPC['page']));
    $psize     = 20;
    $condition = ' WHERE `uniacid` = :uniacid AND `deleted` = :deleted';
    
    	if ($goodsfrom == 'sale') {
			$condition .= ' AND `status` = 1  and `total`>0 and `deleted`=0';
			$status = 1;
		}
		else if ($goodsfrom == 'out') {
			$condition .= ' AND `total` <= 0 and `deleted`=0';
			$status = 1;
		}
		else if ($goodsfrom == 'stock') {
			$status = 0;
			$condition .= ' AND `status` = 0 and `deleted`=0';
		}
    
    $params    = array(
        ':uniacid' => $_W['uniacid'],
        ':deleted' => '0'
    );
    if (!empty($_GPC['keyword'])) {
        $_GPC['keyword'] = trim($_GPC['keyword']);
        $condition .= ' AND `title` LIKE :title';
        $params[':title'] = '%' . trim($_GPC['keyword']) . '%';
    }
    if (!empty($_GPC['category']['thirdid'])) {
        $condition .= ' AND `tcate` = :tcate';
        $params[':tcate'] = intval($_GPC['category']['thirdid']);
    }
    if (!empty($_GPC['category']['childid'])) {
        $condition .= ' AND `ccate` = :ccate';
        $params[':ccate'] = intval($_GPC['category']['childid']);
    }
    if (!empty($_GPC['category']['parentid'])) {
        $condition .= ' AND `pcate` = :pcate';
        $params[':pcate'] = intval($_GPC['category']['parentid']);
    }

    $sql   = 'SELECT COUNT(*) FROM ' . tablename('eshop_goods') . $condition;
    $total = pdo_fetchcolumn($sql, $params);
    if (!empty($total)) {
        $sql   = 'SELECT * FROM ' . tablename('eshop_goods') . $condition . ' ORDER BY `status` DESC, `displayorder` DESC,
						`id` DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
        $list  = pdo_fetchall($sql, $params);
        $pager = pagination($total, $pindex, $psize);
    }
} elseif ($operation == 'delete') {

    $id  = intval($_GPC['id']);
    $row = pdo_fetch("SELECT id, title, thumb FROM " . tablename('eshop_goods') . " WHERE id = :id", array(
        ':id' => $id
    ));
    if (empty($row)) {
        message('抱歉，商品不存在或是已经被删除！');
    }
    pdo_update('eshop_goods', array(
        'deleted' => 1
    ), array(
        'id' => $id
    ));
  
    message('删除成功！', referer(), 'success');
} elseif ($operation == 'setgoodsproperty') {

    $id   = intval($_GPC['id']);
    $type = $_GPC['type'];
    $data = intval($_GPC['data']);
    if (in_array($type, array(
    		'index',
        'new',
        'hot',
        'recommand',
        'discount',
        'time',
        'sendfree',
        'nodiscount'
    ))) {
        $data = ($data == 1 ? '0' : '1');
        pdo_update('eshop_goods', array(
            'is' . $type => $data
        ), array(
            "id" => $id,
            "uniacid" => $_W['uniacid']
        ));
         if ($type == 'index') {
            $typestr = "首页";
        } else if ($type == 'new') {
            $typestr = "新品";
        } else if ($type == 'hot') {
            $typestr = "热卖";
        } else if ($type == 'recommand') {
            $typestr = "推荐";
        } else if ($type == 'discount') {
            $typestr = "促销";
        } else if ($type == 'time') {
            $typestr = "限时卖";
        } else if ($type == 'sendfree') {
            $typestr = "包邮";
        } else if ($type == 'nodiscount') {
            $typestr = "不参与折扣状态";
        }
        die(json_encode(array(
            'result' => 1,
            'data' => $data
        )));
    }
    if (in_array($type, array(
        'status'
    ))) {
        $data = ($data == 1 ? '0' : '1');
        pdo_update('eshop_goods', array(
            $type => $data
        ), array(
            "id" => $id,
            "uniacid" => $_W['uniacid']
        ));
       die(json_encode(array(
            'result' => 1,
            'data' => $data
        )));
    }
    if (in_array($type, array(
        'type'
    ))) {
        $data = ($data == 1 ? '2' : '1');
        pdo_update('eshop_goods', array(
            $type => $data
        ), array(
            "id" => $id,
            "uniacid" => $_W['uniacid']
        ));
        die(json_encode(array(
            'result' => 1,
            'data' => $data
        )));
    }
    die(json_encode(array(
        'result' => 0
    )));
}
include $this->template('goods');