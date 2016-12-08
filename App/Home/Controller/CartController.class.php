<?php
namespace Home\Controller;
/**
 * 购物车控制器
 */
class CartController extends BaseController {
	/**
	 * 添加到购物车
	 */
	public function add(){
		$cartModel = D('Cart');
		$goodsAttrId = I('post.goods_attr_id');
		if($goodsAttrId){
			// 把属性ID升序排列，因为后台存属性的存量时是升序的，为了能取出库存量
			sort($goodsAttrId);
			$goodsAttrId = implode(',', $goodsAttrId);
		}
		$cartModel->addToCart(I('post.goods_id'), $goodsAttrId, I('post.amount'));
		redirect(U('lst'));
	}
	
	/**
	 * 购物车列表
	 * @return [type] [description]
	 */
	public function lst(){
		$cartModel = D('Cart');
		$data = $cartModel->cartList();
		
		$this->assign('data', $data);
		
		$this->setPageInfo('购物车', '购物车', '购物车', 1, array('cart'), array('cart1'));
		$this->display();
	}

	/**
	 * ajax更新数据
	 * @return [type] [description]
	 */
	public function ajaxUpdateData(){
		$gid = I('get.gid');
		$gaid = I('get.gaid', '');  //如果没有属性则默认为
		$gn = I('get.gn');
		$cartModel = D('Cart');
		$data = $cartModel->updateData($gid, $gaid, $gn);
	}

	/**
	 * 下订单
	 * @return [type] [description]
	 */
	public function order(){
		/************** 把用户选择的商品存到SESSION中，如果会员没有选择过商品就不能进入这个页面 *****************/
		$buythis = I('post.buythis');
		// 先判断表单中是否选择了
		if(!$buythis){
			$buythis = session('buythis');
			if(!$buythis){
				$this->error('必须先选择商品', U('lst'));
			}
		}
		else{
			session('buythis', $buythis);
		}
			
		$mid = session('mid');
		// 如果会员没有登录跳到登录页面，登录成功之后再跳回到这个页面
		if(!$mid){
			// 把当前这个页面的地址存到SESSION中，这样登录成功之后就跳回来了
			session('returnUrl', U('order'));
			redirect(U('Member/login'));
		}
		// 如果是下单的表单就处理
		if(IS_POST && !isset($_POST['buythis'])){
			$orderModel = D('Order');
			if($orderModel->create(I('post.'), 1)){
				if($id = $orderModel->add()){
					//下好订单后去支付
					redirect(U('order_ok?id='.$id));
					return;
				}
			}
			$this->error($orderModel->getError());
		}
		
		// 取出购物车中的商品
		$cartModel = D('Cart');
		$data = $cartModel->cartList();
		
		$this->assign('data', $data);
		
		// 显示表单
		$this->setPageInfo('下定单', '下定单', '下定单', 1, array('fillin'), array('cart2'));
		$this->display();
	}

	/**
	 * 下单成功后跳转到的页面
	 * @return [type] [description]
	 */
	public function order_ok(){
		$id = I('get.id');// 定单ID
		// 查询这个定单总价是多少
		$orderModel = M('Order');
		$tp = $orderModel->field('total_price')->find($id);
		/************ 生成支付宝的按钮 **************/
		require_once("./alipay/alipay.config.php");
		require_once("./alipay/lib/alipay_submit.class.php");
		//支付类型
        $payment_type = "1";
        //服务器异步通知页面路径 - 我们用来接收支付宝发来的消息的地址
        $notify_url = "http://www.ecshop.com/index.php/Home/Cart/respond";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径 - 会员在支付宝当支付成功之后跳转到哪个页面
        $return_url = "http://www.ecshop.com/index.php/Home/Cart/success";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户 - 收钱的账号
        $seller_email = '13037208729';
        //商户订单号 - 本地的定单号 -> 这次支付对应我们本地的哪个定单
        $out_trade_no = $id;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = 'ecshop网站定单支付';
        //付款金额 - 定单总价
        $total_fee = $tp['total_price'];
        //订单描述
        $body = 'ecshop网站定单支付';
        //商品展示地址 - 购买的商品的详情页面的地址 -> 定单中所有商品的详情页面
        $show_url = '';
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
        
        $parameter = array(
				"service" => "create_direct_pay_by_user",
				"partner" => trim($alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
		$alipaySubmit = new \AlipaySubmit($alipay_config);
		// 生成按钮的HTML代码
		$html_text = $alipaySubmit->buildRequestForm($parameter, "get", "去支付宝支付");

		$this->assign('btn', $html_text);

		$this->setPageInfo('下单成功', '下单成功', '下单成功', 1, array('success'));
		$this->display();
	}

	/**
     * 接收支付宝发过来的消息
     */
	public function respond(){
		// 执行notify_url.php文件中的代码
		include('./alipay/notify_url.php');
	}

	/**
	 * 支付成功后的提示
	 */
	public function success(){
		echo '支付成功！';
	}
}




















