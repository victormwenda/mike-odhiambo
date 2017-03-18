<?php 

	namespace common\database\modules;

	use common\database\crud\Login;

	/**
	*  
	*	LoginInfo
	*  
	* Provides High level features for interacting with the Login;
	*
	* This source code is auto-generated
    *
    * @author Victor Mwenda
    * Email : vmwenda.vm@gmail.com
    * Phone : +254(0)718034449
	*/
	class LoginInfo{

	private $build;
	private $client;
	private $action;
	private $login;
	private $table = 'login';
	/**
	 * LoginInfo
	 * 
	 * Class to get all the login Information from the login table 
	 * @param String $action
	 * @param String $client
	 * @param String $build
	 * 
	 * @author Victor Mwenda
	 * Email : vmwenda.vm@gmail.com
	 * Phone : +254718034449
	 */
	public function __construct($action = "query", $client = "mobile-android",$build="user-build") {

		$this->client = $client;
		$this->action = $action;
		$this->build = $build;
		
		$this->login = new Login( $action, $client );

	}

	

		/**
	* Inserts data into the table[login] in the order below
	* array ('user_id','username','password','access_token')
	* is mappped into 
	* array ($user_id,$username,$password,$access_token)
	* @return 1 if data was inserted,0 otherwise
	* if redundancy check is true, it inserts if the record if it never existed else.
	* if the record exists, it returns the number of times the record exists on the relation
	*/
	public function insert($user_id,$username,$password,$access_token,$redundancy_check= false, $printSQL = false) {
		$columns = array('user_id','username','password','access_token');
		$records = array($user_id,$username,$password,$access_token);
		return $this->login->insert_prepared_records($user_id,$username,$password,$access_token,$redundancy_check,$printSQL );
	}


 	/**
     * @param $distinct
     * @param string $extraSQL
     * @return string
     */
	public function query($distinct,$extraSQL=""){

		$columns = $records = array ();
		$queried_login = $this->login->fetch_assoc_in_login ($distinct, $columns, $records,$extraSQL );

		if($this->build == "eng-build"){
			return $this->query_eng_build($queried_login);
		}
		if($this->build == "user-build"){
			return $this->query_user_build($queried_login);
		}
	}
/**
     * Inserts records in a relation
     * The records are inserted in the relation columns in the order they are arranged in the array
     *
     * @param $records
     * @param bool $printSQL
     * @return bool|mysqli_result
     * @throws NullabilityException
     */
    public function insert_raw($records, $printSQL = false)
    {
        return $this->login->insert_raw($records, $printSQL);
    }

    /**
     * Inserts records in a relation
     * The records are matched alongside the columns in the relation
         * @param array $columns
         * @param array $records
         * @param bool $redundancy_check
         * @param bool $printSQL
         * @return mixed
         */
        public function insert_records_to_login(Array $columns, Array $records,$redundancy_check = false, $printSQL = false){
            return $this->login->insert_records_to_login($columns, $records,$redundancy_check,$printSQL);
        }

     /**
        * Performs a raw Query
        * @param $sql string sql to execute
        * @return string sql results
        * @throws \app\libs\marvik\libs\database\core\mysql\NullabilityException
        */
	public function rawQuery($sql){

		$queried_login = $this->login->get_database_utils()->rawQuery($sql);

		if($this->build == "eng-build"){
			return $this->query_eng_build($queried_login);
		}
		if($this->build == "user-build"){
			return $this->query_user_build($queried_login);
		}
	}

	public function query_eng_build($queried_login){
		if($this->client == "web-desktop"){
			return $this->export_query_html($queried_login);
		}
		if($this->client == "mobile-android"){
			return $this->export_query_json($queried_login);
		}
	}
	public function query_user_build($queried_login){
		if($this->client == "web-desktop"){
			return $this->export_query_html($queried_login);
		}
		if($this->client == "mobile-android"){
			return $this->export_query_json($queried_login);
		}
	}
	public function export_query_json($queried_login){
		$query_json = json_encode($queried_login);
		return $query_json;
	}
	public function export_query_html($queried_login){
		$query_html = "";
		foreach ( $queried_login as $login_row_items ) {
			$query_html .= $this->process_query_for_html_export ( $login_row_items );
		}
		return $query_html;
	}

	private function process_query_for_html_export ( $login_row_items ){
		$html_export ='<div style="padding:10px;margin:10px;border:2px solid black;"><h3>'  .$this->table.  '</h3>';
		
		$user_id = $login_row_items ['user_id'];
	if ($user_id  != null) {
	$html_export .= $this->parseHtmlExport ( 'user_id', $user_id  );
}
$username = $login_row_items ['username'];
	if ($username  != null) {
	$html_export .= $this->parseHtmlExport ( 'username', $username  );
}
$password = $login_row_items ['password'];
	if ($password  != null) {
	$html_export .= $this->parseHtmlExport ( 'password', $password  );
}
$access_token = $login_row_items ['access_token'];
	if ($access_token  != null) {
	$html_export .= $this->parseHtmlExport ( 'access_token', $access_token  );
}

		
		return $html_export .='</div>';
	}

	private function parseHtmlExport($title,$message){
		return '<div style="width:400px;"><h4>' . $title . '</h4><hr /><p>' . $message . '</p></div>';
	}
} ?>
