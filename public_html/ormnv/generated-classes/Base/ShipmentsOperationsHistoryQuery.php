<?php

namespace Base;

use \ShipmentsOperationsHistory as ChildShipmentsOperationsHistory;
use \ShipmentsOperationsHistoryQuery as ChildShipmentsOperationsHistoryQuery;
use \Exception;
use \PDO;
use Map\ShipmentsOperationsHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipments_operations_history' table.
 *
 *
 *
 * @method     ChildShipmentsOperationsHistoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentsOperationsHistoryQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildShipmentsOperationsHistoryQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildShipmentsOperationsHistoryQuery orderByUid($order = Criteria::ASC) Order by the uid column
 * @method     ChildShipmentsOperationsHistoryQuery orderByDatetime($order = Criteria::ASC) Order by the datetime column
 * @method     ChildShipmentsOperationsHistoryQuery orderByValor($order = Criteria::ASC) Order by the valor column
 *
 * @method     ChildShipmentsOperationsHistoryQuery groupById() Group by the id column
 * @method     ChildShipmentsOperationsHistoryQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildShipmentsOperationsHistoryQuery groupByIdUser() Group by the id_user column
 * @method     ChildShipmentsOperationsHistoryQuery groupByUid() Group by the uid column
 * @method     ChildShipmentsOperationsHistoryQuery groupByDatetime() Group by the datetime column
 * @method     ChildShipmentsOperationsHistoryQuery groupByValor() Group by the valor column
 *
 * @method     ChildShipmentsOperationsHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentsOperationsHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentsOperationsHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentsOperationsHistory findOne(ConnectionInterface $con = null) Return the first ChildShipmentsOperationsHistory matching the query
 * @method     ChildShipmentsOperationsHistory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentsOperationsHistory matching the query, or a new ChildShipmentsOperationsHistory object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentsOperationsHistory findOneById(int $id) Return the first ChildShipmentsOperationsHistory filtered by the id column
 * @method     ChildShipmentsOperationsHistory findOneByIdShipment(int $id_shipment) Return the first ChildShipmentsOperationsHistory filtered by the id_shipment column
 * @method     ChildShipmentsOperationsHistory findOneByIdUser(int $id_user) Return the first ChildShipmentsOperationsHistory filtered by the id_user column
 * @method     ChildShipmentsOperationsHistory findOneByUid(string $uid) Return the first ChildShipmentsOperationsHistory filtered by the uid column
 * @method     ChildShipmentsOperationsHistory findOneByDatetime(string $datetime) Return the first ChildShipmentsOperationsHistory filtered by the datetime column
 * @method     ChildShipmentsOperationsHistory findOneByValor(int $valor) Return the first ChildShipmentsOperationsHistory filtered by the valor column *

 * @method     ChildShipmentsOperationsHistory requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentsOperationsHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOperationsHistory requireOne(ConnectionInterface $con = null) Return the first ChildShipmentsOperationsHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsOperationsHistory requireOneById(int $id) Return the first ChildShipmentsOperationsHistory filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOperationsHistory requireOneByIdShipment(int $id_shipment) Return the first ChildShipmentsOperationsHistory filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOperationsHistory requireOneByIdUser(int $id_user) Return the first ChildShipmentsOperationsHistory filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOperationsHistory requireOneByUid(string $uid) Return the first ChildShipmentsOperationsHistory filtered by the uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOperationsHistory requireOneByDatetime(string $datetime) Return the first ChildShipmentsOperationsHistory filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOperationsHistory requireOneByValor(int $valor) Return the first ChildShipmentsOperationsHistory filtered by the valor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsOperationsHistory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentsOperationsHistory objects based on current ModelCriteria
 * @method     ChildShipmentsOperationsHistory[]|ObjectCollection findById(int $id) Return ChildShipmentsOperationsHistory objects filtered by the id column
 * @method     ChildShipmentsOperationsHistory[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildShipmentsOperationsHistory objects filtered by the id_shipment column
 * @method     ChildShipmentsOperationsHistory[]|ObjectCollection findByIdUser(int $id_user) Return ChildShipmentsOperationsHistory objects filtered by the id_user column
 * @method     ChildShipmentsOperationsHistory[]|ObjectCollection findByUid(string $uid) Return ChildShipmentsOperationsHistory objects filtered by the uid column
 * @method     ChildShipmentsOperationsHistory[]|ObjectCollection findByDatetime(string $datetime) Return ChildShipmentsOperationsHistory objects filtered by the datetime column
 * @method     ChildShipmentsOperationsHistory[]|ObjectCollection findByValor(int $valor) Return ChildShipmentsOperationsHistory objects filtered by the valor column
 * @method     ChildShipmentsOperationsHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentsOperationsHistoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentsOperationsHistoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ShipmentsOperationsHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentsOperationsHistoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentsOperationsHistoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentsOperationsHistoryQuery) {
            return $criteria;
        }
        $query = new ChildShipmentsOperationsHistoryQuery();
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
     * @return ChildShipmentsOperationsHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShipmentsOperationsHistoryTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsOperationsHistoryTableMap::DATABASE_NAME);
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
     * @return ChildShipmentsOperationsHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_shipment`, `id_user`, `uid`, `datetime`, `valor` FROM `shipments_operations_history` WHERE `id` = :p0';
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
            /** @var ChildShipmentsOperationsHistory $obj */
            $obj = new ChildShipmentsOperationsHistory();
            $obj->hydrate($row);
            ShipmentsOperationsHistoryTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildShipmentsOperationsHistory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
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
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the uid column
     *
     * Example usage:
     * <code>
     * $query->filterByUid('fooValue');   // WHERE uid = 'fooValue'
     * $query->filterByUid('%fooValue%'); // WHERE uid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterByUid($uid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uid)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uid)) {
                $uid = str_replace('*', '%', $uid);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_UID, $uid, $comparison);
    }

    /**
     * Filter the query on the datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByDatetime('2011-03-14'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime('now'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime(array('max' => 'yesterday')); // WHERE datetime > '2011-03-13'
     * </code>
     *
     * @param     mixed $datetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (is_array($datetime)) {
            $useMinMax = false;
            if (isset($datetime['min'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_DATETIME, $datetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datetime['max'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_DATETIME, $datetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_DATETIME, $datetime, $comparison);
    }

    /**
     * Filter the query on the valor column
     *
     * Example usage:
     * <code>
     * $query->filterByValor(1234); // WHERE valor = 1234
     * $query->filterByValor(array(12, 34)); // WHERE valor IN (12, 34)
     * $query->filterByValor(array('min' => 12)); // WHERE valor > 12
     * </code>
     *
     * @param     mixed $valor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function filterByValor($valor = null, $comparison = null)
    {
        if (is_array($valor)) {
            $useMinMax = false;
            if (isset($valor['min'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_VALOR, $valor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valor['max'])) {
                $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_VALOR, $valor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_VALOR, $valor, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipmentsOperationsHistory $shipmentsOperationsHistory Object to remove from the list of results
     *
     * @return $this|ChildShipmentsOperationsHistoryQuery The current query, for fluid interface
     */
    public function prune($shipmentsOperationsHistory = null)
    {
        if ($shipmentsOperationsHistory) {
            $this->addUsingAlias(ShipmentsOperationsHistoryTableMap::COL_ID, $shipmentsOperationsHistory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipments_operations_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOperationsHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentsOperationsHistoryTableMap::clearInstancePool();
            ShipmentsOperationsHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOperationsHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentsOperationsHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentsOperationsHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentsOperationsHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentsOperationsHistoryQuery
