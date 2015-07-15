<?php

class OrderController extends Controller{

 	function  __construct() {
          //  $this->css('content.css');
		//	$this->css('content.css');
			$this->css(array('content.css','calendar.css'));  //look  添加时间显示样式calendar.css
			$this->js(array('calendar.js','calendar-setup.js','calendar-zh.js'));  //look  添加时间显示特效js
	}
	
	//订单打印
	function order_print(){
			$this->layout('kong');
			$ids = $_GET['ids'];
			$ids_rt = explode('-',$ids);
			if(empty($ids_rt)) die("非法错误，传送数据为空");
			//修改以打印状态
			$sql = "UPDATE `{$this->App->prefix()}goods_order_info` SET is_prints = '1' WHERE order_id IN(".implode(',',$ids_rt).")";
			$this->App->query($sql);
			
			$sql = "SELECT tb1.*,tb2.region_name AS province,tb3.region_name AS city,tb4.region_name AS district,tb5.region_name AS towns, tb6.region_name AS villages,tb7.consignee AS peisongname FROM `{$this->App->prefix()}goods_order_info` AS tb1";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb2 ON tb2.region_id = tb1.province";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb3 ON tb3.region_id = tb1.city";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb4 ON tb4.region_id = tb1.district";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb5 ON tb5.region_id = tb1.town";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb6 ON tb6.region_id = tb1.village";
			$sql .= " LEFT JOIN `{$this->App->prefix()}user_address` AS tb7 ON tb7.user_id = tb1.shop_id";
			$sql .=" WHERE tb1.order_id IN(".implode(',',$ids_rt).") ORDER BY tb1.add_time DESC";
			$orderlist = $this->App->find($sql);
			if(!empty($orderlist)){
				 foreach($orderlist as $k=>$row){
					$sql= "SELECT * FROM `{$this->App->prefix()}goods_order` WHERE order_id='$row[order_id]' ORDER BY goods_id";
					$orderlist[$k]['goods'] = $this->App->find($sql);
				 }
			}

			$this->set('rt',$orderlist);
			$this->template('order_print');
	}
	
	//订单列表
	function order_list(){
             //排序
            $orderby = "";
            if(isset($_GET['desc'])){
                      $orderby = ' ORDER BY '.$_GET['desc'].' DESC';
            }else if(isset($_GET['asc'])){
                      $orderby = ' ORDER BY '.$_GET['asc'].' ASC';
            }else {
                      $orderby = ' ORDER BY `order_id` DESC';
            }
            //分页
            $page= isset($_GET['page']) ? $_GET['page'] : '';
            if(empty($page)){
                   $page = 1;
            }

            //条件
            $comd = array();
			
		//	$sql = "SELECT  FROM `{$this->App->prefix()}goods_order_info` AS tb1";
			
			//$rst = $this->App->find($sql);
			
            if(isset($_GET['status'])&&!empty($_GET['status'])){
                    $st = $this->select_statue($_GET['status']);
                    !empty($st)? $comd[] = $st : "";
            }
            if(isset($_GET['order_sn'])&&!empty($_GET['order_sn']))
                    $comd[] = "order_sn LIKE '%".trim($_GET['order_sn'])."%'";
			/***********  look添加 日期查询 开始  ********************************/	
			if(isset($_GET['add_time1'])&&!empty($_GET['add_time1']) && empty($_GET['add_time2'])){
					$t = strtotime($_GET['add_time1'])+24*60*60 ;
                    $comd[] = "add_time >= ". strtotime($_GET['add_time1']) ."&&add_time < " .$t;
					}
			if(isset($_GET['add_time2'])&&!empty($_GET['add_time2']) && empty($_GET['add_time1'])){
                    $comd[] = "add_time <= ". strtotime($_GET['add_time2']);
					}
			if(isset($_GET['add_time1'])&&!empty($_GET['add_time1']) &&isset($_GET['add_time2'])&& !empty($_GET['add_time2'])){
					$t = strtotime($_GET['add_time2'])+24*60*60 ;
                    $comd[] = "add_time >= ". strtotime($_GET['add_time1']) ."&&add_time < " .$t;
			}
							
			/***********  look添加 日期查询 结束  ********************************/			
            if(isset($_GET['consignee'])&&!empty($_GET['consignee']))
                    $comd[] = "consignee LIKE '%".trim($_GET['consignee'])."%'";
			
		//	exit;
			
            $w = ""; 
            if(!empty($comd)){
                $w = ' WHERE '.@implode(' AND ',$comd);
            }
            $list = 12;
            $start = ($page-1)*$list;
            $sql = "SELECT COUNT(order_id) FROM `{$this->App->prefix()}goods_order_info` $w";
            $tt = $this->App->findvar($sql);
            $pagelink = Import::basic()->getpage($tt, $list, $page,'?page=',true);
            $this->set("pagelink",$pagelink);
        
            $sql = "SELECT order_id, order_sn, user_id, order_status, shipping_status, pay_status, consignee, add_time,is_prints, SUM( goods_amount + shipping_fee ) AS tprice FROM `{$this->App->prefix()}goods_order_info` $w GROUP BY order_id $orderby LIMIT $start,$list";
            $rt = $this->App->find($sql);
            $orderlist = array();
            if(!empty($rt)){
                foreach($rt as $row){
					$uid = $row['user_id'];	
					if(empty($row['order_id'])||empty($row['order_sn'])) continue;
                    $orderlist[] = array(
                        'order_id'=>$row['order_id'],
                        'order_sn'=>$row['order_sn'],
                        'user_id'=>$row['user_id'],
                        'consignee'=>$row['consignee'],
						'nickname'=>$this->App->findvar("SELECT nickname FROM `{$this->App->prefix()}user` WHERE user_id = '$uid' LIMIT 1"),
                        'tprice'=>$row['tprice'],
                        'order_status'=>$row['order_status'],
                        'shipping_status'=>$row['shipping_status'],
                        'pay_status'=>$row['pay_status'],
						'is_prints'=>$row['is_prints'],
                        'add_time'=>(!empty($row['add_time'])? date('Y-m-d H:i:s',$row['add_time']) : '无知'),
                        'status'=>$this->get_status($row['order_status'],$row['pay_status'],$row['shipping_status'])
                        );
                }
            }
            $this->set('orderlist',$orderlist);
			
	//		echo strtotime("2011-05-01");
	//		exit;
			
			//选择模板
            $ty = isset($_GET['tt'])&&!empty($_GET['tt']) ? trim($_GET['tt']) : "";
			switch($ty){
				case 'delivery': //发货单列表
					$this->template('goods_order_delivery_list');
					break;
				case 'back': //退货单列表
					$this->template('goods_order_back_list');
					break;
				default:
					$this->template('goods_order_list');
					break;
			}
            
	}
	
