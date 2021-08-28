<?php

namespace Map;

use \Chats;
use \ChatsQuery;
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
 * This class defines the structure of the 'chats' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ChatsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ChatsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'chats';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Chats';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Chats';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    const COL_ID = 'chats.id';

    /**
     * the column name for the id_transmitter field
     */
    const COL_ID_TRANSMITTER = 'chats.id_transmitter';

    /**
     * the column name for the id_receiver field
     */
    const COL_ID_RECEIVER = 'chats.id_receiver';

    /**
     * the column name for the message field
     */
    const COL_MESSAGE = 'chats.message';

    /**
     * the column name for the transmitter_date_sent field
     */
    const COL_TRANSMITTER_DATE_SENT = 'chats.transmitter_date_sent';

    /**
     * the column name for the transmitter_date_reading field
     */
    const COL_TRANSMITTER_DATE_READING = 'chats.transmitter_date_reading';

    /**
     * the column name for the receiver_date_sent field
     */
    const COL_RECEIVER_DATE_SENT = 'chats.receiver_date_sent';

    /**
     * the column name for the receiver_date_reading field
     */
    const COL_RECEIVER_DATE_READING = 'chats.receiver_date_reading';

    /**
     * the column name for the archived_transmitter field
     */
    const COL_ARCHIVED_TRANSMITTER = 'chats.archived_transmitter';

    /**
     * the column name for the archived_receiver field
     */
    const COL_ARCHIVED_RECEIVER = 'chats.archived_receiver';

    /**
     * the column name for the attachment_file field
     */
    const COL_ATTACHMENT_FILE = 'chats.attachment_file';

    /**
     * the column name for the attachment_group field
     */
    const COL_ATTACHMENT_GROUP = 'chats.attachment_group';

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
        self::TYPE_PHPNAME       => array('Id', 'IdTransmitter', 'IdReceiver', 'Message', 'TransmitterDateSent', 'TransmitterDateReading', 'ReceiverDateSent', 'ReceiverDateReading', 'ArchivedTransmitter', 'ArchivedReceiver', 'AttachmentFile', 'AttachmentGroup', ),
        self::TYPE_CAMELNAME     => array('id', 'idTransmitter', 'idReceiver', 'message', 'transmitterDateSent', 'transmitterDateReading', 'receiverDateSent', 'receiverDateReading', 'archivedTransmitter', 'archivedReceiver', 'attachmentFile', 'attachmentGroup', ),
        self::TYPE_COLNAME       => array(ChatsTableMap::COL_ID, ChatsTableMap::COL_ID_TRANSMITTER, ChatsTableMap::COL_ID_RECEIVER, ChatsTableMap::COL_MESSAGE, ChatsTableMap::COL_TRANSMITTER_DATE_SENT, ChatsTableMap::COL_TRANSMITTER_DATE_READING, ChatsTableMap::COL_RECEIVER_DATE_SENT, ChatsTableMap::COL_RECEIVER_DATE_READING, ChatsTableMap::COL_ARCHIVED_TRANSMITTER, ChatsTableMap::COL_ARCHIVED_RECEIVER, ChatsTableMap::COL_ATTACHMENT_FILE, ChatsTableMap::COL_ATTACHMENT_GROUP, ),
        self::TYPE_FIELDNAME     => array('id', 'id_transmitter', 'id_receiver', 'message', 'transmitter_date_sent', 'transmitter_date_reading', 'receiver_date_sent', 'receiver_date_reading', 'archived_transmitter', 'archived_receiver', 'attachment_file', 'attachment_group', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdTransmitter' => 1, 'IdReceiver' => 2, 'Message' => 3, 'TransmitterDateSent' => 4, 'TransmitterDateReading' => 5, 'ReceiverDateSent' => 6, 'ReceiverDateReading' => 7, 'ArchivedTransmitter' => 8, 'ArchivedReceiver' => 9, 'AttachmentFile' => 10, 'AttachmentGroup' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idTransmitter' => 1, 'idReceiver' => 2, 'message' => 3, 'transmitterDateSent' => 4, 'transmitterDateReading' => 5, 'receiverDateSent' => 6, 'receiverDateReading' => 7, 'archivedTransmitter' => 8, 'archivedReceiver' => 9, 'attachmentFile' => 10, 'attachmentGroup' => 11, ),
        self::TYPE_COLNAME       => array(ChatsTableMap::COL_ID => 0, ChatsTableMap::COL_ID_TRANSMITTER => 1, ChatsTableMap::COL_ID_RECEIVER => 2, ChatsTableMap::COL_MESSAGE => 3, ChatsTableMap::COL_TRANSMITTER_DATE_SENT => 4, ChatsTableMap::COL_TRANSMITTER_DATE_READING => 5, ChatsTableMap::COL_RECEIVER_DATE_SENT => 6, ChatsTableMap::COL_RECEIVER_DATE_READING => 7, ChatsTableMap::COL_ARCHIVED_TRANSMITTER => 8, ChatsTableMap::COL_ARCHIVED_RECEIVER => 9, ChatsTableMap::COL_ATTACHMENT_FILE => 10, ChatsTableMap::COL_ATTACHMENT_GROUP => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_transmitter' => 1, 'id_receiver' => 2, 'message' => 3, 'transmitter_date_sent' => 4, 'transmitter_date_reading' => 5, 'receiver_date_sent' => 6, 'receiver_date_reading' => 7, 'archived_transmitter' => 8, 'archived_receiver' => 9, 'attachment_file' => 10, 'attachment_group' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('chats');
        $this->setPhpName('Chats');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Chats');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_transmitter', 'IdTransmitter', 'INTEGER', false, null, null);
        $this->addColumn('id_receiver', 'IdReceiver', 'INTEGER', false, null, null);
        $this->addColumn('message', 'Message', 'LONGVARCHAR', false, null, null);
        $this->addColumn('transmitter_date_sent', 'TransmitterDateSent', 'TIMESTAMP', false, null, null);
        $this->addColumn('transmitter_date_reading', 'TransmitterDateReading', 'TIMESTAMP', false, null, null);
        $this->addColumn('receiver_date_sent', 'ReceiverDateSent', 'TIMESTAMP', false, null, null);
        $this->addColumn('receiver_date_reading', 'ReceiverDateReading', 'TIMESTAMP', false, null, null);
        $this->addColumn('archived_transmitter', 'ArchivedTransmitter', 'BOOLEAN', false, 1, false);
        $this->addColumn('archived_receiver', 'ArchivedReceiver', 'BOOLEAN', false, 1, false);
        $this->addColumn('attachment_file', 'AttachmentFile', 'VARCHAR', false, 64, null);
        $this->addColumn('attachment_group', 'AttachmentGroup', 'BIGINT', false, null, null);
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
        return $withPrefix ? ChatsTableMap::CLASS_DEFAULT : ChatsTableMap::OM_CLASS;
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
     * @return array           (Chats object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ChatsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ChatsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ChatsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ChatsTableMap::OM_CLASS;
            /** @var Chats $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ChatsTableMap::addInstanceToPool($obj, $key);
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
            $key = ChatsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ChatsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Chats $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ChatsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ChatsTableMap::COL_ID);
            $criteria->addSelectColumn(ChatsTableMap::COL_ID_TRANSMITTER);
            $criteria->addSelectColumn(ChatsTableMap::COL_ID_RECEIVER);
            $criteria->addSelectColumn(ChatsTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(ChatsTableMap::COL_TRANSMITTER_DATE_SENT);
            $criteria->addSelectColumn(ChatsTableMap::COL_TRANSMITTER_DATE_READING);
            $criteria->addSelectColumn(ChatsTableMap::COL_RECEIVER_DATE_SENT);
            $criteria->addSelectColumn(ChatsTableMap::COL_RECEIVER_DATE_READING);
            $criteria->addSelectColumn(ChatsTableMap::COL_ARCHIVED_TRANSMITTER);
            $criteria->addSelectColumn(ChatsTableMap::COL_ARCHIVED_RECEIVER);
            $criteria->addSelectColumn(ChatsTableMap::COL_ATTACHMENT_FILE);
            $criteria->addSelectColumn(ChatsTableMap::COL_ATTACHMENT_GROUP);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_transmitter');
            $criteria->addSelectColumn($alias . '.id_receiver');
            $criteria->addSelectColumn($alias . '.message');
            $criteria->addSelectColumn($alias . '.transmitter_date_sent');
            $criteria->addSelectColumn($alias . '.transmitter_date_reading');
            $criteria->addSelectColumn($alias . '.receiver_date_sent');
            $criteria->addSelectColumn($alias . '.receiver_date_reading');
            $criteria->addSelectColumn($alias . '.archived_transmitter');
            $criteria->addSelectColumn($alias . '.archived_receiver');
            $criteria->addSelectColumn($alias . '.attachment_file');
            $criteria->addSelectColumn($alias . '.attachment_group');
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
        return Propel::getServiceContainer()->getDatabaseMap(ChatsTableMap::DATABASE_NAME)->getTable(ChatsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ChatsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ChatsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ChatsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Chats or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Chats object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ChatsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Chats) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ChatsTableMap::DATABASE_NAME);
            $criteria->add(ChatsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ChatsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ChatsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ChatsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the chats table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ChatsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Chats or Criteria object.
     *
     * @param mixed               $criteria Criteria or Chats object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ChatsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Chats object
        }

        if ($criteria->containsKey(ChatsTableMap::COL_ID) && $criteria->keyContainsValue(ChatsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ChatsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ChatsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ChatsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ChatsTableMap::buildTableMap();
