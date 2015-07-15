<?php
class MubanController extends Controller{
 	function  __construct() {
           $this->css('content.css');
	}
	
	function index($data=array()){ 
		$this->template('index');
	}
	
	function ajax_save_muban($data=array()){ 
		$id = $data['id'];
		if($this->App->update('systemconfig',array('mubanid'=>$id),'type','basic')){
			echo "保存成功";
		}else{
			echo "保存失败";
		}
		exit;
	}
	
	function diymenuinfo($data=array()){
		$this->css('jquery_dialog.css');
		$this->js('jquery_dialog.js');
			
		$id = isset($data['id']) ? $data['id'] : 0;
		if($id > 0){
			if(!empty($_POST)){
				$key = $_POST['keyword'];
				if(empty($key)){
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo&id='.$id,0,'关键字不能为空');exit;
				}
				$title = $_POST['title'];
				if(empty($title)){
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo&id='.$id,0,'主菜单名称');exit;
				}
				$url = $_POST['url'];
				$is_show = $_POST['is_show'];
				$sort = $_POST['sort'];
				if(!($sort>0)) $sort = 50;
				if($this->App->update('wxdiymen',$_POST,'id',$id)){
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo&id='.$id,0,'更新成功');exit;
				}else{
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo&id='.$id,0,'更新失败');exit;
				}
			}
			$sql = "SELECT * FROM `{$this->App->prefix()}wxdiymen` WHERE id='{$id}'";
			$rt = $this->App->findrow($sql);
		}else{
			if(!empty($_POST)){
				$key = $_POST['keyword'];
				if(empty($key)){
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo',0,'关键字不能为空');exit;
				}
				$title = $_POST['title'];
				if(empty($title)){
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo',0,'主菜单名称');exit;
				}
				$url = $_POST['url'];
				$is_show = $_POST['is_show'];
				$sort = $_POST['sort'];
				if(!($sort>0)) $sort = 50;
				if($this->App->insert('wxdiymen',$_POST)){
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo',0,'添加成功');exit;
				}else{
					$this->jump(ADMIN_URL.'weixin.php?type=diymenuinfo',0,'添加失败');exit;
				}
				$rt = $_POST;
			}
		}
		
		$rt['nav'] = $this->get_cate_diytree();
		//print_r($rt['nav']);
		$this->set('rt',$rt);
		$this->set('id',$id);
		$this->template('diymenuinfo');
	}
	
	function get_cate_diytree($cid = 0)
	{
		$three_arr = array();
		$sql = 'SELECT count(id) FROM `'.$this->App->prefix()."wxdiymen` WHERE parent_id = '$cid'";
		if ($this->App->findvar($sql) || $cid == 0)
		{
			$sql = 'SELECT * FROM `'.$this->App->prefix()."wxdiymen` WHERE parent_id = '$cid' ORDER BY parent_id ASC,sort ASC, id ASC";
			$res = $this->App->find($sql); 
			foreach ($res as $row)
			{
			    $three_arr[$row['id']]   = $row;
			 
			    if (isset($row['id'])&&!empty($row['id']) != NULL)
				{
					 $three_arr[$row['id']]['cat_id'] = $this->get_cate_diytree($row['id']);
				}
			}
		}
		return $three_arr;
	}
}
?>