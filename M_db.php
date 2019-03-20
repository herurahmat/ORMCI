<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_db
{
	protected $CI;
	protected $adb;
	function __construct($connection='')
	{		
		$this->CI=& get_instance();
		if(!empty($connection))
		{
			$this->adb=$this->CI->load->database($connection,TRUE,TRUE);
		}else{
			$this->adb=$this->CI->load->database('default',TRUE,TRUE);
		}		
	}

	function noTable(){
		die('Gunakan nama table terlebih dahulu pada parameter');
	}

	/**
	 * [fetchData Mengambil data]
	 * @param  string $table [libraries form_validation rule-reference]
	 * @param  string $where [Parameter seperti $this->db->where()]
	 * @param  string $order [Parameter seperti $this->db->order_by()]
	 * @param  string $group [Parameter seperti $this->db->group_by()]
	 * @param  string $limit [Parameter seperti $this->db->limit()]
	 * @return stdClass        [Bisa diloop]
	 */
	function get_data($table,$where=array(),$order='',$group='',$limit=null,$start=null){


		if(!empty($table))	{
			if(!empty($where)){
				$this->adb->where($where);
			}

			if(!empty($order)){
				$this->adb->order_by($order);
			}

			if(!empty($group)){
				$this->adb->group_by($group);
			}

			if(!empty($limit)){
				$this->adb->limit($limit,$start);
			}

			$result=$this->adb->get($table);
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}
	
	function get_data_in($table,$where=array(),$order='',$group='',$limit=null,$start=null){


		if(!empty($table))	{
			if(!empty($where)){
				$this->adb->where_in($where);
			}

			if(!empty($order)){
				$this->adb->order_by($order);
			}

			if(!empty($group)){
				$this->adb->group_by($group);
			}

			if(!empty($limit)){
				$this->adb->limit($limit,$start);
			}

			$result=$this->adb->get($table);
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}
	
	function get_data_not_in($table,$where=array(),$order='',$group='',$limit=null,$start=null){


		if(!empty($table))	{
			if(!empty($where)){
				$this->adb->where_not_in($where);
			}

			if(!empty($order)){
				$this->adb->order_by($order);
			}

			if(!empty($group)){
				$this->adb->group_by($group);
			}

			if(!empty($limit)){
				$this->adb->limit($limit,$start);
			}

			$result=$this->adb->get($table);
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}

	/**
	 * [addRow Menambahkan data]
	 * @param string $table [Nama Table]
	 * @param array $data  [Array data]
	 */
	function add_row($table,$data=array()){

		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($data))
			{
				$this->adb->insert($table,$data);
				if($this->adb->affected_rows()>0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
	
	function add_row_multiple($table,$data=array()){

		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($data))
			{
				$this->adb->insert_batch($table,$data);
				if($this->adb->affected_rows()>0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
		

/**
 * [lastInsertID mengambil ID terakhir setelah menambahkan data]
 * @return integer
 */
	function last_insert_id(){
		$id=$this->adb->insert_id();
		return $id;
	}

/**
 * [editRow description]
 * @param  string $table [Nama Table]
 * @param  array $data  [array data]
 * @param  array $where [array search]
 * @return boolean        [description]
 */
	function edit_row($table,$data=array(),$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			
			if(!empty($data))
			{
				$this->adb->update($table,$data);
				if($this->adb->affected_rows()>-1){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}

/**
 * [deleteRow description]
 * @param  string $table [Nama Table]
 * @param  string $where [array where]
 * @return boolean        [description]
 */
	function delete_row($table,$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}

			$this->adb->delete($table);
			if($this->adb->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

		}
	}


/**
 * [isBOF description]
 * @param  string  $table [Nama Table]
 * @param  string  $where [array where]
 * @return boolean        [description]
 */
	function is_bof($table,$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			
			$sql = $this->adb->get($table);
			if($sql->num_rows() > 0){
				return false;
			} else {
				return true;
			}
		}
	}

/**
 * [countData description]
 * @param  string $table [Nama Table]
 * @param  string $where [array where]
 * @return integer        [description]
 */
	function count_data($table,$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			$sql = $this->adb->get($table);
			$count=$sql->num_rows();
			return $count;
		}
	}

/**
 * [recordCount description]
 * @param  string $table [Nama Table]
 * @param  string $where [array where]
 * @return integer        [description]
 */
	function row_count($table,$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			$sql = $this->adb->get($table);
			$count=$sql->num_rows();
			return $count;
		}
	}

/**
 * [fieldRow description]
 * @param  string $table [Nama Table]
 * @param  string $where [array where]
 * @param  string $field [Nama field]
 * @return string        [description]
 */
	function get_row($table,$where=array(),$field,$order=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($order)){
				$this->adb->order_by($order);
			}
			if(!empty($where)){
				$this->adb->where($where);
			}
			$this->CI->db->limit(1);
			$sql = $this->adb->get($table);
			if($sql->num_rows() > 0){
				return $sql->row()->$field;
			} else {
				return "";
			}
		}
	}

	function get_avg_row($table,$where=array(),$field){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			$this->adb->select_avg($field);
			$this->CI->db->limit(1);
			$sql = $this->adb->get($table);
			if($sql->num_rows() > 0){
				return $sql->row()->$field;
			} else {
				return "";
			}
		}
	}

/**
 * [sumRow Jumlah Sub Total]
 * @param  string $table [Nama Table]
 * @param  string $where [array where]
 * @param  string $field [Nama Field]
 * @return integer        [description]
 */
	function get_sum_row($table,$where=array(),$field){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			$this->adb->select_sum($field);
			$this->CI->db->limit(1);
			$sql = $this->adb->get($table);
			if($sql->num_rows() > 0){
				return $sql->row()->$field;
			} else {
				return 0;
			}
		}
	}

/**
 * [maxRow nilai tertinggi]
 * @param  string $table [Nama Table]
 * @param  string $where [array where]
 * @param  string $field [Nama Field]
 * @return string        [description]
 */
	function get_max_row($table,$where=array(),$field){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			$this->adb->select_max($field);
			$this->CI->db->limit(1);
			$sql = $this->adb->get($table);
			if($sql->num_rows() > 0){
				return $sql->row()->$field;
			} else {
				return "";
			}
		}
	}

/**
 * [minRow nilai terendah]
 * @param  string $table [Nama Table]
 * @param  string $where [array where]
 * @param  string $field [Nama Field]
 * @return string        [description]
 */
	function get_min_row($table,$where=array(),$field){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->adb->where($where);
			}
			$this->adb->select_min($field);
			$this->CI->db->limit(1);
			$sql = $this->adb->get($table);
			if($sql->num_rows() > 0){
				return $sql->row()->$field;
			} else {
				return "";
			}
		}
	}