	//订单详情信息
	function order_info($id=0){
            if(empty($id)) { $this->jump('goods_order.php?type=order_list',0,'订单ID为空！'); exit;}
			$sql = "SELECT tb1.*,tb2.region_name AS province,tb3.region_name AS city,tb5.user_name,tb4.region_name AS district,tb6.region_name AS town ,tb7.region_name AS village FROM `{$this->App->prefix()}goods_order_info` AS tb1"; // look添加tb5.user_name
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb2 ON tb2.region_id = tb1.province";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb3 ON tb3.region_id = tb1.city";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb4 ON tb4.region_id = tb1.district";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb6 ON tb6.region_id = tb1.town";
			$sql .=" LEFT JOIN `{$this->App->prefix()}region` AS tb7 ON tb7.region_id = tb1.village";
			$sql .= " LEFT JOIN `{$this->App->prefix()}user` AS tb5 ON tb5.user_id = tb1.shop_id"; // look添加
			$sql .=" WHERE tb1.order_id='$id'";
			$rt['orderinfo'] = $this->App->findrow($sql);
            if(empty($rt['orderinfo'])) { $this->jump('goods_order.php?type=order_list',0,'信息为空！'); exit;}
			
            $rt['orderinfo']['status'] = $this->get_status($rt['orderinfo']['order_status'],$rt['orderinfo']['pay_status'],$rt['orderinfo']['shipping_status']);
			
            $sql = "SELECT tb1.*,tb2.goods_thumb,tb2.goods_unit,tb2.goods_brief,tb2.goods_number AS storage,tb2.goods_id, IFNULL(tb3.brand_name, '') AS brand_name FROM `{$this->App->prefix()}goods_order` AS tb1";  //look 添加
			$sql .= " LEFT JOIN `{$this->App->prefix()}goods` AS tb2 ON tb1.goods_id = tb2.goods_id";
			$sql .= " LEFT JOIN `{$this->App->prefix()}brand` AS tb3 ON tb2.brand_id = tb3.brand_id";
			$sql .= " WHERE tb1.order_id = '$id'";
			$rt['ordergoods']= $this->App->find($sql);
			$rt['order_action_button'] = $this->get_order_action_button($rt['orderinfo']['order_status'],$rt['orderinfo']['pay_status'],$rt['orderinfo']['shipping_status']); //返回订单操作按钮
			
			//订单操作信息
			$sql = "SELECT * FROM `{$this->App->prefix()}goods_order_action` WHERE order_id='$id' ORDER BY log_time DESC";
			$rs = $this->App->find($sql);
			$rt['action_info'] = array();
			if(!empty($rs)){
				foreach($rs as $k=>$row){
				    $rt['action_info'][$k] = $row;
					$rt['action_info'][$k]['status']=  $this->get_status($row['order_status'],$row['pay_status'],$row['shipping_status']);
					$rt['action_info'][$k]['log_time'] = !empty($row['log_time']) ? date('Y-m-d H:i:s',$row['log_time']) : '无知';
					$os = $this->get_status($row['order_status'],'tt','tt');
					$rt['action_info'][$k]['order_status'] = !empty($os) ? str_replace(',','',$os) : "";
					$ss = $this->get_status('tt','tt',$row['shipping_status']);
					$rt['action_info'][$k]['shipping_status'] = !empty($ss) ? str_replace(',','',$ss) : "";;
					$ps = $this->get_status('tt',$row['pay_status'],'tt');
					$rt['action_info'][$k]['pay_status'] = !empty($ps) ? str_replace(',','',$ps) : "";;
				}
			}
			$this->set('rt',$rt);
			unset($rs);
            $this->template('goods_order_info');
	}
	

        //订单的状态
        function get_status($oid=0,$pid=0,$sid=0){ //分别为：订单 支付 发货状态
            $str = '';
            switch($oid){
                case '0':
                    $str .= '未确认,';
                    break;
                case '1':
                    $str .= '<font color="red">取消</font>,';
                    break;
                case '2':
                    $str .= '确认,';
                    break;
                case '3':
                    $str .= '<font color="red">退货</font>,';
                    break;
                case '4':
                    $str .= '<font color="red">无效</font>,';
                    break;
            }

           switch($pid){
                case '0':
                    $str .= '未付款,';
                    break;
                case '1':
                    $str .= '已付款,';
                    break;
                case '2':
                    $str .= '已退款,';
                    break;
            }

            switch($sid){
                case '0':
                    $str .= '未发货';
                    break;
                case '1':
                    $str .= '配货中';
                    break;
                case '2':
                    $str .= '已发货';
                    break;
                case '3':
                    $str .= '部分发货';
                    break;
                case '4':
                    $str .= '退货';
                    break;
                case '5':
                    $str .= '已收货';
                    break;
            }
            return $str;
        }

        //选择订单的所在状态
        function select_statue($id=""){
            if(empty($id)) return "";
            switch ($id){
                case '-1':
                    return "";
                    break;
                case '11':
                    return "order_status='0'";
                    break;
                case '200':
                    return "order_status='2' AND shipping_status='0' AND pay_status='0'";
                    break;
                case '210':
                    return "order_status='2' AND shipping_status='0' AND pay_status='1'";
                    break;
                case '214':
                    return "order_status='2' AND shipping_status='4' AND pay_status='1'";
                    break;
                case '1':
                    return "order_status='1'";
                    break;
                case '4':
                    return "order_status='4'";
                    break;
                case '3':
                    return "order_status='3'";
                    break;
                case '2':
                    return "pay_status='2'";
                    break;
				case '222': //已发货
					return "shipping_status='2'";
					break;
                default :
                    return "";
                    break;
            }
        }

