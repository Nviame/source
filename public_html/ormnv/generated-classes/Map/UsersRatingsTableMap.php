<?php

namespace Map;

use \UsersRatings;
use \UsersRatingsQuery;
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
 * This class defines the structure of the 'users_ratings' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsersRatingsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UsersRatingsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'users_ratings';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\UsersRatings';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'UsersRatings';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    const COL_ID = 'users_ratings.id';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'users_ratings.id_user';

    /**
     * the column name for the id_shipment field
     */
    const COL_ID_SHIPMENT = 'users_ratings.id_shipment';

    /**
     * the column name for the rating field
     */
    const COL_RATING = 'users_ratings.rating';

    /**
     * the column name for the comments field
     */
    const COL_COMMENTS = 'users_ratings.comments';

    /**
     * the column name for the register_at field
     */
    const COL_REGISTER_AT = 'users_ratings.register_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdUser', 'IdShipment', 'Rating', 'Comments', 'RegisterAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idUser', 'idShipment', 'rating', 'comments', 'registerAt', ),
        self::TYPE_COLNAME       => array(UsersRatingsTableMap::COL_ID, UsersRatingsTableMap::COL_ID_USER, UsersRatingsTableMap::COL_ID_SHIPMENT, UsersRatingsTableMap::COL_RATING, UsersRatingsTableMap::COL_COMMENTS, UsersRatingsTableMap::COL_REGISTER_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_user', 'id_shipment', 'rating', 'comments', 'register_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdUser' => 1, 'IdShipment' => 2, 'Rating' => 3, 'Comments' => 4, 'RegisterAt' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idUser' => 1, 'idShipment' => 2, 'rating' => 3, 'comments' => 4, 'registerAt' => 5, ),
        self::TYPE_COLNAME       => array(UsersRatingsTableMap::COL_ID => 0, UsersRatingsTableMap::COL_ID_USER => 1, UsersRatingsTableMap::COL_ID_SHIPMENT => 2, UsersRatingsTableMap::COL_RATING => 3, UsersRatingsTableMap::COL_COMMENTS => 4, UsersRatingsTableMap::COL_REGISTER_AT => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_user' => 1, 'id_shipment' => 2, 'rating' => 3, 'comments' => 4, 'register_at' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('users_ratings');
        $this->setPhpName('UsersRatings');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\UsersRatings');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_user', 'IdUser', 'INTEGER', false, null, null);
        $this->addColumn('id_shipment', 'IdShipment', 'INTEGER', false, null, null);
        $this->addColumn('rating', 'Rating', 'DOUBLE', false, null, null);
        $this->addColumn('comments', 'Comments', 'LONGVARCHAR', false, null, null);
        $this->addColumn('register_at', 'RegisterAt', 'TIMESTAMP', false, null, null);
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
        return $withPrefix ? UsersRatingsTableMap::CLASS_DEFAULT : UsersRatingsTableMap::OM_CLASS;
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
     * @return array           (UsersRatings object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersRatingsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersRatingsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersRatingsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersRatingsTableMap::OM_CLASS;
            /** @var UsersRatings $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersRatingsTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersRatingsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersRatingsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UsersRatings $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersRatingsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersRatingsTableMap::COL_ID);
            $criteria->addSelectColumn(UsersRatingsTableMap::COL_ID_USER);
            $criteria->addSelectColumn(UsersRatingsTableMap::COL_ID_SHIPMENT);
            $criteria->addSelectColumn(UsersRatingsTableMap::COL_RATING);
            $criteria->addSelectColumn(UsersRatingsTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(UsersRatingsTableMap::COL_REGISTER_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.id_shipment');
            $criteria->addSelectColumn($alias . '.rating');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.register_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersRatingsTableMap::DATABASE_NAME)->getTable(UsersRatingsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsersRatingsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsersRatingsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsersRatingsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UsersRatings or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UsersRatings object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersRatingsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \UsersRatings) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersRatingsTableMap::DATABASE_NAME);
            $criteria->add(UsersRatingsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersRatingsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersRatingsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersRatingsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users_ratings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersRatingsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UsersRatings or Criteria object.
     *
     * @param mixed               $criteria Criteria or UsersRatings object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersRatingsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UsersRatings object
        }

        if ($criteria->containsKey(UsersRatingsTableMap::COL_ID) && $criteria->keyContainsValue(UsersRatingsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersRatingsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersRatingsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersRatingsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsersRatingsTableMap::buildTableMap();
