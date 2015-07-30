<?php
namespace Common\Model;
use Think\Model;
class GoodsModel extends Model
{
	// 是否使用表单的批量验证功能
	protected $patchValidate = FALSE;
	// 在添加时，表单中允许出现的字段
	protected $insertFields = array('goods_name','market_price','shop_price','is_on_sale','goods_desc','sort_num');
	// 在修改时，表单中允许出现的字段
	protected $updateFields = array('id','goods_name','market_price','shop_price','is_on_sale','goods_desc','sort_num');
	// 定义表单验证规则
	protected $_validate = array(
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('market_price', 'require', '市场价格不能为空！', 1, 'regex', 3),
		array('shop_price', 'require', '市场价格不能为空！', 1, 'regex', 3),
		array('market_price', 'currency', '市场价格必须是货币格式！', 1, 'regex', 3),
		array('shop_price', 'currency', '本店价格必须是货币格式！', 1, 'regex', 3),
		array('is_on_sale', '0,1', '是否上架只能是1，0两个值！', 1, 'in', 3),
		array('sort_num', 'number', '排序数字必须是数字！', 1, 'regex', 3),
	);
	// 翻页、搜索、排序
	// public function search($perPage = 15)
	// {
		// /********************* 搜索 ************************/
		// $where = array('a.is_delete' => array('eq', 0)); // is_delete=0
		// // 商品名称搜索
		// $goodsName = I('get.goods_name');
		// if($goodsName)
			// $where['a.goods_name'] = array('like', "%$goodsName%");  // goods_name like "%xx%'
		// // 本店价格搜索
		// $priceFrom = I('get.price_from');
		// $priceTo = I('get.price_to');
		// if($priceFrom && $priceTo)
			// $where['a.shop_price'] = array('between', array($priceFrom, $priceTo));
		// elseif ($priceFrom)
			// $where['a.shop_price'] = array('egt', $priceFrom);
		// elseif ($priceTo)
			// $where['a.shop_price'] = array('elt', $priceTo);
		// // 是否上架的搜索
		// $isonsale = I('get.is_on_sale', -1);  // 如果没有传这个变量，默认是-1
		// if($isonsale != -1)
			// $where['a.is_on_sale'] = array('eq', $isonsale);
		// /*********************** 排序 **********************/
		// $orderby = 'id';
		// $orderWay = 'desc';
		// $od = I('get.od');
		// if($od)
		// {
			// if($od == 'id_asc')
				// $orderWay = 'asc';
			// elseif ($od == 'price_asc')
			// {
				// $orderby = 'a.shop_price';
				// $orderWay = 'asc';
			// }
			// elseif ($od == 'price_desc')
				// $orderby = 'a.shop_price';
		// }
		// /************************ 翻页 ********************/
		// // 取出总的记录数
		// $count = $this->alias('a')->where($where)->count();
		// $page = new \Think\Page($count, $perPage);
		// $page->setConfig('next', '下一页');
		// $page->setConfig('prev', '上一页');
		// $pageString = $page->show(); // 获取翻页用的字符串，这个是显示在页面中的
		// $offset = $page->firstRow;
		// /*********************** 取数据 **********************/
		// $data = $this->field('a.*,COUNT(b.id) pic_count,GROUP_CONCAT(b.sm_image_url) image_url')->alias('a')->join('LEFT JOIN __GOODS_PICS__ b ON a.id=b.goods_id')->where($where)->order("sort_num ASC,$orderby $orderWay")->group('a.id')->limit("$offset,$perPage")->select();
		// return array(
			// 'data' => $data,
			// 'page' => $pageString,
		// );
	// }
	// // 这个方法在add方法插入数据之前会自动执行
	// // $data：表单中的数据
	// protected function _before_insert(&$data, $option)
	// {
		// $data['goods_desc'] = clearXSS($_POST['goods_desc']);
		// // 如果上传了图片才执行以下代码
		// if($_FILES['logo']['error'] == 0)
		// {
			// $IMAGE_SAVE_PATH = C('IMAGE_SAVE_PATH');
			// /*** 上传图片的代码 ***/
			// $upload = new \Think\Upload(array(
				// 'maxSize' => 3145728,
				// 'rootPath' => $IMAGE_SAVE_PATH,
				// 'exts' => array('jpg', 'gif', 'png', 'jpeg', 'pjpeg', 'bmp'),
				// 'savePath' => 'Goods/',
			// ));
		    // // 只上传logo这张图片 
		    // $info   =   $upload->upload(array(
		    	// 'logo' => $_FILES['logo']
		    // ));
		    // if(!$info)
		    // {
		    	// // 先把错误信息给模型中error属性，之后返回控制器之后在控制器中会再调用这个模型中getError获取到这个错误信息
		    	// $this->error = $upload->getError();
		    	// return FALSE;  // 返回到控制器
		    // }
		    // // 上传成功之后把图片路径保存到logo字段中
		    // $data['logo'] = $info['logo']['savepath'] . $info['logo']['savename']; 
		    // // 拼出缩略图的文件名
		    // $data['sm_logo'] = $info['logo']['savepath'] . 'sm_' . $info['logo']['savename']; 
		    // // 生成缩略图
		    // $image = new \Think\Image(); 
		    // // 打开要处理的图片
		    // $image->open($IMAGE_SAVE_PATH.$data['logo']);
		    // // 生成缩略图
		    // $image->thumb(150, 150, 1)->save($IMAGE_SAVE_PATH.$data['sm_logo']);
		// }
	// }
	// protected function _before_update(&$data, $option)
	// {
		// $data['goods_desc'] = clearXSS($_POST['goods_desc']);
		// // 如果上传了图片才执行以下代码
		// if($_FILES['logo']['error'] == 0)
		// {
			// /*************** 删除原图片 ******************/
			// $oldLogo = $this->field('sm_logo,logo')->find($option['where']['id']);
			// if($oldLogo)
				// deleteImage($oldLogo);
			// $IMAGE_SAVE_PATH = C('IMAGE_SAVE_PATH');
			// /*** 上传图片的代码 ***/
			// $upload = new \Think\Upload(array(
				// 'maxSize' => 3145728,
				// 'rootPath' => $IMAGE_SAVE_PATH,
				// 'exts' => array('jpg', 'gif', 'png', 'jpeg', 'pjpeg', 'bmp'),
				// 'savePath' => 'Goods/',
			// ));
		    // // 只上传logo这张图片 
		    // $info   =   $upload->upload(array(
		    	// 'logo' => $_FILES['logo']
		    // ));
		    // if(!$info)
		    // {
		    	// // 先把错误信息给模型中error属性，之后返回控制器之后在控制器中会再调用这个模型中getError获取到这个错误信息
		    	// $this->error = $upload->getError();
		    	// return FALSE;  // 返回到控制器
		    // }
		    // // 上传成功之后把图片路径保存到logo字段中
		    // $data['logo'] = $info['logo']['savepath'] . $info['logo']['savename']; 
		    // // 拼出缩略图的文件名
		    // $data['sm_logo'] = $info['logo']['savepath'] . 'sm_' . $info['logo']['savename']; 
		    // // 生成缩略图
		    // $image = new \Think\Image(); 
		    // // 打开要处理的图片
		    // $image->open($IMAGE_SAVE_PATH.$data['logo']);
		    // // 生成缩略图
		    // $image->thumb(150, 150, 1)->save($IMAGE_SAVE_PATH.$data['sm_logo']);
		// }
		// /********************************** 修改相册中的图片 **************************/
		// $has = 0;  // 默认认为没有图片
		// // 判断有没有上传图片
		// foreach ($_FILES['image']['error'] as $v)
		// {
			// if($v == 0)
			// {
				// $has = 1;
				// break ; // 不用再循环判断了，只要找到一个就算有
			// }
		// }
		// // 表单中有图片就上传
		// if($has == 1)
		// {
			// $IMAGE_SAVE_PATH = C('IMAGE_SAVE_PATH');
			// /*** 上传图片的代码 ***/
			// $upload = new \Think\Upload(array(
				// 'maxSize' => 3145728,
				// 'rootPath' => $IMAGE_SAVE_PATH,
				// 'exts' => array('jpg', 'gif', 'png', 'jpeg', 'pjpeg', 'bmp'),
				// 'savePath' => 'Goods/',
			// ));
		    // // 上传名称为 image 的图片 
		    // $info   =   $upload->upload(array(
		    	// 'image' => $_FILES['image']
		    // ));
		    // $gpModel = M('GoodsPics');  // 生成相册表模型
		    // $image = new \Think\Image(); 
		    // // 循环每张图片并生成缩略图
		    // foreach ($info as $k => $v)
		    // {
		    	// $oname = $v['savepath'].$v['savename'];   // 原图名称
		    	// $tname = $v['savepath'].'sm_'.$v['savename']; // 缩略图名称
		    	// $image->open($IMAGE_SAVE_PATH.$oname);
		    	// $image->thumb(150, 150, 1)->save($IMAGE_SAVE_PATH.$tname);	
		    	// // 插入到商品相册表中
		    	// $gpModel->add(array(
		    		// 'image_url' => $oname,
		    		// 'sm_image_url' => $tname,
		    		// 'goods_id' => $option['where']['id'], // 商品的ID
		    	// ));
		    // }
		// }
	// }
	// // $data ： 插入数据库之后的数据，其中$data['id']就是新插入的商品的ID
	// protected function _after_insert($data, $option)
	// {
		// $has = 0;  // 默认认为没有图片
		// // 判断有没有上传图片
		// foreach ($_FILES['image']['error'] as $v)
		// {
			// if($v == 0)
			// {
				// $has = 1;
				// break ; // 不用再循环判断了，只要找到一个就算有
			// }
		// }
		// // 表单中有图片就上传
		// if($has == 1)
		// {
			// $IMAGE_SAVE_PATH = C('IMAGE_SAVE_PATH');
			// /*** 上传图片的代码 ***/
			// $upload = new \Think\Upload(array(
				// 'maxSize' => 3145728,
				// 'rootPath' => $IMAGE_SAVE_PATH,
				// 'exts' => array('jpg', 'gif', 'png', 'jpeg', 'pjpeg', 'bmp'),
				// 'savePath' => 'Goods/',
			// ));
		    // // 上传名称为 image 的图片 
		    // $info   =   $upload->upload(array(
		    	// 'image' => $_FILES['image']
		    // ));
		    // $gpModel = M('GoodsPics');  // 生成相册表模型
		    // $image = new \Think\Image(); 
		    // // 循环每张图片并生成缩略图
		    // foreach ($info as $k => $v)
		    // {
		    	// $oname = $v['savepath'].$v['savename'];   // 原图名称
		    	// $tname = $v['savepath'].'sm_'.$v['savename']; // 缩略图名称
		    	// $image->open($IMAGE_SAVE_PATH.$oname);
		    	// $image->thumb(150, 150, 1)->save($IMAGE_SAVE_PATH.$tname);	
		    	// // 插入到商品相册表中
		    	// $gpModel->add(array(
		    		// 'image_url' => $oname,
		    		// 'sm_image_url' => $tname,
		    		// 'goods_id' => $data['id'], // 商品的ID
		    	// ));
		    // }
		// }
	// }
	// public function recycle($goodsId)
	// {
		// return $this->where(array(
			// 'id' => array('eq', $goodsId),
		// ))->setField('is_delete', 0);
	// }
	// public function trash($goodsId)
	// {
		// return $this->where(array(
			// 'id' => array('eq', $goodsId),
		// ))->setField('is_delete', 1);
	// }
	// public function trash_list($perPage = 15)
	// {
		// $where = array('is_delete' => array('eq', 1));
		// $count = $this->where($where)->count();
		// $page = new \Think\Page($count, $perPage);
		// $page->setConfig('next', '下一页');
		// $page->setConfig('prev', '上一页');
		// $pageString = $page->show(); // 获取翻页用的字符串，这个是显示在页面中的
		// $offset = $page->firstRow;
		// /*********************** 取数据 **********************/
		// $data = $this->where($where)->limit("$offset,$perPage")->select();
		// return array(
			// 'data' => $data,
			// 'page' => $pageString,
		// );
	// }
	// public function _before_delete($data)
	// {
		// $deleteImage = array();  // 要删除的图片路径
		// // 在删除商品之前先把图片都删除掉
		// $logo = $this->field('sm_logo,logo')->find($data['where']['id']);
		// if($logo)
		// {
			// // 先把图片的路径放到这个数组中最后一起删除
			// $deleteImage[] = $logo['sm_logo'];
			// $deleteImage[] = $logo['logo'];
		// }
		// // 再删除相册中的图片
		// $gpModel = M('GoodsPics');
		// $image = $gpModel->field('image_url,sm_image_url')->where(array(
			// 'goods_id' => array('eq', $data['where']['id'])
		// ))->select();
		// // 如果相册中有图片就删除
		// if($image)
		// {
			// foreach ($image as $v)
			// {
				// // 先把图片的路径放到这个数组中最后一起删除
				// $deleteImage[] = $v['image_url'];
				// $deleteImage[] = $v['sm_image_url'];
			// }
			// // 删除相册表中对应的记录
			// $gpModel->where(array(
				// 'goods_id' => array('eq', $data['where']['id'])
			// ))->delete();
		// }
		// // 如果有图片就从硬盘上删除
		// if($deleteImage)
			// deleteImage($deleteImage);
	// }
	
