<?php

class Database
{	
	protected $db;
	protected $result = [];
	protected $content =[];
	protected $p;
	public function __construct($path)
	
	{
		$this->p = $path;
		$this->db = file_get_contents($this->p);
    	$this->content = json_decode($this->db, true);

	}
	#create
	public function insertRow($data)
	{	
		array_push($this->content, $data);
		file_put_contents($this->p, json_encode($this->content, JSON_FORCE_OBJECT));
	}

	#read
	public function readRow($data, $where=NULL)
	{	
		$this->result = [];
		foreach ($this->content as $user){
			if ($data=="*" || in_array("*", $data)){
				if($where){
					$complete = False;
					foreach ($where as $key => $value) {
						if(in_array($where[$key], $user)){
							$complete = True;
						} else {
							$complete = False;
							break;
						}
					}
					if($complete){
						$this->result += $user;

					}
				} else {	
					array_push($this->result, $user);
				}
			} else {
				
				if($where){
					$complete = True;
					foreach ($where as $key => $value) {
						if(in_array($where[$key], $user)){
							$complete = True;
						}else{
							$complete = False;
							break;
						}
					}
					if($complete){
						$res = [];
						foreach ($data as $req){
							$res += array($req=>$user[$req]);	
						array_push($this->result, $res);
						}
					}
						
					
				} else {
					$res = [];
					foreach ($data as $req){
						$res += array($req=>$user[$req]);	
					}
					array_push($this->result, $res);
					
				}
			}
		}		
		return $this->result;
	}

	#update
	public function updateRow($data, $where=NULL)
	{
		foreach($this->content as $id=>$row){
			if ($where){
				foreach($where as $key=>$value){
					if (in_array($value, $row)){
						foreach ($data as $dkey=>$dvalue){
							$this->content[$id][$dkey]=$dvalue;
						}
					}
				}
			} else {
				foreach ($data as $dkey=>$dvalue){
					$this->content[$id][$dkey]=$dvalue;
				}
			}
		}
		file_put_contents($this->p, json_encode($this->content, JSON_FORCE_OBJECT));
	}

	#delete 
	public function deleteRow($where=NULL)
	{
		if ($where){
			foreach ($this->content as $id=>$row){
				foreach ($where as $key=>$value){
					if (in_array($value, $row)){
						unset($this->content[$id]);
					}
				}
			}
		}
		file_put_contents($this->p, json_encode($this->content, JSON_FORCE_OBJECT));
	}

}
?>