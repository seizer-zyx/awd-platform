<?php defined('IN_IA') or exit('Access Denied');?><!-- 订单佣金 -->
<div id='changecommission_modal_container'></div>
<script language='javascript'>
	function commission_change(id) {
		$.ajax({
			url: "<?php  echo $this->createWebUrl('commission/apply',array('op'=>'changecommissionmodal'))?>&id=" + id,
			success: function (html) {
				$('#changecommission_modal_container').html(html);
				$('#modal-changecommission').modal().on('shown.bs.modal', function () {

				})

			}
		})
	}
</script>