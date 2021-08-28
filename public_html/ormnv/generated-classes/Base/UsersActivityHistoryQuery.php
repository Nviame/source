<?php

namespace Base;

use \UsersActivityHistory as ChildUsersActivityHistory;
use \UsersActivityHistoryQuery as ChildUsersActivityHistoryQuery;
use \Exception;
use \PDO;
use Map\UsersActivityHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_activity_history' table.
 *
 *
 *
 * @method     ChildUsersActivityHistoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersActivityHistoryQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildUsersActivityHistoryQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildUsersActivityHistoryQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildUsersActivityHistoryQuery orderByPreviousBalance($order = Criteria::ASC) Order by the previous_balance column
 * @method     ChildUsersActivityHistoryQuery orderByNewBalance($order = Criteria::ASC) Order by the new_balance column
 * @method     ChildUsersActivityHistoryQuery orderByDateTime($order = Criteria::ASC) Order by the date_time column
 *
 * @method     ChildUsersActivityHistoryQuery groupById() Group by the id column
 * @method     ChildUsersActivityHistoryQuery groupByIdUser() Group by the id_user column
 * @method     ChildUsersActivityHistoryQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildUsersActivityHistoryQuery groupByType() Group by the type column
 * @method     ChildUsersActivityHistoryQuery groupByPreviousBalance() Group by the previous_balance column
 * @method     ChildUsersActivityHistoryQuery groupByNewBalance() Group by the new_balance column
 * @method     ChildUsersActivityHistoryQuery groupByDateTime() Group by the date_time column
 *
 * @method     ChildUsersActivityHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersActivityHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersActivityHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersActivityHistory findOne(ConnectionInterface $con = null) Return the first ChildUsersActivityHistory matching the query
 * @method     ChildUsersActivityHistory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersActivityHistory matching the query, or a new ChildUsersActivityHistory object populated from the query conditions when no match is found
 *
 * @method     ChildUsersActivityHistory findOneById(int $id) Return the first ChildUsersActivityHistory filtered by the id column
 * @method     ChildUsersActivityHistory findOneByIdUser(int $id_user) Return the first ChildUsersActivityHistory filtered by the id_user column
 * @method     ChildUsersActivityHistory findOneByIdShipment(int $id_shipment) Return the first ChildUsersActivityHistory filtered by the id_shipment column
 * @method     ChildUsersActivityHistory findOneByType(int $type) Return the first ChildUsersActivityHistory filtered by the type column
 * @method     ChildUsersActivityHistory findOneByPreviousBalance(double $previous_balance) Return the first ChildUsersActivityHistory filtered by the previous_balance column
 * @method     ChildUsersActivityHistory findOneByNewBalance(double $new_balance) Return the first ChildUsersActivityHistory filtered by the new_balance column
 * @method     ChildUsersActivityHistory findOneByDateTime(string $date_time) Return the first ChildUsersActivityHistory filtered by the date_time column *

 * @method     ChildUsersActivityHistory requirePk($key, ConnectionInterface $con = null) Return the ChildUsersActivityHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersActivityHistory requireOne(ConnectionInterface $con = null) Return the first ChildUsersActivityHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersActivityHistory requireOneById(int $id) Return the first ChildUsersActivityHistory filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersActivityHistory requireOneByIdUser(int $id_user) Return the first ChildUsersActivityHistory filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersActivityHistory requireOneByIdShipment(int $id_shipment) Return the first ChildUsersActivityHistory filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersActivityHistory requireOneByType(int $type) Return the first ChildUsersActivityHistory filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersActivityHistory requireOneByPreviousBalance(double $previous_balance) Return the first ChildUsersActivityHistory filtered by the previous_balance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersActivityHistory requireOneByNewBalance(double $new_balance) Return the first ChildUsersActivityHistory filtered by the new_balance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersActivityHistory requireOneByDateTime(string $date_time) Return the first ChildUsersActivityHistory filtered by the date_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersActivityHistory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersActivityHistory objects based on current ModelCriteria
 * @method     ChildUsersActivityHistory[]|ObjectCollection findById(int $id) Return ChildUsersActivityHistory objects filtered by the id column
 * @method     ChildUsersActivityHistory[]|ObjectCollection findByIdUser(int $id_user) Return ChildUsersActivityHistory objects filtered by the id_user column
 * @method     ChildUsersActivityHistory[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildUsersActivityHistory objects filtered by the id_shipment column
 * @method     ChildUsersActivityHistory[]|ObjectCollection findByType(int $type) Return ChildUsersActivityHistory objects filtered by the type column
 * @method     ChildUsersActivityHistory[]|ObjectCollection findByPreviousBalance(double $previous_balance) Return ChildUsersActivityHistory objects filtered by the previous_balance column
 * @method     ChildUsersActivityHistory[]|ObjectCollection findByNewBalance(double $new_balance) Return ChildUsersActivityHistory objects filtered by the new_balance column
 * @method     ChildUsersActivityHistory[]|ObjectCollection findByDateTime(string $date_time) Return ChildUsersActivityHistory objects filtered by the date_time column
 * @method     ChildUsersActivityHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersActivityHistoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersActivityHistoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersActivityHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersActivityHistoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersActivityHistoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersActivityHistoryQuery) {
            return $criteria;
        }
        $query = new ChildUsersActivityHistoryQuery();
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
     * @return ChildUsersActivityHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersActivityHistoryTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersActivityHistoryTableMap::DATABASE_NAME);
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
     * @return ChildUsersActivityHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_shipment`, `type`, `previous_balance`, `new_balance`, `date_time` FROM `users_activity_history` WHERE `id` = :p0';
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
            /** @var ChildUsersActivityHistory $obj */
            $obj = new ChildUsersActivityHistory();
            $obj->hydrate($row);
            UsersActivityHistoryTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsersActivityHistory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_shipment column
     *
     * Example usage:
     * <code>
     * $query->filterByIdShipment(1234); // WHERE id_shipment = 1234
     * $query->filterByIdShipment(array(12, 34)); // WHERE id_shipment IN (12, 34)
     * $query->filterByIdShipment(array('min' => 12)); // WHERE id_shipment > 12
     * </code>
     *
     * @param     mixed $idShipment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType(1234); // WHERE type = 1234
     * $query->filterByType(array(12, 34)); // WHERE type IN (12, 34)
     * $query->filterByType(array('min' => 12)); // WHERE type > 12
     * </code>
     *
     * @param     mixed $type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_TYPE, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_TYPE, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the previous_balance column
     *
     * Example usage:
     * <code>
     * $query->filterByPreviousBalance(1234); // WHERE previous_balance = 1234
     * $query->filterByPreviousBalance(array(12, 34)); // WHERE previous_balance IN (12, 34)
     * $query->filterByPreviousBalance(array('min' => 12)); // WHERE previous_balance > 12
     * </code>
     *
     * @param     mixed $previousBalance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByPreviousBalance($previousBalance = null, $comparison = null)
    {
        if (is_array($previousBalance)) {
            $useMinMax = false;
            if (isset($previousBalance['min'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_PREVIOUS_BALANCE, $previousBalance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($previousBalance['max'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_PREVIOUS_BALANCE, $previousBalance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_PREVIOUS_BALANCE, $previousBalance, $comparison);
    }

    /**
     * Filter the query on the new_balance column
     *
     * Example usage:
     * <code>
     * $query->filterByNewBalance(1234); // WHERE new_balance = 1234
     * $query->filterByNewBalance(array(12, 34)); // WHERE new_balance IN (12, 34)
     * $query->filterByNewBalance(array('min' => 12)); // WHERE new_balance > 12
     * </code>
     *
     * @param     mixed $newBalance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByNewBalance($newBalance = null, $comparison = null)
    {
        if (is_array($newBalance)) {
            $useMinMax = false;
            if (isset($newBalance['min'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_NEW_BALANCE, $newBalance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newBalance['max'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_NEW_BALANCE, $newBalance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_NEW_BALANCE, $newBalance, $comparison);
    }

    /**
     * Filter the query on the date_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDateTime('2011-03-14'); // WHERE date_time = '2011-03-14'
     * $query->filterByDateTime('now'); // WHERE date_time = '2011-03-14'
     * $query->filterByDateTime(array('max' => 'yesterday')); // WHERE date_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function filterByDateTime($dateTime = null, $comparison = null)
    {
        if (is_array($dateTime)) {
            $useMinMax = false;
            if (isset($dateTime['min'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_DATE_TIME, $dateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateTime['max'])) {
                $this->addUsingAlias(UsersActivityHistoryTableMap::COL_DATE_TIME, $dateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersActivityHistoryTableMap::COL_DATE_TIME, $dateTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersActivityHistory $usersActivityHistory Object to remove from the list of results
     *
     * @return $this|ChildUsersActivityHistoryQuery The current query, for fluid interface
     */
    public function prune($usersActivityHistory = null)
    {
        if ($usersActivityHistory) {
            $this->addUsingAlias(UsersActivityHistoryTableMap::COL_ID, $usersActivityHistory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_activity_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersActivityHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersActivityHistoryTableMap::clearInstancePool();
            UsersActivityHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersActivityHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersActivityHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersActivityHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersActivityHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersActivityHistoryQuery
