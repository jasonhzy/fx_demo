<?php
//后台菜单
//这里的菜单排放顺序一定要注意
$menu[1] = array(
	'en_name'=>'1',
	'big_key'=>'s01',
	'small_mod'=>'基本设置',
	'big_mod'=>'管理首页',
	'sub_mod'=>array(
		array('name'=>'信息设置','en_name'=>'101','url'=>'systemconfig.php?type=basic'),
		array('name'=>'站点SEO','en_name'=>'102','url'=>'systemconfig.php?type=seo'),
		array('name'=>'参数设置','en_name'=>'103','url'=>'systemconfig.php?type=arg'),
		array('name'=>'分销设置','en_name'=>'3201','url'=>'weixin.php?type=userconfig'),
		array('name'=>'清空缓存','en_name'=>'104','url'=>'systemconfig.php?type=clear'),
		array('name'=>'手机预览','en_name'=>'3201','url'=>'systemconfig.php?type=viewshop')
	)
);

/*$menu[2] = array(
	'en_name'=>'2',
	'big_key'=>'s01',
	'small_mod'=>'网站公告',
	'big_mod'=>'管理首页',
	'sub_mod'=>array(
		//array('name'=>'分类列表','en_name'=>'201','url'=>'con_notice.php?type=catelist'),
		//array('name'=>'添加分类','en_name'=>'202','url'=>'con_notice.php?type=cateadd'),
		array('name'=>'公告列表','en_name'=>'203','url'=>'con_notice.php?type=newlist'),
		array('name'=>'添加公告','en_name'=>'204','url'=>'con_notice.php?type=newadd')
	)
);*/

$menu[3] = array(
	'en_name'=>'3',
	'big_key'=>'s02',
	'small_mod'=>'数据库设置',
	'big_mod'=>'系统设置',
	'sub_mod'=>array(
		array('name'=>'备份数据库','en_name'=>'301','url'=>'backdb.php?type=backdb'),
		//array('name'=>'备份数据库(测试)','en_name'=>'302','url'=>'backdb.php?type=backdb_test'),
		array('name'=>'还原数据库','en_name'=>'303','url'=>'backdb.php?type=restoredb'),
		array('name'=>'数据表优化','en_name'=>'304','url'=>'backdb.php?type=youhua')
	)
);
/*
$menu[4] = array(
	'en_name'=>'4',
	'small_mod'=>'静态化设置',
	'big_mod'=>'系统设置',
	'sub_mod'=>array(
		array('name'=>'生成首页静态','en_name'=>'401','url'=>'markhtml.php?type=index'),
		array('name'=>'生成分类静态','en_name'=>'402','url'=>'markhtml.php?type=category'),
		array('name'=>'生成内容静态','en_name'=>'403','url'=>'markhtml.php?type=article'),
		array('name'=>'生成所有导航','en_name'=>'404','url'=>'markhtml.php?type=nav'),
		array('name'=>'一键全站生成','en_name'=>'405','url'=>'markhtml.php?type=all')
	)
);*/

$menu[5] = array(
	'en_name'=>'5',
	'big_key'=>'s02',
	'small_mod'=>'管理员设置',
	'big_mod'=>'系统设置',
	'sub_mod'=>array(
		array('name'=>'管理员列表','en_name'=>'501','url'=>'manager.php?type=list'),
		array('name'=>'添加管理员','en_name'=>'502','url'=>'manager.php?type=add'),
		array('name'=>'管理员日记','en_name'=>'503','url'=>'manager.php?type=loglist'),
		array('name'=>'修改密码','en_name'=>'504','url'=>'manager.php?type=edit'),
		array('name'=>'权限组列表','en_name'=>'505','url'=>'manager.php?type=group'),
		array('name'=>'添加权限组','en_name'=>'506','url'=>'manager.php?type=group&tt=add')
	)
);
$menu[6] = array(
	'en_name'=>'6',
	'big_key'=>'s03',
	'small_mod'=>'会员管理',
	'big_mod'=>'用户管理',
	'sub_mod'=>array(
		//array('name'=>'会员设置','en_name'=>'605','url'=>'user.php?type=userset'),
		array('name'=>'会员列表','en_name'=>'601','url'=>'user.php?type=list'),
		array('name'=>'添加会员','en_name'=>'602','url'=>'user.php?type=info'),
		array('name'=>'提款申请','en_name'=>'603','url'=>'user.php?type=drawmoney'),
		array('name'=>'会员关系','en_name'=>'604','url'=>'user.php?type=userrelate'),
		array('name'=>'邀请列表','en_name'=>'605','url'=>'user.php?type=yaoqing'),
		array('name'=>'分享统计','en_name'=>'606','url'=>'user.php?type=sharetongji'),
		array('name'=>'销量统计','en_name'=>'607','url'=>'user.php?type=saletongji'),
		//array('name'=>'收货地址','en_name'=>'601','url'=>'user.php?type=addresslist'),
		//array('name'=>'分享统计','en_name'=>'601','url'=>'user.php?type=usershare'),
		array('name'=>'帐变记录','en_name'=>'608','url'=>'user.php?type=usermoney'),
		array('name'=>'积分记录','en_name'=>'609','url'=>'user.php?type=userjifen'),
/*		array('name'=>'批量改变关系','en_name'=>'609','url'=>'user.php?type=runsql1'),
		array('name'=>'批量改变订单','en_name'=>'609','url'=>'user.php?type=runsql3'),
		array('name'=>'批量改变资金','en_name'=>'609','url'=>'user.php?type=runsql4'),
		array('name'=>'批量改变返佣','en_name'=>'609','url'=>'user.php?type=runsql2'),*/
		array('name'=>'会员等级','en_name'=>'6010','url'=>'user.php?type=levellist')
		//array('name'=>'添加等级','en_name'=>'603','url'=>'user.php?type=levelinfo')

	)
);
$menu[7] = array(
	'en_name'=>'7',
	'big_key'=>'s03',
	'small_mod'=>'高级分销',
	'big_mod'=>'用户管理',
	'sub_mod'=>array(
		//array('name'=>'代理设置','en_name'=>'605','url'=>'user.php?type=dailiset'),
		array('name'=>'分销申请','en_name'=>'601','url'=>'user.php?type=dailiapply'),
		array('name'=>'分销列表','en_name'=>'602','url'=>'user.php?type=suppliers'),
		array('name'=>'添加分销','en_name'=>'603','url'=>'user.php?type=infodaili_step1'),
		//array('name'=>'用户列表','en_name'=>'603','url'=>'user.php?type=dailiuser'),
		array('name'=>'发货申请','en_name'=>'604','url'=>'user.php?type=fahuoapply'),
		array('name'=>'分销业绩','en_name'=>'605','url'=>'user.php?type=dailiorder')
		
	)
);

$menu[8] = array(
	'en_name'=>'8',
	'big_key'=>'s03',
	'small_mod'=>'会员工具',
	'big_mod'=>'用户管理',
	'sub_mod'=>array(
		array('name'=>'消息群发','en_name'=>'801','url'=>'user.php?type=send_message'),
		array('name'=>'消息列表','en_name'=>'802','url'=>'user.php?type=messagelist')

	)
);

$menu[9] = array(
	'en_name'=>'9',
	'big_key'=>'s04',
	'small_mod'=>'附近商家',
	'big_mod'=>'商家管理',
	'sub_mod'=>array(
		//array('name'=>'分类列表','en_name'=>'701','url'=>'con_new.php?type=catelist'),
		//array('name'=>'添加分类','en_name'=>'702','url'=>'con_new.php?type=cateadd'),
		array('name'=>'商家列表','en_name'=>'701','url'=>'con_new.php?type=newlist'),
		array('name'=>'添加商家','en_name'=>'702','url'=>'con_new.php?type=newadd')
	)
);
/*
$menu[] = array(
	'en_name'=>'7',
	'big_key'=>'s04',
	'small_mod'=>'品牌预告',
	'big_mod'=>'产品管理',
	'sub_mod'=>array(
		array('name'=>'分类列表','en_name'=>'701','url'=>'con_case.php?type=catelist'),
		array('name'=>'添加分类','en_name'=>'702','url'=>'con_case.php?type=cateadd'),
		array('name'=>'预告列表','en_name'=>'703','url'=>'con_case.php?type=newlist'),
		array('name'=>'添加内容','en_name'=>'704','url'=>'con_case.php?type=newadd')
		array('name'=>'颜色分类','en_name'=>'705','url'=>'con_case.php?type=colorlist'),
		array('name'=>'添加颜色','en_name'=>'706','url'=>'con_case.php?type=colorinfo')
	)
);

$menu[] = array(
	'en_name'=>'8',
	'big_key'=>'s04',
	'small_mod'=>'网站建设',
	'big_mod'=>'内容管理',
	'sub_mod'=>array(
		array('name'=>'分类列表','en_name'=>'801','url'=>'con_website.php?type=catelist'),
		array('name'=>'添加分类','en_name'=>'802','url'=>'con_website.php?type=cateadd'),
		array('name'=>'内容列表','en_name'=>'803','url'=>'con_website.php?type=newlist'),
		array('name'=>'添加内容','en_name'=>'804','url'=>'con_website.php?type=newadd')
	)
);
*/

$menu[10] = array(
	'en_name'=>'10',
	'big_key'=>'s05',
	'small_mod'=>'商品管理',
	'big_mod'=>'产品管理',
	'sub_mod'=>array(
		array('name'=>'积分商品','en_name'=>'1001','url'=>'exchange.php?type=lists'),
		array('name'=>'商品列表','en_name'=>'1002','url'=>'goods.php?type=goods_list'),
		//array('name'=>'商品转移','en_name'=>'1023','url'=>'goods.php?type=zhuanyi'),
		//array('name'=>'已审核商品','en_name'=>'1023','url'=>'goods.php?type=goods_list_check&sale=yes'),
		//array('name'=>'待审核商品','en_name'=>'1021','url'=>'goods.php?type=goods_list_check&sale=no'),
		array('name'=>'我的回收站','en_name'=>'1003','url'=>'goods.php?type=goods_list_all'),
		array('name'=>'添加商品','en_name'=>'1004','url'=>'goods.php?type=goods_info'),
		array('name'=>'批量传图','en_name'=>'1005','url'=>'goods.php?type=batch_add'),
		array('name'=>'批量上传','en_name'=>'1026','url'=>'goods.php?type=batch_add_text'),
		array('name'=>'分类列表','en_name'=>'1007','url'=>'goods.php?type=cate_list'),
		array('name'=>'添加分类','en_name'=>'1008','url'=>'goods.php?type=cate_info'),
		array('name'=>'品牌列表','en_name'=>'1009','url'=>'brand.php?type=band_list'),
		array('name'=>'添加品牌','en_name'=>'1010','url'=>'brand.php?type=band_info'),
		//array('name'=>'搜索关键字','en_name'=>'1008','url'=>'goods.php?type=keyword'),
		//array('name'=>'品牌类型','en_name'=>'1008','url'=>'goods.php?type=band_type'),
		array('name'=>'商品属性','en_name'=>'1011','url'=>'goods.php?type=goods_attr_list'),
		array('name'=>'团购管理','en_name'=>'1012','url'=>'groupbuy.php?type=list'),
		array('name'=>'派放红包','en_name'=>'1013','url'=>'coupon.php?type=list'),
		array('name'=>'用户评论','en_name'=>'1014','url'=>'goods.php?type=comment_list'),
		//array('name'=>'消费额赠品','en_name'=>'1017','url'=>'goods.php?type=spend_gift'),
		//array('name'=>'设置提取目录','en_name'=>'1018','url'=>'goods.php?type=freecataloginfo'),
		//array('name'=>'提取目录列表','en_name'=>'1019','url'=>'goods.php?type=freecatalog'),
		array('name'=>'专题管理','en_name'=>'1020','url'=>'topic.php?type=list'),
		//array('name'=>'推荐产品','en_name'=>'1021','url'=>'topgoods.php?type=clist'),
		array('name'=>'产品收藏','en_name'=>'1022','url'=>'goods.php?type=goodscoll')
	)
);

/*$menu[11] = array(
	'en_name'=>'11',
	'big_key'=>'s05',
	'small_mod'=>'移动管理',
	'big_mod'=>'产品管理',
	'sub_mod'=>array(
		array('name'=>'选择分享商品','en_name'=>'1101','url'=>'share.php?type=goods_list'),
		array('name'=>'分享页列表','en_name'=>'1102','url'=>'share.php?type=goods_list'),
	)
);*/

$menu[23] = array(
	'en_name'=>'23',
	'big_key'=>'s08',
	'small_mod'=>'订单管理',
	'big_mod'=>'订单管理',
	'sub_mod'=>array(
		array('name'=>'订单列表','en_name'=>'2301','url'=>'goods_order.php?type=list'),
		//array('name'=>'积分订单','en_name'=>'2301','url'=>'goods_order.php?type=jifenorder'),
		array('name'=>'发货单','en_name'=>'2302','url'=>'goods_order.php?type=list&tt=delivery&status=222'),
		array('name'=>'退货单','en_name'=>'2304','url'=>'goods_order.php?type=list&tt=back&status=3'),
		array('name'=>'退款单','en_name'=>'2305','url'=>'goods_order.php?type=list&tt=back&status=2'),
		array('name'=>'退货申请单','en_name'=>'2306','url'=>'goods_order.php?type=list&tt=back&status=2'),
		array('name'=>'换货申请单','en_name'=>'2307','url'=>'goods_order.php?type=list&tt=back&status=2'),
		array('name'=>'退款申请单','en_name'=>'2308','url'=>'goods_order.php?type=list&tt=back&status=2'),
		array('name'=>'生成物流单','en_name'=>'2309','url'=>'goods_order_v2.php?type=shoppingsn')
		//array('name'=>'产品总销量','en_name'=>'2304','url'=>'goods_order.php?type=product_list')  //look添加
	)
);

/*$menu[30] = array(
	'en_name'=>'30',
	'big_key'=>'s08',
	'small_mod'=>'新版订单',
	'big_mod'=>'订单管理',
	'sub_mod'=>array(
		array('name'=>'订单列表','en_name'=>'3001','url'=>'goods_order_v2.php?type=orderlist'),
		array('name'=>'物流单','en_name'=>'3001','url'=>'goods_order_v2.php?type=shoppingsn')
	)
);
*/
$menu[24] = array(
	'en_name'=>'24',
	'big_key'=>'s08',
	'small_mod'=>'其他设置',
	'big_mod'=>'订单管理',
	'sub_mod'=>array(
		array('name'=>'地区设置','en_name'=>'2401','url'=>'area.php?type=list'),
		array('name'=>'支付方式','en_name'=>'2413','url'=>'payment.php?type=list'),
		array('name'=>'配送方式','en_name'=>'2414','url'=>'delivery.php?type=list')
	)
);


/*
$menu[] = array(
	'en_name'=>'12',
	'small_mod'=>'分类优化',
	'big_mod'=>'SEO优化',
	'sub_mod'=>array(
		array('name'=>'新闻资讯','url'=>'seo_youhua.php?type=cate_xwzx'),
		array('name'=>'模板案例','url'=>'seo_youhua.php?type=cate_mbal'),
		array('name'=>'网站建设','url'=>'seo_youhua.php?type=cate_wzjs'),
		array('name'=>'客户列表','url'=>'seo_youhua.php?type=cate_khlb')
	)
);
$menu[] = array(
	'en_name'=>'13',
	'small_mod'=>'内容优化',
	'big_mod'=>'SEO优化',
	'sub_mod'=>array(
		array('name'=>'新闻资讯','url'=>'seo_youhua.php?type=cate_con_xwzx'),
		array('name'=>'模板案例','url'=>'seo_youhua.php?type=cate_con_mbal'),
		array('name'=>'网站建设','url'=>'seo_youhua.php?type=cate_con_wzjs'),
		array('name'=>'客户列表','url'=>'seo_youhua.php?type=cate_con_khlb')
	)
);

$menu[14] = array(
	'en_name'=>'14',
	'big_key'=>'s04',
	'small_mod'=>'用户晒单',
	'big_mod'=>'内容管理',
	'sub_mod'=>array(
		//array('name'=>'文章分类','en_name'=>'1401','url'=>'con_default.php?type=catelist'),
		//array('name'=>'添加分类','en_name'=>'1402','url'=>'con_default.php?type=cateadd'),
		array('name'=>'文章列表','en_name'=>'1403','url'=>'con_default.php?type=newlist'),
		array('name'=>'添加文章','en_name'=>'1404','url'=>'con_default.php?type=newadd')
	)
);

$menu[9] = array(
	'en_name'=>'9',
	'big_key'=>'s04',
	'small_mod'=>'信息管理',
	'big_mod'=>'内容管理',
	'sub_mod'=>array(
		//array('name'=>'客户分类','en_name'=>'901','url'=>'con_clientlist.php?type=catelist'),
		//array('name'=>'添加分类','en_name'=>'902','url'=>'con_clientlist.php?type=cateadd'),
		array('name'=>'文章列表','en_name'=>'903','url'=>'con_clientlist.php?type=newlist'),
		array('name'=>'添加文章','en_name'=>'904','url'=>'con_clientlist.php?type=newadd'),
		array('name'=>'投票调查','en_name'=>'905','url'=>'systemconfig.php?type=votes')
	)
);

$menu[15] = array(
	'en_name'=>'15',
	'big_key'=>'s06',
	'small_mod'=>'友情链接',
	'big_mod'=>'其他扩展',
	'sub_mod'=>array(
		array('name'=>'列表展示','en_name'=>'1501','url'=>'friendlink.php?type=list'),
		array('name'=>'添加链接','en_name'=>'1502','url'=>'friendlink.php?type=add')
	)
);
*/
$menu[16] = array(
	'en_name'=>'16',
	'big_key'=>'s06',
	'small_mod'=>'广告设置',
	'big_mod'=>'其他扩展',
	'sub_mod'=>array(
		array('name'=>'广告列表','en_name'=>'1601','url'=>'ads.php?type=adslist'),
		array('name'=>'广告标签','en_name'=>'1602','url'=>'ads.php?type=adstaglist'),
		array('name'=>'添加标签','en_name'=>'1603','url'=>'ads.php?type=adstag_add'),
		array('name'=>'添加广告','en_name'=>'1604','url'=>'ads.php?type=ads_add')
	)
);
$menu[32] = array(
	'en_name'=>'32',
	'big_key'=>'s06',
	'small_mod'=>'平台设置',
	'big_mod'=>'其他扩展',
	'sub_mod'=>array(
		array('name'=>'模板设置','en_name'=>'3201','url'=>'muban.php?type=index')
		
	)
);
/*
$menu[17] = array(
	'en_name'=>'17',
	'big_key'=>'s06',
	'small_mod'=>'定义导航',
	'big_mod'=>'其他扩展',
	'sub_mod'=>array(
		array('name'=>'导航栏列表','en_name'=>'1701','url'=>'systemconfig.php?type=nav_list'),
		array('name'=>'添加导航栏','en_name'=>'1702','url'=>'systemconfig.php?type=nav_add')
	)
);

$menu[19] = array(
	'en_name'=>'18',
	'big_key'=>'s06',
	'small_mod'=>'友情链接',
	'big_mod'=>'其他扩展',
	'sub_mod'=>array(
		array('name'=>'添加友情链接','en_name'=>'1801','url'=>'systemconfig.php?type=other_site_info'),
		array('name'=>'友情链接列表','en_name'=>'1802','url'=>'systemconfig.php?type=other_site_list')
	)
);*/

