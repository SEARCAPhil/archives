<?php
class Privilege_test extends TestCase
{
	public function setUp()
    {
    	$this->resetInstance();//reset the Codeigniter instance ($this->CI)
    	$this->CI->load->database();
    	$this->CI->load->model('privilege');
        $this->obj = $this->CI->privilege;
    }

	public function test_get_roles()
	{ 
		 $this->assertNotEmpty($this->obj->_get_roles());
	}

	public function test_get_privilege_of_general_role(){
	 	$this->assertEquals('general',$this->obj->get_privilege('general')[0]->role);
	}

	public function test_get_privilege_details(){

	 	//general role
	 	$general_role_id=$this->obj->get_privilege('general')[0]->id;

	 	$this->assertEquals('general',$this->obj->_get_privilege_details($general_role_id)[0]->role);
	}
	
}
?>