<?php

namespace Base;

use \NotificationsDeleted as ChildNotificationsDeleted;
use \NotificationsDeletedQuery as ChildNotificationsDeletedQuery;
use \Exception;
use \PDO;
use Map\NotificationsDeletedTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'notifications_deleted' table.
 *
 *
 *
 * @method     ChildNotificationsDeletedQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildNotificationsDeletedQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildNotificationsDeletedQuery orderByIdNotification($order = Criteria::ASC) Order by the id_notification column
 * @method     ChildNotificationsDeletedQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 *
 * @method     ChildNotificationsDeletedQuery groupById() Group by the id column
 * @method     ChildNotificationsDeletedQuery groupByIdUser() Group by the id_user column
 * @method     ChildNotificationsDeletedQuery groupByIdNotification() Group by the id_notification column
 * @method     ChildNotificationsDeletedQuery groupByDeletedAt() Group by the deleted_at column
 *
 * @method     ChildNotificationsDeletedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNotificationsDeletedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNotificationsDeletedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNotificationsDeleted findOne(ConnectionInterface $con = null) Return the first ChildNotificationsDeleted matching the query
 * @method     ChildNotificationsDeleted findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNotificationsDeleted matching the query, or a new ChildNotificationsDeleted object populated from the query conditions when no match is found
 *
 * @method     ChildNotificationsDeleted findOneById(int $id) Return the first ChildNotificationsDeleted filtered by the id column
 * @method     ChildNotificationsDeleted findOneByIdUser(int $id_user) Return the first ChildNotificationsDeleted filtered by the id_user column
 * @method     ChildNotificationsDeleted findOneByIdNotification(int $id_notification) Return the first ChildNotificationsDeleted filtered by the id_notification column
 * @method     ChildNotificationsDeleted findOneByDeletedAt(string $deleted_at) Return the first ChildNotificationsDeleted filtered by the deleted_at column *

 * @method     ChildNotificationsDeleted requirePk($key, ConnectionInterface $con = null) Return the ChildNotificationsDeleted by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationsDeleted requireOne(ConnectionInterface $con = null) Return the first ChildNotificationsDeleted matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotificationsDeleted requireOneById(int $id) Return the first ChildNotificationsDeleted filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationsDeleted requireOneByIdUser(int $id_user) Return the first ChildNotificationsDeleted filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationsDeleted requireOneByIdNotification(int $id_notification) Return the first ChildNotificationsDeleted filtered by the id_notification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationsDeleted requireOneByDeletedAt(string $deleted_at) Return the first ChildNotificationsDeleted filtered by the deleted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotificationsDeleted[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNotificationsDeleted objects based on current ModelCriteria
 * @method     ChildNotificationsDeleted[]|ObjectCollection findById(int $id) Return ChildNotificationsDeleted objects filtered by the id column
 * @method     ChildNotificationsDeleted[]|ObjectCollection findByIdUser(int $id_user) Return ChildNotificationsDeleted objects filtered by the id_user column
 * @method     ChildNotificationsDeleted[]|ObjectCollection findByIdNotification(int $id_notification) Return ChildNotificationsDeleted objects filtered by the id_notification column
 * @method     ChildNotificationsDeleted[]|ObjectCollection findByDeletedAt(string $deleted_at) Return ChildNotificationsDeleted objects filtered by the deleted_at column
 * @method     ChildNotificationsDeleted[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NotificationsDeletedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\NotificationsDeletedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\NotificationsDeleted', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNotificationsDeletedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNotificationsDeletedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNotificationsDeletedQuery) {
            return $criteria;
        }
        $query = new ChildNotificationsDeletedQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildNotificationsDeleted|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotificationsDeletedTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NotificationsDeletedTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNotificationsDeleted A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_notification`, `deleted_at` FROM `notifications_deleted` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildNotificationsDeleted $obj */
            $obj = new ChildNotificationsDeleted();
            $obj->hydrate($row);
            NotificationsDeletedTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildNotificationsDeleted|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildNotificationsDeletedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNotificationsDeletedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsDeletedQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsDeletedQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_notification column
     *
     * Example usage:
     * <code>
     * $query->filterByIdNotification(1234); // WHERE id_notification = 1234
     * $query->filterByIdNotification(array(12, 34)); // WHERE id_notification IN (12, 34)
     * $query->filterByIdNotification(array('min' => 12)); // WHERE id_notification > 12
     * </code>
     *
     * @param     mixed $idNotification The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsDeletedQuery The current query, for fluid interface
     */
    public function filterByIdNotification($idNotification = null, $comparison = null)
    {
        if (is_array($idNotification)) {
            $useMinMax = false;
            if (isset($idNotification['min'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID_NOTIFICATION, $idNotification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idNotification['max'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID_NOTIFICATION, $idNotification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID_NOTIFICATION, $idNotification, $comparison);
    }

    /**
     * Filter the query on the deleted_at column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedAt('2011-03-14'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt('now'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt(array('max' => 'yesterday')); // WHERE deleted_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $deletedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsDeletedQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(NotificationsDeletedTableMap::COL_DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsDeletedTableMap::COL_DELETED_AT, $deletedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNotificationsDeleted $notificationsDeleted Object to remove from the list of results
     *
     * @return $this|ChildNotificationsDeletedQuery The current query, for fluid interface
     */
    public function prune($notificationsDeleted = null)
    {
        if ($notificationsDeleted) {
            $this->addUsingAlias(NotificationsDeletedTableMap::COL_ID, $notificationsDeleted->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the notifications_deleted table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsDeletedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NotificationsDeletedTableMap::clearInstancePool();
            NotificationsDeletedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsDeletedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NotificationsDeletedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NotificationsDeletedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NotificationsDeletedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // NotificationsDeletedQuery