		//获取当前可以操作的按钮
		/*
		if(没确认){
		  =>确认、付款、取消、无效
			
		}else if(确认){
		  if(没支付){
			 =>支付、取消、无效
			 
		  }else if(已支付){
			 if(没发货){
			   =>发货、设为未付款、取消（设为没付款、没发货）
			 }else if(已发货){
			   =>未发货、已收货、退货
			 }else if(配货中){
			   =>设为没付款、取消
			 }else if(已收货){
			   =>退货
			 }     
		
		  }else if(退款){
			 if(已发货){
			   =>未发货、退货、
			 }else if(配货中){
			   =>未发货、退货、
			 }else if(已收货){
			   =>未发货、退货、
			 }     
		  }
		
		}else if(取消){
		  =>确认、移除
		}else if(退货){
		  =>确认
		}else if(无效){
		 =>确认、移除
		}
		*/
		function get_order_action_button($order_status=0,$pay_status=0,$shipping_status=0){
			$str = "";
			if($order_status==0){ 	//没确认(没付款、没发货)
				$str .= '<input value="确认" class="order_action" type="button" id="200">'."\n";
				$str .= '<input value="发货" class="order_action" type="button" id="202">'."\n";
				$str .= '<input value="付款" class="order_action" type="button" id="210">'."\n";
				$str .= '<input value="取消" class="order_action" type="button" id="100">'."\n";
				$str .= '<input value="无效" class="order_action" type="button" id="400">'."\n";
				
			}else if($order_status==2){   //已经确认
			    if($pay_status==0){ //没支付
					$s2 = '0';
					if($pay_status=='1') $s = '1'; else $s = '0';
					if($shipping_status=='0'){
						$str .= '<input value="发货" class="order_action" type="button" id="2'.$s.'2">'."\n";
					}elseif($shipping_status=='2'){//已经发货
						$s2 = '2';
						$str .= '<input value="收货" class="order_action" type="button" id="215">'."\n";
					}
					if($pay_status!='1'){
				    $str .= '<input value="付款" class="order_action" type="button" id="21'.$s2.'">'."\n";
					}
				    $str .= '<input value="取消" class="order_action" type="button" id="100">'."\n";
				    $str .= '<input value="无效" class="order_action" type="button" id="400">'."\n";
				
				}else if($pay_status==1){ //已支付
					if($shipping_status==0){ //未发货
						 if($pay_status=='1') $s = '1'; else $s = '0';
					    	 $str .= '<input value="发货" class="order_action" type="button" id="2'.$s.'2">'."\n";
						 if($pay_status!='1'){
							 $str .= '<input value="付款" class="order_action" type="button" id="210">'."\n";
						 }
				   		 $str .= '<input value="设为未支付" class="order_action" type="button" id="200">'."\n";
				    	 $str .= '<input value="取消" class="order_action" type="button" id="100">'."\n";
						 
					 }else if($shipping_status==2){ //已发货
					     $str .= '<input value="设为未支付" class="order_action" type="button" id="200">'."\n";
					     $str .= '<input value="设为未发货" class="order_action" type="button" id="210">'."\n";
						 if($pay_status!='1'){
						 	$str .= '<input value="付款" class="order_action" type="button" id="210">'."\n";
						 }
				   		 $str .= '<input value="收货" class="order_action" type="button" id="215">'."\n";
				    	 $str .= '<input value="退货" class="order_action" type="button" id="324">'."\n";
						 
					 }else if($shipping_status==1){ //配货中
					     $str .= '<input value="设为未支付" class="order_action" type="button" id="200">'."\n";
				   		 $str .= '<input value="取消" class="order_action" type="button" id="100">'."\n";
					 }else if($shipping_status==5){ //已收货
					     $str .= '<input value="退货" class="order_action" type="button" id="324">'."\n";
						 if($pay_status!='1'){
						 	$str .= '<input value="付款" class="order_action" type="button" id="210">'."\n";
						 }
					 }     
				}else if($pay_status==2){ //退款
				    if($shipping_status==2){ //已发货
					     $str .= '<input value="设为未发货" class="order_action" type="button" id="120">'."\n";
				   		 $str .= '<input value="退货" class="order_action" type="button" id="124">'."\n";
					 }else if($shipping_status==1){ //配货中
					      $str .= '<input value="设为未发货" class="order_action" type="button" id="120">'."\n";
				   		  $str .= '<input value="退货" class="order_action" type="button" id="124">'."\n";
					 }else if($shipping_status==5){  //已收货
					      $str .= '<input value="设为未发货" class="order_action" type="button" id="120">'."\n";
				   		  $str .= '<input value="退货" class="order_action" type="button" id="124">'."\n";
					 }     
				}
			}else if($order_status==1){  //取消
			  	$str .= '<input value="确认" class="order_action" type="button" id="200">'."\n";
				$str .= '<input value="移除" class="order_action" type="button" id="remove">'."\n";
			}else if($order_status==4){ //无效
			    $str .= '<input value="确认" class="order_action" type="button" id="200">'."\n";
			}else if($order_status==3){ //退货
			    $str .= '<input value="确认" class="order_action" type="button" id="200">'."\n";
				$str .= '<input value="移除" class="order_action" type="button" id="remove">'."\n";
			}
			return $str;
		}
		
		//ajax订单状态操作记录
		function ajax_op_status($data=array()){
			@set_time_limit(300); //最大运行时间
			if(strlen($data['opstatus'])!=3) {echo  "非法操作"; exit; }
			if(empty($data['opid'])){echo  "非法操作"; exit; }
			
 			$datas['order_status'] = substr($data['opstatus'],0,1);
			$datas['pay_status'] = substr($data['opstatus'],1,1);
			$datas['shipping_status'] = substr($data['opstatus'],-1);
			if($datas['shipping_status']=='5' || $datas['shipping_status']=='2'){ //收货，开通代理
				$order_id = $data['opid'];
				//当前购买用户
				$pu = $this->App->findrow("SELECT user_id,order_sn FROM `{$this->App->prefix()}goods_order_info` WHERE order_id = '$order_id' LIMIT 1");
				$uid = isset($pu['user_id']) ? $pu['user_id'] : 0; 
				$order_sn = isset($pu['order_sn']) ? $pu['order_sn'] : ''; 
				if($uid > 0){
					//标记当前用户所有下级为该代理会员
					//加入代理关系表
					$rank = $this->App->findvar("SELECT user_rank FROM `{$this->App->prefix()}user` WHERE user_id = '$uid' LIMIT 1");
					if($rank=='1'){
						$this->App->update('user',array('user_rank'=>'12'),'user_id',$uid);
						
						$this->action('user','update_user_tree',$uid,$uid);
						
						$this->action('user','update_daili_tree',$uid);//更新代理关系
					}
					
				}
			}
			
			//发货
			if($datas['shipping_status']=='2'){
				$rr = $this->App->findrow("SELECT wecha_id,nickname FROM `{$this->App->prefix()}user` WHERE user_id='$uid' LIMIT 1");
				$pwecha_id = isset($rr['wecha_id']) ? $rr['wecha_id'] : '';
				$nickname = isset($rr['nickname']) ? $rr['nickname'] : '';
				if(!empty($pwecha_id) && !empty($nickname)){
					$this->action('api','send',array('openid'=>$pwecha_id,'appid'=>'','appsecret'=>'','nickname'=>$nickname,'order_sn'=>$order_sn),'fahuo');
				}
			}
		
			$this->App->update('goods_order_info',$datas,'order_id',$data['opid']); //更新状态
			$datas['order_id'] = $data['opid'];
			$datas['action_note'] = !empty($data['opremark']) ? $data['opremark'] : "---";
			$datas['log_time'] = mktime();
			$datas['action_user'] = $this->Session->read('adminname');
			$this->App->insert('goods_order_action',$datas);  //操作记录
			//查询操作
			$sql = "SELECT * FROM `{$this->App->prefix()}goods_order_action` WHERE order_id='$data[opid]' ORDER BY log_time DESC";
			$rt = $this->App->find($sql);
			if(!empty($rt)){
				foreach($rt as $k=>$row){
				    $rt[$k] = $row;
					$rt[$k]['status']=  $this->get_status($row['order_status'],$row['pay_status'],$row['shipping_status']);
					$rt[$k]['log_time'] = !empty($row['log_time']) ? date('Y-m-d H:i:s',$row['log_time']) : '无知';
					$os = $this->get_status($row['order_status'],'tt','tt');
					$rt[$k]['order_status'] = !empty($os) ? str_replace(',','',$os) : "";
					$ss = $this->get_status('tt','tt',$row['shipping_status']);
					$rt[$k]['shipping_status'] = !empty($ss) ? str_replace(',','',$ss) : "";
					$ps = $this->get_status('tt',$row['pay_status'],'tt');
					$rt[$k]['pay_status'] = !empty($ps) ? str_replace(',','',$ps) : "";;
				}
			}
			//邮件发送
			
			//支付
			//返佣金
			if($datas['pay_status']=='1'){
				$order_id = $data['opid'];
				$order_sn = $this->App->findvar("SELECT order_sn FROM `{$this->App->prefix()}goods_order_info` WHERE order_id = '$order_id' LIMIT 1");
				$this->pay_successs_tatus2($order_sn);
			}
			
			$this->set('action_info',$rt);
			$this->fetch('goods_order_action_ajax');
		}
	
	function format_price($price=0){
		if(empty($price)) return '0.00';
		return number_format($price, 2, '.', '');
	}

