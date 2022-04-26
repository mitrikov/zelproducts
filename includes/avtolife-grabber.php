<?php


require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' ); 
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-admin/includes/upgrade.php' );

if (!$wpdb) { $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST); } else { global $wpdb; }

$wpdb->show_errors();

class InsuranceTable {
  private $name;
  private $charset_collate;

  public function __construct($name, $charset_collate) {
    $this->name = $wpdb->prefix . $name;
    $this->charset_collate = $charset_collate;
  }

  public function create($schema) {
    $fields = '';

    foreach($schema as $fieldName => $fieldParam) {
      $fields .= "`$fieldName` $fieldParam , ";
    }

    $fields .= 'PRIMARY KEY (`id`)';

    $sql = "CREATE TABLE $this->name ($fields) $charset_collate;" ;
    dbDelta( $sql );

    $success = empty($wpdb->last_error);

    return $success;
  }

  public function getName() {
    return $this->name;
  }
}

$schema = array(
  'id' => 'INT NOT NULL AUTO_INCREMENT' , 
  'created' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP' ,
  'policyBeginAt' => 'VARCHAR(10)' , 
  'insuranceMonth' => 'TINYINT NOT NULL' , 
  'prevPolicySerial' => 'VARCHAR(3) NOT NULL' , 
  'prevPolicyNumber' => 'VARCHAR(15) NOT NULL' , 
  'regNumber' => 'VARCHAR(9)', 
  'notRegNumber' => 'BOOLEAN',
  'mark' => 'VARCHAR(200)',
  'model' => 'VARCHAR(200)',
  'transportCategory' => 'VARCHAR(1) NOT NULL',
  'transportYear' => 'YEAR NOT NULL',
  'transportPower' => 'VARCHAR(4)',
  'documentType' => 'VARCHAR(40) NOT NULL',
  'transportDocSeries' => 'VARCHAR(4)',
  'transportDocNumber' => 'VARCHAR(15)',
  'dateOfIssue' => 'VARCHAR(10)', 
  'idType' => 'VARCHAR(18) NOT NULL',
  'vinOrBodyOrChassisNumber' => 'VARCHAR(17)',
  'diagnosticNumber' => 'VARCHAR(21)',
  'diagnosticEndAt' => 'VARCHAR(10)',
  'withTrailer' => 'BOOLEAN',
  'surname' => 'VARCHAR(30)',
  'firstName' => 'VARCHAR(30)',
  'patronymic' => 'VARCHAR(30)',
  'birthday' => 'VARCHAR(10)',
  'gender' => 'VARCHAR(7)',
  'passportSeries' => 'VARCHAR(4)',
  'passportNumber' => 'VARCHAR(6)',
  'passportDateOfIssue' => 'VARCHAR(10)',
  'insurerAddress' => 'VARCHAR(200)',
  'email' => 'VARCHAR(100)',
  'phone' => 'VARCHAR(30)',
  'inOwnerInsured' => 'BOOLEAN',
  'limit' => 'BOOLEAN');

$table = new InsuranceTable("avtolife", $wpdb->get_charset_collate());

//$table->create($schema);

function saveTable(WP_REST_Request $request) {
  $mysqlFields = "`id`, `created`";
  $mysqlValues = "NULL, current_timestamp()";

  foreach($request->get_params() as $paramName => $paramValue) {
    $mysqlFields .= ", `$paramName`";
    $mysqlValues .= ", '$paramValue'";
    
  }
  $sql = "INSERT INTO `avtolife` ($mysqlFields) VALUES ($mysqlValues);";
  dbDelta( $sql );
    return $request;
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'grabber/v1', '/save', array(
    'methods' => 'POST',
    'callback' => 'saveTable',
  ) );
} );

?>