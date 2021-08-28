<?php

namespace Map;

use \UsersConveyances;
use \UsersConveyancesQuery;
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
 * This class defines the structure of the 'users_conveyances' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsersConveyancesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UsersConveyancesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'users_conveyances';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\UsersConveyances';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'UsersConveyances';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'users_conveyances.id';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'users_conveyances.id_user';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'users_conveyances.type';

    /**
     * the column name for the brand field
     */
    const COL_BRAND = 'users_conveyances.brand';

    /**
     * the column name for the model field
     */
    const COL_MODEL = 'users_conveyances.model';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'users_conveyances.year';

    /**
     * the column name for the domain field
     */
    const COL_DOMAIN = 'users_conveyances.domain';

    /**
     * the column name for the main_photo field
     */
    const COL_MAIN_PHOTO = 'users_conveyances.main_photo';

    /**
     * the column name for the identification_card field
     */
    const COL_IDENTIFICATION_CARD = 'users_conveyances.identification_card';

    /**
     * the column name for the insurance_policy field
     */
    const COL_INSURANCE_POLICY = 'users_conveyances.insurance_policy';

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
        self::TYPE_PHPNAME       => array('Id', 'IdUser', 'Type', 'Brand', 'Model', 'Year', 'Domain', 'MainPhoto', 'IdentificationCard', 'InsurancePolicy', ),
        self::TYPE_CAMELNAME     => array('id', 'idUser', 'type', 'brand', 'model', 'year', 'domain', 'mainPhoto', 'identificationCard', 'insurancePolicy', ),
        self::TYPE_COLNAME       => array(UsersConveyancesTableMap::COL_ID, UsersConveyancesTableMap::COL_ID_USER, UsersConveyancesTableMap::COL_TYPE, UsersConveyancesTableMap::COL_BRAND, UsersConveyancesTableMap::COL_MODEL, UsersConveyancesTableMap::COL_YEAR, UsersConveyancesTableMap::COL_DOMAIN, UsersConveyancesTableMap::COL_MAIN_PHOTO, UsersConveyancesTableMap::COL_IDENTIFICATION_CARD, UsersConveyancesTableMap::COL_INSURANCE_POLICY, ),
        self::TYPE_FIELDNAME     => array('id', 'id_user', 'type', 'brand', 'model', 'year', 'domain', 'main_photo', 'identification_card', 'insurance_policy', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdUser' => 1, 'Type' => 2, 'Brand' => 3, 'Model' => 4, 'Year' => 5, 'Domain' => 6, 'MainPhoto' => 7, 'IdentificationCard' => 8, 'InsurancePolicy' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idUser' => 1, 'type' => 2, 'brand' => 3, 'model' => 4, 'year' => 5, 'domain' => 6, 'mainPhoto' => 7, 'identificationCard' => 8, 'insurancePolicy' => 9, ),
        self::TYPE_COLNAME       => array(UsersConveyancesTableMap::COL_ID => 0, UsersConveyancesTableMap::COL_ID_USER => 1, UsersConveyancesTableMap::COL_TYPE => 2, UsersConveyancesTableMap::COL_BRAND => 3, UsersConveyancesTableMap::COL_MODEL => 4, UsersConveyancesTableMap::COL_YEAR => 5, UsersConveyancesTableMap::COL_DOMAIN => 6, UsersConveyancesTableMap::COL_MAIN_PHOTO => 7, UsersConveyancesTableMap::COL_IDENTIFICATION_CARD => 8, UsersConveyancesTableMap::COL_INSURANCE_POLICY => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_user' => 1, 'type' => 2, 'brand' => 3, 'model' => 4, 'year' => 5, 'domain' => 6, 'main_photo' => 7, 'identification_card' => 8, 'insurance_policy' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('users_conveyances');
        $this->setPhpName('UsersConveyances');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\UsersConveyances');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_user', 'IdUser', 'INTEGER', false, null, null);
        $this->addColumn('type', 'Type', 'INTEGER', false, null, null);
        $this->addColumn('brand', 'Brand', 'VARCHAR', false, 64, null);
        $this->addColumn('model', 'Model', 'VARCHAR', false, 64, null);
        $this->addColumn('year', 'Year', 'INTEGER', false, null, null);
        $this->addColumn('domain', 'Domain', 'VARCHAR', false, 96, null);
        $this->addColumn('main_photo', 'MainPhoto', 'VARCHAR', false, 64, null);
        $this->addColumn('identification_card', 'IdentificationCard', 'VARCHAR', false, 64, null);
        $this->addColumn('insurance_policy', 'InsurancePolicy', 'VARCHAR', false, 255, null);
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
        return $withPrefix ? UsersConveyancesTableMap::CLASS_DEFAULT : UsersConveyancesTableMap::OM_CLASS;
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
     * @return array           (UsersConveyances object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersConveyancesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersConveyancesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersConveyancesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersConveyancesTableMap::OM_CLASS;
            /** @var UsersConveyances $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersConveyancesTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersConveyancesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersConveyancesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UsersConveyances $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersConveyancesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_ID);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_ID_USER);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_TYPE);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_BRAND);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_MODEL);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_YEAR);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_DOMAIN);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_MAIN_PHOTO);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_IDENTIFICATION_CARD);
            $criteria->addSelectColumn(UsersConveyancesTableMap::COL_INSURANCE_POLICY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.brand');
            $criteria->addSelectColumn($alias . '.model');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.domain');
            $criteria->addSelectColumn($alias . '.main_photo');
            $criteria->addSelectColumn($alias . '.identification_card');
            $criteria->addSelectColumn($alias . '.insurance_policy');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersConveyancesTableMap::DATABASE_NAME)->getTable(UsersConveyancesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsersConveyancesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsersConveyancesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsersConveyancesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UsersConveyances or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UsersConveyances object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersConveyancesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \UsersConveyances) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersConveyancesTableMap::DATABASE_NAME);
            $criteria->add(UsersConveyancesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersConveyancesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersConveyancesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersConveyancesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users_conveyances table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersConveyancesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UsersConveyances or Criteria object.
     *
     * @param mixed               $criteria Criteria or UsersConveyances object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersConveyancesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UsersConveyances object
        }

        if ($criteria->containsKey(UsersConveyancesTableMap::COL_ID) && $criteria->keyContainsValue(UsersConveyancesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersConveyancesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersConveyancesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersConveyancesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsersConveyancesTableMap::buildTableMap();
