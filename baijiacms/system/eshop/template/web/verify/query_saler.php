<?php defined('IN_IA') or exit('Access Denied');?><div style='max-height:500px;overflow:auto;min-width:850px;'>
<table class="table table-hover" style="min-width:850px;">
    <thead>
        <th>核销员</th>
        <th>信息</th>
        <th>门店</th>
    </thead>
    <tbody>   
        <?php  if(is_array($ds)) { foreach($ds as $row) { ?>
        <tr>
            <td><img src='<?php  echo $row['avatar'];?>' onerror="this.src='<?php  echo RESOURCE_ROOT;?>eshop/mobile/default/static/images/tx.png'" style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?></td>
            <td><?php  echo $row['realname'];?>/<?php  echo $row['mobile'];?></td>
            <td><?php  if(empty($row['storename'])) { ?>全店核销<?php  } else { ?><?php  echo $row['storename'];?><?php  } ?></td>
            <td style="width:80px;"><a href="javascript:;" onclick='select_saler(<?php  echo json_encode($row);?>)'>选择</a></td>
        </tr>
        <?php  } } ?>
        <?php  if(count($ds)<=0) { ?>
        <tr> 
            <td colspan='4' align='center'>未找到核销员, 点击<a href="<?php  echo $this->createWebUrl('verify/store/post')?>" target='_blank'>【新增核销员】</a></td>
        </tr>
        <?php  } ?>
    </tbody>
</table>
</div>