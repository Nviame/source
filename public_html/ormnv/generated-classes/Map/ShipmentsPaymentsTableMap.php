<?php

namespace Map;

use \ShipmentsPayments;
use \ShipmentsPaymentsQuery;
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
 * This class defines the structure of the 'shipments_payments' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ShipmentsPaymentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ShipmentsPaymentsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'shipments_payments';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ShipmentsPayments';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ShipmentsPayments';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 20;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 20;

    /**
     * the column name for the id field
     */
    const COL_ID = 'shipments_payments.id';

    /**
     * the column name for the id_shipment field
     */
    const COL_ID_SHIPMENT = 'shipments_payments.id_shipment';

    /**
     * the column name for the preference_id field
     */
    const COL_PREFERENCE_ID = 'shipments_payments.preference_id';

    /**
     * the column name for the collection_id field
     */
    const COL_COLLECTION_ID = 'shipments_payments.collection_id';

    /**
     * the column name for the collection_status field
     */
    const COL_COLLECTION_STATUS = 'shipments_payments.collection_status';

    /**
     * the column name for the merchant_order_id field
     */
    const COL_MERCHANT_ORDER_ID = 'shipments_payments.merchant_order_id';

    /**
     * the column name for the total_paid_amount field
     */
    const COL_TOTAL_PAID_AMOUNT = 'shipments_payments.total_paid_amount';

    /**
     * the column name for the net_received_amount field
     */
    const COL_NET_RECEIVED_AMOUNT = 'shipments_payments.net_received_amount';

    /**
     * the column name for the registered_at field
     */
    const COL_REGISTERED_AT = 'shipments_payments.registered_at';

    /**
     * the column name for the fee_mp field
     */
    const COL_FEE_MP = 'shipments_payments.fee_mp';

    /**
     * the column name for the fee_nv field
     */
    const COL_FEE_NV = 'shipments_payments.fee_nv';

    /**
     * the column name for the card_type_id field
     */
    const COL_CARD_TYPE_ID = 'shipments_payments.card_type_id';

    /**
     * the column name for the card_method_id field
     */
    const COL_CARD_METHOD_ID = 'shipments_payments.card_method_id';

    /**
     * the column name for the card_expiration_month field
     */
    const COL_CARD_EXPIRATION_MONTH = 'shipments_payments.card_expiration_month';

    /**
     * the column name for the card_expiration_year field
     */
    const COL_CARD_EXPIRATION_YEAR = 'shipments_payments.card_expiration_year';

    /**
     * the column name for the card_cardholder_identification_type field
     */
    const COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE = 'shipments_payments.card_cardholder_identification_type';

    /**
     * the column name for the card_cardholder_identification_number field
     */
    const COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER = 'shipments_payments.card_cardholder_identification_number';

    /**
     * the column name for the card_cardholder_name field
     */
    const COL_CARD_CARDHOLDER_NAME = 'shipments_payments.card_cardholder_name';

    /**
     * the column name for the card_date_created field
     */
    const COL_CARD_DATE_CREATED = 'shipments_payments.card_date_created';

    /**
     * the column name for the card_date_last_updated field
     */
    const COL_CARD_DATE_LAST_UPDATED = 'shipments_payments.card_date_last_updated';

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
        self::TYPE_PHPNAME       => array('Id', 'IdShipment', 'PreferenceId', 'CollectionId', 'CollectionStatus', 'MerchantOrderId', 'TotalPaidAmount', 'NetReceivedAmount', 'RegisteredAt', 'FeeMp', 'FeeNv', 'CardTypeId', 'CardMethodId', 'CardExpirationMonth', 'CardExpirationYear', 'CardCardholderIdentificationType', 'CardCardholderIdentificationNumber', 'CardCardholderName', 'CardDateCreated', 'CardDateLastUpdated', ),
        self::TYPE_CAMELNAME     => array('id', 'idShipment', 'preferenceId', 'collectionId', 'collectionStatus', 'merchantOrderId', 'totalPaidAmount', 'netReceivedAmount', 'registeredAt', 'feeMp', 'feeNv', 'cardTypeId', 'cardMethodId', 'cardExpirationMonth', 'cardExpirationYear', 'cardCardholderIdentificationType', 'cardCardholderIdentificationNumber', 'cardCardholderName', 'cardDateCreated', 'cardDateLastUpdated', ),
        self::TYPE_COLNAME       => array(ShipmentsPaymentsTableMap::COL_ID, ShipmentsPaymentsTableMap::COL_ID_SHIPMENT, ShipmentsPaymentsTableMap::COL_PREFERENCE_ID, ShipmentsPaymentsTableMap::COL_COLLECTION_ID, ShipmentsPaymentsTableMap::COL_COLLECTION_STATUS, ShipmentsPaymentsTableMap::COL_MERCHANT_ORDER_ID, ShipmentsPaymentsTableMap::COL_TOTAL_PAID_AMOUNT, ShipmentsPaymentsTableMap::COL_NET_RECEIVED_AMOUNT, ShipmentsPaymentsTableMap::COL_REGISTERED_AT, ShipmentsPaymentsTableMap::COL_FEE_MP, ShipmentsPaymentsTableMap::COL_FEE_NV, ShipmentsPaymentsTableMap::COL_CARD_TYPE_ID, ShipmentsPaymentsTableMap::COL_CARD_METHOD_ID, ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_MONTH, ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_YEAR, ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE, ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER, ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_NAME, ShipmentsPaymentsTableMap::COL_CARD_DATE_CREATED, ShipmentsPaymentsTableMap::COL_CARD_DATE_LAST_UPDATED, ),
        self::TYPE_FIELDNAME     => array('id', 'id_shipment', 'preference_id', 'collection_id', 'collection_status', 'merchant_order_id', 'total_paid_amount', 'net_received_amount', 'registered_at', 'fee_mp', 'fee_nv', 'card_type_id', 'card_method_id', 'card_expiration_month', 'card_expiration_year', 'card_cardholder_identification_type', 'card_cardholder_identification_number', 'card_cardholder_name', 'card_date_created', 'card_date_last_updated', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdShipment' => 1, 'PreferenceId' => 2, 'CollectionId' => 3, 'CollectionStatus' => 4, 'MerchantOrderId' => 5, 'TotalPaidAmount' => 6, 'NetReceivedAmount' => 7, 'RegisteredAt' => 8, 'FeeMp' => 9, 'FeeNv' => 10, 'CardTypeId' => 11, 'CardMethodId' => 12, 'CardExpirationMonth' => 13, 'CardExpirationYear' => 14, 'CardCardholderIdentificationType' => 15, 'CardCardholderIdentificationNumber' => 16, 'CardCardholderName' => 17, 'CardDateCreated' => 18, 'CardDateLastUpdated' => 19, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idShipment' => 1, 'preferenceId' => 2, 'collectionId' => 3, 'collectionStatus' => 4, 'merchantOrderId' => 5, 'totalPaidAmount' => 6, 'netReceivedAmount' => 7, 'registeredAt' => 8, 'feeMp' => 9, 'feeNv' => 10, 'cardTypeId' => 11, 'cardMethodId' => 12, 'cardExpirationMonth' => 13, 'cardExpirationYear' => 14, 'cardCardholderIdentificationType' => 15, 'cardCardholderIdentificationNumber' => 16, 'cardCardholderName' => 17, 'cardDateCreated' => 18, 'cardDateLastUpdated' => 19, ),
        self::TYPE_COLNAME       => array(ShipmentsPaymentsTableMap::COL_ID => 0, ShipmentsPaymentsTableMap::COL_ID_SHIPMENT => 1, ShipmentsPaymentsTableMap::COL_PREFERENCE_ID => 2, ShipmentsPaymentsTableMap::COL_COLLECTION_ID => 3, ShipmentsPaymentsTableMap::COL_COLLECTION_STATUS => 4, ShipmentsPaymentsTableMap::COL_MERCHANT_ORDER_ID => 5, ShipmentsPaymentsTableMap::COL_TOTAL_PAID_AMOUNT => 6, ShipmentsPaymentsTableMap::COL_NET_RECEIVED_AMOUNT => 7, ShipmentsPaymentsTableMap::COL_REGISTERED_AT => 8, ShipmentsPaymentsTableMap::COL_FEE_MP => 9, ShipmentsPaymentsTableMap::COL_FEE_NV => 10, ShipmentsPaymentsTableMap::COL_CARD_TYPE_ID => 11, ShipmentsPaymentsTableMap::COL_CARD_METHOD_ID => 12, ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_MONTH => 13, ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_YEAR => 14, ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE => 15, ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER => 16, ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_NAME => 17, ShipmentsPaymentsTableMap::COL_CARD_DATE_CREATED => 18, ShipmentsPaymentsTableMap::COL_CARD_DATE_LAST_UPDATED => 19, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_shipment' => 1, 'preference_id' => 2, 'collection_id' => 3, 'collection_status' => 4, 'merchant_order_id' => 5, 'total_paid_amount' => 6, 'net_received_amount' => 7, 'registered_at' => 8, 'fee_mp' => 9, 'fee_nv' => 10, 'card_type_id' => 11, 'card_method_id' => 12, 'card_expiration_month' => 13, 'card_expiration_year' => 14, 'card_cardholder_identification_type' => 15, 'card_cardholder_identification_number' => 16, 'card_cardholder_name' => 17, 'card_date_created' => 18, 'card_date_last_updated' => 19, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
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
        $this->setName('shipments_payments');
        $this->setPhpName('ShipmentsPayments');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\ShipmentsPayments');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_shipment', 'IdShipment', 'INTEGER', false, null, null);
        $this->addColumn('preference_id', 'PreferenceId', 'VARCHAR', false, 96, null);
        $this->addPrimaryKey('collection_id', 'CollectionId', 'VARCHAR', true, 16, null);
        $this->addColumn('collection_status', 'CollectionStatus', 'VARCHAR', false, 16, null);
        $this->addColumn('merchant_order_id', 'MerchantOrderId', 'VARCHAR', false, 16, null);
        $this->addColumn('total_paid_amount', 'TotalPaidAmount', 'DOUBLE', false, null, null);
        $this->addColumn('net_received_amount', 'NetReceivedAmount', 'DOUBLE', false, null, null);
        $this->addColumn('registered_at', 'RegisteredAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('fee_mp', 'FeeMp', 'DOUBLE', false, null, null);
        $this->addColumn('fee_nv', 'FeeNv', 'DOUBLE', false, null, null);
        $this->addColumn('card_type_id', 'CardTypeId', 'VARCHAR', false, 36, null);
        $this->addColumn('card_method_id', 'CardMethodId', 'VARCHAR', false, 48, null);
        $this->addColumn('card_expiration_month', 'CardExpirationMonth', 'INTEGER', false, null, null);
        $this->addColumn('card_expiration_year', 'CardExpirationYear', 'INTEGER', false, null, null);
        $this->addColumn('card_cardholder_identification_type', 'CardCardholderIdentificationType', 'VARCHAR', false, 16, null);
        $this->addColumn('card_cardholder_identification_number', 'CardCardholderIdentificationNumber', 'VARCHAR', false, 16, null);
        $this->addColumn('card_cardholder_name', 'CardCardholderName', 'VARCHAR', false, 96, null);
        $this->addColumn('card_date_created', 'CardDateCreated', 'TIMESTAMP', false, null, null);
        $this->addColumn('card_date_last_updated', 'CardDateLastUpdated', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \ShipmentsPayments $obj A \ShipmentsPayments object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getCollectionId()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \ShipmentsPayments object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \ShipmentsPayments) {
                $key = serialize(array((string) $value->getId(), (string) $value->getCollectionId()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \ShipmentsPayments object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('CollectionId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('CollectionId', TableMap::TYPE_PHPNAME, $indexType)]));
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 3 + $offset
                : self::translateFieldName('CollectionId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? ShipmentsPaymentsTableMap::CLASS_DEFAULT : ShipmentsPaymentsTableMap::OM_CLASS;
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
     * @return array           (ShipmentsPayments object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ShipmentsPaymentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShipmentsPaymentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShipmentsPaymentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShipmentsPaymentsTableMap::OM_CLASS;
            /** @var ShipmentsPayments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShipmentsPaymentsTableMap::addInstanceToPool($obj, $key);
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
            $key = ShipmentsPaymentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShipmentsPaymentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ShipmentsPayments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShipmentsPaymentsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_ID);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_ID_SHIPMENT);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_PREFERENCE_ID);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_COLLECTION_ID);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_COLLECTION_STATUS);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_MERCHANT_ORDER_ID);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_TOTAL_PAID_AMOUNT);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_NET_RECEIVED_AMOUNT);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_REGISTERED_AT);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_FEE_MP);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_FEE_NV);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_TYPE_ID);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_METHOD_ID);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_MONTH);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_YEAR);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_NAME);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_DATE_CREATED);
            $criteria->addSelectColumn(ShipmentsPaymentsTableMap::COL_CARD_DATE_LAST_UPDATED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_shipment');
            $criteria->addSelectColumn($alias . '.preference_id');
            $criteria->addSelectColumn($alias . '.collection_id');
            $criteria->addSelectColumn($alias . '.collection_status');
            $criteria->addSelectColumn($alias . '.merchant_order_id');
            $criteria->addSelectColumn($alias . '.total_paid_amount');
            $criteria->addSelectColumn($alias . '.net_received_amount');
            $criteria->addSelectColumn($alias . '.registered_at');
            $criteria->addSelectColumn($alias . '.fee_mp');
            $criteria->addSelectColumn($alias . '.fee_nv');
            $criteria->addSelectColumn($alias . '.card_type_id');
            $criteria->addSelectColumn($alias . '.card_method_id');
            $criteria->addSelectColumn($alias . '.card_expiration_month');
            $criteria->addSelectColumn($alias . '.card_expiration_year');
            $criteria->addSelectColumn($alias . '.card_cardholder_identification_type');
            $criteria->addSelectColumn($alias . '.card_cardholder_identification_number');
            $criteria->addSelectColumn($alias . '.card_cardholder_name');
            $criteria->addSelectColumn($alias . '.card_date_created');
            $criteria->addSelectColumn($alias . '.card_date_last_updated');
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
        return Propel::getServiceContainer()->getDatabaseMap(ShipmentsPaymentsTableMap::DATABASE_NAME)->getTable(ShipmentsPaymentsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ShipmentsPaymentsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ShipmentsPaymentsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ShipmentsPaymentsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ShipmentsPayments or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ShipmentsPayments object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsPaymentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ShipmentsPayments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShipmentsPaymentsTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ShipmentsPaymentsTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ShipmentsPaymentsTableMap::COL_COLLECTION_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ShipmentsPaymentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShipmentsPaymentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShipmentsPaymentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the shipments_payments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ShipmentsPaymentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ShipmentsPayments or Criteria object.
     *
     * @param mixed               $criteria Criteria or ShipmentsPayments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsPaymentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ShipmentsPayments object
        }

        if ($criteria->containsKey(ShipmentsPaymentsTableMap::COL_ID) && $criteria->keyContainsValue(ShipmentsPaymentsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShipmentsPaymentsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ShipmentsPaymentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ShipmentsPaymentsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ShipmentsPaymentsTableMap::buildTableMap();
