# ORMCI
Simple library database untuk penggunaan Codeigniter


# Cara Install
- Tambahkan Library M_db.php ke folder application/libraries
- Buatlah model untuk memproseskan database

# Contoh Pemakaian
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sample extends CI_Model
{
	private $default;
	private $other;
	function __construct()
	{
		$this->load->library('m_db');
		$this->default=new M_db(); // For Default Group Database
		$this->other=new M_db('otherdb'); //For Other Group Database
	}
	
	function get_default($where=array(),$order="",$group_by='')
	{
		$d=$this->default->get_data('default_table',$where,$order,$group_by);
		return $d;
	}
	
	function get_other($where=array(),$order="",$group_by='')
	{
		$d=$this->other->get_data('other_table',$where,$order,$group_by);
		return $d;
	}
	
	function find_id($fieldDefaultID,$output='')
	{
		$s=array('ID'=>$fieldDefaultID);
		$item=$this->default->get_row('default_table',$s,$output);
		return $item;
	}
	
	function count_table()
	{
		$count=$this->default->count_data('default_table');
		return $count;
	}
	
	function insert_data($field1,$field2)
	{
		$d=array(
			'field1'=>$field1,
			'field2'=>$field2,
		);
		if($this->default->add_row('default_table',$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function edit_data($primaryKey,$field1,$field2)
	{
		$s=array(
			'ID'=>$primaryKey
		);
		$d=array(
			'field1'=>$field1,
			'field2'=>$field2,
		);
		if($this->default->edit_row('default_table',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function delete_row($primaryKey)
	{
		$s=array(
			'ID'=>$primaryKey
		);
		if($this->default->delete_row('default_table',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
}
```php
