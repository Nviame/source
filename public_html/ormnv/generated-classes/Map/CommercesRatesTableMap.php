<?php

namespace Map;

use \CommercesRates;
use \CommercesRatesQuery;
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
 * This class defines the structure of the 'commerces_rates' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CommercesRatesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CommercesRatesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'commerces_rates';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CommercesRates';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CommercesRates';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'commerces_rates.id';

    /**
     * the column name for the id_commerce field
     */
    const COL_ID_COMMERCE = 'commerces_rates.id_commerce';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'commerces_rates.name';

    /**
     * the column name for the km field
     */
    const COL_KM = 'commerces_rates.km';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'commerces_rates.price';

    /**
     * the column name for the registered_at field
     */
    const COL_REGISTERED_AT = 'commerces_rates.registered_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'commerces_rates.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdCommerce', 'Name', 'Km', 'Price', 'RegisteredAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idCommerce', 'name', 'km', 'price', 'registeredAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(CommercesRatesTableMap::COL_ID, CommercesRatesTableMap::COL_ID_COMMERCE, CommercesRatesTableMap::COL_NAME, CommercesRatesTableMap::COL_KM, CommercesRatesTableMap::COL_PRICE, CommercesRatesTableMap::COL_REGISTERED_AT, CommercesRatesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_commerce', 'name', 'km', 'price', 'registered_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdCommerce' => 1, 'Name' => 2, 'Km' => 3, 'Price' => 4, 'RegisteredAt' => 5, 'UpdatedAt' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idCommerce' => 1, 'name' => 2, 'km' => 3, 'price' => 4, 'registeredAt' => 5, 'updatedAt' => 6, ),
        self::TYPE_COLNAME       => array(CommercesRatesTableMap::COL_ID => 0, CommercesRatesTableMap::COL_ID_COMMERCE => 1, CommercesRatesTableMap::COL_NAME => 2, CommercesRatesTableMap::COL_KM => 3, CommercesRatesTableMap::COL_PRICE => 4, CommercesRatesTableMap::COL_REGISTERED_AT => 5, CommercesRatesTableMap::COL_UPDATED_AT => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_commerce' => 1, 'name' => 2, 'km' => 3, 'price' => 4, 'registered_at' => 5, 'updated_at' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('commerces_rates');
        $this->setPhpName('CommercesRates');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CommercesRates');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('id_commerce', 'IdCommerce', 'INTEGER', 'commerces', 'id', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 64, null);
        $this->addColumn('km', 'Km', 'FLOAT', false, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', false, 10, null);
        $this->addColumn('registered_at', 'RegisteredAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Commerces', '\\Commerces', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_commerce',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
        $this->addRelation('CommercesShipments', '\\CommercesShipments', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_rate',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', 'CommercesShipmentss', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to commerces_rates     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CommercesShipmentsTableMap::clearInstancePool();
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
        return $withPrefix ? CommercesRatesTableMap::CLASS_DEFAULT : CommercesRatesTableMap::OM_CLASS;
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
     * @return array           (CommercesRates object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CommercesRatesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CommercesRatesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CommercesRatesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CommercesRatesTableMap::OM_CLASS;
            /** @var CommercesRates $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CommercesRatesTableMap::addInstanceToPool($obj, $key);
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
            $key = CommercesRatesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CommercesRatesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CommercesRates $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CommercesRatesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CommercesRatesTableMap::COL_ID);
            $criteria->addSelectColumn(CommercesRatesTableMap::COL_ID_COMMERCE);
            $criteria->addSelectColumn(CommercesRatesTableMap::COL_NAME);
            $criteria->addSelectColumn(CommercesRatesTableMap::COL_KM);
            $criteria->addSelectColumn(CommercesRatesTableMap::COL_PRICE);
            $criteria->addSelectColumn(CommercesRatesTableMap::COL_REGISTERED_AT);
            $criteria->addSelectColumn(CommercesRatesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_commerce');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.km');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.registered_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(CommercesRatesTableMap::DATABASE_NAME)->getTable(CommercesRatesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CommercesRatesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CommercesRatesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CommercesRatesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CommercesRates or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CommercesRates object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesRatesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CommercesRates) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CommercesRatesTableMap::DATABASE_NAME);
            $criteria->add(CommercesRatesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CommercesRatesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CommercesRatesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CommercesRatesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the commerces_rates table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CommercesRatesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CommercesRates or Criteria object.
     *
     * @param mixed               $criteria Criteria or CommercesRates object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesRatesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CommercesRates object
        }

        if ($criteria->containsKey(CommercesRatesTableMap::COL_ID) && $criteria->keyContainsValue(CommercesRatesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CommercesRatesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CommercesRatesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CommercesRatesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CommercesRatesTableMap::buildTableMap();