	//返佣金
	function pay_successs_tatus2($order_sn=''){
		@set_time_limit(300); //最大运行时间
		//购买用户返积分
		$sql = "SELECT cid FROM `{$this->App->prefix()}user_money_change` WHERE order_sn='$order_sn'"; //资金
		$cid = $this->App->findvar($sql);
		$tt = 'true';
		if($cid > 0){
				$tt = 'false';
				return;
		}	
		//上三级返佣金
		
		//送佣金，找出推荐用户
		$pu = $this->App->findrow("SELECT user_id,daili_uid,parent_uid,parent_uid2,parent_uid3,goods_amount,order_amount,order_sn,pay_status,order_id FROM `{$this->App->prefix()}goods_order_info` WHERE order_sn='$order_sn' LIMIT 1");
		$parent_uid = isset($pu['parent_uid']) ? $pu['parent_uid'] : 0; //一级
		$parent_uid2 = isset($pu['parent_uid2']) ? $pu['parent_uid2'] : 0; //二级
		$parent_uid3 = isset($pu['parent_uid3']) ? $pu['parent_uid3'] : 0; //三级
		$user_id = isset($pu['user_id']) ? $pu['user_id'] : 0; //分享者
		
		$daili_uid = isset($pu['daili_uid']) ? $pu['daili_uid'] : 0; //代理
		$moeyss = isset($pu['order_amount']) ? $pu['order_amount'] : 0; //实际消费
		$uid = isset($pu['user_id']) ? $pu['user_id'] : 0;
		$pay_status = isset($pu['pay_status']) ? $pu['pay_status'] : 0;
		
		$order_id = isset($pu['order_id']) ? $pu['order_id'] : 0;
		
		if(!empty($order_sn) && $tt=='true'){
			
			$sql = "SELECT * FROM `{$this->App->prefix()}userconfig` LIMIT 1";//用户配置信息
			$rts = $this->App->findrow($sql);
						
			//购物者送积分
			if($pay_status=='1'){//支付了的
				$pointnum =  $rts['pointnum'];
				if($pointnum > 0 && !empty($moeyss)){
						$points = intval($moeyss * $pointnum);
						$thismonth = date('Y-m-d',mktime());
						//购买者送积分
						$sql = "UPDATE `{$this->App->prefix()}user` SET `points_ucount` = `points_ucount`+$points,`mypoints` = `mypoints`+$points WHERE user_id = '$uid'";
						$this->App->query($sql);
						$this->App->insert('user_point_change',array('order_sn'=>$order_sn,'thismonth'=>$thismonth,'points'=>$points,'changedesc'=>'消费返积分','time'=>mktime(),'uid'=>$uid));
				}
			}
			
			//一级返佣金
			if($parent_uid > 0){
				$sql = "SELECT user_rank FROM `{$this->App->prefix()}user` WHERE user_id='$parent_uid' LIMIT 1";
				$rank = $this->App->findvar($sql);
				if($rank != '1'){ //不是普通会员
					$sql = "SELECT types FROM `{$this->App->prefix()}user` WHERE user_id='$parent_uid' LIMIT 1";
					$types = $this->App->findvar($sql);
					
					$off = 0;
					if($types=='1'){ //全职
						if($rts['ticheng360_1'] < 101 && $rts['ticheng360_1'] > 0){
							$off = $rts['ticheng360_1']/100;
						}
					}else{
						if($rank=='12'){ //普通分销商
							if($rts['ticheng180_1'] < 101 && $rts['ticheng180_1'] > 0){
								$off = $rts['ticheng180_1']/100;
							}
						}elseif($rank=='11'){//高级分销商
							if($rts['ticheng180_h1_1'] < 101 && $rts['ticheng180_h1_1'] > 0){
								$off = $rts['ticheng180_h1_1']/100;
							}
						}elseif($rank=='10'){//特权分销商
							if($rts['ticheng180_h2_1'] < 101 && $rts['ticheng180_h2_1'] > 0){
								$off = $rts['ticheng180_h2_1']/100;
							}
						}
						
					}
					$moeys = $this->format_price($moeyss*$off);
					if(!empty($moeys)){
						$record['puid1_money'] = $moeys;
						$record['p_uid1'] = $parent_uid;
						$thismonth = date('Y-m-d',mktime());
						$thism = date('Y-m',mktime());
						if($pay_status=='1'){//支付了的
							$sql = "UPDATE `{$this->App->prefix()}user` SET `money_ucount` = `money_ucount`+$moeys,`mymoney` = `mymoney`+$moeys WHERE user_id = '$parent_uid'";
							$this->App->query($sql);
							$this->App->insert('user_money_change',array('buyuid'=>$uid,'order_sn'=>$order_sn,'thismonth'=>$thismonth,'thism'=>$thism,'money'=>$moeys,'changedesc'=>'购买商品返佣金','time'=>mktime(),'uid'=>$parent_uid));
						}
					}
				}
			}
			
			
			//二级返佣金
			if($parent_uid2 > 0){
				$sql = "SELECT user_rank FROM `{$this->App->prefix()}user` WHERE user_id='$parent_uid2' LIMIT 1";
				$rank = $this->App->findvar($sql);
				if($rank != '1'){ //不是普通会员
					$sql = "SELECT types FROM `{$this->App->prefix()}user` WHERE user_id='$parent_uid2' LIMIT 1";
					$types = $this->App->findvar($sql);
					
					$off = 0;
					if($types=='1'){ //全职
						if($rts['ticheng360_2'] < 101 && $rts['ticheng360_2'] > 0){
							$off = $rts['ticheng360_2']/100;
						}
					}else{
						if($rank=='12'){ //普通分销商
							if($rts['ticheng180_2'] < 101 && $rts['ticheng180_2'] > 0){
								$off = $rts['ticheng180_2']/100;
							}
						}elseif($rank=='11'){//高级分销商
							if($rts['ticheng180_h1_2'] < 101 && $rts['ticheng180_h1_2'] > 0){
								$off = $rts['ticheng180_h1_2']/100;
							}
						}elseif($rank=='10'){//特权分销商
							if($rts['ticheng180_h2_2'] < 101 && $rts['ticheng180_h2_2'] > 0){
								$off = $rts['ticheng180_h2_2']/100;
							}
						}
						
					}
					$moeys = $this->format_price($moeyss*$off);
					if(!empty($moeys)){
						$record['puid2_money'] = $moeys;
						$record['p_uid2'] = $parent_uid2;
						$thismonth = date('Y-m-d',mktime());
						$thism = date('Y-m',mktime());
						if($pay_status=='1'){//支付了的
							$sql = "UPDATE `{$this->App->prefix()}user` SET `money_ucount` = `money_ucount`+$moeys,`mymoney` = `mymoney`+$moeys WHERE user_id = '$parent_uid2'";
							$this->App->query($sql);
						
							$this->App->insert('user_money_change',array('buyuid'=>$uid,'order_sn'=>$order_sn,'thismonth'=>$thismonth,'thism'=>$thism,'money'=>$moeys,'changedesc'=>'购买商品返佣金','time'=>mktime(),'uid'=>$parent_uid2));
						}
					}
				}
			}
			
			//三级返佣金
			if($parent_uid3 > 0){
				$sql = "SELECT user_rank FROM `{$this->App->prefix()}user` WHERE user_id='$parent_uid3' LIMIT 1";
				$rank = $this->App->findvar($sql);
				if($rank != '1'){ //不是普通会员
					$sql = "SELECT types FROM `{$this->App->prefix()}user` WHERE user_id='$parent_uid3' LIMIT 1";
					$types = $this->App->findvar($sql);
					
					$off = 0;
					if($types=='1'){ //全职
						if($rts['ticheng360_3'] < 101 && $rts['ticheng360_3'] > 0){
							$off = $rts['ticheng360_3']/100;
						}
					}else{
						if($rank=='12'){ //普通分销商
							if($rts['ticheng180_3'] < 101 && $rts['ticheng180_3'] > 0){
								$off = $rts['ticheng180_3']/100;
							}
						}elseif($rank=='11'){//高级分销商
							if($rts['ticheng180_h1_3'] < 101 && $rts['ticheng180_h1_3'] > 0){
								$off = $rts['ticheng180_h1_3']/100;
							}
						}elseif($rank=='10'){//特权分销商
							if($rts['ticheng180_h2_3'] < 101 && $rts['ticheng180_h2_3'] > 0){
								$off = $rts['ticheng180_h2_3']/100;
							}
						}
						
					}
					$moeys = $this->format_price($moeyss*$off);
					if(!empty($moeys)){
						$record['puid3_money'] = $moeys;
						$record['p_uid3'] = $parent_uid3;
						$thismonth = date('Y-m-d',mktime());
						$thism = date('Y-m',mktime());
						if($pay_status=='1'){//支付了的
							$sql = "UPDATE `{$this->App->prefix()}user` SET `money_ucount` = `money_ucount`+$moeys,`mymoney` = `mymoney`+$moeys WHERE user_id = '$parent_uid3'";
							$this->App->query($sql);
						
							$this->App->insert('user_money_change',array('buyuid'=>$uid,'order_sn'=>$order_sn,'thismonth'=>$thismonth,'thism'=>$thism,'money'=>$moeys,'changedesc'=>'购买商品返佣金','time'=>mktime(),'uid'=>$parent_uid3));
						}
					}
				}
			}
			
		}
	}
	
