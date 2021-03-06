<?php namespace core;
use \helpers\gump;

/*
 * model - the base model
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */

abstract class Model extends Controller {

	/**
	 * hold the database connection
	 * @var object
	 */
	protected $_db;

	/**
	 * contains fillable keys
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * contains changeable attributes
	 * @var array
	 */
	public $attributes = [];

	/**
	 * table name
	 * @var string
	 */
	protected $table = '';

	/**
	 * valid operators for where clause
	 * @var regex string to match
	 */
	protected $operators = '/(=|<>|!=|in|not\sin)/i';
	
	/**
	 * create a new instance of the database helper
	 */
	public function __construct($data = []){

		//connect to PDO here.
		$this->_db = \helpers\database::get();

		// guess table name
		$class_name = get_called_class();
		$class_name = str_replace('models\\', '', $class_name);
		$this->table = strtolower($class_name) . 's';

		if ( is_array($data) ) {
			foreach ($this->fillable as $key) {
				$this->{$key} = $data[$key];
				$this->attributes[$key] = $data[$key];
			}
		}

		$datetime = date('Y-m-d H:i:s');

		$this->attributes['created_at'] = $datetime;
		$this->attributes['updated_at'] = $datetime;

	}

	/**
	 * saves the new instance to the database
	 * @return [type] [description]
	 */
	public function save ()
	{
		if ( $this->table ) {

			$now = date("Y-m-d H:i:s", time());

			if ( !isset($this->id) ) {

				$this->attributes['created_at'] = $now;
				$this->attributes['updated_at'] = $now;
				
				if ( $this->_db->insert(PREFIX.$this->table,$this->attributes) ) {
					$this->attributes['id'] = $id;
					$this->id = $id;
					$this->created_at = $now;
					$this->updated_at = $now;
					return true;
				}				

			} else {

				$this->attributes['updated_at'] = $now;

				if ( $this->_db->update(PREFIX.$this->table,$this->attributes, [ 'id' => $this->id ]) ) {
					$this->updated_at = $now;
					return true;
				}

			}

			return false;
			
		}

		$exception = new \Exception('The table name was not set for ' . self);
		\core\logger::exception_handler($exception);

	}

	/**
	 * updates the attributes of the model
	 * @param  assoc $new_data the new data
	 * @return void 
	 */	
	public function update ($new_data)
	{
		// var_dump($new_data);
		$old_attributes = $this->attributes;
		if ( is_array($new_data) ) {
			foreach ($this->fillable as $key) {
				$this->attributes[$key] = isset($new_data[$key]) ? $new_data[$key] : $this->attributes[$key];
				$this->{$key} = $this->attributes[$key];
			}
			$this->attibutes['updated_at'] = date('Y-m-d H:i:s');
		}
	}

	/**
	 * deletes the current object from db
	 * @return [type] [description]
	 */
	public function destroy ()
	{
		$data = [ 'id' => $this->id ];
		$this->_db->delete(PREFIX.$this->table, $data);

		// check if still existing
		if ( static::find($data['id']) ) {
			return false;
		}

		return true;
	}

	public function toArray ()
	{
		return $this->attributes;
	}

	/**
	 * gets a set of records within the limit and offset
	 * @param  integer $limit number of records to fetch
	 * @param  integer $offset the starting point
	 * @return array set of records
	 */
	private function getSet ($limit = 20,$offset = 0)
	{
		$args = [
			':limit' => $limit,
			':offset' => $offset
		];
		return $this->_db->select('SELECT * FROM '. PREFIX.$this->table . ' ORDER BY created_at DESC LIMIT :limit OFFSET :offset', $args );
	}

	public static function get ($limit = 20,$offset = 0)
	{
		$instance = new static();
		return $instance->getSet($limit,$offset);
	}

	public static function getWhere ( $key = FALSE, $arg2 = FALSE, $arg3 = FALSE )
	{
		if ( !$arg2 || !$key) return NULL;
		$instance = new static();
		$operator = '=';
		$result = NULL;
		$query_string = 'SELECT * FROM '. PREFIX.$instance->table . " WHERE $key ";

		// Setup query string acc to operator
		if ( !$arg3 ) {
			$query_string .= "= $arg3 ";
		} else {
			if ( !preg_match($instance->operators, $arg2) ) return NULL;
			$query_string .= $arg2 . ' ';
			$value = '';

			switch ( $arg2 ) {					
				case 'in': case 'IN':
				case 'not in': case 'NOT IN':
					if ( is_array($arg3) ) {
						$value = $arg3;
					} else {
						$value = [$arg3];
					}
					$value = '('. implode(',', array_map(function ($item)
					{
						return '"'.$item.'"';
					}, $value)) .')';
					break;
				default:
					$value = $value;
					break;
			}

			$query_string .= $value;
		}

		$query_string .= '  ORDER BY created_at DESC';
		$result = $instance->_db->select($query_string);
		return $result;		
	}

	private function queryAll ($sort_by , $order)
	{
		$result = $this->_db->select("SELECT * FROM " . PREFIX . $this->table . " ORDER BY " . $sort_by . " " . $order );
		return $result;
	}

	public static function find ($id = null)
	{
		if ( !$id ) {
			return null;
		}

		$instance = new static();
		$result = $instance->_db->select('SELECT * FROM '. PREFIX.$instance->table . ' WHERE id = :id LIMIT 1',[ ':id' => $id] );

		if ( !isset($result[0]) ) {
			return null;
		}

		if ( isset($result[0]) ) {
			$found = get_object_vars($result[0]);
			$new = static::create($found);
			$new->id = $found['id'];
			return $new;
		}

		return null;
	}

	public static function findWhere ( $key, $value )
	{
		$instance = new static();
		$result = $instance->_db->select('SELECT * FROM '. PREFIX.$instance->table . ' WHERE '.$key.' = "'.$value.'" LIMIT 1');
		if ( !isset($result[0]) ) {
			return null;
		}

		if ( isset($result[0]) ) {
			$found = get_object_vars($result[0]);
			$new = static::create($found);
			$new->id = $found['id'];
			return $new;
		}

		return null;
	}

	/**
	 * creates an instance of the model according to the data
	 * @param  array $data the data to be filled
	 * @return assoc. array 
	 */
	public static function create ($data)
	{
		$new = null;

		if ( is_array($data) ) {
			$new = new static($data);
		}

		return $new;

	}

	public static function all ($sort_by = 'id', $order = 'DESC')
	{
		$instance = new static();
		return $instance->queryAll($sort_by, $order);
	}

}