$menu[20] = array(
	'en_name'=>'20',
	'big_key'=>'s03',
	'small_mod'=>'在线留言',
	'big_mod'=>'用户管理',
	'sub_mod'=>array(
		array('name'=>'留言列表','en_name'=>'2001','url'=>'manager.php?type=meslist'),
		array('name'=>'已处理留言','en_name'=>'2002','url'=>'manager.php?type=meslist&tt=2'),
		array('name'=>'未处理留言','en_name'=>'2003','url'=>'manager.php?type=meslist&tt=1')
	)
);

/*$menu[21] = array(
	'en_name'=>'21',
	'big_key'=>'s07',
	'small_mod'=>'数据分析', 
	'big_mod'=>'数据管理',
	'sub_mod'=>array(
		array('name'=>'订单走势','en_name'=>'2101','url'=>'stats.php?type=order_trend'),
		array('name'=>'销售走势','en_name'=>'2102','url'=>'stats.php?type=sale_trend'),
		array('name'=>'利润走势','en_name'=>'2103','url'=>'stats.php?type=profit_trend'),
		array('name'=>'销售排行','en_name'=>'2104','url'=>'stats.php?type=sale_rank'),
		array('name'=>'访问购买率','en_name'=>'2105','url'=>'stats.php?type=visit_sale')
	)
);*/

$menu[22] = array(
	'en_name'=>'22',
	'big_key'=>'s02',
	'small_mod'=>'邮箱服务器设置',
	'big_mod'=>'系统设置',
	'sub_mod'=>array(
		array('name'=>'服务器账号设置','en_name'=>'2201','url'=>'email.php?type=email_config'),
		array('name'=>'发送模板设置','en_name'=>'2201','url'=>'email.php?type=tpl'),
		array('name'=>'发送开启设置','en_name'=>'2201','url'=>'email.php?type=send')
	)
);

/*$menu[25] = array(
	'en_name'=>'25',
	'big_key'=>'s07',
	'small_mod'=>'商品采集', 
	'big_mod'=>'数据管理',
	'sub_mod'=>array(
		array('name'=>'商品导出','en_name'=>'2501','url'=>'caiji.php?type=goodslist_cache'),
		array('name'=>'商品列表','en_name'=>'2501','url'=>'caiji.php?type=goodslist'),
		array('name'=>'网站设置','en_name'=>'2502','url'=>'caiji.php?type=setpreg')
		//array('name'=>'开始采集','en_name'=>'2503','url'=>'caiji.php?type=starecaiji')
	)
);*/

$menu[26] = array(
	'en_name'=>'26',
	'big_key'=>'s09',
	'small_mod'=>'公众平台',
	'big_mod'=>'公众平台',
	'sub_mod'=>array(
		array('name'=>'公众号管理','en_name'=>'2601','url'=>'weixin.php?type=wxconfig'),
		array('name'=>'关注时回复','en_name'=>'2602','url'=>'weixin.php?type=wxgzreply'),
		array('name'=>'图文信息','en_name'=>'2603','url'=>'weixin.php?type=wxnewlist'),
		array('name'=>'文本信息','en_name'=>'2604','url'=>'weixin.php?type=wxnewlisttxt'),
		array('name'=>'分类列表','en_name'=>'2605','url'=>'weixin.php?type=catelist'),
		array('name'=>'自定义菜单','en_name'=>'2606','url'=>'weixin.php?type=diymenu')
		//array('name'=>'通知配置','en_name'=>'2607','url'=>'weixin.php?type=tongzhiset')
	)
);
?>