		//获取操作状态按钮
		function ajax_get_status_button($var=0){
			if(strlen($var) != 3) return;
			
			$order_status = substr($var,0,1);
			$pay_status = substr($var,1,1);
			$shipping_status = substr($var,-1);
			
			$str = $this->get_order_action_button($order_status,$pay_status,$shipping_status);
			die($str);
		}
		
        //ajax 处理订单状态
        function  ajax_order_bathop($ids=0,$type=""){
			@set_time_limit(600); //最大运行时间
			
            if(empty($ids)){ echo "没有找到需要删除的产品！"; exit;}
            if(empty($type)){ echo "没有指定的操作类型！"; exit;}
            $id_arr = @explode('+',$ids);

            switch ($type){
                case 'bathdel':
                    //批量删除订单
                    $now_status = $this->App->findcol("SELECT order_status FROM `{$this->App->prefix()}goods_order_info` WHERE order_id IN(".implode(',',$id_arr).")");
                    if(!empty($now_status)){
                        $afterarr = array();
                        foreach($now_status as $k=>$status){
                            if(in_array($status,array('0','2','3'))){
                                //$str = "部分操作不能完成，例如：确认、退货、刚下的的订单不能操作了！";
                                $afterarr[] = $id_arr[$k];
                            }
                        }
                        if(!empty($afterarr)){
                            $id_arr_ = array_diff($id_arr, $afterarr);
                            unset($id_arr);
                            $id_arr = $id_arr_;
                            unset($id_arr_);
                        }
                    }

                    //$sql = "DELETE FROM `{$this->App->prefix()}goods_order_info` WHERE order_id IN(".implode(',',$id_arr).")";
                    //$this->App->query($sql);
                    if(!empty($id_arr)){
                    	$this->App->delete('goods_order_info','order_id',$id_arr);  //订单表
                    	$this->App->delete('goods_order','order_id',$id_arr);  //订单商品表
						$this->App->delete('goods_order_action','order_id',$id_arr);  //订单操作记录表
                    	$this->action('system','add_admin_log','批量删除商品订单：'.@implode(',',$id_arr));
                    }else{
							echo "无法进行该操作！";exit;
					}
                    break;
                 case 'bathconfirm':
                    //批量确认订单
                    //查询当前的订单状态，如果当前的状态为取消[1]、失效[4]、那么将不能再确认了
                    $now_status = $this->App->findcol("SELECT order_status FROM `{$this->App->prefix()}goods_order_info` WHERE order_id IN(".implode(',',$id_arr).")");
                    if(!empty($now_status)){
                        $afterarr = array();
                        foreach($now_status as $k=>$status){
                            if(in_array($status,array('1','4'))){
                                //$str = "部分操作不能完成，例如：失效、取消的订单不能操作了！";
                                $afterarr[] = $id_arr[$k];
                            }
                        }
                        if(!empty($afterarr)){
                            $id_arr_ = array_diff($id_arr, $afterarr);
                            unset($id_arr);
                            $id_arr = $id_arr_;
                            unset($id_arr_);
                        }
                    }
                    if(!empty($id_arr)){
                        if($this->App->update('goods_order_info',array('order_status'=>'2'),'order_id',$id_arr)){
							$sql = "SELECT tb1.user_id,tb1.order_sn,tb1.order_id,tb2.user_name,tb2.email FROM `{$this->App->prefix()}goods_order_info` AS tb1 LEFT JOIN `{$this->App->prefix()}user` AS tb2 ON tb1.user_id=tb2.user_id WHERE tb1.order_id IN(".implode(',',$id_arr).")";
							$emails = $this->App->find($sql);
							if(!empty($emails))foreach($emails as $row){
								//确认后，发送mail
								$datas = array();
								if(!empty($row['email']) && $GLOBALS['LANG']['email_open_config']['confirm_order']=='1'){
									$datas['user_name'] = $row['user_name'];
									$datas['uid'] = $row['user_id'];
									$datas['order_sn'] = $row['order_sn'];
									$datas['email'] = $row['email'];
									$datas['orderinfourl'] = SITE_URL.'user.php?act=orderinfo&order_id='.$row['order_id'];
									$this->action('email','send_confirm_order',$datas);
									unset($datas);
								}
							}
							
						}
                        $this->action('system','add_admin_log','批量确认订单：'.@implode(',',$id_arr));
                    }else{
							echo "无法进行该操作！";exit;
					}
                    break;
                 case 'bathcancel':
                    //批量取消订单
                    //查询当前的订单状态，如果当前的状态为确认[2]、退货[3]、那么将不能再取消了了
                    $now_status = $this->App->findcol("SELECT order_status FROM `{$this->App->prefix()}goods_order_info` WHERE order_id IN(".implode(',',$id_arr).")");
                    $str = "";
                    if(!empty($now_status)){
                        $afterarr = array();
                        foreach($now_status as $k=>$status){
                            if(in_array($status,array('2','3'))){
                                $afterarr[] = $id_arr[$k];
                            }
                        }
                        if(!empty($afterarr)){
                            $id_arr_ = array_diff($id_arr, $afterarr);
                            unset($id_arr);
                            $id_arr = $id_arr_;
                            unset($id_arr_);
                        }
                    }
                    if(!empty($id_arr)){
                    	$this->App->update('goods_order_info',array('order_status'=>'1'),'order_id',$id_arr);
						
						$sql = "SELECT tb1.user_id,tb1.order_sn,tb1.order_id,tb2.user_name,tb2.email FROM `{$this->App->prefix()}goods_order_info` AS tb1 LEFT JOIN `{$this->App->prefix()}user` AS tb2 ON tb1.user_id=tb2.user_id WHERE tb1.order_id IN(".implode(',',$id_arr).")";
						$emails = $this->App->find($sql);
						if(!empty($emails))foreach($emails as $row){
							//订单取消后，发送mail
							$datas = array();
							if(!empty($row['email']) && $GLOBALS['LANG']['email_open_config']['cancel_order']=='1'){
								$datas['user_name'] = $row['user_name'];
								$datas['uid'] = $row['user_id'];
								$datas['order_sn'] = $row['order_sn'];
								$datas['email'] = $row['email'];
								$datas['orderinfourl'] = SITE_URL.'user.php?act=orderinfo&order_id='.$row['order_id'];
								$this->action('email','send_cancel_order',$datas);
								unset($datas);
							}
						}
							
                    	$this->action('system','add_admin_log','批量取消订单：'.@implode(',',$id_arr));
                    }else{
							echo "无法进行该操作！";exit;
					}
                    break;
                 case 'bathinvalid':
                    //批量失效订单
                    //查询当前的订单状态，如果当前的状态为确认[2]、退货[3]、那么将不能再失效了
                    $now_status = $this->App->findcol("SELECT order_status FROM `{$this->App->prefix()}goods_order_info` WHERE order_id IN(".implode(',',$id_arr).")");
                    $str = "";
                    if(!empty($now_status)){
                        $afterarr = array();
                        foreach($now_status as $k=>$status){
                            if(in_array($status,array('2','3'))){
                                //$str = "部分操作不能完成，例如：确认、退货的订单不能操作了！";
                                $afterarr[] = $id_arr[$k];
                            }
                        }
                        if(!empty($afterarr)){
                            $id_arr_ = array_diff($id_arr, $afterarr);
                            unset($id_arr);
                            $id_arr = $id_arr_;
                            unset($id_arr_);
                        }
                    }
                    if(!empty($id_arr)){
                    	$this->App->update('goods_order_info',array('order_status'=>'4'),'order_id',$id_arr);
						
						$sql = "SELECT tb1.user_id,tb1.order_sn,tb1.order_id,tb2.user_name,tb2.email FROM `{$this->App->prefix()}goods_order_info` AS tb1 LEFT JOIN `{$this->App->prefix()}user` AS tb2 ON tb1.user_id=tb2.user_id WHERE tb1.order_id IN(".implode(',',$id_arr).")";
						$emails = $this->App->find($sql);
						if(!empty($emails))foreach($emails as $row){
							//订单取消后，发送mail
							$datas = array();
							if(!empty($row['email']) && $GLOBALS['LANG']['email_open_config']['orders_invalid']=='1'){
								$datas['user_name'] = $row['user_name'];
								$datas['uid'] = $row['user_id'];
								$datas['order_sn'] = $row['order_sn'];
								$datas['email'] = $row['email'];
								$datas['orderinfourl'] = SITE_URL.'user.php?act=orderinfo&order_id='.$row['order_id'];
								$this->action('email','send_invalid_order',$datas);
								unset($datas);
							}
						}
							
                    	$this->action('system','add_admin_log','批量失效订单：'.@implode(',',$id_arr));
                    }else{
							echo "无法进行该操作！";exit;
					}
                    break;

            }

        }
		
