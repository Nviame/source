<?php

namespace Map;

use \Commerces;
use \CommercesQuery;
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
 * This class defines the structure of the 'commerces' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CommercesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CommercesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'commerces';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Commerces';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Commerces';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 22;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 22;

    /**
     * the column name for the id field
     */
    const COL_ID = 'commerces.id';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'commerces.id_user';

    /**
     * the column name for the id_position_commerce field
     */
    const COL_ID_POSITION_COMMERCE = 'commerces.id_position_commerce';

    /**
     * the column name for the id_heading_commerce field
     */
    const COL_ID_HEADING_COMMERCE = 'commerces.id_heading_commerce';

    /**
     * the column name for the id_province field
     */
    const COL_ID_PROVINCE = 'commerces.id_province';

    /**
     * the column name for the id_locality field
     */
    const COL_ID_LOCALITY = 'commerces.id_locality';

    /**
     * the column name for the token field
     */
    const COL_TOKEN = 'commerces.token';

    /**
     * the column name for the logo field
     */
    const COL_LOGO = 'commerces.logo';

    /**
     * the column name for the business_name field
     */
    const COL_BUSINESS_NAME = 'commerces.business_name';

    /**
     * the column name for the cuit_cuil field
     */
    const COL_CUIT_CUIL = 'commerces.cuit_cuil';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'commerces.name';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'commerces.phone';

    /**
     * the column name for the phone_personal field
     */
    const COL_PHONE_PERSONAL = 'commerces.phone_personal';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'commerces.email';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'commerces.password';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'commerces.address';

    /**
     * the column name for the address_lat field
     */
    const COL_ADDRESS_LAT = 'commerces.address_lat';

    /**
     * the column name for the address_lng field
     */
    const COL_ADDRESS_LNG = 'commerces.address_lng';

    /**
     * the column name for the address_locality field
     */
    const COL_ADDRESS_LOCALITY = 'commerces.address_locality';

    /**
     * the column name for the address_region field
     */
    const COL_ADDRESS_REGION = 'commerces.address_region';

    /**
     * the column name for the address_country field
     */
    const COL_ADDRESS_COUNTRY = 'commerces.address_country';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'commerces.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdUser', 'IdPositionCommerce', 'IdHeadingCommerce', 'IdProvince', 'IdLocality', 'Token', 'Logo', 'BusinessName', 'CuitCuil', 'Name', 'Phone', 'PhonePersonal', 'Email', 'Password', 'Address', 'AddressLat', 'AddressLng', 'AddressLocality', 'AddressRegion', 'AddressCountry', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idUser', 'idPositionCommerce', 'idHeadingCommerce', 'idProvince', 'idLocality', 'token', 'logo', 'businessName', 'cuitCuil', 'name', 'phone', 'phonePersonal', 'email', 'password', 'address', 'addressLat', 'addressLng', 'addressLocality', 'addressRegion', 'addressCountry', 'updatedAt', ),
        self::TYPE_COLNAME       => array(CommercesTableMap::COL_ID, CommercesTableMap::COL_ID_USER, CommercesTableMap::COL_ID_POSITION_COMMERCE, CommercesTableMap::COL_ID_HEADING_COMMERCE, CommercesTableMap::COL_ID_PROVINCE, CommercesTableMap::COL_ID_LOCALITY, CommercesTableMap::COL_TOKEN, CommercesTableMap::COL_LOGO, CommercesTableMap::COL_BUSINESS_NAME, CommercesTableMap::COL_CUIT_CUIL, CommercesTableMap::COL_NAME, CommercesTableMap::COL_PHONE, CommercesTableMap::COL_PHONE_PERSONAL, CommercesTableMap::COL_EMAIL, CommercesTableMap::COL_PASSWORD, CommercesTableMap::COL_ADDRESS, CommercesTableMap::COL_ADDRESS_LAT, CommercesTableMap::COL_ADDRESS_LNG, CommercesTableMap::COL_ADDRESS_LOCALITY, CommercesTableMap::COL_ADDRESS_REGION, CommercesTableMap::COL_ADDRESS_COUNTRY, CommercesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_user', 'id_position_commerce', 'id_heading_commerce', 'id_province', 'id_locality', 'token', 'logo', 'business_name', 'cuit_cuil', 'name', 'phone', 'phone_personal', 'email', 'password', 'address', 'address_lat', 'address_lng', 'address_locality', 'address_region', 'address_country', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdUser' => 1, 'IdPositionCommerce' => 2, 'IdHeadingCommerce' => 3, 'IdProvince' => 4, 'IdLocality' => 5, 'Token' => 6, 'Logo' => 7, 'BusinessName' => 8, 'CuitCuil' => 9, 'Name' => 10, 'Phone' => 11, 'PhonePersonal' => 12, 'Email' => 13, 'Password' => 14, 'Address' => 15, 'AddressLat' => 16, 'AddressLng' => 17, 'AddressLocality' => 18, 'AddressRegion' => 19, 'AddressCountry' => 20, 'UpdatedAt' => 21, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idUser' => 1, 'idPositionCommerce' => 2, 'idHeadingCommerce' => 3, 'idProvince' => 4, 'idLocality' => 5, 'token' => 6, 'logo' => 7, 'businessName' => 8, 'cuitCuil' => 9, 'name' => 10, 'phone' => 11, 'phonePersonal' => 12, 'email' => 13, 'password' => 14, 'address' => 15, 'addressLat' => 16, 'addressLng' => 17, 'addressLocality' => 18, 'addressRegion' => 19, 'addressCountry' => 20, 'updatedAt' => 21, ),
        self::TYPE_COLNAME       => array(CommercesTableMap::COL_ID => 0, CommercesTableMap::COL_ID_USER => 1, CommercesTableMap::COL_ID_POSITION_COMMERCE => 2, CommercesTableMap::COL_ID_HEADING_COMMERCE => 3, CommercesTableMap::COL_ID_PROVINCE => 4, CommercesTableMap::COL_ID_LOCALITY => 5, CommercesTableMap::COL_TOKEN => 6, CommercesTableMap::COL_LOGO => 7, CommercesTableMap::COL_BUSINESS_NAME => 8, CommercesTableMap::COL_CUIT_CUIL => 9, CommercesTableMap::COL_NAME => 10, CommercesTableMap::COL_PHONE => 11, CommercesTableMap::COL_PHONE_PERSONAL => 12, CommercesTableMap::COL_EMAIL => 13, CommercesTableMap::COL_PASSWORD => 14, CommercesTableMap::COL_ADDRESS => 15, CommercesTableMap::COL_ADDRESS_LAT => 16, CommercesTableMap::COL_ADDRESS_LNG => 17, CommercesTableMap::COL_ADDRESS_LOCALITY => 18, CommercesTableMap::COL_ADDRESS_REGION => 19, CommercesTableMap::COL_ADDRESS_COUNTRY => 20, CommercesTableMap::COL_UPDATED_AT => 21, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_user' => 1, 'id_position_commerce' => 2, 'id_heading_commerce' => 3, 'id_province' => 4, 'id_locality' => 5, 'token' => 6, 'logo' => 7, 'business_name' => 8, 'cuit_cuil' => 9, 'name' => 10, 'phone' => 11, 'phone_personal' => 12, 'email' => 13, 'password' => 14, 'address' => 15, 'address_lat' => 16, 'address_lng' => 17, 'address_locality' => 18, 'address_region' => 19, 'address_country' => 20, 'updated_at' => 21, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
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
        $this->setName('commerces');
        $this->setPhpName('Commerces');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Commerces');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_user', 'IdUser', 'INTEGER', false, null, null);
        $this->addForeignKey('id_position_commerce', 'IdPositionCommerce', 'INTEGER', 'positions_commerce', 'id', false, null, null);
        $this->addForeignKey('id_heading_commerce', 'IdHeadingCommerce', 'INTEGER', 'headings_commerce', 'id', false, null, null);
        $this->addForeignKey('id_province', 'IdProvince', 'INTEGER', 'provinces', 'id', false, null, null);
        $this->addForeignKey('id_locality', 'IdLocality', 'INTEGER', 'provinces_localities', 'id', false, null, null);
        $this->addColumn('token', 'Token', 'LONGVARCHAR', false, null, null);
        $this->addColumn('logo', 'Logo', 'VARCHAR', false, 64, null);
        $this->addColumn('business_name', 'BusinessName', 'VARCHAR', false, 96, null);
        $this->addColumn('cuit_cuil', 'CuitCuil', 'VARCHAR', false, 48, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 64, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 16, null);
        $this->addColumn('phone_personal', 'PhonePersonal', 'VARCHAR', false, 16, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 64, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 96, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 255, null);
        $this->addColumn('address_lat', 'AddressLat', 'VARCHAR', false, 64, null);
        $this->addColumn('address_lng', 'AddressLng', 'VARCHAR', false, 64, null);
        $this->addColumn('address_locality', 'AddressLocality', 'VARCHAR', false, 64, null);
        $this->addColumn('address_region', 'AddressRegion', 'VARCHAR', false, 64, null);
        $this->addColumn('address_country', 'AddressCountry', 'VARCHAR', false, 24, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PositionsCommerce', '\\PositionsCommerce', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_position_commerce',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
        $this->addRelation('HeadingsCommerce', '\\HeadingsCommerce', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_heading_commerce',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
        $this->addRelation('Provinces', '\\Provinces', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_province',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
        $this->addRelation('ProvincesLocalities', '\\ProvincesLocalities', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_locality',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
        $this->addRelation('CommercesBranchOffices', '\\CommercesBranchOffices', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_commerce',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'CommercesBranchOfficess', false);
        $this->addRelation('CommercesPreferences', '\\CommercesPreferences', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_commerce',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'CommercesPreferencess', false);
        $this->addRelation('CommercesRates', '\\CommercesRates', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_commerce',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'CommercesRatess', false);
        $this->addRelation('CommercesReminders', '\\CommercesReminders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_commerce',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'CommercesReminderss', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to commerces     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CommercesBranchOfficesTableMap::clearInstancePool();
        CommercesPreferencesTableMap::clearInstancePool();
        CommercesRatesTableMap::clearInstancePool();
        CommercesRemindersTableMap::clearInstancePool();
    }

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
        return $withPrefix ? CommercesTableMap::CLASS_DEFAULT : CommercesTableMap::OM_CLASS;
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
     * @return array           (Commerces object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CommercesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CommercesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CommercesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CommercesTableMap::OM_CLASS;
            /** @var Commerces $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CommercesTableMap::addInstanceToPool($obj, $key);
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
            $key = CommercesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CommercesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Commerces $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CommercesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CommercesTableMap::COL_ID);
            $criteria->addSelectColumn(CommercesTableMap::COL_ID_USER);
            $criteria->addSelectColumn(CommercesTableMap::COL_ID_POSITION_COMMERCE);
            $criteria->addSelectColumn(CommercesTableMap::COL_ID_HEADING_COMMERCE);
            $criteria->addSelectColumn(CommercesTableMap::COL_ID_PROVINCE);
            $criteria->addSelectColumn(CommercesTableMap::COL_ID_LOCALITY);
            $criteria->addSelectColumn(CommercesTableMap::COL_TOKEN);
            $criteria->addSelectColumn(CommercesTableMap::COL_LOGO);
            $criteria->addSelectColumn(CommercesTableMap::COL_BUSINESS_NAME);
            $criteria->addSelectColumn(CommercesTableMap::COL_CUIT_CUIL);
            $criteria->addSelectColumn(CommercesTableMap::COL_NAME);
            $criteria->addSelectColumn(CommercesTableMap::COL_PHONE);
            $criteria->addSelectColumn(CommercesTableMap::COL_PHONE_PERSONAL);
            $criteria->addSelectColumn(CommercesTableMap::COL_EMAIL);
            $criteria->addSelectColumn(CommercesTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(CommercesTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(CommercesTableMap::COL_ADDRESS_LAT);
            $criteria->addSelectColumn(CommercesTableMap::COL_ADDRESS_LNG);
            $criteria->addSelectColumn(CommercesTableMap::COL_ADDRESS_LOCALITY);
            $criteria->addSelectColumn(CommercesTableMap::COL_ADDRESS_REGION);
            $criteria->addSelectColumn(CommercesTableMap::COL_ADDRESS_COUNTRY);
            $criteria->addSelectColumn(CommercesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.id_position_commerce');
            $criteria->addSelectColumn($alias . '.id_heading_commerce');
            $criteria->addSelectColumn($alias . '.id_province');
            $criteria->addSelectColumn($alias . '.id_locality');
            $criteria->addSelectColumn($alias . '.token');
            $criteria->addSelectColumn($alias . '.logo');
            $criteria->addSelectColumn($alias . '.business_name');
            $criteria->addSelectColumn($alias . '.cuit_cuil');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.phone_personal');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.address_lat');
            $criteria->addSelectColumn($alias . '.address_lng');
            $criteria->addSelectColumn($alias . '.address_locality');
            $criteria->addSelectColumn($alias . '.address_region');
            $criteria->addSelectColumn($alias . '.address_country');
            $criteria->addSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(CommercesTableMap::DATABASE_NAME)->getTable(CommercesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CommercesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CommercesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CommercesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Commerces or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Commerces object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Commerces) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CommercesTableMap::DATABASE_NAME);
            $criteria->add(CommercesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CommercesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CommercesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CommercesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the commerces table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CommercesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Commerces or Criteria object.
     *
     * @param mixed               $criteria Criteria or Commerces object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Commerces object
        }

        if ($criteria->containsKey(CommercesTableMap::COL_ID) && $criteria->keyContainsValue(CommercesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CommercesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CommercesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CommercesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CommercesTableMap::buildTableMap();