	public function search()
	{
		/******************搜索*********************/
		$is_on_sale = I('get.is_on_sale',-1);
		$goods_name = I('get.goods_name');
		$priceFrom = I('get.price_from'); 
		$priceTo = I('get.price_to'); 
		
		
		$where = array('a.is_delete'=>array('eq',0));
		
		if($goods_name)
			$where['a.goods_name'] = array('like',"%$goods_name%");
		if($priceFrom && $priceTo)
			$where['a.shop_price'] = array('between',array("$priceFrom,$priceTo")); 
		elseif($priceFrom)
			$where['a.shop_price'] = array('egt',$priceFrom);
		elseif($priceTo)
			$where['a.shop_price'] = array('elt',$priceTo);
		/*****有bug   再次选择全部的时候会发生不发现是数据的情况，因为查找is_on_sale=-1是没有这样的数据的********/
		if($is_on_sale !== -1)
			$where['a.is_on_sale'] = array('eq', $is_on_sale);

			
			
		/******************排序*********************/
		$orderby = 'id';
		$orderType = 'desc';
		$od = I('get.od');
		if($od)
		{
			if($od == 'id_asc')
			{
				$orderType = 'asc';
			}elseif($od == "price_asc")
			{
				$orderby = "a.shop_price";
				$orderType= 'asc';
			}elseif($od == "price_desc")
			{
				$orderby = "a.shop_price";
			}
		}
		
		// $orderby = 'id';
		// $orderWay = 'desc';
		// $od = I('get.od');
		// if($od)
		// {
			// if($od == 'id_asc')
				// $orderWay = 'asc';
			// elseif ($od == 'price_asc')
			// {
				// $orderby = 'a.shop_price';
				// $orderWay = 'asc';
			// }
			// elseif ($od == 'price_desc')
				// $orderby = 'a.shop_price';
		// }
		/******************翻页*********************/
		$goods = M('goods');
		$count = $goods->count();
		$pageCount = 2;
		$Page  = new \Think\Page($count,$pageCount);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$pageFirst = $Page->firstRow;
		$show = $Page->show(); 
		
		
		$result = $this->alias('a')->field('a.*,goods_name ,logo ,shop_price ,is_on_sale ,sort_num,GROUP_CONCAT(sm_image_url),count(b.id) as s')->join('left join jd_goods_pics as b on a.id=b.goods_id')->group('a.id')->order($orderby." ".$orderType)->where($where)->limit($pageFirst.",".$pageCount)->select();
		
		echo $this->getLastSql();
		return array(
			'result' => $result,
			'show' => $show,
		);
	}
}



















