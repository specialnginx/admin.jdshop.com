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

<div class="form-div">
    <form action="/index.php/Admin/Goods/lst" name="searchForm">
        <p>
	        是否上架：
	        <input type="radio" value="-1" name="is_on_sale" <?php if(I('get.is_on_sale', -1) == -1) echo 'checked="checked"'; ?> />全部
	        <input type="radio" value="1" name="is_on_sale" <?php if(I('get.is_on_sale') === '1') echo 'checked="checked"'; ?> />上架
	        <input type="radio" value="0" name="is_on_sale" <?php if(I('get.is_on_sale') === '0') echo 'checked="checked"'; ?> />下架
        </p>
        <p>
	        商品名称： <input value="<?php echo I('get.goods_name'); ?>" type="text" name="goods_name" size="30" />
        </p>
        <p>
	        本店价格：<input value="<?php echo I('get.price_from'); ?>" type="text" name="price_from" size="6" /> ~ 
	        <input value="<?php echo I('get.price_to'); ?>" type="text" name="price_to" size="6" />
        </p>
        <input type="submit" value=" 搜索 " class="button" />
        <p>
        	<input <?php if(I('get.od') == 'id_asc') echo 'checked="checked"'; ?> onclick="this.parentNode.parentNode.submit();" type="radio" name="od" value="id_asc" />编号升序
        	<input <?php if(I('get.od', 'id_desc') == 'id_desc') echo 'checked="checked"'; ?> onclick="this.parentNode.parentNode.submit();" type="radio" name="od" value="id_desc" />编号降序
        	<input <?php if(I('get.od') == 'price_asc') echo 'checked="checked"'; ?> onclick="this.parentNode.parentNode.submit();" type="radio" name="od" value="price_asc" />价格升序
        	<input <?php if(I('get.od') == 'price_desc') echo 'checked="checked"'; ?> onclick="this.parentNode.parentNode.submit();" type="radio" name="od" value="price_desc" />价格降序
        </p>
    </form>
</div>

<!-- 商品列表 -->
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>logo</th>
                <th>相册图片</th>
                <th>价格</th>
                <th>上架</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            <?php foreach ($lstData as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['id']; ?></td>
                <td align="center"><?php echo $v['goods_name']; ?></td>
                <td align="center"></td>
                <td align="center">
                	【数量：<?php echo $v['s']; ?>】
                <!--ssda-->	
 
                	<!--end-->
                </td>
                <td align="center"><?php echo $v['shop_price']; ?></td>
                <td align="center"><?php echo $v['is_on_sale']==1?'上架':'下架'; ?></td>
                <td align="center"><?php echo $v['sort_num']; ?></td>
                <td align="center">
                	<a href="<?php echo U('save?id='.$v['id']); ?>">修改</a>
                	<a onclick="return confirm('确定要放入回收站吗？');" href="<?php echo U('trash?id='.$v['id']); ?>">放入回收站</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo $page; ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>
<div id="footer"> 传智播客-PHP就业班35期 </div>
</body>
</html>
<script type="text/javascript" src="/Public/Admin/Js/tron.js"></script>