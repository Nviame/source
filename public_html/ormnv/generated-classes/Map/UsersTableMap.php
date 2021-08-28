<?php

namespace Map;

use \Users;
use \UsersQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Users';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 37;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 37;

    /**
     * the column name for the id field
     */
    const COL_ID = 'users.id';

    /**
     * the column name for the id_company field
     */
    const COL_ID_COMPANY = 'users.id_company';

    /**
     * the column name for the avatar field
     */
    const COL_AVATAR = 'users.avatar';

    /**
     * the column name for the fullname field
     */
    const COL_FULLNAME = 'users.fullname';

    /**
     * the column name for the first_name field
     */
    const COL_FIRST_NAME = 'users.first_name';

    /**
     * the column name for the last_name field
     */
    const COL_LAST_NAME = 'users.last_name';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'users.password';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'users.email';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'users.country';

    /**
     * the column name for the country_code field
     */
    const COL_COUNTRY_CODE = 'users.country_code';

    /**
     * the column name for the home_address field
     */
    const COL_HOME_ADDRESS = 'users.home_address';

    /**
     * the column name for the providence_code field
     */
    const COL_PROVIDENCE_CODE = 'users.providence_code';

    /**
     * the column name for the providence field
     */
    const COL_PROVIDENCE = 'users.providence';

    /**
     * the column name for the locality_code field
     */
    const COL_LOCALITY_CODE = 'users.locality_code';

    /**
     * the column name for the locality field
     */
    const COL_LOCALITY = 'users.locality';

    /**
     * the column name for the postal_code field
     */
    const COL_POSTAL_CODE = 'users.postal_code';

    /**
     * the column name for the dni field
     */
    const COL_DNI = 'users.dni';

    /**
     * the column name for the dni_front field
     */
    const COL_DNI_FRONT = 'users.dni_front';

    /**
     * the column name for the dni_back field
     */
    const COL_DNI_BACK = 'users.dni_back';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'users.phone';

    /**
     * the column name for the drivers_license field
     */
    const COL_DRIVERS_LICENSE = 'users.drivers_license';

    /**
     * the column name for the overall_rating field
     */
    const COL_OVERALL_RATING = 'users.overall_rating';

    /**
     * the column name for the last_login field
     */
    const COL_LAST_LOGIN = 'users.last_login';

    /**
     * the column name for the registered_at field
     */
    const COL_REGISTERED_AT = 'users.registered_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'users.updated_at';

    /**
     * the column name for the last_location_lat field
     */
    const COL_LAST_LOCATION_LAT = 'users.last_location_lat';

    /**
     * the column name for the last_location_lng field
     */
    const COL_LAST_LOCATION_LNG = 'users.last_location_lng';

    /**
     * the column name for the last_location_datetime field
     */
    const COL_LAST_LOCATION_DATETIME = 'users.last_location_datetime';

    /**
     * the column name for the last_location_locality field
     */
    const COL_LAST_LOCATION_LOCALITY = 'users.last_location_locality';

    /**
     * the column name for the last_location_region field
     */
    const COL_LAST_LOCATION_REGION = 'users.last_location_region';

    /**
     * the column name for the last_location_country field
     */
    const COL_LAST_LOCATION_COUNTRY = 'users.last_location_country';

    /**
     * the column name for the timezone field
     */
    const COL_TIMEZONE = 'users.timezone';

    /**
     * the column name for the traveling field
     */
    const COL_TRAVELING = 'users.traveling';

    /**
     * the column name for the verified field
     */
    const COL_VERIFIED = 'users.verified';

    /**
     * the column name for the pwd_reset_code field
     */
    const COL_PWD_RESET_CODE = 'users.pwd_reset_code';

    /**
     * the column name for the commission field
     */
    const COL_COMMISSION = 'users.commission';

    /**
     * the column name for the disabled field
     */
    const COL_DISABLED = 'users.disabled';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'IdCompany', 'Avatar', 'Fullname', 'FirstName', 'LastName', 'Password', 'Email', 'Country', 'CountryCode', 'HomeAddress', 'ProvidenceCode', 'Providence', 'LocalityCode', 'Locality', 'PostalCode', 'Dni', 'DniFront', 'DniBack', 'Phone', 'DriversLicense', 'OverallRating', 'LastLogin', 'RegisteredAt', 'UpdatedAt', 'LastLocationLat', 'LastLocationLng', 'LastLocationDatetime', 'LastLocationLocality', 'LastLocationRegion', 'LastLocationCountry', 'Timezone', 'Traveling', 'Verified', 'PwdResetCode', 'Commission', 'Disabled', ),
        self::TYPE_CAMELNAME     => array('id', 'idCompany', 'avatar', 'fullname', 'firstName', 'lastName', 'password', 'email', 'country', 'countryCode', 'homeAddress', 'providenceCode', 'providence', 'localityCode', 'locality', 'postalCode', 'dni', 'dniFront', 'dniBack', 'phone', 'driversLicense', 'overallRating', 'lastLogin', 'registeredAt', 'updatedAt', 'lastLocationLat', 'lastLocationLng', 'lastLocationDatetime', 'lastLocationLocality', 'lastLocationRegion', 'lastLocationCountry', 'timezone', 'traveling', 'verified', 'pwdResetCode', 'commission', 'disabled', ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_ID, UsersTableMap::COL_ID_COMPANY, UsersTableMap::COL_AVATAR, UsersTableMap::COL_FULLNAME, UsersTableMap::COL_FIRST_NAME, UsersTableMap::COL_LAST_NAME, UsersTableMap::COL_PASSWORD, UsersTableMap::COL_EMAIL, UsersTableMap::COL_COUNTRY, UsersTableMap::COL_COUNTRY_CODE, UsersTableMap::COL_HOME_ADDRESS, UsersTableMap::COL_PROVIDENCE_CODE, UsersTableMap::COL_PROVIDENCE, UsersTableMap::COL_LOCALITY_CODE, UsersTableMap::COL_LOCALITY, UsersTableMap::COL_POSTAL_CODE, UsersTableMap::COL_DNI, UsersTableMap::COL_DNI_FRONT, UsersTableMap::COL_DNI_BACK, UsersTableMap::COL_PHONE, UsersTableMap::COL_DRIVERS_LICENSE, UsersTableMap::COL_OVERALL_RATING, UsersTableMap::COL_LAST_LOGIN, UsersTableMap::COL_REGISTERED_AT, UsersTableMap::COL_UPDATED_AT, UsersTableMap::COL_LAST_LOCATION_LAT, UsersTableMap::COL_LAST_LOCATION_LNG, UsersTableMap::COL_LAST_LOCATION_DATETIME, UsersTableMap::COL_LAST_LOCATION_LOCALITY, UsersTableMap::COL_LAST_LOCATION_REGION, UsersTableMap::COL_LAST_LOCATION_COUNTRY, UsersTableMap::COL_TIMEZONE, UsersTableMap::COL_TRAVELING, UsersTableMap::COL_VERIFIED, UsersTableMap::COL_PWD_RESET_CODE, UsersTableMap::COL_COMMISSION, UsersTableMap::COL_DISABLED, ),
        self::TYPE_FIELDNAME     => array('id', 'id_company', 'avatar', 'fullname', 'first_name', 'last_name', 'password', 'email', 'country', 'country_code', 'home_address', 'providence_code', 'providence', 'locality_code', 'locality', 'postal_code', 'dni', 'dni_front', 'dni_back', 'phone', 'drivers_license', 'overall_rating', 'last_login', 'registered_at', 'updated_at', 'last_location_lat', 'last_location_lng', 'last_location_datetime', 'last_location_locality', 'last_location_region', 'last_location_country', 'timezone', 'traveling', 'verified', 'pwd_reset_code', 'commission', 'disabled', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdCompany' => 1, 'Avatar' => 2, 'Fullname' => 3, 'FirstName' => 4, 'LastName' => 5, 'Password' => 6, 'Email' => 7, 'Country' => 8, 'CountryCode' => 9, 'HomeAddress' => 10, 'ProvidenceCode' => 11, 'Providence' => 12, 'LocalityCode' => 13, 'Locality' => 14, 'PostalCode' => 15, 'Dni' => 16, 'DniFront' => 17, 'DniBack' => 18, 'Phone' => 19, 'DriversLicense' => 20, 'OverallRating' => 21, 'LastLogin' => 22, 'RegisteredAt' => 23, 'UpdatedAt' => 24, 'LastLocationLat' => 25, 'LastLocationLng' => 26, 'LastLocationDatetime' => 27, 'LastLocationLocality' => 28, 'LastLocationRegion' => 29, 'LastLocationCountry' => 30, 'Timezone' => 31, 'Traveling' => 32, 'Verified' => 33, 'PwdResetCode' => 34, 'Commission' => 35, 'Disabled' => 36, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idCompany' => 1, 'avatar' => 2, 'fullname' => 3, 'firstName' => 4, 'lastName' => 5, 'password' => 6, 'email' => 7, 'country' => 8, 'countryCode' => 9, 'homeAddress' => 10, 'providenceCode' => 11, 'providence' => 12, 'localityCode' => 13, 'locality' => 14, 'postalCode' => 15, 'dni' => 16, 'dniFront' => 17, 'dniBack' => 18, 'phone' => 19, 'driversLicense' => 20, 'overallRating' => 21, 'lastLogin' => 22, 'registeredAt' => 23, 'updatedAt' => 24, 'lastLocationLat' => 25, 'lastLocationLng' => 26, 'lastLocationDatetime' => 27, 'lastLocationLocality' => 28, 'lastLocationRegion' => 29, 'lastLocationCountry' => 30, 'timezone' => 31, 'traveling' => 32, 'verified' => 33, 'pwdResetCode' => 34, 'commission' => 35, 'disabled' => 36, ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_ID => 0, UsersTableMap::COL_ID_COMPANY => 1, UsersTableMap::COL_AVATAR => 2, UsersTableMap::COL_FULLNAME => 3, UsersTableMap::COL_FIRST_NAME => 4, UsersTableMap::COL_LAST_NAME => 5, UsersTableMap::COL_PASSWORD => 6, UsersTableMap::COL_EMAIL => 7, UsersTableMap::COL_COUNTRY => 8, UsersTableMap::COL_COUNTRY_CODE => 9, UsersTableMap::COL_HOME_ADDRESS => 10, UsersTableMap::COL_PROVIDENCE_CODE => 11, UsersTableMap::COL_PROVIDENCE => 12, UsersTableMap::COL_LOCALITY_CODE => 13, UsersTableMap::COL_LOCALITY => 14, UsersTableMap::COL_POSTAL_CODE => 15, UsersTableMap::COL_DNI => 16, UsersTableMap::COL_DNI_FRONT => 17, UsersTableMap::COL_DNI_BACK => 18, UsersTableMap::COL_PHONE => 19, UsersTableMap::COL_DRIVERS_LICENSE => 20, UsersTableMap::COL_OVERALL_RATING => 21, UsersTableMap::COL_LAST_LOGIN => 22, UsersTableMap::COL_REGISTERED_AT => 23, UsersTableMap::COL_UPDATED_AT => 24, UsersTableMap::COL_LAST_LOCATION_LAT => 25, UsersTableMap::COL_LAST_LOCATION_LNG => 26, UsersTableMap::COL_LAST_LOCATION_DATETIME => 27, UsersTableMap::COL_LAST_LOCATION_LOCALITY => 28, UsersTableMap::COL_LAST_LOCATION_REGION => 29, UsersTableMap::COL_LAST_LOCATION_COUNTRY => 30, UsersTableMap::COL_TIMEZONE => 31, UsersTableMap::COL_TRAVELING => 32, UsersTableMap::COL_VERIFIED => 33, UsersTableMap::COL_PWD_RESET_CODE => 34, UsersTableMap::COL_COMMISSION => 35, UsersTableMap::COL_DISABLED => 36, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_company' => 1, 'avatar' => 2, 'fullname' => 3, 'first_name' => 4, 'last_name' => 5, 'password' => 6, 'email' => 7, 'country' => 8, 'country_code' => 9, 'home_address' => 10, 'providence_code' => 11, 'providence' => 12, 'locality_code' => 13, 'locality' => 14, 'postal_code' => 15, 'dni' => 16, 'dni_front' => 17, 'dni_back' => 18, 'phone' => 19, 'drivers_license' => 20, 'overall_rating' => 21, 'last_login' => 22, 'registered_at' => 23, 'updated_at' => 24, 'last_location_lat' => 25, 'last_location_lng' => 26, 'last_location_datetime' => 27, 'last_location_locality' => 28, 'last_location_region' => 29, 'last_location_country' => 30, 'timezone' => 31, 'traveling' => 32, 'verified' => 33, 'pwd_reset_code' => 34, 'commission' => 35, 'disabled' => 36, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Users');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_company', 'IdCompany', 'INTEGER', false, null, null);
        $this->addColumn('avatar', 'Avatar', 'VARCHAR', false, 64, null);
        $this->addColumn('fullname', 'Fullname', 'VARCHAR', false, 64, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, 32, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, 32, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 96, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 96, null);
        $this->addColumn('country', 'Country', 'VARCHAR', false, 64, null);
        $this->addColumn('country_code', 'CountryCode', 'VARCHAR', false, 2, null);
        $this->addColumn('home_address', 'HomeAddress', 'VARCHAR', false, 128, null);
        $this->addColumn('providence_code', 'ProvidenceCode', 'VARCHAR', false, 16, null);
        $this->addColumn('providence', 'Providence', 'VARCHAR', false, 56, null);
        $this->addColumn('locality_code', 'LocalityCode', 'VARCHAR', false, 16, null);
        $this->addColumn('locality', 'Locality', 'VARCHAR', false, 48, null);
        $this->addColumn('postal_code', 'PostalCode', 'VARCHAR', false, 16, null);
        $this->addColumn('dni', 'Dni', 'VARCHAR', false, 32, null);
        $this->addColumn('dni_front', 'DniFront', 'VARCHAR', false, 32, null);
        $this->addColumn('dni_back', 'DniBack', 'VARCHAR', false, 32, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 48, null);
        $this->addColumn('drivers_license', 'DriversLicense', 'VARCHAR', false, 48, null);
        $this->addColumn('overall_rating', 'OverallRating', 'DOUBLE', false, null, 0);
        $this->addColumn('last_login', 'LastLogin', 'TIMESTAMP', false, null, null);
        $this->addColumn('registered_at', 'RegisteredAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('last_location_lat', 'LastLocationLat', 'DECIMAL', false, 10, null);
        $this->addColumn('last_location_lng', 'LastLocationLng', 'DECIMAL', false, 11, null);
        $this->addColumn('last_location_datetime', 'LastLocationDatetime', 'TIMESTAMP', false, null, null);
        $this->addColumn('last_location_locality', 'LastLocationLocality', 'VARCHAR', false, 64, null);
        $this->addColumn('last_location_region', 'LastLocationRegion', 'VARCHAR', false, 64, null);
        $this->addColumn('last_location_country', 'LastLocationCountry', 'VARCHAR', false, 24, null);
        $this->addColumn('timezone', 'Timezone', 'VARCHAR', false, 48, null);
        $this->addColumn('traveling', 'Traveling', 'BOOLEAN', false, 1, false);
        $this->addColumn('verified', 'Verified', 'BOOLEAN', true, 1, false);
        $this->addColumn('pwd_reset_code', 'PwdResetCode', 'VARCHAR', false, 8, null);
        $this->addColumn('commission', 'Commission', 'INTEGER', false, null, null);
        $this->addColumn('disabled', 'Disabled', 'BOOLEAN', false, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Users object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UsersTableMap::COL_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_ID_COMPANY);
            $criteria->addSelectColumn(UsersTableMap::COL_AVATAR);
            $criteria->addSelectColumn(UsersTableMap::COL_FULLNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UsersTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(UsersTableMap::COL_COUNTRY_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_HOME_ADDRESS);
            $criteria->addSelectColumn(UsersTableMap::COL_PROVIDENCE_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_PROVIDENCE);
            $criteria->addSelectColumn(UsersTableMap::COL_LOCALITY_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_LOCALITY);
            $criteria->addSelectColumn(UsersTableMap::COL_POSTAL_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_DNI);
            $criteria->addSelectColumn(UsersTableMap::COL_DNI_FRONT);
            $criteria->addSelectColumn(UsersTableMap::COL_DNI_BACK);
            $criteria->addSelectColumn(UsersTableMap::COL_PHONE);
            $criteria->addSelectColumn(UsersTableMap::COL_DRIVERS_LICENSE);
            $criteria->addSelectColumn(UsersTableMap::COL_OVERALL_RATING);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(UsersTableMap::COL_REGISTERED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOCATION_LAT);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOCATION_LNG);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOCATION_DATETIME);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOCATION_LOCALITY);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOCATION_REGION);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOCATION_COUNTRY);
            $criteria->addSelectColumn(UsersTableMap::COL_TIMEZONE);
            $criteria->addSelectColumn(UsersTableMap::COL_TRAVELING);
            $criteria->addSelectColumn(UsersTableMap::COL_VERIFIED);
            $criteria->addSelectColumn(UsersTableMap::COL_PWD_RESET_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_COMMISSION);
            $criteria->addSelectColumn(UsersTableMap::COL_DISABLED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_company');
            $criteria->addSelectColumn($alias . '.avatar');
            $criteria->addSelectColumn($alias . '.fullname');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.country_code');
            $criteria->addSelectColumn($alias . '.home_address');
            $criteria->addSelectColumn($alias . '.providence_code');
            $criteria->addSelectColumn($alias . '.providence');
            $criteria->addSelectColumn($alias . '.locality_code');
            $criteria->addSelectColumn($alias . '.locality');
            $criteria->addSelectColumn($alias . '.postal_code');
            $criteria->addSelectColumn($alias . '.dni');
            $criteria->addSelectColumn($alias . '.dni_front');
            $criteria->addSelectColumn($alias . '.dni_back');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.drivers_license');
            $criteria->addSelectColumn($alias . '.overall_rating');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.registered_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.last_location_lat');
            $criteria->addSelectColumn($alias . '.last_location_lng');
            $criteria->addSelectColumn($alias . '.last_location_datetime');
            $criteria->addSelectColumn($alias . '.last_location_locality');
            $criteria->addSelectColumn($alias . '.last_location_region');
            $criteria->addSelectColumn($alias . '.last_location_country');
            $criteria->addSelectColumn($alias . '.timezone');
            $criteria->addSelectColumn($alias . '.traveling');
            $criteria->addSelectColumn($alias . '.verified');
            $criteria->addSelectColumn($alias . '.pwd_reset_code');
            $criteria->addSelectColumn($alias . '.commission');
            $criteria->addSelectColumn($alias . '.disabled');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Users object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed               $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }

        if ($criteria->containsKey(UsersTableMap::COL_ID) && $criteria->keyContainsValue(UsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsersTableMap::buildTableMap();