			//支付方式
		function paymentlist(){
			//删除
				$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
				if($id>0){
				$this->App->delete('payment','pay_id',$id);
				}
				
			$rt = $this->App->find("SELECT * FROM `{$this->App->prefix()}payment`");
			$this->set('rt',$rt);
			 $this->template('paymentlist');
		}
		
		function paymentinfo($id=0){
			$data = array();
			if(!empty($_POST)){
				$data['pay_name'] = $_POST['pay_name'];
				$data['pay_desc'] = $_POST['pay_desc'];
				$data['pay_fee'] = $_POST['pay_fee'];
				$data['pay_config'] = serialize(array('pay_no'=>(isset($_POST['pay_no'])?$_POST['pay_no']:""),'pay_code'=>(isset($_POST['pay_code'])?$_POST['pay_code']:""),'pay_idt'=>(isset($_POST['pay_idt'])?$_POST['pay_idt']:"")));
			
			}
			if($id>0){
				if(isset($data)&&!empty($data)){
					
					if($this->App->update('payment',$data,'pay_id',$id)){
						$this->action('system','add_admin_log','更新支付方式：'.$data['pay_name']);
						$this->action('common','showdiv',$this->getthisurl());
					}else{
						$this->jump('payment.php?type=info&id='.$id,0,'更新失败！'); exit;
					}
				}
				$rt = $this->App->findrow("SELECT * FROM `{$this->App->prefix()}payment` WHERE pay_id='$id' LIMIT 1");
				$pay_config = unserialize($rt['pay_config']);
				$rt['pay_no'] = $pay_config['pay_no'];
				$rt['pay_code'] = $pay_config['pay_code'];
				$rt['pay_idt'] = $pay_config['pay_idt'];
				$type = 'edit';
			}else{
				if(!empty($data)){
					
					if($this->App->insert('payment',$data)){
						$this->action('system','add_admin_log','添加支付方式：'.$data['pay_name']);
						$this->action('common','showdiv',$this->getthisurl());
					}else{
						$this->jump('payment.php?type=info',0,'添加失败！'); exit;
					}
				}
				$type = 'add';
			}
			$this->set('type',$type);
			$this->set('rt',$rt);
			if($id=='4'){
				$this->template('paymentinfowx');
			}else{
				$this->template('paymentinfo');
			}
		}
		
		function ajax_pay_activeop($data=array()){
			if(empty($data['id'])) die("非法操作，ID为空！");
			$type = $data['type']; 
			$sdata = array();
			$sdata['enabled']= $data['active'];
			$this->App->update('payment',$sdata,'pay_id',$data['id']);
			unset($data,$sdata);
		}
		
		//配送方式方式
		function deliverylist(){
			//删除
				$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
				if($id>0){
				$this->App->delete('shipping','shipping_id',$id);
				}
				
			$rt = $this->App->find("SELECT * FROM `{$this->App->prefix()}shipping`");
			$this->set('rt',$rt);
			 $this->template('deliverylist');
		}
		//配送方式信息
		function deliveryinfo($id=0){
			if($id>0){
				$rt = $this->App->findrow("SELECT * FROM `{$this->App->prefix()}shipping` WHERE shipping_id='$id' LIMIT 1");
				if(isset($_POST)&&!empty($_POST)){
					if($this->App->update('shipping',$_POST,'shipping_id',$id)){
						$this->jump('delivery.php?type=info&id='.$id,0,'更新成功！'); exit;
					}else{
						$this->jump('delivery.php?type=info&id='.$id,0,'更新失败！'); exit;
					}
				}
				$type = 'edit';
			}else{
				if(isset($_POST)&&!empty($_POST)){
					if($this->App->insert('shipping',$_POST)){
						$this->jump('delivery.php?type=info',0,'添加成功！'); exit;
					}else{
						$this->jump('delivery.php?type=info',0,'添加失败！'); exit;
					}
				}
				$type = 'add';
			}
			$this->set('type',$type);
			$this->set('rt',$rt);
			 $this->template('deliveryinfo');
		}
		