/**
 * [fetchQuery description]
 * @param  string $sqlQuery [description]
 * @return stdClass           [description]
 */
	function get_query_data($sqlQuery){
		$sql=$this->adb->query($sqlQuery);
		if($sql->num_rows()>0){
			$data=$sql->result();
			return $data;
		}else{
			return null;
		}
	}

/**
 * [fieldQuery mengambil satu data]
 * @param  string $sqlQuery [Query Native]
 * @param  string $field    [Nama Field]
 * @return string           [description]
 */
	function get_query_row($sqlQuery,$field){
		$sql=$this->adb->query($sqlQuery);
		if($sql->num_rows()>0){
			$row=$sql->row();
			return $row->$field;
		}else{
			return "";
		}
	}

/**
 * [countQuery Jumlah Data]
 * @param  string $sqlQuery [description]
 * @return integer           [description]
 */
	function count_query($sqlQuery){
		$sql=$this->adb->query($sqlQuery);
		$count=$this->adb->count_all_results();
		return $count;
	}

/**
 * [toolsBackupDB description]
 * @param  string $fileType      [txt,zip,gzip]
 * @param  string $name          [nama file backup]
 * @param  string $tables        [description]
 * @param  boolean $addDrop       [Membuat parameter drop/hapus terlebih dahulu]
 * @param  boolean $addInsert     [Memebuat parameter insert terlebih dahulu]
 * @param  boolean $forceDownload [Paksa download file]
 * @param  string $Location      [lokasi upload jika tidak didownload]
 * @return boolean                [description]
 */
	function backup_db($fileType,$name,$tables=array(),$addDrop=FALSE,$addInsert=FALSE,$forceDownload=TRUE,$Location=''){
		$this->CI->load->dbutil();
		$config = array(
			'tables'		=>$tables,
	        'format'        => $fileType,
	        'filename'      => $name.'.sql',
	        'add_drop'      => $addDrop,
	        'add_insert'    => $addInsert,
	        'newline'       => "\n"
		);

		$backup =$this->CI->dbutil->backup($config);
		$nameBackup=$name.'.'.$fileType;
		if($forceDownload==TRUE){
			$this->CI->load->helper('download');
    		force_download($nameBackup,$backup);
    		return true;
		}else{
			if($forceDownload==FALSE && empty($Location))
			{
				return false;
			}else{
				$this->CI->load->helper('file');
				write_file($Location.$nameBackup, $backup);
				return true;
			}
		}
	}

