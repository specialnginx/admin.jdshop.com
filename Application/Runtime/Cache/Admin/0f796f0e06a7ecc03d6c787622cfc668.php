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

<!-- 商品列表 -->
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>logo</th>
                <th>操作</th>
            </tr>
            <?php foreach ($data as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['id']; ?></td>
                <td align="center"><?php echo $v['goods_name']; ?></td>
                <td align="center"><?php showImage($v['sm_logo'], 50); ?></td>
                <td align="center">
                	<a onclick="return confirm('确定要还原吗？');" href="<?php echo U('recycle?id='.$v['id']); ?>">还原</a>
                	<a onclick="return confirm('确定要删除吗？');" href="<?php echo U('delete?id='.$v['id']); ?>">彻底删除</a>
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