		//配送区域列表
		function delivery_area_list($id=0){
			if(!empty($_GET['delid'])&&intval($_GET['delid'])>0){
				$this->App->delete('shipping_area','shipping_area_id',intval($_GET['delid']));
			}
			$rt = array();
			if($id>0){
				$sql = "SELECT * FROM `{$this->App->prefix()}shipping_area` WHERE shipping_id='$id'";
				$rs = $this->App->find($sql);
				if(!empty($rs)){
					foreach($rs as $row){
							$areaid = !empty($row['configure']) ? json_decode($row['configure']) : array();
							if(!empty($areaid)){
								$row['configure'] = $this->App->findcol("SELECT region_name FROM `{$this->App->prefix()}region` WHERE region_id IN (".@implode(',',$areaid).") ORDER BY region_id ASC");
							}
							$rt[] = $row;
					}
					unset($rs);
				}
			}

			$this->set('rt',$rt);
		 	$this->template('delivery_area_list');
		}
		
/***************  look添加 开始    *************************************************************************/		
//产品总销量
	function product_order_list(){
             //排序
            $orderby = "";
            if(isset($_GET['desc'])){
                      $orderby = ' ORDER BY '.$_GET['desc'].' DESC';
            }else if(isset($_GET['asc'])){
                      $orderby = ' ORDER BY '.$_GET['asc'].' ASC';
            }else {
                      $orderby = ' ORDER BY `order_id` DESC';
            }
            //分页
            $page= isset($_GET['page']) ? $_GET['page'] : '';
            if(empty($page)){
                   $page = 1;
            }

            //条件
			/*	$sql = "SELECT distinct tb1.user_name,tb1.user_id,tb1.nickname FROM `{$this->App->prefix()}user` AS tb1 LEFT JOIN `{$this->App->prefix()}goods` AS tb2 ON tb1.user_id=tb2.uid WHERE tb1.user_rank='10' ORDER BY tb1.user_id";*/
			// 查询供应商
			$sql = "SELECT distinct tb1.user_name,tb1.user_id,tb1.nickname FROM `{$this->App->prefix()}user` AS tb1  WHERE tb1.user_rank='10' ORDER BY tb1.user_id";
		$this->set('uidlist',$this->App->find($sql));
			
			
			//查询配送店
			$sql = "SELECT distinct tb1.user_name,tb1.user_id,tb1.nickname FROM `{$this->App->prefix()}user` As tb1 WHERE tb1.user_rank = '12' ORDER BY tb1.user_id ";
			$this->set('pslist',$this->App->find($sql));
			
			
			
			
            $comd = array();
			/*if(isset($_GET['status'])&&!empty($_GET['status'])){
                    $st = $this->select_statue($_GET['status']);
                    !empty($st)? $comd[] = $st : "";
            }*/
		
            if(isset($_GET['status'])&&!empty($_GET['status'])){
                    $st = $this->select_statue($_GET['status']);
                    !empty($st)? $comd[] = $st : "";
            }
			
			/***********  look添加 日期查询 开始  ********************************/	
			if(isset($_GET['add_time1'])&&!empty($_GET['add_time1']) && empty($_GET['add_time2'])){
					$t = strtotime($_GET['add_time1'])+24*60*60 ;
                    $comd[] = "add_time >= ". strtotime($_GET['add_time1']) ."&&add_time < " .$t;
					}
			if(isset($_GET['add_time2'])&&!empty($_GET['add_time2']) && empty($_GET['add_time1'])){
                    $comd[] = "add_time <= ". strtotime($_GET['add_time2']);
					}
			if(isset($_GET['add_time1'])&&!empty($_GET['add_time1']) &&isset($_GET['add_time2'])&& !empty($_GET['add_time2'])){
					$t = strtotime($_GET['add_time2'])+24*60*60 ;
                    $comd[] = "add_time >= ". strtotime($_GET['add_time1']) ."&&add_time < " .$t;
			}
							
			/***********  look添加 日期查询 结束  ********************************/	
			
			
			
            if(isset($_GET['order_sn'])&&!empty($_GET['order_sn']))
                    $comd[] = "order_sn LIKE '%".trim($_GET['order_sn'])."%'";
            if(isset($_GET['consignee'])&&!empty($_GET['consignee']))
                    $comd[] = "consignee LIKE '%".trim($_GET['consignee'])."%'";
			if(isset($_GET['psid'])&&!empty($_GET['psid'])&&$_GET['psid']=='-1'){
					$comd[] = " shipping_id = '4' ";
			}		
			if(isset($_GET['psid'])&&!empty($_GET['psid'])&&$_GET['psid']!='-1'){
                    $comd[] = " shop_id = $_GET[psid] ";	
					}
			
            $w = ""; 
            if(!empty($comd)){
                $w = ' WHERE '.@implode(' AND ',$comd);
            }
			
		//	print_r ($w);
		//	exit;
		//	print_r ($comd);
			
		//	exit;
			
            $list = 12;
            $start = ($page-1)*$list;
            $sql = "SELECT COUNT(order_id) FROM `{$this->App->prefix()}goods_order_info` $w";
            $tt = $this->App->findvar($sql);
            $pagelink = Import::basic()->getpage($tt, $list, $page,'?page=',true);
            $this->set("pagelink",$pagelink);
          /*  $sql = "SELECT order_id, order_sn, user_id, order_status, shipping_status, pay_status, consignee, add_time, SUM( goods_amount + shipping_fee ) AS tprice FROM `{$this->App->prefix()}goods_order_info` $w GROUP BY order_id $orderby LIMIT $start,$list";
		  
		    $sql = "SELECT tb1.*,tb2.goods_thumb,tb2.goods_number AS storage,tb2.goods_id, IFNULL(tb3.brand_name, '') AS brand_name FROM `{$this->App->prefix()}goods_order` AS tb1";
			$sql .= " LEFT JOIN `{$this->App->prefix()}goods` AS tb2 ON tb1.goods_id = tb2.goods_id";
			$sql .= " LEFT JOIN `{$this->App->prefix()}brand` AS tb3 ON tb2.brand_id = tb3.brand_id";
			$sql .= " WHERE tb1.order_id = '$id'";
		  */
		  $sql = "SELECT order_id  FROM `{$this->App->prefix()}goods_order_info` $w GROUP BY order_id $orderby ";  //取得订单表id
		
		/*************************  能获取到供应商商品的订单  ****************************************
		
		$sql = "SELECT tb1.order_id , tb2.goods_id ,tb3.uid ,tb4.user_name  FROM `{$this->App->prefix()}goods_order_info` AS tb1"; 
		$sql .= " LEFT JOIN `{$this->App->prefix()}goods_order` AS tb2 ON tb1.order_id = tb2.order_id";
		$sql .= " LEFT JOIN `{$this->App->prefix()}goods` AS tb3 ON tb2.goods_id = tb3.goods_id";
		$sql .= " LEFT JOIN `{$this->App->prefix()}user` AS tb4 ON tb3.uid = tb4.user_id";
		$sql .= " $w GROUP BY tb1.order_id $orderby";
		
		************************************************************************************************/
		
        $rt = $this->App->find($sql);
		
		
		//开始截取订单表id的值  用	‘，’分开；
	//	echo mysql_error();
	//	exit;
		
	//	print_r($rt);
	//	exit;
		
	//	$sql = "SELECT user_name FROM `{$this->App->prefix()}user` WHERE user_id = $_GET[psid] ";
	//	$rs = $this->App->find($sql);
	//	echo $_GET['order_sn'];
		
	//	echo $_GET['psid'];
	//	exit;
	//	print_r($rs);
		
			$str = '';
			foreach($rt as $value){
				$str .= $value['order_id'].',';
									}
			$goods_id = rtrim($str,',');
			
		/*	$user_id = ' ' ;
			foreach($comd as $value){
				$user_id .= $value['tb3.uid'].',';
									}
			print_r ($user_id);*/
			
			
			
			if(isset($_GET['uid'])&&intval($_GET['uid'])>0)
			$user_id = 'and tb3.user_id ='. intval($_GET['uid']). ' '; // 组装 多个where条件 
		//	print_r ($user_id);
			
		//开始查询 订购各个商品的总数	
			$sql = "SELECT tb1.goods_bianhao,tb1.goods_name, tb1.goods_id,sum(tb1.goods_number) as numb,tb2.uid,tb2.market_price , tb2.pifa_price , tb3.user_name,tb3.user_id  FROM `{$this->App->prefix()}goods_order` AS tb1";
			$sql .= " LEFT JOIN `{$this->App->prefix()}goods` AS tb2 ON tb2.goods_id = tb1.goods_id";
			$sql .= " LEFT JOIN `{$this->App->prefix()}user` AS tb3 ON tb3.user_id = tb2.uid";
			
			$sql .= " WHERE order_id in ($goods_id) $user_id GROUP BY goods_id order by tb2.uid LIMIT $start,$list";
			$rt = $this->App->find($sql);
	//	echo mysql_error ();
            $orderlist = array();
            if(!empty($rt)){
                foreach($rt as $row){
				//	if(empty($row['order_id'])||empty($row['order_sn'])) continue;
                    $orderlist[] = array(
						'goods_bianhao'=>$row['goods_bianhao'],
                        'goods_name'=>$row['goods_name'],
						'numb'=>$row['numb'],
						'uid'=>$row['uid'],
						'user_id'=>$row['user_id'],
						'user_name'=>$row['user_name'],
						'market_price'=>$row['market_price'],
						'pifa_price'=>$row['pifa_price'],
						'goods_id'=>$row['goods_id']
						/*
						'order_id'=>$row['order_id'],
                        'order_sn'=>$row['order_sn'],
                        'user_id'=>$row['user_id'],
                        'consignee'=>$row['consignee'],
                        'tprice'=>$row['tprice'],
                        'order_status'=>$row['order_status'],
                        'shipping_status'=>$row['shipping_status'],
                        'pay_status'=>$row['pay_status'],
                        'add_time'=>(!empty($row['add_time'])? date('Y-m-d H：i:s',$row['add_time']) : '无知'),
                        'status'=>$this->get_status($row['order_status'],$row['pay_status'],$row['shipping_status'])*/
                        );
                }
            }
			
            $this->set('orderlist',$orderlist);
			
			
			
		//	查询所有订单各个商品详细信息
		
		/* 
		 $sql = "SELECT tb1.goods_name ,COUNT(tb1.goods_id) as numb from `{$this->App->prefix()}goods_order` AS tb1 group by goods_id";
		$rt['ordergoods']= $this->App->find($sql);
			
		 print_r($rt);
		 exit;*/
	/*	
			  $sql = "SELECT tb1.*,count(tb1.goods_id) as c,
			  tb2.goods_thumb,tb2.goods_number AS storage,tb2.goods_id, IFNULL(tb3.brand_name, '') AS brand_name FROM `{$this->App->prefix()}goods_order` AS tb1";
			$sql .= " LEFT JOIN `{$this->App->prefix()}goods` AS tb2 ON tb1.goods_id = tb2.goods_id";
			$sql .= " LEFT JOIN `{$this->App->prefix()}brand` AS tb3 ON tb2.brand_id = tb3.brand_id";
			$sql .= " WHERE tb1.order_id = '$id'";
			$rt['ordergoods']= $this->App->find($sql);*/
			
		//	print_r($_GET);
		//	exit;
			
			//选择模板
            $ty = isset($_GET['tt'])&&!empty($_GET['tt']) ? trim($_GET['tt']) : "";
			switch($ty){
				case 'delivery': //发货单列表
					$this->template('goods_order_delivery_list');
					break;
				case 'back': //退货单列表
					$this->template('goods_order_back_list');
					break;
				default:
					$this->template('product_order_list');
					break;
			}
            
	}

/***************  look添加 结束    *************************************************************************/		
		
