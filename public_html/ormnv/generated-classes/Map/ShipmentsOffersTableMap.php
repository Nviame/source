<?php

namespace Map;

use \ShipmentsOffers;
use \ShipmentsOffersQuery;
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
 * This class defines the structure of the 'shipments_offers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ShipmentsOffersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ShipmentsOffersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'shipments_offers';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ShipmentsOffers';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ShipmentsOffers';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the id field
     */
    const COL_ID = 'shipments_offers.id';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'shipments_offers.id_user';

    /**
     * the column name for the id_shipment field
     */
    const COL_ID_SHIPMENT = 'shipments_offers.id_shipment';

    /**
     * the column name for the offer field
     */
    const COL_OFFER = 'shipments_offers.offer';

    /**
     * the column name for the transport_id field
     */
    const COL_TRANSPORT_ID = 'shipments_offers.transport_id';

    /**
     * the column name for the transport_type field
     */
    const COL_TRANSPORT_TYPE = 'shipments_offers.transport_type';

    /**
     * the column name for the estimated_arrival_date field
     */
    const COL_ESTIMATED_ARRIVAL_DATE = 'shipments_offers.estimated_arrival_date';

    /**
     * the column name for the registered_at field
     */
    const COL_REGISTERED_AT = 'shipments_offers.registered_at';

    /**
     * the column name for the accepted_at field
     */
    const COL_ACCEPTED_AT = 'shipments_offers.accepted_at';

    /**
     * the column name for the approximate_arrival_value field
     */
    const COL_APPROXIMATE_ARRIVAL_VALUE = 'shipments_offers.approximate_arrival_value';

    /**
     * the column name for the approximate_arrival_desc field
     */
    const COL_APPROXIMATE_ARRIVAL_DESC = 'shipments_offers.approximate_arrival_desc';

    /**
     * the column name for the approximate_distance_value field
     */
    const COL_APPROXIMATE_DISTANCE_VALUE = 'shipments_offers.approximate_distance_value';

    /**
     * the column name for the approximate_distance_desc field
     */
    const COL_APPROXIMATE_DISTANCE_DESC = 'shipments_offers.approximate_distance_desc';

    /**
     * the column name for the readed field
     */
    const COL_READED = 'shipments_offers.readed';

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
        self::TYPE_PHPNAME       => array('Id', 'IdUser', 'IdShipment', 'Offer', 'TransportId', 'TransportType', 'EstimatedArrivalDate', 'RegisteredAt', 'AcceptedAt', 'ApproximateArrivalValue', 'ApproximateArrivalDesc', 'ApproximateDistanceValue', 'ApproximateDistanceDesc', 'Readed', ),
        self::TYPE_CAMELNAME     => array('id', 'idUser', 'idShipment', 'offer', 'transportId', 'transportType', 'estimatedArrivalDate', 'registeredAt', 'acceptedAt', 'approximateArrivalValue', 'approximateArrivalDesc', 'approximateDistanceValue', 'approximateDistanceDesc', 'readed', ),
        self::TYPE_COLNAME       => array(ShipmentsOffersTableMap::COL_ID, ShipmentsOffersTableMap::COL_ID_USER, ShipmentsOffersTableMap::COL_ID_SHIPMENT, ShipmentsOffersTableMap::COL_OFFER, ShipmentsOffersTableMap::COL_TRANSPORT_ID, ShipmentsOffersTableMap::COL_TRANSPORT_TYPE, ShipmentsOffersTableMap::COL_ESTIMATED_ARRIVAL_DATE, ShipmentsOffersTableMap::COL_REGISTERED_AT, ShipmentsOffersTableMap::COL_ACCEPTED_AT, ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_VALUE, ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_DESC, ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_VALUE, ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_DESC, ShipmentsOffersTableMap::COL_READED, ),
        self::TYPE_FIELDNAME     => array('id', 'id_user', 'id_shipment', 'offer', 'transport_id', 'transport_type', 'estimated_arrival_date', 'registered_at', 'accepted_at', 'approximate_arrival_value', 'approximate_arrival_desc', 'approximate_distance_value', 'approximate_distance_desc', 'readed', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdUser' => 1, 'IdShipment' => 2, 'Offer' => 3, 'TransportId' => 4, 'TransportType' => 5, 'EstimatedArrivalDate' => 6, 'RegisteredAt' => 7, 'AcceptedAt' => 8, 'ApproximateArrivalValue' => 9, 'ApproximateArrivalDesc' => 10, 'ApproximateDistanceValue' => 11, 'ApproximateDistanceDesc' => 12, 'Readed' => 13, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idUser' => 1, 'idShipment' => 2, 'offer' => 3, 'transportId' => 4, 'transportType' => 5, 'estimatedArrivalDate' => 6, 'registeredAt' => 7, 'acceptedAt' => 8, 'approximateArrivalValue' => 9, 'approximateArrivalDesc' => 10, 'approximateDistanceValue' => 11, 'approximateDistanceDesc' => 12, 'readed' => 13, ),
        self::TYPE_COLNAME       => array(ShipmentsOffersTableMap::COL_ID => 0, ShipmentsOffersTableMap::COL_ID_USER => 1, ShipmentsOffersTableMap::COL_ID_SHIPMENT => 2, ShipmentsOffersTableMap::COL_OFFER => 3, ShipmentsOffersTableMap::COL_TRANSPORT_ID => 4, ShipmentsOffersTableMap::COL_TRANSPORT_TYPE => 5, ShipmentsOffersTableMap::COL_ESTIMATED_ARRIVAL_DATE => 6, ShipmentsOffersTableMap::COL_REGISTERED_AT => 7, ShipmentsOffersTableMap::COL_ACCEPTED_AT => 8, ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_VALUE => 9, ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_DESC => 10, ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_VALUE => 11, ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_DESC => 12, ShipmentsOffersTableMap::COL_READED => 13, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_user' => 1, 'id_shipment' => 2, 'offer' => 3, 'transport_id' => 4, 'transport_type' => 5, 'estimated_arrival_date' => 6, 'registered_at' => 7, 'accepted_at' => 8, 'approximate_arrival_value' => 9, 'approximate_arrival_desc' => 10, 'approximate_distance_value' => 11, 'approximate_distance_desc' => 12, 'readed' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
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
        $this->setName('shipments_offers');
        $this->setPhpName('ShipmentsOffers');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\ShipmentsOffers');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_user', 'IdUser', 'INTEGER', false, null, null);
        $this->addColumn('id_shipment', 'IdShipment', 'INTEGER', false, null, null);
        $this->addColumn('offer', 'Offer', 'DOUBLE', false, null, null);
        $this->addColumn('transport_id', 'TransportId', 'INTEGER', false, null, null);
        $this->addColumn('transport_type', 'TransportType', 'INTEGER', false, null, null);
        $this->addColumn('estimated_arrival_date', 'EstimatedArrivalDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('registered_at', 'RegisteredAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('accepted_at', 'AcceptedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('approximate_arrival_value', 'ApproximateArrivalValue', 'DOUBLE', false, null, null);
        $this->addColumn('approximate_arrival_desc', 'ApproximateArrivalDesc', 'VARCHAR', false, 48, null);
        $this->addColumn('approximate_distance_value', 'ApproximateDistanceValue', 'DOUBLE', false, null, null);
        $this->addColumn('approximate_distance_desc', 'ApproximateDistanceDesc', 'VARCHAR', false, 48, null);
        $this->addColumn('readed', 'Readed', 'BOOLEAN', false, 1, false);
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
        return $withPrefix ? ShipmentsOffersTableMap::CLASS_DEFAULT : ShipmentsOffersTableMap::OM_CLASS;
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
     * @return array           (ShipmentsOffers object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ShipmentsOffersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShipmentsOffersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShipmentsOffersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShipmentsOffersTableMap::OM_CLASS;
            /** @var ShipmentsOffers $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShipmentsOffersTableMap::addInstanceToPool($obj, $key);
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
            $key = ShipmentsOffersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShipmentsOffersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ShipmentsOffers $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShipmentsOffersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_ID);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_ID_USER);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_ID_SHIPMENT);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_OFFER);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_TRANSPORT_ID);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_TRANSPORT_TYPE);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_ESTIMATED_ARRIVAL_DATE);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_REGISTERED_AT);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_ACCEPTED_AT);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_VALUE);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_DESC);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_VALUE);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_DESC);
            $criteria->addSelectColumn(ShipmentsOffersTableMap::COL_READED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.id_shipment');
            $criteria->addSelectColumn($alias . '.offer');
            $criteria->addSelectColumn($alias . '.transport_id');
            $criteria->addSelectColumn($alias . '.transport_type');
            $criteria->addSelectColumn($alias . '.estimated_arrival_date');
            $criteria->addSelectColumn($alias . '.registered_at');
            $criteria->addSelectColumn($alias . '.accepted_at');
            $criteria->addSelectColumn($alias . '.approximate_arrival_value');
            $criteria->addSelectColumn($alias . '.approximate_arrival_desc');
            $criteria->addSelectColumn($alias . '.approximate_distance_value');
            $criteria->addSelectColumn($alias . '.approximate_distance_desc');
            $criteria->addSelectColumn($alias . '.readed');
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
        return Propel::getServiceContainer()->getDatabaseMap(ShipmentsOffersTableMap::DATABASE_NAME)->getTable(ShipmentsOffersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ShipmentsOffersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ShipmentsOffersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ShipmentsOffersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ShipmentsOffers or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ShipmentsOffers object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOffersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ShipmentsOffers) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShipmentsOffersTableMap::DATABASE_NAME);
            $criteria->add(ShipmentsOffersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ShipmentsOffersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShipmentsOffersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShipmentsOffersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the shipments_offers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ShipmentsOffersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ShipmentsOffers or Criteria object.
     *
     * @param mixed               $criteria Criteria or ShipmentsOffers object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOffersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ShipmentsOffers object
        }

        if ($criteria->containsKey(ShipmentsOffersTableMap::COL_ID) && $criteria->keyContainsValue(ShipmentsOffersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShipmentsOffersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ShipmentsOffersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ShipmentsOffersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ShipmentsOffersTableMap::buildTableMap();
