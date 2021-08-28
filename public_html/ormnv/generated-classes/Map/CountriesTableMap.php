<?php

namespace Map;

use \Countries;
use \CountriesQuery;
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
 * This class defines the structure of the 'countries' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CountriesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CountriesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'countries';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Countries';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Countries';

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
    const COL_ID = 'countries.id';

    /**
     * the column name for the iso field
     */
    const COL_ISO = 'countries.iso';

    /**
     * the column name for the iso2 field
     */
    const COL_ISO2 = 'countries.iso2';

    /**
     * the column name for the iso3 field
     */
    const COL_ISO3 = 'countries.iso3';

    /**
     * the column name for the prefix field
     */
    const COL_PREFIX = 'countries.prefix';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'countries.name';

    /**
     * the column name for the continent field
     */
    const COL_CONTINENT = 'countries.continent';

    /**
     * the column name for the subcontinent field
     */
    const COL_SUBCONTINENT = 'countries.subcontinent';

    /**
     * the column name for the currency_iso field
     */
    const COL_CURRENCY_ISO = 'countries.currency_iso';

    /**
     * the column name for the currency_name field
     */
    const COL_CURRENCY_NAME = 'countries.currency_name';

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
        self::TYPE_PHPNAME       => array('Id', 'Iso', 'Iso2', 'Iso3', 'Prefix', 'Name', 'Continent', 'Subcontinent', 'CurrencyIso', 'CurrencyName', ),
        self::TYPE_CAMELNAME     => array('id', 'iso', 'iso2', 'iso3', 'prefix', 'name', 'continent', 'subcontinent', 'currencyIso', 'currencyName', ),
        self::TYPE_COLNAME       => array(CountriesTableMap::COL_ID, CountriesTableMap::COL_ISO, CountriesTableMap::COL_ISO2, CountriesTableMap::COL_ISO3, CountriesTableMap::COL_PREFIX, CountriesTableMap::COL_NAME, CountriesTableMap::COL_CONTINENT, CountriesTableMap::COL_SUBCONTINENT, CountriesTableMap::COL_CURRENCY_ISO, CountriesTableMap::COL_CURRENCY_NAME, ),
        self::TYPE_FIELDNAME     => array('id', 'iso', 'iso2', 'iso3', 'prefix', 'name', 'continent', 'subcontinent', 'currency_iso', 'currency_name', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Iso' => 1, 'Iso2' => 2, 'Iso3' => 3, 'Prefix' => 4, 'Name' => 5, 'Continent' => 6, 'Subcontinent' => 7, 'CurrencyIso' => 8, 'CurrencyName' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'iso' => 1, 'iso2' => 2, 'iso3' => 3, 'prefix' => 4, 'name' => 5, 'continent' => 6, 'subcontinent' => 7, 'currencyIso' => 8, 'currencyName' => 9, ),
        self::TYPE_COLNAME       => array(CountriesTableMap::COL_ID => 0, CountriesTableMap::COL_ISO => 1, CountriesTableMap::COL_ISO2 => 2, CountriesTableMap::COL_ISO3 => 3, CountriesTableMap::COL_PREFIX => 4, CountriesTableMap::COL_NAME => 5, CountriesTableMap::COL_CONTINENT => 6, CountriesTableMap::COL_SUBCONTINENT => 7, CountriesTableMap::COL_CURRENCY_ISO => 8, CountriesTableMap::COL_CURRENCY_NAME => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'iso' => 1, 'iso2' => 2, 'iso3' => 3, 'prefix' => 4, 'name' => 5, 'continent' => 6, 'subcontinent' => 7, 'currency_iso' => 8, 'currency_name' => 9, ),
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
        $this->setName('countries');
        $this->setPhpName('Countries');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Countries');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('iso', 'Iso', 'SMALLINT', true, null, null);
        $this->addColumn('iso2', 'Iso2', 'CHAR', true, 2, null);
        $this->addColumn('iso3', 'Iso3', 'CHAR', true, 3, null);
        $this->addColumn('prefix', 'Prefix', 'SMALLINT', true, 5, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('continent', 'Continent', 'VARCHAR', false, 16, null);
        $this->addColumn('subcontinent', 'Subcontinent', 'VARCHAR', false, 32, null);
        $this->addColumn('currency_iso', 'CurrencyIso', 'VARCHAR', false, 3, null);
        $this->addColumn('currency_name', 'CurrencyName', 'VARCHAR', false, 100, null);
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
        return $withPrefix ? CountriesTableMap::CLASS_DEFAULT : CountriesTableMap::OM_CLASS;
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
     * @return array           (Countries object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CountriesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CountriesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CountriesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CountriesTableMap::OM_CLASS;
            /** @var Countries $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CountriesTableMap::addInstanceToPool($obj, $key);
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
            $key = CountriesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CountriesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Countries $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CountriesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CountriesTableMap::COL_ID);
            $criteria->addSelectColumn(CountriesTableMap::COL_ISO);
            $criteria->addSelectColumn(CountriesTableMap::COL_ISO2);
            $criteria->addSelectColumn(CountriesTableMap::COL_ISO3);
            $criteria->addSelectColumn(CountriesTableMap::COL_PREFIX);
            $criteria->addSelectColumn(CountriesTableMap::COL_NAME);
            $criteria->addSelectColumn(CountriesTableMap::COL_CONTINENT);
            $criteria->addSelectColumn(CountriesTableMap::COL_SUBCONTINENT);
            $criteria->addSelectColumn(CountriesTableMap::COL_CURRENCY_ISO);
            $criteria->addSelectColumn(CountriesTableMap::COL_CURRENCY_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.iso');
            $criteria->addSelectColumn($alias . '.iso2');
            $criteria->addSelectColumn($alias . '.iso3');
            $criteria->addSelectColumn($alias . '.prefix');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.continent');
            $criteria->addSelectColumn($alias . '.subcontinent');
            $criteria->addSelectColumn($alias . '.currency_iso');
            $criteria->addSelectColumn($alias . '.currency_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(CountriesTableMap::DATABASE_NAME)->getTable(CountriesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CountriesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CountriesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CountriesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Countries or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Countries object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CountriesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Countries) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CountriesTableMap::DATABASE_NAME);
            $criteria->add(CountriesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CountriesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CountriesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CountriesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the countries table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CountriesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Countries or Criteria object.
     *
     * @param mixed               $criteria Criteria or Countries object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountriesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Countries object
        }

        if ($criteria->containsKey(CountriesTableMap::COL_ID) && $criteria->keyContainsValue(CountriesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CountriesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CountriesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CountriesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CountriesTableMap::buildTableMap();