		//配送区域信息
		function delivery_area_info($cid=0,$id=0){
			if($id>0){
				if(!empty($_POST['regions'])){
						   $data['shipping_id'] = $cid;
							$data['shipping_area_name'] = $_POST['shipping_area_name'];
							$data['shipping_desc'] = $_POST['shipping_desc'];
							$data['item_fee'] = $_POST['item_fee'];
							$data['step_item_fee'] = $_POST['step_item_fee'];
							$data['weight_fee'] = $_POST['weight_fee'];
							$data['step_weight_fee'] = $_POST['step_weight_fee'];
							$data['max_money'] = $_POST['max_money'];
							$data['configure'] = json_encode($_POST['regions']);
							$data['type'] = $_POST['fee_compute_mode'];
							if($this->App->update('shipping_area',$data,'shipping_area_id',$id)){
								$this->jump('',0,'修改成功！'); exit;
							}else{
								$this->jump('',0,'修改失败！'); exit;
							}
						 } //end if
						$type = 'edit';
						$rt = $this->App->findrow("SELECT * FROM `{$this->App->prefix()}shipping_area` WHERE shipping_area_id='$id'");
						if(empty($rt)){
						$this->jump('delivery.php?type=arealist&id='.$cid);
						}
						$areaid = !empty($rt['configure']) ? json_decode($rt['configure']) : array();
						if(!empty($areaid)){
						$rt['configure'] = $this->App->find("SELECT * FROM `{$this->App->prefix()}region` WHERE region_id IN (".implode(',',$areaid).") ORDER BY region_id ASC");
						
						}
			
			}else{
				if(!empty($_POST)){ 
					if(!empty($_POST['shipping_area_name'])){
                                            	if(!empty($_POST['regions'])){
						   $data['shipping_id'] = $cid;
                                                    $data['shipping_area_name'] = $_POST['shipping_area_name'];
                                                    $data['shipping_desc'] = $_POST['shipping_desc'];
                                                    $data['item_fee'] = $_POST['item_fee'];
                                                    $data['step_item_fee'] = $_POST['step_item_fee'];
                                                    $data['weight_fee'] = $_POST['weight_fee'];
                                                    $data['step_weight_fee'] = $_POST['step_weight_fee'];
                                                    $data['max_money'] = $_POST['max_money'];
                                                    $data['configure'] = json_encode($_POST['regions']);
                                                    $data['type'] = $_POST['fee_compute_mode'];
                                                    if($this->App->insert('shipping_area',$data)){
                                                        $this->jump('',0,'添加成功！'); exit;
                                                    }
                                                 } //end if
                                            
					}else{
						echo '<script> alert("配送方式不能为空！");</script>';
					}
				}
				$type = 'add';
			}
			$this->set('type',$type);
			$this->set('rt',$rt);
			 $this->template('delivery_area_info');
		}
		
		
		//导入订单数据
		
		function order_import(){
			  header("Content-Type:text/html;charset=utf-8");
			  header("Content-type:application/vnd.ms-excel");
			  header("Cache-Control: no-cache");
			  header("Pragma: no-cache");
			  header("Content-Disposition:filename=facebook_".date('Y-m-d',time()).".xls");
		  

			  if(!empty($rt)){ 
			  $data=array();
			  $str1  ='<table border="1" cellspacing="0" cellpadding="0">';
			  $str1 .='<tr><td>&nbsp;</td><th colspan="3" style="background:#ccc; border:1px solod #000; height:40px;font-size:20px">Facebook Data</th></tr>';
			   $data[]='<tr><td>&nbsp;</td><th width="120">Date</th><th width="100">Total Pages</th><th width="100">Total Fans</th></tr>';
				foreach($rt as $k=>$row){	
				   $data[]='<tr><td>&nbsp;</td><td width="120">'.$row["date"].'</td><td width="100">'.$row["total_role"].'</td><td width="100">'.$row["totalfans"].'</td></tr>';
				} //end foreach
			  $str1 .=implode(' ',$data);
			  $str1 .='</table>';
			  } // end if 
		}
	
}
?>