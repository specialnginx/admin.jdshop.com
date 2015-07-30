<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - <?php echo $_page_title; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo $_page_btn_link; ?>"><?php echo $_page_btn_name; ?></a></span>
    <span class="action-span1"><a href="__GROUP__">管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_desc; ?> </span>
    <div style="clear:both"></div>
</h1>

<link href="/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/umeditor/lang/zh-cn/zh-cn.js"></script>

<style>
#image_ul li{float:left;margin:5px;list-style-type:none;height:180px;}
</style>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front">基本信息</span>
            <span class="tab-back">商品描述</span>
            <span class="tab-back">会员价格</span>
            <span class="tab-back">商品属性</span>
            <span class="tab-back">商品相册</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/index.php/Admin/Goods/save/id/4.html" method="post">
        	<input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
            <table width="90%" class="form_table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="<?php echo $info['goods_name']; ?>" size="60" />
                    <span class="require-field">*</span></td>
                </tr>
                 <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo $info['market_price']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo $info['shop_price']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="1" <?php if($info['is_on_sale']==1) echo 'checked="checked"'; ?> /> 是
                        <input type="radio" name="is_on_sale" value="0" <?php if($info['is_on_sale']==0) echo 'checked="checked"'; ?> /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">商品图片：</td>
                    <td>
                    	<?php showImage($info['sm_logo']); ?><br />
                        <input type="file" name="logo" size="35" />
                    </td>
                </tr>
                <tr>
                    <td class="label">排序数字：</td>
                    <td>
                        <input type="text" size="5" name="sort_num" value="<?php echo $info['sort_num']; ?>" />
                    </td>
                </tr>
            </table>
            <table width="100%" class="form_table" align="center" style="display:none;">
            	<tr>
                    <td>
                        <textarea id="goods_desc" name="goods_desc"><?php echo $info['goods_desc']; ?></textarea>
                    </td>
                </tr>
            </table>
             <table width="90%" class="form_table" align="center" style="display:none;">
            	<tr><td>b</td></tr>
            </table>
             <table width="90%" class="form_table" align="center" style="display:none;">
            	<tr><td>c</td></tr>
            </table>
            <!-- 相册 -->
            <table id="image_table" width="100%" class="form_table" align="center" style="display:none;">
            	<tr><td><input id="add_image" type="button" value="添加一张" /></td></tr>
            	<tr><td>&nbsp;</td></tr>
            	<tr><td>
            	<ul id="image_ul">
	            	<?php foreach ($gpData as $k => $v): ?>
		            	<li>
			            	<input pic_id="<?php echo $v['id']; ?>" type="button" value="删除" /><br />
			            	<?php showImage($v['sm_image_url']); ?>
		            	</li>
	            	<?php endforeach; ?>
            	</ul>
            	</td></tr>
            	<tr><td>&nbsp;</td></tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>
<script>
// 为删除图片的按钮添加JS
$("#image_ul li :button").click(function(){
	if(confirm('确定要删除吗？'))
	{
		// 获取这个图片的ID
		var pic_id = $(this).attr('pic_id');
		// 获取图片所在的li
		var li = $(this).parent();
		$.ajax({
			type : "GET",
			url : "<?php echo U('ajaxDelImage', '', FALSE); ?>/pic_id/"+pic_id,
			success : function(data)
			{
				// ajax执行完之后从页面中删除li标签
				li.remove();
			}
		});
	}
});

$("#add_image").click(function(){
	$("#image_table").append('<tr><td><a onclick="$(this).parent().parent().remove();" href="#">[-]</a><input type="file" name="image[]" /></td></tr>');
});
var um = UM.getEditor('goods_desc', {
	initialFrameWidth:"100%"
});
$("#tabbar-div p span").click(function(){
	// 获取当前点击的是第几个按钮
	var i = $(this).index();
	// 隐藏所有的Table
	$(".form_table").hide();
	// 再选中第I个table并显示出来
	$(".form_table").eq(i).show();
	// 先把原来选中的按钮去掉选中状态
	$(".tab-front").removeClass("tab-front").addClass('tab-back');
	// 再把当前点击的按钮变成选中的状态
	$(this).removeClass("tab-back").addClass('tab-front');
});
</script>
<div id="footer"> 传智播客-PHP就业班35期 </div>
</body>
</html>
<script type="text/javascript" src="/Public/Admin/Js/tron.js"></script>