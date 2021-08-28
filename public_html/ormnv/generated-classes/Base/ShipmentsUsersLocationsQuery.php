<?php

namespace Base;

use \ShipmentsUsersLocations as ChildShipmentsUsersLocations;
use \ShipmentsUsersLocationsQuery as ChildShipmentsUsersLocationsQuery;
use \Exception;
use \PDO;
use Map\ShipmentsUsersLocationsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipments_users_locations' table.
 *
 *
 *
 * @method     ChildShipmentsUsersLocationsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentsUsersLocationsQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildShipmentsUsersLocationsQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildShipmentsUsersLocationsQuery orderByLat($order = Criteria::ASC) Order by the lat column
 * @method     ChildShipmentsUsersLocationsQuery orderByLng($order = Criteria::ASC) Order by the lng column
 * @method     ChildShipmentsUsersLocationsQuery orderByDatetime($order = Criteria::ASC) Order by the datetime column
 *
 * @method     ChildShipmentsUsersLocationsQuery groupById() Group by the id column
 * @method     ChildShipmentsUsersLocationsQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildShipmentsUsersLocationsQuery groupByIdUser() Group by the id_user column
 * @method     ChildShipmentsUsersLocationsQuery groupByLat() Group by the lat column
 * @method     ChildShipmentsUsersLocationsQuery groupByLng() Group by the lng column
 * @method     ChildShipmentsUsersLocationsQuery groupByDatetime() Group by the datetime column
 *
 * @method     ChildShipmentsUsersLocationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentsUsersLocationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentsUsersLocationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentsUsersLocations findOne(ConnectionInterface $con = null) Return the first ChildShipmentsUsersLocations matching the query
 * @method     ChildShipmentsUsersLocations findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentsUsersLocations matching the query, or a new ChildShipmentsUsersLocations object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentsUsersLocations findOneById(int $id) Return the first ChildShipmentsUsersLocations filtered by the id column
 * @method     ChildShipmentsUsersLocations findOneByIdShipment(int $id_shipment) Return the first ChildShipmentsUsersLocations filtered by the id_shipment column
 * @method     ChildShipmentsUsersLocations findOneByIdUser(int $id_user) Return the first ChildShipmentsUsersLocations filtered by the id_user column
 * @method     ChildShipmentsUsersLocations findOneByLat(string $lat) Return the first ChildShipmentsUsersLocations filtered by the lat column
 * @method     ChildShipmentsUsersLocations findOneByLng(string $lng) Return the first ChildShipmentsUsersLocations filtered by the lng column
 * @method     ChildShipmentsUsersLocations findOneByDatetime(string $datetime) Return the first ChildShipmentsUsersLocations filtered by the datetime column *

 * @method     ChildShipmentsUsersLocations requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentsUsersLocations by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsUsersLocations requireOne(ConnectionInterface $con = null) Return the first ChildShipmentsUsersLocations matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsUsersLocations requireOneById(int $id) Return the first ChildShipmentsUsersLocations filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsUsersLocations requireOneByIdShipment(int $id_shipment) Return the first ChildShipmentsUsersLocations filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsUsersLocations requireOneByIdUser(int $id_user) Return the first ChildShipmentsUsersLocations filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsUsersLocations requireOneByLat(string $lat) Return the first ChildShipmentsUsersLocations filtered by the lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsUsersLocations requireOneByLng(string $lng) Return the first ChildShipmentsUsersLocations filtered by the lng column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsUsersLocations requireOneByDatetime(string $datetime) Return the first ChildShipmentsUsersLocations filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsUsersLocations[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentsUsersLocations objects based on current ModelCriteria
 * @method     ChildShipmentsUsersLocations[]|ObjectCollection findById(int $id) Return ChildShipmentsUsersLocations objects filtered by the id column
 * @method     ChildShipmentsUsersLocations[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildShipmentsUsersLocations objects filtered by the id_shipment column
 * @method     ChildShipmentsUsersLocations[]|ObjectCollection findByIdUser(int $id_user) Return ChildShipmentsUsersLocations objects filtered by the id_user column
 * @method     ChildShipmentsUsersLocations[]|ObjectCollection findByLat(string $lat) Return ChildShipmentsUsersLocations objects filtered by the lat column
 * @method     ChildShipmentsUsersLocations[]|ObjectCollection findByLng(string $lng) Return ChildShipmentsUsersLocations objects filtered by the lng column
 * @method     ChildShipmentsUsersLocations[]|ObjectCollection findByDatetime(string $datetime) Return ChildShipmentsUsersLocations objects filtered by the datetime column
 * @method     ChildShipmentsUsersLocations[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentsUsersLocationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentsUsersLocationsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ShipmentsUsersLocations', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentsUsersLocationsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentsUsersLocationsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentsUsersLocationsQuery) {
            return $criteria;
        }
        $query = new ChildShipmentsUsersLocationsQuery();
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
     * @return ChildShipmentsUsersLocations|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShipmentsUsersLocationsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsUsersLocationsTableMap::DATABASE_NAME);
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
     * @return ChildShipmentsUsersLocations A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_shipment`, `id_user`, `lat`, `lng`, `datetime` FROM `shipments_users_locations` WHERE `id` = :p0';
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
            /** @var ChildShipmentsUsersLocations $obj */
            $obj = new ChildShipmentsUsersLocations();
            $obj->hydrate($row);
            ShipmentsUsersLocationsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildShipmentsUsersLocations|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
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
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the lat column
     *
     * Example usage:
     * <code>
     * $query->filterByLat(1234); // WHERE lat = 1234
     * $query->filterByLat(array(12, 34)); // WHERE lat IN (12, 34)
     * $query->filterByLat(array('min' => 12)); // WHERE lat > 12
     * </code>
     *
     * @param     mixed $lat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterByLat($lat = null, $comparison = null)
    {
        if (is_array($lat)) {
            $useMinMax = false;
            if (isset($lat['min'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_LAT, $lat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lat['max'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_LAT, $lat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_LAT, $lat, $comparison);
    }

    /**
     * Filter the query on the lng column
     *
     * Example usage:
     * <code>
     * $query->filterByLng(1234); // WHERE lng = 1234
     * $query->filterByLng(array(12, 34)); // WHERE lng IN (12, 34)
     * $query->filterByLng(array('min' => 12)); // WHERE lng > 12
     * </code>
     *
     * @param     mixed $lng The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterByLng($lng = null, $comparison = null)
    {
        if (is_array($lng)) {
            $useMinMax = false;
            if (isset($lng['min'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_LNG, $lng['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lng['max'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_LNG, $lng['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_LNG, $lng, $comparison);
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
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (is_array($datetime)) {
            $useMinMax = false;
            if (isset($datetime['min'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_DATETIME, $datetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datetime['max'])) {
                $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_DATETIME, $datetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_DATETIME, $datetime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipmentsUsersLocations $shipmentsUsersLocations Object to remove from the list of results
     *
     * @return $this|ChildShipmentsUsersLocationsQuery The current query, for fluid interface
     */
    public function prune($shipmentsUsersLocations = null)
    {
        if ($shipmentsUsersLocations) {
            $this->addUsingAlias(ShipmentsUsersLocationsTableMap::COL_ID, $shipmentsUsersLocations->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipments_users_locations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsUsersLocationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentsUsersLocationsTableMap::clearInstancePool();
            ShipmentsUsersLocationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsUsersLocationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentsUsersLocationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentsUsersLocationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentsUsersLocationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentsUsersLocationsQuery
