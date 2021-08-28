<?php

namespace Map;

use \CommercesShipments;
use \CommercesShipmentsQuery;
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
 * This class defines the structure of the 'commerces_shipments' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CommercesShipmentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CommercesShipmentsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'commerces_shipments';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CommercesShipments';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CommercesShipments';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 27;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 27;

    /**
     * the column name for the id field
     */
    const COL_ID = 'commerces_shipments.id';

    /**
     * the column name for the id_commerce field
     */
    const COL_ID_COMMERCE = 'commerces_shipments.id_commerce';

    /**
     * the column name for the id_rate field
     */
    const COL_ID_RATE = 'commerces_shipments.id_rate';

    /**
     * the column name for the id_shipment field
     */
    const COL_ID_SHIPMENT = 'commerces_shipments.id_shipment';

    /**
     * the column name for the uuid field
     */
    const COL_UUID = 'commerces_shipments.uuid';

    /**
     * the column name for the pickup_at_name field
     */
    const COL_PICKUP_AT_NAME = 'commerces_shipments.pickup_at_name';

    /**
     * the column name for the pickup_at_lat field
     */
    const COL_PICKUP_AT_LAT = 'commerces_shipments.pickup_at_lat';

    /**
     * the column name for the pickup_at_lng field
     */
    const COL_PICKUP_AT_LNG = 'commerces_shipments.pickup_at_lng';

    /**
     * the column name for the pickup_at_locality field
     */
    const COL_PICKUP_AT_LOCALITY = 'commerces_shipments.pickup_at_locality';

    /**
     * the column name for the pickup_at_region field
     */
    const COL_PICKUP_AT_REGION = 'commerces_shipments.pickup_at_region';

    /**
     * the column name for the pickup_at_country field
     */
    const COL_PICKUP_AT_COUNTRY = 'commerces_shipments.pickup_at_country';

    /**
     * the column name for the size field
     */
    const COL_SIZE = 'commerces_shipments.size';

    /**
     * the column name for the priority field
     */
    const COL_PRIORITY = 'commerces_shipments.priority';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'commerces_shipments.type';

    /**
     * the column name for the type_rate field
     */
    const COL_TYPE_RATE = 'commerces_shipments.type_rate';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'commerces_shipments.description';

    /**
     * the column name for the delivery_date field
     */
    const COL_DELIVERY_DATE = 'commerces_shipments.delivery_date';

    /**
     * the column name for the delivery_address_lat field
     */
    const COL_DELIVERY_ADDRESS_LAT = 'commerces_shipments.delivery_address_lat';

    /**
     * the column name for the delivery_address_lng field
     */
    const COL_DELIVERY_ADDRESS_LNG = 'commerces_shipments.delivery_address_lng';

    /**
     * the column name for the delivery_address_locality field
     */
    const COL_DELIVERY_ADDRESS_LOCALITY = 'commerces_shipments.delivery_address_locality';

    /**
     * the column name for the delivery_address_region field
     */
    const COL_DELIVERY_ADDRESS_REGION = 'commerces_shipments.delivery_address_region';

    /**
     * the column name for the delivery_address_country field
     */
    const COL_DELIVERY_ADDRESS_COUNTRY = 'commerces_shipments.delivery_address_country';

    /**
     * the column name for the addressee_name field
     */
    const COL_ADDRESSEE_NAME = 'commerces_shipments.addressee_name';

    /**
     * the column name for the addressee_phone field
     */
    const COL_ADDRESSEE_PHONE = 'commerces_shipments.addressee_phone';

    /**
     * the column name for the delivery_address field
     */
    const COL_DELIVERY_ADDRESS = 'commerces_shipments.delivery_address';

    /**
     * the column name for the registered_at field
     */
    const COL_REGISTERED_AT = 'commerces_shipments.registered_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'commerces_shipments.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdCommerce', 'IdRate', 'IdShipment', 'Uuid', 'PickupAtName', 'PickupAtLat', 'PickupAtLng', 'PickupAtLocality', 'PickupAtRegion', 'PickupAtCountry', 'Size', 'Priority', 'Type', 'TypeRate', 'Description', 'DeliveryDate', 'DeliveryAddressLat', 'DeliveryAddressLng', 'DeliveryAddressLocality', 'DeliveryAddressRegion', 'DeliveryAddressCountry', 'AddresseeName', 'AddresseePhone', 'DeliveryAddress', 'RegisteredAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idCommerce', 'idRate', 'idShipment', 'uuid', 'pickupAtName', 'pickupAtLat', 'pickupAtLng', 'pickupAtLocality', 'pickupAtRegion', 'pickupAtCountry', 'size', 'priority', 'type', 'typeRate', 'description', 'deliveryDate', 'deliveryAddressLat', 'deliveryAddressLng', 'deliveryAddressLocality', 'deliveryAddressRegion', 'deliveryAddressCountry', 'addresseeName', 'addresseePhone', 'deliveryAddress', 'registeredAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(CommercesShipmentsTableMap::COL_ID, CommercesShipmentsTableMap::COL_ID_COMMERCE, CommercesShipmentsTableMap::COL_ID_RATE, CommercesShipmentsTableMap::COL_ID_SHIPMENT, CommercesShipmentsTableMap::COL_UUID, CommercesShipmentsTableMap::COL_PICKUP_AT_NAME, CommercesShipmentsTableMap::COL_PICKUP_AT_LAT, CommercesShipmentsTableMap::COL_PICKUP_AT_LNG, CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY, CommercesShipmentsTableMap::COL_PICKUP_AT_REGION, CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY, CommercesShipmentsTableMap::COL_SIZE, CommercesShipmentsTableMap::COL_PRIORITY, CommercesShipmentsTableMap::COL_TYPE, CommercesShipmentsTableMap::COL_TYPE_RATE, CommercesShipmentsTableMap::COL_DESCRIPTION, CommercesShipmentsTableMap::COL_DELIVERY_DATE, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY, CommercesShipmentsTableMap::COL_ADDRESSEE_NAME, CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS, CommercesShipmentsTableMap::COL_REGISTERED_AT, CommercesShipmentsTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_commerce', 'id_rate', 'id_shipment', 'uuid', 'pickup_at_name', 'pickup_at_lat', 'pickup_at_lng', 'pickup_at_locality', 'pickup_at_region', 'pickup_at_country', 'size', 'priority', 'type', 'type_rate', 'description', 'delivery_date', 'delivery_address_lat', 'delivery_address_lng', 'delivery_address_locality', 'delivery_address_region', 'delivery_address_country', 'addressee_name', 'addressee_phone', 'delivery_address', 'registered_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdCommerce' => 1, 'IdRate' => 2, 'IdShipment' => 3, 'Uuid' => 4, 'PickupAtName' => 5, 'PickupAtLat' => 6, 'PickupAtLng' => 7, 'PickupAtLocality' => 8, 'PickupAtRegion' => 9, 'PickupAtCountry' => 10, 'Size' => 11, 'Priority' => 12, 'Type' => 13, 'TypeRate' => 14, 'Description' => 15, 'DeliveryDate' => 16, 'DeliveryAddressLat' => 17, 'DeliveryAddressLng' => 18, 'DeliveryAddressLocality' => 19, 'DeliveryAddressRegion' => 20, 'DeliveryAddressCountry' => 21, 'AddresseeName' => 22, 'AddresseePhone' => 23, 'DeliveryAddress' => 24, 'RegisteredAt' => 25, 'UpdatedAt' => 26, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idCommerce' => 1, 'idRate' => 2, 'idShipment' => 3, 'uuid' => 4, 'pickupAtName' => 5, 'pickupAtLat' => 6, 'pickupAtLng' => 7, 'pickupAtLocality' => 8, 'pickupAtRegion' => 9, 'pickupAtCountry' => 10, 'size' => 11, 'priority' => 12, 'type' => 13, 'typeRate' => 14, 'description' => 15, 'deliveryDate' => 16, 'deliveryAddressLat' => 17, 'deliveryAddressLng' => 18, 'deliveryAddressLocality' => 19, 'deliveryAddressRegion' => 20, 'deliveryAddressCountry' => 21, 'addresseeName' => 22, 'addresseePhone' => 23, 'deliveryAddress' => 24, 'registeredAt' => 25, 'updatedAt' => 26, ),
        self::TYPE_COLNAME       => array(CommercesShipmentsTableMap::COL_ID => 0, CommercesShipmentsTableMap::COL_ID_COMMERCE => 1, CommercesShipmentsTableMap::COL_ID_RATE => 2, CommercesShipmentsTableMap::COL_ID_SHIPMENT => 3, CommercesShipmentsTableMap::COL_UUID => 4, CommercesShipmentsTableMap::COL_PICKUP_AT_NAME => 5, CommercesShipmentsTableMap::COL_PICKUP_AT_LAT => 6, CommercesShipmentsTableMap::COL_PICKUP_AT_LNG => 7, CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY => 8, CommercesShipmentsTableMap::COL_PICKUP_AT_REGION => 9, CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY => 10, CommercesShipmentsTableMap::COL_SIZE => 11, CommercesShipmentsTableMap::COL_PRIORITY => 12, CommercesShipmentsTableMap::COL_TYPE => 13, CommercesShipmentsTableMap::COL_TYPE_RATE => 14, CommercesShipmentsTableMap::COL_DESCRIPTION => 15, CommercesShipmentsTableMap::COL_DELIVERY_DATE => 16, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT => 17, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG => 18, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY => 19, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION => 20, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY => 21, CommercesShipmentsTableMap::COL_ADDRESSEE_NAME => 22, CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE => 23, CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS => 24, CommercesShipmentsTableMap::COL_REGISTERED_AT => 25, CommercesShipmentsTableMap::COL_UPDATED_AT => 26, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_commerce' => 1, 'id_rate' => 2, 'id_shipment' => 3, 'uuid' => 4, 'pickup_at_name' => 5, 'pickup_at_lat' => 6, 'pickup_at_lng' => 7, 'pickup_at_locality' => 8, 'pickup_at_region' => 9, 'pickup_at_country' => 10, 'size' => 11, 'priority' => 12, 'type' => 13, 'type_rate' => 14, 'description' => 15, 'delivery_date' => 16, 'delivery_address_lat' => 17, 'delivery_address_lng' => 18, 'delivery_address_locality' => 19, 'delivery_address_region' => 20, 'delivery_address_country' => 21, 'addressee_name' => 22, 'addressee_phone' => 23, 'delivery_address' => 24, 'registered_at' => 25, 'updated_at' => 26, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
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
        $this->setName('commerces_shipments');
        $this->setPhpName('CommercesShipments');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CommercesShipments');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_commerce', 'IdCommerce', 'INTEGER', false, null, null);
        $this->addForeignKey('id_rate', 'IdRate', 'INTEGER', 'commerces_rates', 'id', false, null, null);
        $this->addColumn('id_shipment', 'IdShipment', 'INTEGER', false, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 48, null);
        $this->addColumn('pickup_at_name', 'PickupAtName', 'VARCHAR', false, 255, null);
        $this->addColumn('pickup_at_lat', 'PickupAtLat', 'VARCHAR', false, 32, null);
        $this->addColumn('pickup_at_lng', 'PickupAtLng', 'VARCHAR', false, 32, null);
        $this->addColumn('pickup_at_locality', 'PickupAtLocality', 'VARCHAR', false, 64, null);
        $this->addColumn('pickup_at_region', 'PickupAtRegion', 'VARCHAR', false, 56, null);
        $this->addColumn('pickup_at_country', 'PickupAtCountry', 'VARCHAR', false, 48, null);
        $this->addColumn('size', 'Size', 'VARCHAR', false, 8, null);
        $this->addColumn('priority', 'Priority', 'INTEGER', false, null, null);
        $this->addColumn('type', 'Type', 'INTEGER', false, null, null);
        $this->addColumn('type_rate', 'TypeRate', 'INTEGER', false, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 96, null);
        $this->addColumn('delivery_date', 'DeliveryDate', 'DATE', false, null, null);
        $this->addColumn('delivery_address_lat', 'DeliveryAddressLat', 'VARCHAR', false, 32, null);
        $this->addColumn('delivery_address_lng', 'DeliveryAddressLng', 'VARCHAR', false, 32, null);
        $this->addColumn('delivery_address_locality', 'DeliveryAddressLocality', 'VARCHAR', false, 64, null);
        $this->addColumn('delivery_address_region', 'DeliveryAddressRegion', 'VARCHAR', false, 56, null);
        $this->addColumn('delivery_address_country', 'DeliveryAddressCountry', 'VARCHAR', false, 48, null);
        $this->addColumn('addressee_name', 'AddresseeName', 'VARCHAR', false, 64, null);
        $this->addColumn('addressee_phone', 'AddresseePhone', 'VARCHAR', false, 48, null);
        $this->addColumn('delivery_address', 'DeliveryAddress', 'VARCHAR', false, 96, null);
        $this->addColumn('registered_at', 'RegisteredAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CommercesRates', '\\CommercesRates', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_rate',
    1 => ':id',
  ),
), 'SET NULL', 'CASCADE', null, false);
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
        return $withPrefix ? CommercesShipmentsTableMap::CLASS_DEFAULT : CommercesShipmentsTableMap::OM_CLASS;
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
     * @return array           (CommercesShipments object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CommercesShipmentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CommercesShipmentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CommercesShipmentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CommercesShipmentsTableMap::OM_CLASS;
            /** @var CommercesShipments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CommercesShipmentsTableMap::addInstanceToPool($obj, $key);
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
            $key = CommercesShipmentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CommercesShipmentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CommercesShipments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CommercesShipmentsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_ID);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_ID_COMMERCE);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_ID_RATE);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_ID_SHIPMENT);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_UUID);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_PICKUP_AT_NAME);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_PICKUP_AT_LAT);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_PICKUP_AT_LNG);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_PICKUP_AT_REGION);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_SIZE);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_PRIORITY);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_TYPE);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_TYPE_RATE);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DELIVERY_DATE);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_ADDRESSEE_NAME);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_REGISTERED_AT);
            $criteria->addSelectColumn(CommercesShipmentsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_commerce');
            $criteria->addSelectColumn($alias . '.id_rate');
            $criteria->addSelectColumn($alias . '.id_shipment');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.pickup_at_name');
            $criteria->addSelectColumn($alias . '.pickup_at_lat');
            $criteria->addSelectColumn($alias . '.pickup_at_lng');
            $criteria->addSelectColumn($alias . '.pickup_at_locality');
            $criteria->addSelectColumn($alias . '.pickup_at_region');
            $criteria->addSelectColumn($alias . '.pickup_at_country');
            $criteria->addSelectColumn($alias . '.size');
            $criteria->addSelectColumn($alias . '.priority');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.type_rate');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.delivery_date');
            $criteria->addSelectColumn($alias . '.delivery_address_lat');
            $criteria->addSelectColumn($alias . '.delivery_address_lng');
            $criteria->addSelectColumn($alias . '.delivery_address_locality');
            $criteria->addSelectColumn($alias . '.delivery_address_region');
            $criteria->addSelectColumn($alias . '.delivery_address_country');
            $criteria->addSelectColumn($alias . '.addressee_name');
            $criteria->addSelectColumn($alias . '.addressee_phone');
            $criteria->addSelectColumn($alias . '.delivery_address');
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
        return Propel::getServiceContainer()->getDatabaseMap(CommercesShipmentsTableMap::DATABASE_NAME)->getTable(CommercesShipmentsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CommercesShipmentsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CommercesShipmentsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CommercesShipmentsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CommercesShipments or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CommercesShipments object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesShipmentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CommercesShipments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CommercesShipmentsTableMap::DATABASE_NAME);
            $criteria->add(CommercesShipmentsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CommercesShipmentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CommercesShipmentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CommercesShipmentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the commerces_shipments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CommercesShipmentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CommercesShipments or Criteria object.
     *
     * @param mixed               $criteria Criteria or CommercesShipments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesShipmentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CommercesShipments object
        }

        if ($criteria->containsKey(CommercesShipmentsTableMap::COL_ID) && $criteria->keyContainsValue(CommercesShipmentsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CommercesShipmentsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CommercesShipmentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CommercesShipmentsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CommercesShipmentsTableMap::buildTableMap();
