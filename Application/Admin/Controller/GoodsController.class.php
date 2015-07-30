<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller
{
	public function add()
	{
		// 2. 处理表单
		if(IS_POST)
		{
			// 如果30秒处理不完工就加上这个函数。设置脚本执行时间，0代表执行到结束
//			set_time_limit(0);
			// 3. 生成模型
			$model = D('Goods');
			// 4. 接收表单并且验证表单【表单验证的规则要自己在模型中定义】
			if($model->create(I('post.'), 1))
			{
				// 5. 如果表单验证成功
				if($model->add())
				{
					$this->success('添加成功！', U('lst'));
					// 因为success 1秒 之后才会跳转，如果不停止后面的代码还会继续执行的
					exit;
				}
			}
			// 如果出错获取出错误的原因
			$error = $model->getError();
			// 打印错误信息并在3秒之后返回上一个页面
			$this->error($error);
		}
		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '添加商品',
			'_page_btn_name' => '商品列表',
			'_page_btn_link' => U('Admin/Goods/lst'),
			'_page_desc' => '添加商品',
		));
		// 1. 显示表单
		$this->display();
	}
	public function save()
	{
		$goodsId = I('get.id');
		$model = D('Goods');
		if(IS_POST)
		{
			if($model->create(I('post.'), 2))
			{
				// save()方法返回值是mysql_affected_rows受影响的条数，如果没有修改任何字段返回的是0，但0代表成功不应该是失败，只有返回FALSE时才算失败
				if(FALSE !== $model->save())
				{
					$this->success('修改成功！', U('lst'));
					exit;
				}
			}
			$error = $model->getError();
			$this->error($error);
		}
		/******************** 取修改的商品的信息 *********************/
		// 先把这件商品的信息取出来填到表单中
		$info = $model->find($goodsId);
		// 再取出当前商品相册中的图片，在表单中列出来,让用户修改
		$gpModel = M('GoodsPics');
		$gpData = $gpModel->where(array(
			'goods_id' => array('eq', $goodsId),
		))->select();
		$this->assign(array(
			'info' => $info,
			'gpData' => $gpData,
		));
		
		$this->assign(array(
			'_page_title' => '修改商品',
			'_page_btn_name' => '商品列表',
			'_page_btn_link' => U('Admin/Goods/lst'),
			'_page_desc' => '修改商品',
		));
		$this->display();
	}
	// 商品列表页
	// public function lst()
	// {
		// $model = D('Goods');
		// $data = $model->search();
		// $this->assign(array(
			// 'data' => $data['data'],
			// 'page' => $data['page'],
		// ));
		// // 设置页面中的信息
		// $this->assign(array(
			// '_page_title' => '商品列表',
			// '_page_btn_name' => '添加商品',
			// '_page_btn_link' => U('Admin/Goods/add'),
			// '_page_desc' => '商品列表',
		// ));
		// $this->display();
	// }
	// // 放入回收站
	// public function trash()
	// {
		// $id = I('get.id');
		// $model = D('Goods');
		// if($model->trash($id) !== FALSE)
			// $this->success('操作成功！');
		// else 
			// $this->error('操作失败，请重试！');
	// }
	// // 还原
	// public function recycle()
	// {
		// $id = I('get.id');
		// $model = D('Goods');
		// if($model->recycle($id) !== FALSE)
			// $this->success('操作成功！');
		// else 
			// $this->error('操作失败，请重试！');
	// }
	// // 彻底删除
	// public function delete()
	// {
		// $id = I('get.id');
		// $model = D('Goods');
		// if($model->delete($id) !== FALSE)
			// $this->success('操作成功！');
		// else 
			// $this->error('操作失败，请重试！');
	// }
	// public function trash_list()
	// {
		// $model = D('Goods');
		// $data = $model->trash_list();
		// $this->assign(array(
			// 'data' => $data['data'],
			// 'page' => $data['page'],
		// ));
		// // 设置页面中的信息
		// $this->assign(array(
			// '_page_title' => '回收站',
			// '_page_desc' => '回收站',
		// ));
		// $this->display();
	// }
	// public function ajaxDelImage()
	// {
		// $picId = I('get.pic_id');
		// $gpModel = M('GoodsPics');
		// $gpImg = $gpModel->field('sm_image_url,image_url')->find($picId);
		// if($gpImg)
		// {
			// deleteImage($gpImg); // 从硬盘上删除图片
			// $gpModel->delete($picId);  // 把数据库中的记录删除掉
		// }
	// }
	
	
	
	
	
	
	
	//jd_goods               								//jd_goods_pics
	//id goods_name logo shop_price is_on_sale sort_num       image_url
	
	// select a.id,goods_name ,logo ,shop_price ,is_on_sale ,sort_num,image_url,count(a.id) from jd_goods as a left join jd_goods_pics as b on a.id = b.goods_id group by a.id;
	public function lst(){
		$model = D('Goods');
		$data = $model->search();
		$this->assign(array(
			'lstData' => $data['result'],
			'page' => $data['show'],
		));
		$this->display();
	}
	
	
	
	
	
}






















