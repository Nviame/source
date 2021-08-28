<?php

namespace Map;

use \CommercesReminders;
use \CommercesRemindersQuery;
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
 * This class defines the structure of the 'commerces_reminders' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CommercesRemindersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CommercesRemindersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'commerces_reminders';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CommercesReminders';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CommercesReminders';

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
    const COL_ID = 'commerces_reminders.id';

    /**
     * the column name for the id_commerce field
     */
    const COL_ID_COMMERCE = 'commerces_reminders.id_commerce';

    /**
     * the column name for the icon field
     */
    const COL_ICON = 'commerces_reminders.icon';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'commerces_reminders.title';

    /**
     * the column name for the content field
     */
    const COL_CONTENT = 'commerces_reminders.content';

    /**
     * the column name for the registered_at field
     */
    const COL_REGISTERED_AT = 'commerces_reminders.registered_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'commerces_reminders.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdCommerce', 'Icon', 'Title', 'Content', 'RegisteredAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idCommerce', 'icon', 'title', 'content', 'registeredAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(CommercesRemindersTableMap::COL_ID, CommercesRemindersTableMap::COL_ID_COMMERCE, CommercesRemindersTableMap::COL_ICON, CommercesRemindersTableMap::COL_TITLE, CommercesRemindersTableMap::COL_CONTENT, CommercesRemindersTableMap::COL_REGISTERED_AT, CommercesRemindersTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_commerce', 'icon', 'title', 'content', 'registered_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdCommerce' => 1, 'Icon' => 2, 'Title' => 3, 'Content' => 4, 'RegisteredAt' => 5, 'UpdatedAt' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idCommerce' => 1, 'icon' => 2, 'title' => 3, 'content' => 4, 'registeredAt' => 5, 'updatedAt' => 6, ),
        self::TYPE_COLNAME       => array(CommercesRemindersTableMap::COL_ID => 0, CommercesRemindersTableMap::COL_ID_COMMERCE => 1, CommercesRemindersTableMap::COL_ICON => 2, CommercesRemindersTableMap::COL_TITLE => 3, CommercesRemindersTableMap::COL_CONTENT => 4, CommercesRemindersTableMap::COL_REGISTERED_AT => 5, CommercesRemindersTableMap::COL_UPDATED_AT => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_commerce' => 1, 'icon' => 2, 'title' => 3, 'content' => 4, 'registered_at' => 5, 'updated_at' => 6, ),
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
        $this->setName('commerces_reminders');
        $this->setPhpName('CommercesReminders');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\CommercesReminders');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('id_commerce', 'IdCommerce', 'INTEGER', 'commerces', 'id', false, null, null);
        $this->addColumn('icon', 'Icon', 'VARCHAR', false, 48, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 64, null);
        $this->addColumn('content', 'Content', 'VARCHAR', false, 96, null);
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
        return $withPrefix ? CommercesRemindersTableMap::CLASS_DEFAULT : CommercesRemindersTableMap::OM_CLASS;
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
     * @return array           (CommercesReminders object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CommercesRemindersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CommercesRemindersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CommercesRemindersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CommercesRemindersTableMap::OM_CLASS;
            /** @var CommercesReminders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CommercesRemindersTableMap::addInstanceToPool($obj, $key);
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
            $key = CommercesRemindersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CommercesRemindersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CommercesReminders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CommercesRemindersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CommercesRemindersTableMap::COL_ID);
            $criteria->addSelectColumn(CommercesRemindersTableMap::COL_ID_COMMERCE);
            $criteria->addSelectColumn(CommercesRemindersTableMap::COL_ICON);
            $criteria->addSelectColumn(CommercesRemindersTableMap::COL_TITLE);
            $criteria->addSelectColumn(CommercesRemindersTableMap::COL_CONTENT);
            $criteria->addSelectColumn(CommercesRemindersTableMap::COL_REGISTERED_AT);
            $criteria->addSelectColumn(CommercesRemindersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_commerce');
            $criteria->addSelectColumn($alias . '.icon');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.content');
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
        return Propel::getServiceContainer()->getDatabaseMap(CommercesRemindersTableMap::DATABASE_NAME)->getTable(CommercesRemindersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CommercesRemindersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CommercesRemindersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CommercesRemindersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CommercesReminders or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CommercesReminders object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesRemindersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CommercesReminders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CommercesRemindersTableMap::DATABASE_NAME);
            $criteria->add(CommercesRemindersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CommercesRemindersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CommercesRemindersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CommercesRemindersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the commerces_reminders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CommercesRemindersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CommercesReminders or Criteria object.
     *
     * @param mixed               $criteria Criteria or CommercesReminders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesRemindersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CommercesReminders object
        }

        if ($criteria->containsKey(CommercesRemindersTableMap::COL_ID) && $criteria->keyContainsValue(CommercesRemindersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CommercesRemindersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CommercesRemindersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CommercesRemindersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CommercesRemindersTableMap::buildTableMap();
