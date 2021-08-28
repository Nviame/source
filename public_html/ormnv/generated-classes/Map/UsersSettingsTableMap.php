<?php

namespace Map;

use \UsersSettings;
use \UsersSettingsQuery;
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
 * This class defines the structure of the 'users_settings' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsersSettingsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UsersSettingsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'users_settings';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\UsersSettings';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'UsersSettings';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id field
     */
    const COL_ID = 'users_settings.id';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'users_settings.user_id';

    /**
     * the column name for the push_new_shipments field
     */
    const COL_PUSH_NEW_SHIPMENTS = 'users_settings.push_new_shipments';

    /**
     * the column name for the push_offers field
     */
    const COL_PUSH_OFFERS = 'users_settings.push_offers';

    /**
     * the column name for the push_chats field
     */
    const COL_PUSH_CHATS = 'users_settings.push_chats';

    /**
     * the column name for the online field
     */
    const COL_ONLINE = 'users_settings.online';

    /**
     * the column name for the rate_base_price field
     */
    const COL_RATE_BASE_PRICE = 'users_settings.rate_base_price';

    /**
     * the column name for the rate_base_price_enabled field
     */
    const COL_RATE_BASE_PRICE_ENABLED = 'users_settings.rate_base_price_enabled';

    /**
     * the column name for the rate_price_km field
     */
    const COL_RATE_PRICE_KM = 'users_settings.rate_price_km';

    /**
     * the column name for the rate_price_km_enabled field
     */
    const COL_RATE_PRICE_KM_ENABLED = 'users_settings.rate_price_km_enabled';

    /**
     * the column name for the rate_percent_night_schedule field
     */
    const COL_RATE_PERCENT_NIGHT_SCHEDULE = 'users_settings.rate_percent_night_schedule';

    /**
     * the column name for the rate_percent_night_schedule_enabled field
     */
    const COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED = 'users_settings.rate_percent_night_schedule_enabled';

    /**
     * the column name for the rate_percent_non_business_day field
     */
    const COL_RATE_PERCENT_NON_BUSINESS_DAY = 'users_settings.rate_percent_non_business_day';

    /**
     * the column name for the rate_percent_non_business_day_enabled field
     */
    const COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED = 'users_settings.rate_percent_non_business_day_enabled';

    /**
     * the column name for the shipments_max_offers field
     */
    const COL_SHIPMENTS_MAX_OFFERS = 'users_settings.shipments_max_offers';

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
        self::TYPE_PHPNAME       => array('Id', 'UserId', 'PushNewShipments', 'PushOffers', 'PushChats', 'Online', 'RateBasePrice', 'RateBasePriceEnabled', 'RatePriceKm', 'RatePriceKmEnabled', 'RatePercentNightSchedule', 'RatePercentNightScheduleEnabled', 'RatePercentNonBusinessDay', 'RatePercentNonBusinessDayEnabled', 'ShipmentsMaxOffers', ),
        self::TYPE_CAMELNAME     => array('id', 'userId', 'pushNewShipments', 'pushOffers', 'pushChats', 'online', 'rateBasePrice', 'rateBasePriceEnabled', 'ratePriceKm', 'ratePriceKmEnabled', 'ratePercentNightSchedule', 'ratePercentNightScheduleEnabled', 'ratePercentNonBusinessDay', 'ratePercentNonBusinessDayEnabled', 'shipmentsMaxOffers', ),
        self::TYPE_COLNAME       => array(UsersSettingsTableMap::COL_ID, UsersSettingsTableMap::COL_USER_ID, UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS, UsersSettingsTableMap::COL_PUSH_OFFERS, UsersSettingsTableMap::COL_PUSH_CHATS, UsersSettingsTableMap::COL_ONLINE, UsersSettingsTableMap::COL_RATE_BASE_PRICE, UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED, UsersSettingsTableMap::COL_RATE_PRICE_KM, UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED, UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED, UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED, UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS, ),
        self::TYPE_FIELDNAME     => array('id', 'user_id', 'push_new_shipments', 'push_offers', 'push_chats', 'online', 'rate_base_price', 'rate_base_price_enabled', 'rate_price_km', 'rate_price_km_enabled', 'rate_percent_night_schedule', 'rate_percent_night_schedule_enabled', 'rate_percent_non_business_day', 'rate_percent_non_business_day_enabled', 'shipments_max_offers', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserId' => 1, 'PushNewShipments' => 2, 'PushOffers' => 3, 'PushChats' => 4, 'Online' => 5, 'RateBasePrice' => 6, 'RateBasePriceEnabled' => 7, 'RatePriceKm' => 8, 'RatePriceKmEnabled' => 9, 'RatePercentNightSchedule' => 10, 'RatePercentNightScheduleEnabled' => 11, 'RatePercentNonBusinessDay' => 12, 'RatePercentNonBusinessDayEnabled' => 13, 'ShipmentsMaxOffers' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userId' => 1, 'pushNewShipments' => 2, 'pushOffers' => 3, 'pushChats' => 4, 'online' => 5, 'rateBasePrice' => 6, 'rateBasePriceEnabled' => 7, 'ratePriceKm' => 8, 'ratePriceKmEnabled' => 9, 'ratePercentNightSchedule' => 10, 'ratePercentNightScheduleEnabled' => 11, 'ratePercentNonBusinessDay' => 12, 'ratePercentNonBusinessDayEnabled' => 13, 'shipmentsMaxOffers' => 14, ),
        self::TYPE_COLNAME       => array(UsersSettingsTableMap::COL_ID => 0, UsersSettingsTableMap::COL_USER_ID => 1, UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS => 2, UsersSettingsTableMap::COL_PUSH_OFFERS => 3, UsersSettingsTableMap::COL_PUSH_CHATS => 4, UsersSettingsTableMap::COL_ONLINE => 5, UsersSettingsTableMap::COL_RATE_BASE_PRICE => 6, UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED => 7, UsersSettingsTableMap::COL_RATE_PRICE_KM => 8, UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED => 9, UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE => 10, UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED => 11, UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY => 12, UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED => 13, UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS => 14, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'user_id' => 1, 'push_new_shipments' => 2, 'push_offers' => 3, 'push_chats' => 4, 'online' => 5, 'rate_base_price' => 6, 'rate_base_price_enabled' => 7, 'rate_price_km' => 8, 'rate_price_km_enabled' => 9, 'rate_percent_night_schedule' => 10, 'rate_percent_night_schedule_enabled' => 11, 'rate_percent_non_business_day' => 12, 'rate_percent_non_business_day_enabled' => 13, 'shipments_max_offers' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
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
        $this->setName('users_settings');
        $this->setPhpName('UsersSettings');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\UsersSettings');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('user_id', 'UserId', 'INTEGER', false, null, null);
        $this->addColumn('push_new_shipments', 'PushNewShipments', 'BOOLEAN', false, 1, true);
        $this->addColumn('push_offers', 'PushOffers', 'BOOLEAN', false, 1, true);
        $this->addColumn('push_chats', 'PushChats', 'BOOLEAN', false, 1, true);
        $this->addColumn('online', 'Online', 'BOOLEAN', false, 1, true);
        $this->addColumn('rate_base_price', 'RateBasePrice', 'DOUBLE', false, null, null);
        $this->addColumn('rate_base_price_enabled', 'RateBasePriceEnabled', 'BOOLEAN', false, 1, null);
        $this->addColumn('rate_price_km', 'RatePriceKm', 'DOUBLE', false, null, null);
        $this->addColumn('rate_price_km_enabled', 'RatePriceKmEnabled', 'BOOLEAN', false, 1, null);
        $this->addColumn('rate_percent_night_schedule', 'RatePercentNightSchedule', 'DOUBLE', false, null, null);
        $this->addColumn('rate_percent_night_schedule_enabled', 'RatePercentNightScheduleEnabled', 'BOOLEAN', false, 1, null);
        $this->addColumn('rate_percent_non_business_day', 'RatePercentNonBusinessDay', 'DOUBLE', false, null, null);
        $this->addColumn('rate_percent_non_business_day_enabled', 'RatePercentNonBusinessDayEnabled', 'BOOLEAN', false, 1, null);
        $this->addColumn('shipments_max_offers', 'ShipmentsMaxOffers', 'INTEGER', false, null, null);
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
        return $withPrefix ? UsersSettingsTableMap::CLASS_DEFAULT : UsersSettingsTableMap::OM_CLASS;
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
     * @return array           (UsersSettings object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersSettingsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersSettingsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersSettingsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersSettingsTableMap::OM_CLASS;
            /** @var UsersSettings $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersSettingsTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersSettingsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersSettingsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UsersSettings $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersSettingsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_ID);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_PUSH_OFFERS);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_PUSH_CHATS);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_ONLINE);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_BASE_PRICE);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_PRICE_KM);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED);
            $criteria->addSelectColumn(UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.push_new_shipments');
            $criteria->addSelectColumn($alias . '.push_offers');
            $criteria->addSelectColumn($alias . '.push_chats');
            $criteria->addSelectColumn($alias . '.online');
            $criteria->addSelectColumn($alias . '.rate_base_price');
            $criteria->addSelectColumn($alias . '.rate_base_price_enabled');
            $criteria->addSelectColumn($alias . '.rate_price_km');
            $criteria->addSelectColumn($alias . '.rate_price_km_enabled');
            $criteria->addSelectColumn($alias . '.rate_percent_night_schedule');
            $criteria->addSelectColumn($alias . '.rate_percent_night_schedule_enabled');
            $criteria->addSelectColumn($alias . '.rate_percent_non_business_day');
            $criteria->addSelectColumn($alias . '.rate_percent_non_business_day_enabled');
            $criteria->addSelectColumn($alias . '.shipments_max_offers');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersSettingsTableMap::DATABASE_NAME)->getTable(UsersSettingsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsersSettingsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsersSettingsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsersSettingsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UsersSettings or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UsersSettings object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSettingsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \UsersSettings) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersSettingsTableMap::DATABASE_NAME);
            $criteria->add(UsersSettingsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersSettingsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersSettingsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersSettingsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users_settings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersSettingsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UsersSettings or Criteria object.
     *
     * @param mixed               $criteria Criteria or UsersSettings object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSettingsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UsersSettings object
        }

        if ($criteria->containsKey(UsersSettingsTableMap::COL_ID) && $criteria->keyContainsValue(UsersSettingsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersSettingsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersSettingsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersSettingsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsersSettingsTableMap::buildTableMap();