/**
 * [toolsOptimizeDB description]
 * @return boolean [description]
 */
	function optimize_db(){
		$this->CI->load->dbutil();
		$result = $this->CI->dbutil->optimize_database();
		return TRUE;
	}

/**
 * [toolsRepairTable description]
 * @param  string $table [Nama Table]
 * @return boolean        [description]
 */
	function repair_table($table)
    {
    	$this->CI->load->dbutil();
		if ($this->CI->dbutil->repair_table($table))
		{
		    return true;
		}else{
			return false;
		}
	}

/**
 * [toolsTableExits description]
 * @param  string $table [Nama Table]
 * @return boolean        [description]
 */
	function is_table_exists($table){

		if(!empty($table)){
			if($this->adb->table_exists($table)){
				return true;
			}else{
				return false;
			}
		}else{
			$this->noTable();
		}

	}

/**
 * [toolsListTable Mengambil daftar table]
 * @return stdClass [description]
 */
	function get_list_table(){
		$output=array();
		$tables = $this->adb->list_tables();
		foreach ($tables as $table)
		{
		        $output[]=$table;
		}
		return $output;
	}

/**
 * [toolsFieldTable Mengambil info file pada table]
 * @param  string $table [Nama Table]
 * @return stdClass        [description]
 */
	function get_field_table($table){

		if(!empty($table)){
			$output=array();
			$fields = $this->adb->list_fields($table);

			foreach ($fields as $field)
			{
				$output[]=$field;
			}
			return $output;
		}else{
			$this->noTable();
		}
	}

/**
 * [toolsMetadataTable Mengambil info field pada table datatype,length,dll]
 * @param  string $table [Nama Table]
 * @return stdClass        [description]
 */
	function get_meta_table($table){

		if(!empty($table)){
			$metadata=$this->adb->field_data($table);
			return $metadata;
		}else{
			$this->noTable();
		}
	}


	/**
	 * [forgeCreateDB Membuat database]
	 * @param  string $dbname [Nama Database]
	 * @return boolean         [description]
	 */
	function create_db($dbname){

		if(!empty($dbname)){
			$this->CI->load->dbforge();
			if($this->CI->dbforge->create_database($dbname)){
				return true;
			}else{
				return false;
			}
		}else{
			die('Kesalahan membuat database');
		}

	}

/**
 * [forgeDropDB menghapus database]
 * @param  string $dbname [Nama Database]
 * @return boolean         [description]
 */
	function delete_database($dbname){

		if(!empty($dbname)){
			$this->CI->load->dbforge();
			if($this->CI->dbforge->drop_database($dbname)){
				return true;
			}else{
				return false;
			}
		}else{
			$this->noTable();
		}

	}

/**
 * [forgeDropTable Menghapus table]
 * @param  string $table [Nama Table]
 * @return boolean        [description]
 */
	function delete_table($table){
		if(!empty($table)){
			$this->CI->load->dbforge();
			if($this->CI->dbforge->drop_table($table)){
				return true;
			}else{
				return false;
			}
		}else{
			$this->noTable();
		}
	}

/* VERSION 2 */

	function get_data_field($table,$field=array(),$where=array(),$order='',$group='',$limit=null,$start=null)
	{
		if(!empty($table))	{
			
			$this->adb->select($field);
			
			if(!empty($where)){
				$this->adb->where($where);
			}

			if(!empty($order)){
				$this->adb->order_by($order);
			}

			if(!empty($group)){
				$this->adb->group_by($group);
			}

			if(!empty($limit)){
				$this->adb->limit($limit,$start);
			}

			$result=$this->adb->get($table);
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}
	
	function reset_auto_increament($table){
		$this->CI->db->protect_identifiers($table);
		$sqlQuery="ALTER TABLE ".$table." AUTO_INCREMENT = 1";
		$sql=$this->adb->query($sqlQuery);
		$count=$this->adb->count_all_results();
		return $count;
	}

/* END VERSION 2 */


}