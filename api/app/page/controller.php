<?php
class PageController extends Controller{
	private $mykey = 'D27897844bc35e217de79b30b3567356'; //安全码
	private $token;
	private $wecha_id;
    private $fun;
    private $data = array();
    public $fans;
    private $my = '小邻宝';
    public $wxuser;
    public $apiServer;
	
 	function  __construct() {
		$this->layout('content');
	}
	
	function send($rts=array(),$type=""){
		if(empty($rts['openid'])) return;
		
		$appid = isset($rts['appid']) ? $rts['appid'] : "";
		$appsecret = isset($rts['appsecret']) ? $rts['appsecret'] : "";
		if(empty($appid) || empty($appsecret)){
			$sql = "SELECT appid,appsecret,is_oauth,winxintype FROM `{$this->App->prefix()}wxuserset` WHERE id='1'";
			$rt = $this->App->findrow($sql);
			$appid = $rt['appid'];
			$appsecret = $rt['appsecret'];
		}
		$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
		$json=json_decode($this->curlGet($url_get));
		if (!$json->errmsg){
			$data = $this->_get_send_con($rts,$type);
			if(!empty($data)){
				$rt=$this->curlPost('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$json->access_token,$data,0);
				if($rt['rt']==false){
					//操作失败
				}else{
					
				}
		    }
		}
		
		$access_token = $this->_get_access_token();
		$data = $this->_get_send_con($rts,$type);
		$rt=$this->curlPost('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token,$data,0);
	}
	function _get_send_con($rt=array(),$ty=''){
		$data = array();
		switch($ty){
			case 'guanzhu':
			$openid = $rt['openid'];
			$str = '你的好友['.$rt['nickname'].']已经关注你啦;\n\n服务类型：关注已返积分\n提交时间：'.date('Y-m-d H:i:s').'\n\n备注：再接再厉哦!返积分详情点击进入查看!';
			$data='{"touser": "'.$openid.'","msgtype": "news","news": {"articles": [{"title": "服务申请提交成功", "description": "'.$str.'","url":"'.str_replace('api','m',ADMIN_URL).'user.php?act=mypoints"}]}}';
			break;
			case 'guanzhudaili':
			$openid = $rt['openid'];
			$str = '你的用户下级好友['.$rt['nickname'].']已经关注你啦;\n\n服务类型：用户关注下级已返积分\n提交时间：'.date('Y-m-d H:i:s').'\n\n备注：他还需要购买你才有收入哦!';
			$data='{"touser": "'.$openid.'","msgtype": "news","news": {"articles": [{"title": "服务申请提交成功", "description": "'.$str.'","url":"'.str_replace('api','m',ADMIN_URL).'user.php?act=mypoints"}]}}';
			break;
		}
		
		return $data;
	}
	
	function curlPost($url, $data,$showError=1){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno=curl_errno($ch);
		if ($errorno) {
			return array('rt'=>false,'errorno'=>$errorno);
		}else{
			$js=json_decode($tmpInfo,1);
			if (intval($js['errcode']==0)){
				return array('rt'=>true,'errorno'=>0,'media_id'=>$js['media_id'],'msg_id'=>$js['msg_id']);
			}else {
				if ($showError){
					return array('rt'=>true,'errorno'=>10,'msg'=>'发生了Post错误：错误代码'.$js['errcode'].',微信返回错误信息：'.$js['errmsg']);
				}
			}
		}
	}
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
	
	function index(){
		$thisurl = Import::basic()->thisurl();
		$rt = explode('index.php',$thisurl);
		$arg = isset($rt[1]) ? $rt[1] : '';
		if(!empty($arg)){
			$rt = explode('/',$arg);
			$arg = isset($rt[1]) ? $rt[1] : '';
			if(!empty($arg)){
				$this->token = trim($arg);
			}else{
				$t = isset($_GET['t']) ? $_GET['t'] : '';
				if(empty($t)){
					die('参数为空');
				}else{
					$this->token = $t;
				}
			}
		}else{
			$t = isset($_GET['t']) ? $_GET['t'] : '';
			if(empty($t)){
				die('参数为空');
			}else{
				$this->token = $t;
			}
		}

		$ss = $this->token;
		$sql = "SELECT pigsecret FROM `{$this->App->prefix()}wxuserset` WHERE token='$ss' LIMIT 1";
		$pigsecret = $this->App->findvar($sql);
		if(empty($pigsecret)) $pigsecret = "isempty";
		
		if (!class_exists('SimpleXMLElement')) {
            die('SimpleXMLElement class not exist');
        }
        if (!function_exists('dom_import_simplexml')) {
            die('dom_import_simplexml function not exist');
        }
        if (!preg_match('/^[0-9a-zA-Z]{3,42}$/', $this->token)) {
            die('Error token');
        }
		//包含
		if(!class_exists('Wechat')) require_once(SYS_PATH_API.'inc/Wechat.class.php');
		$weixin = new Wechat($pigsecret);
		$data = $weixin->request();
        $this->data = $data;
		
		if ($this->data) {
            //自定义机器人名字
			$wecha_id = $this->data['FromUserName'];
			$token = $this->token;
			$this->Session->write('User.wecha_id',$wecha_id);
			$this->Session->write('User.token',$token);
			setcookie(CFGH.'USER[UKEY]', $wecha_id, mktime() + 2592000);
			
			$this->fans = $this->App->findrow("SELECT * FROM `{$this->App->prefix()}user` WHERE wecha_id='$wecha_id' ");
            $this->wxuser = 'wxuser_' . $this->token;
            $this->apiServer = 'http://api.apiqq.com';
            $this->fun = ''; //这里是允许访问的权限
			$this->wecha_id = $wecha_id;
			
            list($content, $type) = $this->reply($data);
            $weixin->response($content, $type);
        }
		
	}
	
	function _return_px(){
		   $t = '';
		   $x = $_SERVER["HTTP_HOST"];
		   $x1 = explode('.',$x);
		   if(count($x1)==2){
			 $t = $x1[0];
		   }elseif(count($x1)>2){
			 $t =$x1[0].$x1[1];
		   }
		   return $t;
	}
		
	//获取appid、appsecret
	function _get_appid_appsecret(){
			$t = $this->_return_px();
			$cache = Import::ajincache();
			$cache->SetFunction(__FUNCTION__);
			$cache->SetMode('sitemes'.$t);
			$fn = $cache->fpath(func_get_args());
			if(file_exists($fn)&& (mktime() - filemtime($fn) < 7000) && !$cache->GetClose()){
				    include($fn);
			}
			else
		    {
					$sql = "SELECT appid,appsecret FROM `{$this->App->prefix()}wxuserset` LIMIT 1";
					$rr = $this->App->findrow($sql);
					$rt['appid'] = $rr['appid'];
					$rt['appsecret'] = $rr['appsecret'];
					
					$cache->write($fn, $rt,'rt');
		   }
		   return $rt;
	}
	
	//获取access_token
	function _get_access_token(){
			$t = $this->_return_px();
			$cache = Import::ajincache();
			$cache->SetFunction(__FUNCTION__);
			$cache->SetMode('sitemes'.$t);
			$fn = $cache->fpath(func_get_args());
			if(file_exists($fn)&& (mktime() - filemtime($fn) < 7000) && !$cache->GetClose()){
				    include($fn);
			}
			else
		    {
					$rr = $this->_get_appid_appsecret();
					$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$rr['appid'].'&secret='.$rr['appsecret'];
					$con = $this->curlGet($url);
					$json=json_decode($con);
					$rt = $json->access_token; //获取 access_token
					
					$cache->write($fn, $rt,'rt');
		   }
		   return $rt;
	}
	
	private function reply($data)
    {
        //语音功能
        if (isset($data['MsgType'])) {
            if ('voice' == $data['MsgType']) {
                $data['Content'] = $data['Recognition'];
                $this->data['Content'] = $data['Recognition'];
            }
        }
		
		//单文本回复
		//return array('<a href="http://www.baidu.com">'.$this->token.$data['FromUserName'].'</a>', 'text');
		
		//单图文回复
/*		$data['title'] = "test";
		$data['keyword'] = "keyword";
		$data['picurl'] = 'http://www.wanyangok.com/theme/images/website04_img_left.jpg';
		$data['url'] = "http://www.baidu.com";*/
		//return array(array(array($data['title'], $data['keyword'], $data['picurl'], $data['url'])), 'news');
		
		//多图文(1)
/*		$data['title'] = "test";
		$data['keyword'] = "keyword";
		$data['picurl'] = 'http://www.wanyangok.com/theme/images/website04_img_left.jpg';
		$data['url'] = "http://www.baidu.com";*/
		//return array(array(array($data['title'], $data['keyword'], $data['picurl'], $data['url']),array($data['title'], $data['keyword'], $data['picurl'], $data['url'])), 'news');
		 
		 //多图文（2）
/*		$result = array();
		$result[0][] = $data['title'];
		$result[0][] = $data['keyword'];
		$result[0][] = $data['picurl'];
		$result[0][] = $data['url'];
		$result[1][] = $data['title'];
		$result[1][] = $data['keyword'];
		$result[1][] = $data['picurl'];
		$result[1][] = $data['url'];
		$result[2][] = $data['title'];
		$result[2][] = $data['keyword'];
		$result[2][] = $data['picurl'];
		$result[2][] = $data['url'];*/
		//return array($result, 'news');
		
		//多图文（3）
/*		$row = array();
		$row[] = $data['title'];
		$row[] = $data['keyword'];
		$row[] = $data['picurl'];
		$row[] = $data['url'];
		$result[] = $row;
		$result[] = array($data['title'], $data['keyword'], $data['picurl'], $data['url']);
		$result[] = array($data['title'], $data['keyword'], $data['picurl'], $data['url']);*/
		//return array($result, 'news');
		
		
        //判断关注
        if (isset($data['Event'])) {
            if ('CLICK' == $data['Event']) {
                $data['Content'] = $data['EventKey'];
                $this->data['Content'] = $data['EventKey'];
            }
            if ($data['Event'] == 'SCAN') { //语音
                $data['Content'] = $this->getRecognition($data['EventKey']);
                $this->data['Content'] = $data['Content'];
				
            } elseif ($data['Event'] == 'MASSSENDJOBFINISH') {
               
				
            } elseif ('subscribe' == $data['Event']) { //关注后
				/***********************************************/
				$wecha_id = $data['FromUserName']; //用户openid
				//1、更改关注标识 表user_tuijian，user
				//2、更改用户资料
				//3、关注时间、关注排名等
				
				$rr = $this->_get_appid_appsecret();
				$appid = $rr['appid'];
				$appsecret = $rr['appsecret'];
				
				$access_token = $this->_get_access_token();
				
				//获取用户信息
				$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$wecha_id;
				$json=json_decode($this->curlGet($url));
				$subscribe = $json->subscribe;
				$nickname = isset($json->nickname)?$json->nickname : '';
				$sex = isset($json->sex)?$json->sex : '';
				$city = isset($json->city)?$json->city : '';
				$province = isset($json->province)?$json->province : '';
				$headimgurl = isset($json->headimgurl)?$json->headimgurl : '';
				$subscribe_time = isset($json->subscribe_time)?$json->subscribe_time : '';
				$this->Session->write('User.subscribe','1');
				setcookie(CFGH.'USER[SUBSCRIBE]', '1', mktime() + 2592000);
				
				$dd = array();
				$dd['is_subscribe'] = '1';
				$dd['subscribe_time'] = mktime();
				if(!empty($nickname)) $dd['nickname'] = $nickname;
				if(!empty($sex)) $dd['sex'] = $sex;
				if(!empty($city)) $dd['cityname'] = $city;
				if(!empty($province)) $dd['provincename'] = $province;
				if(!empty($headimgurl)) $dd['headimgurl'] = $headimgurl;
				if(!empty($subscribe_time)) $dd['subscribe_time'] = $subscribe_time;
				
				//检查是否存在该用户
				$ukey = $this->Session->read('User.ukey');
				if(empty($ukey)) $ukey = isset($_COOKIE[CFGH.'USER']['UKEY']) ? $_COOKIE[CFGH.'USER']['UKEY'] : '';
				if(!empty($ukey) && $ukey!=$wecha_id){
					$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE wecha_id='$wecha_id' LIMIT 1";
					$uid = $this->App->findvar($sql);
				}else{
					$uid = $this->Session->read('User.uid');
					if(!($uid>0)){
						$uid = isset($_COOKIE[CFGH.'USER']['UID']) ? $_COOKIE[CFGH.'USER']['UID'] : '0';
						if(!($uid>0)){
								$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE wecha_id='$wecha_id' LIMIT 1";
								$uid = $this->App->findvar($sql);
								$this->Session->write('User.uid',$uid);
								setcookie(CFGH.'USER[UID]', $uid, mktime() + 2592000);
						}
					}
				}
				if($uid > 0){
					$this->App->update('user',$dd,'user_id',$uid);
					$counts = $this->App->findvar("SELECT COUNT(user_id) FROM `{$this->App->prefix()}user` WHERE is_subscribe='1'");
					$this->App->update('user',array('subscribe_rank'=>$counts),'user_id',$uid); //更改排名
				}else{
					//添加用户
					$dd['user_name'] = $wecha_id;
					$dd['wecha_id'] = $wecha_id;
					$t = mktime();
					$dd['password'] = md5('A123456');
					$dd['user_rank'] = 1;
					$ip = Import::basic()->getip();
					$dd['reg_ip'] = $ip ? $ip : '0.0.0.0';
					$dd['reg_time'] = $t;
					$dd['reg_from'] = Import::ip()->ipCity($ip);
					$dd['last_login'] = mktime();
					$dd['last_ip'] = $dd['reg_ip'];
					$dd['active'] = 1;
					if($this->App->insert('user',$dd)){
							$uid = $this->App->iid();
							$counts = $this->App->findvar("SELECT COUNT(user_id) FROM `{$this->App->prefix()}user` WHERE is_subscribe='1'");
							$$counts = $counts+1;
							$this->App->update('user',array('subscribe_rank'=>$counts),'user_id',$uid); //更改排名
							
							$this->Session->write('User.username',$dd['user_name']);
							$this->Session->write('User.uid',$uid);
							$this->Session->write('User.active','1');
							$this->Session->write('User.rank','1');
							$this->Session->write('User.ukey',$dd['wecha_id']);
							//$this->Session->write('User.pass',$dd['password']);
							$this->Session->write('User.addtime',mktime());
							//写入cookie
							setcookie(CFGH.'USER[UKEY]',$dd['wecha_id'],mktime()+2592000);
							setcookie(CFGH.'USER[UID]',$uid,mktime()+2592000);
							
							$tid = $this->Session->read('User.tid');	
							if(!($tid>0)) $tid = isset($_COOKIE[CFGH.'USER']['TID']) ? $_COOKIE[CFGH.'USER']['TID'] : "0"; //分享的来源ID
							$to_wecha_id = $this->Session->read('User.to_wecha_id'); //来源ID
							if(!($to_wecha_id>0)) $to_wecha_id = isset($_COOKIE[CFGH.'USER']['TOOPENID']) ? $_COOKIE[CFGH.'USER']['TOOPENID'] : "0";

							if($tid!=$uid){//加入分享表
								$dd = array();
								//$url = $this->Session->read('User.url');
								$dd['share_uid'] = $tid; //分享者uid
								$dd['parent_uid'] = $to_wecha_id > 0 ? $to_wecha_id : $tid; //关注者分享ID
								$dd['uid'] = $uid;
								$puid = $dd['parent_uid'];
								$duid = 0;
								//正常来说一下代理不会执行到
								if($puid > 0){
									//检查是否是代理
									$rank = $this->App->findvar("SELECT user_rank FROM `{$this->App->prefix()}user` WHERE user_id = '$puid' LIMIT 1");
									if($rank!='1'){
										$duid = $puid;
									}else{
										//检查推荐的代理ID
										$duid = $this->App->findvar("SELECT daili_uid FROM `{$this->App->prefix()}user_tuijian` WHERE uid = '$puid' LIMIT 1");
									}
								}
								//$dd['url'] = $url;
								$dd['addtime'] = mktime();
								if($this->App->insert('user_tuijian',$dd)){ //添加推荐用户
									   if($dd['share_uid'] > 0){
											$id = $dd['share_uid'];
											$sql = "UPDATE `{$this->App->prefix()}user` SET `share_ucount` = `share_ucount`+1 WHERE user_id = '$id'";
											$this->App->query($sql);
									   }
								}
								unset($dd);
							} //end if
							
							
					} //end insert

				} //end if uid>0
				
				//添加地址
				if(!empty($city) && !empty($province)){
					$sql = "SELECT region_id FROM `{$this->App->prefix()}region` WHERE region_name LIKE '%$city%' LIMIT 1";
					$cityid = $this->App->findvar($sql);
					$sql = "SELECT region_id FROM `{$this->App->prefix()}region` WHERE region_name LIKE '%$province%' LIMIT 1";
					$provinceid = $this->App->findvar($sql);
					if($cityid > 0 && $provinceid>0){
						$dd = array();
						$dd['consignee'] = $nickname;
						$dd['user_id'] = $uid;
						$dd['sex'] = $sex;
						$dd['city'] = $cityid;
						$dd['province'] = $provinceid;
						$dd['country'] = 1;
						$dd['is_own'] = 1;
						$this->App->insert('user_address',$dd);
						unset($dd);
					}
				}
			
				//增加关注积分
				$sql = "SELECT tuijiannum FROM `{$this->App->prefix()}userconfig` LIMIT 1";//配置信息
				$tuijiannum = $this->App->findvar($sql);
				if($tuijiannum > 0){
					//查找推荐用户人
					$uid = $this->Session->read('User.uid');
					if(!($uid > 0)){
						$uid = isset($_COOKIE[CFGH.'USER']['UID']) ? $_COOKIE[CFGH.'USER']['UID'] : "0";
						if(!($uid > 0)){
							$uid = $this->App->findvar("SELECT user_id FROM `{$this->App->prefix()}user` WHERE wecha_id='$wecha_id' LIMIT 1");
						}
					}
					if($uid > 0){
						$purt = $this->App->findrow("SELECT ut.parent_uid,u.wecha_id FROM `{$this->App->prefix()}user_tuijian` AS ut LEFT JOIN `{$this->App->prefix()}user` AS u ON u.user_id = ut.parent_uid WHERE ut.uid='$uid' LIMIT 1");
						$puid = isset($purt['parent_uid']) ? $purt['parent_uid'] : '0';
						$pwecha_id = isset($purt['wecha_id']) ? $purt['wecha_id'] : '';
						if($puid > 0){ //派送积分  推荐的用户
							$dd = array();
							$dd['time'] = mktime();
							$dd['points'] = $tuijiannum;
							$dd['uid'] = $puid;
							$dd['subuid'] = $uid;
							$dd['changedesc'] = '推荐关注送积分';
							$dd['thismonth'] = date('Y-m-d',mktime());
							$this->App->insert('user_point_change',$dd);
							
							//积分总计、关注数叠加 方便排序及查找
							$tuijiannum = intval($tuijiannum);
							if(!($tuijiannum>0)) $tuijiannum = 1;
							$sql = "UPDATE `{$this->App->prefix()}user` SET `mypoints` = `mypoints`+$tuijiannum,`points_ucount` = `points_ucount`+$tuijiannum,`guanzhu_ucount` = `guanzhu_ucount`+1 WHERE user_id = '$puid' AND is_subscribe='1'";
							$this->App->query($sql);
							
								
							$this->send(array('openid'=>$pwecha_id,'appid'=>$appid,'appsecret'=>$appsecret,'nickname'=>$nickname),'guanzhu');
							
							$duid = 0;
							if($uid !=$duid && $puid != $duid){
								//检查是否是代理
								$rank = $this->App->findvar("SELECT user_rank FROM `{$this->App->prefix()}user` WHERE user_id = '$puid' LIMIT 1");
								if($rank!='1'){
									$duid = $puid;
								}else{
									//检查推荐的代理ID
									$duid = $this->App->findvar("SELECT daili_uid FROM `{$this->App->prefix()}user_tuijian` WHERE uid = '$puid' LIMIT 1");
								}
								if($duid > 0 && $duid!=$uid){
									$pwecha_id = $this->App->findvar("SELECT wecha_id FROM `{$this->App->prefix()}user` WHERE user_id='$duid' LIMIT 1");
									$this->send(array('openid'=>$pwecha_id,'appid'=>$appid,'appsecret'=>$appsecret,'nickname'=>$nickname),'guanzhudaili');
								}
							}
							//信息推送
						}
					}
				}
				/**********************************************/
				
				$token = $this->token;
/*				$keyword = $this->App->findvar("SELECT keyword FROM `{$this->App->prefix()}wxkeyword` WHERE type='guanzhu' LIMIT 1");
				if(!empty($keyword)){
					//查找图文
					$sql = "SELECT * FROM `{$this->App->prefix()}wx_article` WHERE keyword='$keyword' LIMIT 1";
					$rts = $this->App->findrow($sql);
					if(empty($rts)){
						return array('商家暂未有设置关注回复，请联系商家设置', 'text');
					}else{
						$type = $rts['type'];
						if($type=="txt"){ //文本信息
							return array($rts['content'], 'text');
						}else{
							  
							//回复图文信息
							$url = $rts['art_url'];
							$id = $rts['article_id'];
							if(empty($url)) $url = SITE_URL.'m/art.php?id='.$id;
							$img = SITE_URL.$rts['article_img'];
							$about = $rts['about'];
							$title = $rts['article_title'];
							
							$data['title'] = $title;
							$data['keyword'] = $about;
							$data['picurl'] = $img;
							$data['url'] = $url;
							return array(array(array($data['title'], $data['keyword'], $data['picurl'], $data['url'])), 'news');
						}
					}
				}else{
					return array('商家暂未有设置关注回复，请联系商家设置', 'text');
				}
				
                if ($follow_data['home'] == 1) {
                    return $this->keyword($follow_data['keyword']);
                } else {
                    return array(html_entity_decode($follow_data['content']), 'text');
                }*/
               
			    //这是回复推荐人的信息
				if($uid > 0){
					$gzcount = $this->App->findvar("SELECT COUNT(user_id) FROM `{$this->App->prefix()}user` LIMIT 1");
					$gzcount = $gzcount*5+750;
					if($puid > 0){
						$nickname = $this->App->findvar("SELECT nickname FROM `{$this->App->prefix()}user` WHERE user_id = '$puid' LIMIT 1");
						if(empty($nickname)) $nickname = '官网';
						$str = '来自好友【'.$nickname.'】的推荐成为第【'.$gzcount.'】位会员，立即关注，抢夺东家地盘！';
					}else{
						$str = '来自【官网】的推荐成为第【'.$gzcount.'】位会员，立即关注，抢夺东家地盘！';
					}
					return array($str, 'text');
				}
				
            } elseif ('unsubscribe' == $data['Event']) { //取消关注
                //$this->requestdata('unfollownum');
				//释放cookie 释放session 更改关注标记
				$wecha_id = $this->wecha_id; //用户openid
				$this->App->update('user',array('is_subscribe'=>'0'),'wecha_id',$wecha_id); //更改排名
				$this->Session->write('User.subscribe',null);
				unset($_SESSION['User']['subscribe']);
				if(isset($_COOKIE[CFGH.'USER']['SUBSCRIBE'])) setcookie(CFGH.'USER[SUBSCRIBE]',"",mktime()-2592000); 
				unset($_COOKIE[CFGH.'USER']['SUBSCRIBE']);
				
				//改变取消关注的数据
				$sql = "SELECT tuijiannum FROM `{$this->App->prefix()}userconfig` LIMIT 1";//配置信息
				$tuijiannum = $this->App->findvar($sql);
				if($tuijiannum > 0){
					//查找推荐用户人
					$uid = $this->Session->read('User.uid');
					if(!($uid > 0)){
						$uid = $this->App->findvar("SELECT user_id FROM `{$this->App->prefix()}user` WHERE wecha_id='$wecha_id' LIMIT 1");
					}
					if($uid > 0){
						//父类UID
						$purt = $this->App->findrow("SELECT ut.parent_uid,u.wecha_id FROM `{$this->App->prefix()}user_tuijian` AS ut LEFT JOIN `{$this->App->prefix()}user` AS u ON u.user_id = ut.parent_uid WHERE ut.uid='$uid' LIMIT 1");
						$puid = isset($purt['parent_uid']) ? $purt['parent_uid'] : '0';
						$pwecha_id = isset($purt['wecha_id']) ? $purt['wecha_id'] : '';
						if($puid > 0){ //派送积分
							$dd = array();
							$dd['time'] = mktime();
							$dd['points'] = -$tuijiannum;
							$dd['uid'] = $puid;
							$dd['subuid'] = $uid;
							$dd['changedesc'] = '用户取消关注减积分';
							$dd['thismonth'] = date('Y-m-d',mktime());
							$this->App->insert('user_point_change',$dd);
							
							//积分总计、关注数叠加 方便排序及查找
							$tuijiannum = intval(-$tuijiannum);
							$sql = "UPDATE `{$this->App->prefix()}user` SET `mypoints` = `mypoints`+$tuijiannum,`points_ucount` = `points_ucount`+$tuijiannum,`guanzhu_ucount` = `guanzhu_ucount`-1 WHERE user_id = '$puid'";
							$this->App->query($sql);
							
							
							//$this->send(array('openid'=>$pwecha_id),'guanzhu');
							//信息推送

						}
					}
				}
							
				
            } elseif ($data['Event'] == 'LOCATION') { //自动获取位置回复
                //return array('LOCATION', 'text');
            }
        }
		
		return $this->keyword($data['Content']);
	} 
	
	function requestdata($field)
    {
        $data['year'] = date('Y');
        $data['month'] = date('m');
        $data['day'] = date('d');
        $data['token'] = $this->token;
       /* $mysql = M('Requestdata');
        $check = $mysql->field('id')->where($data)->find();
        if ($check == false) {
            $data['time'] = time();
            $data[$field] = 1;
            $mysql->add($data);
        } else {
            $mysql->where($data)->setInc($field);
        }*/
    }
	
	function keyword($keyword=''){
		//return array($keyword, 'text');
	}
	
	private function getRecognition($id)
    {
        return false;
    }
	
	
}
?>