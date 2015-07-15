<?php
class CommonController extends Controller{

 	function  __construct() {
		
	}
	
	function index(){
		$this->show404tpl();
	}
	
	function show404tpl(){
		header("HTTP/1.0 404 Not Found");
		$this->layout('kong');
		$this->title('页面无法找到');
		$this->template('404');
		exit;
	}
	
	function mark_phpqrcode($filename=""){
		$uid = $this->Session->read('User.uid');
		if(empty($filename)) $filename = $uid.'.png';
		
		include(SYS_PATH.'inc/phpqrcode.php');
		
		// 二维码数据
		$thisurl = Import::basic()->thisurl();
		$thisurl = @str_replace('user.php?act=myerweima&','?',$thisurl);
		if(empty($thisurl)) $thisurl = ADMIN_URL."?tid=".$uid;
		
		// 生成的文件名
		$filename = SYS_PATH_PHOTOS.'qcody'.DS.$uid.DS.$filename;
		Import::fileop()->checkDir($filename);
		
		// 纠错级别：L、M、Q、H
		$errorCorrectionLevel = 'L';
		// 点的大小：1到10
		$matrixPointSize = 6;
		QRcode::png($thisurl, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
	}
	
	function get_share_user_info(){
		$issubscribe = $this->Session->read('User.subscribe'); //是否关注
		if(empty($issubscribe)) $issubscribe = isset($_COOKIE[CFGH.'USER']['SUBSCRIBE']) ? $_COOKIE[CFGH.'USER']['SUBSCRIBE'] : '0';
		
		$openid = $this->Session->read('User.wecha_id');
		if(empty($openid)) $openid = isset($_COOKIE[CFGH.'USER']['UKEY']) ? $_COOKIE[CFGH.'USER']['UKEY'] : '';
		
		$issubscribe = $this->App->findvar("SELECT is_subscribe FROM `{$this->App->prefix()}user` WHERE wecha_id='$openid' LIMIT 1");
		if($issubscribe!='1' && !empty($openid)){ //获取分享者信息
			$sql = "SELECT tb1.nickname,tb1.headimgurl FROM `{$this->App->prefix()}user` AS tb1 LEFT JOIN `{$this->App->prefix()}user_tuijian` AS tb2 ON tb1.user_id = tb2.parent_uid LEFT JOIN `{$this->App->prefix()}user` AS tb3 ON tb3.user_id = tb2.uid WHERE tb3.wecha_id='$openid' LIMIT 1";
			$rt = $this->App->findrow($sql);
			if(empty($rt)){
			 	$rt['nickname'] = '[自荐]';
				$rt['headimgurl'] = ADMIN_URL.'images/uclicon.jpg';
			}
			$rt['is_subscribe'] = '0';
			
			return $rt;
		}else{
			if($issubscribe=='1'){
				//清空来路
				$to_wecha_id = $this->Session->read('User.to_wecha_id');
				if(!empty($to_wecha_id)){
					$this->Session->write('User.to_wecha_id',null);
				}
				$to_wecha_id = isset($_COOKIE[CFGH.'USER']['TOOPENID']) ? $_COOKIE[CFGH.'USER']['TOOPENID'] : "0";
				if(!empty($to_wecha_id)){
					setcookie(CFGH.'USER[TOOPENID]', '', mktime() - 2592000);
				}
				
				//写入关注
				$issubscribe = $this->Session->read('User.subscribe'); //是否关注
				if($issubscribe!='1'){
					$this->Session->write('User.subscribe',$issubscribe);
				}
				$issubscribe = isset($_COOKIE[CFGH.'USER']['SUBSCRIBE']) ? $_COOKIE[CFGH.'USER']['SUBSCRIBE'] : '0';
				if($issubscribe!='1'){
					setcookie(CFGH.'USER[SUBSCRIBE]', $issubscribe, mktime() + 2592000);
				}
			}
			return array();
		}
	}
	
	function get_user_info(){
		$uid = $this->Session->read('User.uid');
		$sql = "SELECT * FROM `{$this->App->prefix()}user` WHERE user_id = '$uid' LIMIT 1";
		$rt = $this->App->findrow($sql);
		$rank = '1';
		if(!empty($rt)){
			$rank = $rt['user_rank'];
		}
		
		if($rank=='1'){
			$rt = array();
		}
		return $rt;
	}
	
	//获取当前代理信息
	function get_daili_info(){
		$cache = Import::ajincache();
		$cache->SetFunction(__FUNCTION__);
		$cache->SetMode('daili');
		$fn = $cache->fpath(func_get_args());
		if(file_exists($fn)&&!$cache->GetClose()){
			include($fn);
		}
		else
		{
			//求出当前用户的推荐用户的代理信息
			$uid = $this->Session->read('User.uid');
			$sql = "SELECT tb1.share_uid,tb2.user_rank FROM `{$this->App->prefix()}user_tuijian` AS tb1 LEFT JOIN `{$this->App->prefix()}user` AS tb2 ON tb2.user_id = tb1.daili_uid WHERE tb1.uid = '$uid' AND tb2.user_rank!='1' LIMIT 1";
			//$sql = "SELECT tb1.user_rank,tb2.share_uid FROM `{$this->App->prefix()}user` AS tb1 LEFT JOIN `{$this->App->prefix()}user_tuijian` AS tb2 ON tb2.daili_uid = tb1.user_id WHERE tb1.user_rank!='1 AND tb2.uid = '$uid'  LIMIT 1";
			$rts = $this->App->findrow($sql);
			$rank = '1';
			if(!empty($rts)){
				$rank = $rts['user_rank'];
				$pid = $rts['share_uid']; //分享的ID
			}
			if($rank!='1'){
                   $uid = $pid;
			}
			//查抄代理信息
			$sql = "SELECT * FROM `{$this->App->prefix()}udaili_siteset` WHERE uid='$uid' LIMIT 1";
			$rt = $this->App->findrow($sql);
			if($rank!='1'){
                   $rt['rank'] = $rank;
			}
			$cache->write($fn, $rt,'rt');
		}
		return $rt;
	}
	
	//获取授权code
	function get_user_code(){
		$this->Session->write('User.codetime',mktime());
		setcookie(CFGH.'USER[CODETIME]', mktime(), mktime() + 2592000);
		$appid = $this->Session->read('User.appid');
		if(empty($appid)) $appid = isset($_COOKIE[CFGH.'USER']['APPID']) ? $_COOKIE[CFGH.'USER']['APPID'] : "0";
		if(empty($appid)){
			$sql = "SELECT appid,appsecret FROM `{$this->App->prefix()}wxuserset` WHERE id='1'";
			$rt = $this->App->findrow($sql);
			$appid = $rt['appid'];
			
			$this->Session->write('User.appid',$appid);
			setcookie(CFGH.'USER[APPID]', $appid, mktime() + 3600*24);
			$this->Session->write('User.appsecret',$rt['appsecret']);
			setcookie(CFGH.'USER[APPSECRET]', $rt['appsecret'], mktime() + 3600*24);
		}
		
		$thisurl = Import::basic()->thisurl();
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($thisurl).'&response_type=code&scope=snsapi_base &state=STATE#wechat_redirect';
		$this->jump($url);exit; //返回带code的URL
	}
	
	//检测跳转
	function checkjump(){
		$uid = $this->Session->read('User.uid'); //普通用户
		$wecha_id = $this->Session->read('User.wecha_id'); //用户openid
		$issubscribe = $this->Session->read('User.subscribe'); //是否关注
		$to_wecha_id = $this->Session->read('User.to_wecha_id'); //来源ID
		if(!($to_wecha_id>0)) $to_wecha_id = isset($_COOKIE[CFGH.'USER']['TOOPENID']) ? $_COOKIE[CFGH.'USER']['TOOPENID'] : "0";

		if(empty($issubscribe)) $issubscribe = isset($_COOKIE[CFGH.'USER']['SUBSCRIBE']) ? $_COOKIE[CFGH.'USER']['SUBSCRIBE'] : '0';
		$thisurl = Import::basic()->thisurl();
		if(isset($_GET['code'])&&!empty($_GET['code'])) $thisurl = str_replace('code='.$_GET['code'].'&','',$thisurl);
		if($issubscribe!='1' && $to_wecha_id > 0){
			if(strpos($thisurl,'?')){
				 $thisurl = $thisurl.'&toid='.$to_wecha_id;
			}else{
			 	 $thisurl = $thisurl.'?toid='.$to_wecha_id;
			}
			//为了超过有效期，重新写入
			$this->Session->write('User.to_wecha_id',$to_wecha_id); //来源ID
			setcookie(CFGH.'USER[TOOPENID]', $to_wecha_id, mktime() + 2592000);
		} 
		
		//如果关注了 清空原来推荐用户
		if($issubscribe=='1' && !empty($to_wecha_id)){
			$this->Session->write('User.to_wecha_id',null);
			setcookie(CFGH.'USER[TOOPENID]', '', mktime() - 2592000);
			$toid = isset($_GET['toid']) ? intval($_GET['toid']) : '0';
			if($toid > 0){
				$thisurl = str_replace(array('?toid='.$toid,'&toid='.$toid),'',$thisurl);
				$this->jump($thisurl);exit;
			}
		}
		
		$tid = isset($_GET['tid']) ? intval($_GET['tid']) : '0';
		if($tid=='0'){
			if(isset($_GET['tid'])){
				$thisurl = str_replace(array('?tid=0','&tid=0','tid=0'),'',$thisurl);
			}
			if($uid>0){
				$thisurl = strpos($thisurl,'?') ? $thisurl.'&tid='.$uid : $thisurl.'?tid='.$uid;
				$this->jump($thisurl);exit;
			}else{
				if($issubscribe!='1' && $to_wecha_id > 0){
					$this->jump(ADMIN_URL.'?toid='.$to_wecha_id);exit;
				}else{
					$this->jump(ADMIN_URL);exit;
				}
			}
		}else{
			if($tid != $uid && $uid > 0){
					//$thisurl = Import::basic()->thisurl();
					$thisurl = str_replace(array('?tid='.$tid,'&tid='.$tid),array('?tid='.$uid,'&tid='.$uid),$thisurl);
					$this->jump($thisurl);exit;
			}
		}
	}
	
	
	//自动登陆
	function user_auto_login(){
		//一下用于测试
/*		if($GLOBALS['LANG']['is_cache']=='1'&&!isset($_GET['code'])){
			$this->Session->write('User',null);
			//$this->Session->write('Agent',null);
			setcookie(CFGH.'USER[TOOPENID]', "", mktime()-3600);
			setcookie(CFGH.'USER[UKEY]', "", mktime()-3600);
			setcookie(CFGH.'USER[PASS]', "", mktime()-3600);
			setcookie(CFGH.'USER[TID]', "", mktime()-3600);
			setcookie(CFGH.'USER[CODETIME]', "", mktime()-3600);
			setcookie(CFGH.'USER[ISOAUTH]', "", mktime()-3600);
			setcookie(CFGH.'USER[APPID]', "", mktime()-3600);
			setcookie(CFGH.'USER[APPSECRET]', "", mktime()-3600);
			die('这是测试阶段，缓存已经清空完成....');
		}*/
		//授权判断
		
		$wecha_id = $this->Session->read('User.wecha_id');
		if(empty($wecha_id)) $wecha_id = isset($_COOKIE[CFGH.'USER']['UKEY']) ? $_COOKIE[CFGH.'USER']['UKEY'] : '';
		
		$rt['winxintype'] = 3;
		$appid = $this->Session->read('User.appid');
		if(empty($appid)) $appid = isset($_COOKIE[CFGH.'USER']['APPID']) ? $_COOKIE[CFGH.'USER']['APPID'] : '';
		$appsecret = $this->Session->read('User.appsecret');
		if(empty($appsecret)) $appsecret = isset($_COOKIE[CFGH.'USER']['APPSECRET']) ? $_COOKIE[CFGH.'USER']['APPSECRET'] : '';
		
		$codetime = $this->Session->read('User.codetime');
		if(empty($codetime)) $codetime = isset($_COOKIE[CFGH.'USER']['CODETIME']) ? $_COOKIE[CFGH.'USER']['CODETIME'] : 0;

		if(empty($appid) || empty($appsecret)){
			$sql = "SELECT appid,appsecret,is_oauth,winxintype FROM `{$this->App->prefix()}wxuserset` WHERE id='1'";
			$rt = $this->App->findrow($sql);
			$this->Session->write('User.appid',$rt['appid']);
			setcookie(CFGH.'USER[APPID]', $rt['appid'], mktime() + 3600*24);
			$this->Session->write('User.appsecret',$rt['appsecret']);
			setcookie(CFGH.'USER[APPSECRET]', $rt['appsecret'], mktime() + 3600*24);
			$this->Session->write('User.isoauth',$rt['is_oauth']);
			setcookie(CFGH.'USER[ISOAUTH]', $rt['is_oauth'], mktime() + 3600*24);
		}else{
			$isoauth = $this->Session->read('User.isoauth');
			if(empty($isoauth)) $isoauth = isset($_COOKIE[CFGH.'USER']['ISOAUTH']) ? $_COOKIE[CFGH.'USER']['ISOAUTH'] : '0';
			$rt['appid'] = $appid;
			$rt['appsecret'] = $appsecret;
			if(mktime() - intval($codetime) > 120){
				$isoauth = $this->App->findvar("SELECT is_oauth FROM `{$this->App->prefix()}wxuserset` WHERE id='1'");
			}
			$rt['is_oauth'] = $isoauth;
		}
		
		if( (empty($wecha_id) || ((mktime() - intval($codetime)) > 3600)) && $rt['is_oauth']=='1' && $rt['winxintype']=='3' ){
			
			//if(mktime() - $codetime > 300){
			if(!isset($_GET['code'])){
				$this->get_user_code();
			}
			$code = isset($_GET['code']) ? $_GET['code'] : '';
			if(!empty($code)){
				$appid = $rt['appid'];
				$appsecret = $rt['appsecret'];
				
				$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
				//$con = Import::crawler()->curl_get_con($url);
				$con = $this->curlGet($url);
				$json=json_decode($con);
				$access_token = $json->access_token; //获取 access_token
				
				$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
				//$con = Import::crawler()->curl_get_con($url);
				$con = $this->curlGet($url);
				$json=json_decode($con);
				//$access_token = $json->access_token;
				$refresh_token = $json->refresh_token; //获取 refresh_token
				if(!empty($access_token)){
					$url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$refresh_token;
					//$con = Import::crawler()->curl_get_con($url);
					$con = $this->curlGet($url);
					$json=json_decode($con);
					$openid = $json->openid; //获取 openid
					$this->Session->write('User.wecha_id',$openid);
					setcookie('USER[UKEY]', $openid, mktime() + 2592000);
					
					//获取用户信息
					$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid;
					//$con = Import::crawler()->curl_get_con($url);
					$con = $this->curlGet($url);
					$json=json_decode($con);
					$subscribe = $json->subscribe;
					if($subscribe == '1'){
						$this->Session->write('User.nickname',(isset($json->nickname)?$json->nickname : ''));
						$this->Session->write('User.sex',(isset($json->sex)?$json->sex : ''));
						$this->Session->write('User.city',(isset($json->city)?$json->city : ''));
						$this->Session->write('User.province',(isset($json->province)?$json->province : ''));
						$this->Session->write('User.headimgurl',(isset($json->headimgurl)?$json->headimgurl : ''));
						$this->Session->write('User.subscribe_time',(isset($json->subscribe_time)?$json->subscribe_time : ''));
					}
					$this->Session->write('User.subscribe',$subscribe);
					setcookie(CFGH.'USER[SUBSCRIBE]', $subscribe, mktime() + 2592000);
				}
			}
		}
		
		//双重记录UID
		$uid = $this->Session->read('User.uid');
		if(!($uid > 0)){
		 	$uid = isset($_COOKIE[CFGH.'USER']['UID']) ? $_COOKIE[CFGH.'USER']['UID'] : '0';
			if($uid > 0){
				$this->Session->write('User.uid',$uid);
			}
		}
		
		//记录推荐用户信息
		$tid = $this->Session->read('User.tid');
		if(!($tid>0)){
			$tid = isset($_COOKIE[CFGH.'USER']['TID']) ? $_COOKIE[CFGH.'USER']['TID'] : '0';
			if($tid>0){
				setcookie(CFGH.'USER[TID]', $tid, mktime() + 2592000);
				$this->Session->write('User.tid',$tid);
			}else{
				$tid = isset($_GET['tid']) ? intval($_GET['tid']) : '0'; //用户入来的id
				$this->Session->write('User.url',(Import::basic()->thisurl())); //记录当前进入连接
				//检查是否是有效用户ID
				if($tid >0){ //有用户推荐
					$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id='$tid'";
					$uuid = $this->App->findvar($sql);
					if(!($uuid>0)){
						//$this->jump(ADMIN_URL);exit;
						//die("用户信息验证错误，麻烦客户看到这个问题请联系我们的管理员，谢谢！");
						$this->Session->write('User.tid',null);
						setcookie(CFGH.'USER[TID]', "", mktime() - 2592000);
					}else{
						setcookie(CFGH.'USER[TID]', $tid, mktime() + 2592000);
						$this->Session->write('User.tid',$tid);
						
						$toid = isset($_GET['toid']) ? intval($_GET['toid']) : '0';  //这个是关注后转发的用户ID
						if($toid > 0){
							$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id='$toid'";
							$uuid = $this->App->findvar($sql);
							if($uuid > 0){
								$this->Session->write('User.to_wecha_id',$uuid); //来源ID
								setcookie(CFGH.'USER[TOOPENID]', $uuid, mktime() + 2592000);
							}
						}
					}
				}else{
					//第一次进来，下一步开始创建帐号
					$toid = isset($_GET['toid']) ? intval($_GET['toid']) : '0';
					if($toid > 0){
						$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id='$toid'";
						$uuid = $this->App->findvar($sql);
						if($uuid > 0){
							$this->Session->write('User.to_wecha_id',$uuid); //来源ID
							setcookie(CFGH.'USER[TOOPENID]', $uuid, mktime() + 2592000);
						}
					}
				}
			}
		}else{  //第二次进入网站

		}
		
		//检查当前用户
		$uid = $this->Session->read('User.uid');
		$ukey = $this->Session->read('User.ukey');
		if(empty($ukey)){
			//if(isset($_COOKIE['USER']['AUTOLOGIN']) && intval($_COOKIE['USER']['AUTOLOGIN']) ==1){
				$user = isset($_COOKIE[CFGH.'USER']['UKEY']) ? $_COOKIE[CFGH.'USER']['UKEY'] : "";
				//$pass = isset($_COOKIE['USER']['PASS']) ? $_COOKIE['USER']['PASS'] : "";
				if(!empty($user)){
					
					//从新登陆
					$user = trim(stripcslashes(strip_tags(nl2br($user)))); //过滤
					$pass = trim($pass);
					$sql = "SELECT password,user_id,wecha_id,active,user_rank FROM `{$this->App->prefix()}user` WHERE user_name='$user' OR user_id='$uid' LIMIT 1";
					$rt = $this->App->findrow($sql);
					if(empty($rt)){
						//分配一个账号
						$this->_create_user();
					}else{
						$wecha_id = $this->Session->read('User.wecha_id'); //获取微信接口的当前微信用户openid
						if(!empty($wecha_id) && $user != $wecha_id){
							$rt['wecha_id'] = $wecha_id;
							$this->App->update('user',array('wecha_id'=>$wecha_id),'user_id',$rt['user_id']);
						}
						//if($rt['password']==$pass){ //判断正确
							//相当第二次检查登录
							$ip = Import::basic()->getip();
							$datas['last_ip'] = empty($ip) ? '0.0.0.0' : $ip;
							$datas['last_login'] = mktime();
							$datas['visit_count'] = '`visit_count`+1';
							
							$this->App->update('user',$datas,'user_id',$rt['user_id']); //更新
							$this->Session->write('User.username',$user);
							$this->Session->write('User.uid',$rt['user_id']);
							$this->Session->write('User.active',$rt['active']);
							$this->Session->write('User.rank',$rt['user_rank']);
							$this->Session->write('User.ukey',$rt['wecha_id']);
							//$this->Session->write('User.pass',$rt['password']);
							$this->Session->write('User.addtime',mktime());
							
							//写入cookie
							setcookie(CFGH.'USER[UKEY]', $rt['wecha_id'], mktime() + 2592000);
							//setcookie('USER[PASS]', $rt['password'], mktime() + 2592000);
/*						}else{ //判断错误，需要跳转到验证页面（手机验证）
							$this->jump(ADMIN_URL.'safe.php?f=yanzhengphone');exit;
						}*/
					}
				}else{
					//相当第一次进来，分配一个账号
					$this->_create_user();
				}
			/*}else{
				
			}*/
		} else{//end if 第二次以上进来的用户入口
				$addtime = $this->Session->read('User.addtime');
				if( (mktime() - intval($addtime)) > 7200){
					$this->Session->write('User.addtime',mktime());
					
					//超出有效期检测,为了及时后台删除用户更新
					$uid = $this->Session->read('User.uid');
					if($uid > 0){
						$sql = "SELECT user_name FROM `{$this->App->prefix()}user` WHERE user_id = '$uid' LIMIT 1";
						$uname = $this->App->findvar($sql);
						if(empty($uname)){
							$this->_create_user(); //删除后从新创建
						}else{
							$wecha_id = $this->Session->read('User.wecha_id');
							if(!empty($wecha_id) && $ukey != $wecha_id){
								$this->Session->write('User.ukey',$wecha_id);
								$this->App->update('user',array('wecha_id'=>$wecha_id),'user_id',$uid);
							}
						}
					}else{
						$this->_create_user();
					}
				}
		}
		
	}
	//创建账号,并且添加分享记录到数据库
	function _create_user(){
		$uid = $this->Session->read('User.uid');
		
		//处理第一次进来的推荐用户数据
		$tid = $this->Session->read('User.tid');
		if(!($tid>0)){ //SESSION记录为空
			$tid = isset($_COOKIE[CFGH.'USER']['TID']) ? $_COOKIE[CFGH.'USER']['TID'] : '0';
			if($tid>0){ //从新记录TID
				setcookie(CFGH.'USER[TID]', $tid, mktime() + 2592000);
				$this->Session->write('User.tid',$tid);
			}else{
				//获取GET的TID
				$tid = isset($_GET['tid']) ? intval($_GET['tid']) : '0'; //用户入来的id
				$this->Session->write('User.url',(Import::basic()->thisurl())); //记录当前进入连接
				//检查是否是有效用户ID
				if($tid >0){
						$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id='$tid' LIMIT 1";
						$uuid = $this->App->findvar($sql);
						if(!($uuid>0)){
							$this->Session->write('User.tid',null);
							setcookie(CFGH.'USER[TID]', "", mktime() - 2592000);
						}else{
							if($uid > 0 && $uid == $tid){ //认定了是当前用户
								$this->Session->write('User.tid',null);
								setcookie(CFGH.'USER[TID]', "", mktime() - 2592000);
							}else{
								setcookie(CFGH.'USER[TID]', $tid, mktime() + 2592000);
								$this->Session->write('User.tid',$tid);
							}
						}
				}
			}
		}
		
		$toid = $this->Session->read('User.to_wecha_id');
		if(!($toid>0)){ //SESSION记录为空
			$toid = isset($_COOKIE[CFGH.'USER']['TOOPENID']) ? $_COOKIE[CFGH.'USER']['TOOPENID'] : '0';
			if($toid>0){ //从新记录TID
				setcookie(CFGH.'USER[TOOPENID]', $toid, mktime() + 2592000);
				$this->Session->write('User.to_wecha_id',$toid);
			}else{
				//获取GET的TID
				$toid = isset($_GET['toid']) ? intval($_GET['toid']) : '0'; //用户入来的id
				//检查是否是有效用户ID
				if($toid >0){
						$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id='$toid' LIMIT 1";
						$uuid = $this->App->findvar($sql);
						if(!($uuid>0)){
							$this->Session->write('User.to_wecha_id',null);
							setcookie(CFGH.'USER[TOOPENID]', "", mktime() - 2592000);
						}else{
							if($uid > 0 && $uid == $toid){ //认定了是当前用户
								$this->Session->write('User.to_wecha_id',null);
								setcookie(CFGH.'USER[TOOPENID]', "", mktime() - 2592000);
							}else{
								setcookie(CFGH.'USER[TOOPENID]', $toid, mktime() + 2592000);
								$this->Session->write('User.to_wecha_id',$toid);
							}
						}
				}
			}
		}
		
		//添加新用户
		$wecha_id = $this->Session->read('User.wecha_id');
		$ukey = $this->Session->read('User.username');
		$comd = array();
		if(!empty($wecha_id)) $comd[] = "wecha_id = '$wecha_id'";
		if(!empty($ukey)) $comd[] = "wecha_id = '$ukey'";
		//检测数据库是否存在，不存在则创建
		$usid = 0;
		if(!empty($comd)){
			$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE ".implode(' OR ',$comd)." LIMIT 1";
			$usid = $this->App->findvar($sql);
		}
		if(!($usid>0)){ //当前用户ID，判断数据库是否存在
				$tid = $this->Session->read('User.tid');	
				if(!($tid>0)) $tid = isset($_COOKIE[CFGH.'USER']['TID']) ? $_COOKIE[CFGH.'USER']['TID'] : "0"; //分享的来源ID
				//2次检测该用户是否是有效ID
				/*$tid_ = isset($_GET['tid']) ? intval($_GET['tid']) : '0'; //用户入来的id
				if($tid_ > 0 && $tid_ != $tid){
					$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id = '$tid' LIMIT 1";
					$user_id = $this->App->findvar($sql);
					if(!($user_id>0)){ //不存在，则以当前ID为准
						$tid = $tid_;
						setcookie('USER[TID]', $tid, mktime() + 2592000);
						$this->Session->write('User.tid',$tid);
					}
				}*/
				
				//2次检测该推荐用户是否是有效ID		
				$to_wecha_id = $this->Session->read('User.to_wecha_id'); //来源ID
				if(!($to_wecha_id>0)) $to_wecha_id = isset($_COOKIE[CFGH.'USER']['TOOPENID']) ? $_COOKIE[CFGH.'USER']['TOOPENID'] : "0";
				/*$toid_ = isset($_GET['toid']) ? intval($_GET['toid']) : '0'; //用户入来的id
				if($toid_ > 0 && $toid_ != $to_wecha_id){
					$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id = '$to_wecha_id' LIMIT 1";
					$user_id = $this->App->findvar($sql);
					if(!($user_id>0)){ //不存在，则以当前ID为准
						$to_wecha_id = $toid_;
						setcookie('USER[TOOPENID]', $to_wecha_id, mktime() + 2592000);
						$this->Session->write('User.to_wecha_id',$to_wecha_id);
					}
				}*/
				
				$nickname = $this->Session->read('User.nickname');
				$sex = $this->Session->read('User.sex');
				$city = $this->Session->read('User.city');
				$province = $this->Session->read('User.province');
				$headimgurl = $this->Session->read('User.headimgurl');
					
				$datas = array();
				if(!empty($nickname)) $datas['nickname'] = $nickname;
				if(!empty($city)) $datas['cityname'] = $city;
				if(!empty($province)) $datas['provincename'] = $province;
				if(!empty($headimgurl)) $datas['headimgurl'] = $headimgurl;
				if($sex > 0) $datas['sex'] = $sex;
				if(empty($wecha_id)) $wecha_id = isset($_COOKIE[CFGH.'USER']['UKEY']) ? $_COOKIE[CFGH.'USER']['UKEY'] : "";
				if(empty($wecha_id)){ //跳转首页
					$is_oauth = $this->App->findvar("SELECT is_oauth FROM `{$this->App->prefix()}wxuserset` WHERE id='1'");
					if($is_oauth=='1'){ //授权跳转首页
						$this->Session->write('User',null);
						setcookie(CFGH.'USER[TOOPENID]', "", mktime()-3600);
						setcookie(CFGH.'USER[UKEY]', "", mktime()-3600);
						//setcookie('USER[PASS]', "", mktime()-3600);
						setcookie(CFGH.'USER[TID]', "", mktime()-3600);
						setcookie(CFGH.'USER[UID]', "", mktime()-3600);
						$this->jump(ADMIN_URL); exit;
					}
				}
				$datas['user_name'] = !empty($wecha_id) ? $wecha_id : 'GZSH'.$tid.mktime();
				$datas['wecha_id'] = $datas['user_name'];
				$t = mktime();
				$datas['password'] = md5('A123456');
				$datas['user_rank'] = 1;
				$ip = Import::basic()->getip();
				$datas['reg_ip'] = $ip ? $ip : '0.0.0.0';
				$datas['reg_time'] = $t;
				$datas['reg_from'] = Import::ip()->ipCity($ip);
				$datas['last_login'] = mktime();
				$datas['last_ip'] = $datas['reg_ip'];
				$datas['active'] = 1;
				$issubscribe = $this->Session->read('User.subscribe');
				if(empty($issubscribe)) $isSUBSCRIBE = isset($_COOKIE[CFGH.'USER']['SUBSCRIBE']) ? $_COOKIE[CFGH.'USER']['SUBSCRIBE'] : '0';
				if($issubscribe == '1'){ $datas['is_subscribe'] = 1; }
				if($this->App->insert('user',$datas)){ //添加账户
						$uid = $this->App->iid();
						if(/*$tid > 0 &&*/ $tid!=$uid){//加入分享表
							$dd = array();
							$url = $this->Session->read('User.url');
							$dd['share_uid'] = $tid; //分享者uid
							$dd['parent_uid'] = $to_wecha_id > 0 ? $to_wecha_id : $tid; //关注者分享ID
							$dd['uid'] = $uid;
							$puid = $dd['parent_uid'];
							$duid = 0;
							if($puid > 0){
								//检查是否是代理
								$rank = $this->App->findvar("SELECT user_rank FROM `{$this->App->prefix()}user` WHERE user_id = '$puid' LIMIT 1");
								if($rank=='10'){
									$duid = $puid;
								}else{
									//检查推荐的代理ID
									$duid = $this->App->findvar("SELECT daili_uid FROM `{$this->App->prefix()}user_tuijian` WHERE uid = '$puid' LIMIT 1");
								}
							}
							$dd['daili_uid'] = $duid;
							$dd['url'] = $url;
							$dd['addtime'] = mktime();
							if($this->App->insert('user_tuijian',$dd)){ //添加推荐用户
								//统计分享 跟 关注数
								if($issubscribe=='1'){ //当前用户关注了的
										if($dd['parent_uid']==$dd['share_uid'] && $dd['share_uid'] > 0){
												$sql = "UPDATE `{$this->App->prefix()}user` SET `share_ucount` = `share_ucount`+1,`guanzhu_ucount` = `guanzhu_ucount`+1 WHERE user_id = '$tid'";
												$this->App->query($sql);
										}else{
											if($dd['parent_uid'] > 0){
												$id = $dd['parent_uid'];
												$sql = "UPDATE `{$this->App->prefix()}user` SET `guanzhu_ucount` = `guanzhu_ucount`+1 WHERE user_id = '$id' AND is_subscribe='1'";
												$this->App->query($sql);
											}
											
											if($dd['share_uid'] > 0){
												$id = $dd['share_uid'];
												$sql = "UPDATE `{$this->App->prefix()}user` SET `share_ucount` = `share_ucount`+1 WHERE user_id = '$id'";
												$this->App->query($sql);
											}
										}
										
								}else{
									//统计分享用户数
									if($dd['share_uid'] > 0){
										$id = $dd['share_uid'];
										$sql = "UPDATE `{$this->App->prefix()}user` SET `share_ucount` = `share_ucount`+1 WHERE user_id = '$id'";
										$this->App->query($sql);
									}
								} //end if subscribe
								
								if($tid > 0){
									//发送推荐用户通知
									$pwecha_id = $this->App->findvar("SELECT wecha_id FROM `{$this->App->prefix()}user` WHERE user_id='$tid' LIMIT 1");
									$appid = $this->Session->read('User.appid');
									if(empty($appid)) $appid = isset($_COOKIE[CFGH.'USER']['APPID']) ? $_COOKIE[CFGH.'USER']['APPID'] : '';
									$appsecret = $this->Session->read('User.appsecret');
									if(empty($appsecret)) $appsecret = isset($_COOKIE[CFGH.'USER']['APPSECRET']) ? $_COOKIE[CFGH.'USER']['APPSECRET'] : '';
									$na = !empty($nickname) ? $nickname : '(UID:'.$uid.')';
									
									$this->action('api','send',array('openid'=>$pwecha_id,'appid'=>$appid,'appsecret'=>$appsecret,'nickname'=>$na),'share');
									if($duid > 0 && $duid != $tid){
										$pwecha_id = $this->App->findvar("SELECT wecha_id FROM `{$this->App->prefix()}user` WHERE user_id='$duid' LIMIT 1");
										$this->action('api','send',array('openid'=>$pwecha_id,'appid'=>$appid,'appsecret'=>$appsecret,'nickname'=>$na),'sharedaili');
									}
								}
							}
							unset($dd);
						}
						
						
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
						$this->Session->write('User.username',$datas['user_name']);
						$this->Session->write('User.uid',$uid);
						$this->Session->write('User.active','1');
						$this->Session->write('User.rank','1');
						$this->Session->write('User.ukey',$datas['wecha_id']);
						//$this->Session->write('User.pass',$datas['password']);
						$this->Session->write('User.addtime',mktime());
						//写入cookie
						setcookie(CFGH.'USER[UKEY]', $datas['wecha_id'], mktime() + 2592000);
						setcookie(CFGH.'USER[UID]', $uid, mktime() + 2592000);
						//setcookie('USER[PASS]', $datas['password'], mktime() + 2592000);
		
				}else{
					die('初始化帐号失败，请联系管理员解决这个问题，谢谢！');
				}
			}else{
				$sql = "SELECT * FROM `{$this->App->prefix()}user` WHERE user_id = '$usid' LIMIT 1";
				$rt = $this->App->findrow($sql);
				if(!empty($rt)){
					//2次检测该用户是否是有效ID
					/*$tid = $this->Session->read('User.tid');	
					if(!($tid>0)) $tid = isset($_COOKIE['USER']['TID']) ? $_COOKIE['USER']['TID'] : "0"; //分享的来源ID
					$tid_ = isset($_GET['tid']) ? intval($_GET['tid']) : '0'; //用户入来的id
					if($tid_ > 0 && $tid_ != $tid){
						$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id = '$tid' LIMIT 1";
						$user_id = $this->App->findvar($sql);
						if(!($user_id>0)){ //不存在，则以当前ID为准
							$tid = $tid_;
							setcookie('USER[TID]', $tid, mktime() + 2592000);
							$this->Session->write('User.tid',$tid);
							//检查推荐表
							
						}
					}*/
					
					//2次检测该用户是否是有效ID		
					/*$to_wecha_id = $this->Session->read('User.to_wecha_id'); //来源ID
					if(!($to_wecha_id>0)) $to_wecha_id = isset($_COOKIE['USER']['TOOPENID']) ? $_COOKIE['USER']['TOOPENID'] : "0";
					$toid_ = isset($_GET['toid']) ? intval($_GET['toid']) : '0'; //用户入来的id
					if($toid_ > 0 && $toid_ != $to_wecha_id){
						$sql = "SELECT user_id FROM `{$this->App->prefix()}user` WHERE user_id = '$to_wecha_id' LIMIT 1";
						$user_id = $this->App->findvar($sql);
						if(!($user_id>0)){ //不存在，则以当前ID为准
							$to_wecha_id = $toid_;
							setcookie('USER[TOOPENID]', $to_wecha_id, mktime() + 2592000);
							$this->Session->write('User.to_wecha_id',$to_wecha_id);
						}
					}*/
				
					$this->Session->write('User.username',$rt['user_name']);
					$this->Session->write('User.uid',$rt['user_id']);
					$this->Session->write('User.active',$rt['active']);
					$this->Session->write('User.rank',$rt['user_rank']);
					$this->Session->write('User.ukey',$rt['wecha_id']);
					//$this->Session->write('User.pass',$rt['password']);
					//写入cookie
					setcookie(CFGH.'USER[UKEY]', $rt['wecha_id'], mktime() + 2592000);
					setcookie(CFGH.'USER[UID]', $rt['user_id'], mktime() + 2592000);
					//setcookie('USER[PASS]', $rt['password'], mktime() + 2592000);
				}else{
					$this->Session->write('User',null);
					if(isset($_COOKIE[CFGH.'USER']['UKEY'])) setcookie(CFGH.'USER[UKEY]',"",mktime()-3600);
					if(isset($_COOKIE[CFGH.'USER']['UID'])) setcookie(CFGH.'USER[UID]',"",mktime()-3600); 
					//if(isset($_COOKIE['USER']['PASS'])) setcookie('USER[PASS]',"",mktime()-3600); 
					$this->jump(ADMIN_URL); exit;
				}
				return true;
			}
	}
	
	
	function fasong($rt=array()){
		$iconv = Import::gz_iconv();

		$con = $rt['con'];
		$tpn = $rt['tpn'];
		$uid = $rt['uid'];
		
		if(empty($con)){
			return array('error'=>1,'message'=>'内容为空');
		}
		if(empty($tpn)){
			return array('error'=>1,'message'=>'发送对象号码不合法');
		}
		if( preg_match("/1[3458]{1}\d{9}$/",$tpn) ){}else{
			return array('error' => 1, 'message' => '发送对象号码不合法');
		}
		if(!(preg_match('/^.*$/u', $con) > 0)){
			$con = $iconv->ec_iconv('GB2312', 'UTF8', $con);
		}
							
		require_once(SYS_PATH.'data'.DS.'smsconfig.php');
		$jgid = $sms['jgid'];
		$loginname = $sms['loginname'];
		$passwd = $sms['passwd'];
		$url = 'http://121.12.175.198:8180';
		$urls = "{$url}/service.asmx/SendMessageStr?Id={$jgid}&Name={$loginname}&Psw={$passwd}&Message={$con}&Phone={$tpn}&Timestamp=0";
		$result = file_get_contents($urls);
		if(!(preg_match('/^.*$/u', $result) > 0)){
			$result = $iconv->ec_iconv('GB2312', 'UTF8', $result);
		}
		$state = 1;
		$sa = @explode(',',$result);
		if(!empty($sa))foreach($sa as $k=>$item){
			if($k==0){
				$sa2 = @explode(':',$item);
				$state = $sa2[1];
			}
		}
		$data['addtime'] = mktime();
		$data['state'] = $state;
		$data['uid'] = $uid;
		$data['con'] = $con;
		$data['tpn'] = $tpn;
		
		$this->App->insert('sms_log',$data);
		return true;
	}
	
	/*
	*返回弹出框HTML代码的方法
	*/
	function ajax_popbox($boxname="",$data=array()){
		if($data['type']=='cart'){
			$gid = $data['gid'];
			$sql = "SELECT goods_id,goods_name,goods_thumb,shop_price,promote_price,qianggou_price,pifa_price,promote_start_date,promote_end_date,is_qianggou,is_promote,qianggou_start_date,qianggou_end_date FROM `{$this->App->prefix()}goods` WHERE goods_id='{$gid}'";
			
			$rt = $this->App->findrow($sql);
			if($rt['is_promote']=='1'){
				//促销 价格
				if($rt['promote_start_date']<mktime()&&$rt['promote_end_date']>mktime()){
					$rt['promote_price'] = format_price($rt['promote_price']);
				}else{
					$rt['promote_price'] = "0.00";
				}
			}else{
				$rt['promote_price'] = "0.00";
			}
			
			if($rt['is_qianggou']=='1'){
				//促销 价格
				if($rt['qianggou_start_date']<mktime()&&$rt['qianggou_end_date']>mktime()){
					$rt['qianggou_price'] = format_price($rt['qianggou_price']);
				}else{
					$rt['qianggou_price'] = "0.00";
				}
			}else{
				$rt['qianggou_price'] = "0.00";
			}
		}
		$rt['number'] = $data['num'];
		$this->set('rt',$rt);
		$con = "";
		if(!empty($boxname)) $con = $this->fetch($boxname,true);
		echo $con; exit;
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
}
?>