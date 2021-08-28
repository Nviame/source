<?php

namespace Base;

use \ShipmentsOffersDeleted as ChildShipmentsOffersDeleted;
use \ShipmentsOffersDeletedQuery as ChildShipmentsOffersDeletedQuery;
use \Exception;
use \PDO;
use Map\ShipmentsOffersDeletedTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipments_offers_deleted' table.
 *
 *
 *
 * @method     ChildShipmentsOffersDeletedQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentsOffersDeletedQuery orderByIdOffer($order = Criteria::ASC) Order by the id_offer column
 * @method     ChildShipmentsOffersDeletedQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 *
 * @method     ChildShipmentsOffersDeletedQuery groupById() Group by the id column
 * @method     ChildShipmentsOffersDeletedQuery groupByIdOffer() Group by the id_offer column
 * @method     ChildShipmentsOffersDeletedQuery groupByDeletedAt() Group by the deleted_at column
 *
 * @method     ChildShipmentsOffersDeletedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentsOffersDeletedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentsOffersDeletedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentsOffersDeleted findOne(ConnectionInterface $con = null) Return the first ChildShipmentsOffersDeleted matching the query
 * @method     ChildShipmentsOffersDeleted findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentsOffersDeleted matching the query, or a new ChildShipmentsOffersDeleted object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentsOffersDeleted findOneById(int $id) Return the first ChildShipmentsOffersDeleted filtered by the id column
 * @method     ChildShipmentsOffersDeleted findOneByIdOffer(int $id_offer) Return the first ChildShipmentsOffersDeleted filtered by the id_offer column
 * @method     ChildShipmentsOffersDeleted findOneByDeletedAt(string $deleted_at) Return the first ChildShipmentsOffersDeleted filtered by the deleted_at column *

 * @method     ChildShipmentsOffersDeleted requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentsOffersDeleted by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffersDeleted requireOne(ConnectionInterface $con = null) Return the first ChildShipmentsOffersDeleted matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsOffersDeleted requireOneById(int $id) Return the first ChildShipmentsOffersDeleted filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffersDeleted requireOneByIdOffer(int $id_offer) Return the first ChildShipmentsOffersDeleted filtered by the id_offer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffersDeleted requireOneByDeletedAt(string $deleted_at) Return the first ChildShipmentsOffersDeleted filtered by the deleted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsOffersDeleted[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentsOffersDeleted objects based on current ModelCriteria
 * @method     ChildShipmentsOffersDeleted[]|ObjectCollection findById(int $id) Return ChildShipmentsOffersDeleted objects filtered by the id column
 * @method     ChildShipmentsOffersDeleted[]|ObjectCollection findByIdOffer(int $id_offer) Return ChildShipmentsOffersDeleted objects filtered by the id_offer column
 * @method     ChildShipmentsOffersDeleted[]|ObjectCollection findByDeletedAt(string $deleted_at) Return ChildShipmentsOffersDeleted objects filtered by the deleted_at column
 * @method     ChildShipmentsOffersDeleted[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentsOffersDeletedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentsOffersDeletedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ShipmentsOffersDeleted', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentsOffersDeletedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentsOffersDeletedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentsOffersDeletedQuery) {
            return $criteria;
        }
        $query = new ChildShipmentsOffersDeletedQuery();
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
     * @return ChildShipmentsOffersDeleted|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShipmentsOffersDeletedTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsOffersDeletedTableMap::DATABASE_NAME);
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
     * @return ChildShipmentsOffersDeleted A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_offer`, `deleted_at` FROM `shipments_offers_deleted` WHERE `id` = :p0';
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
            /** @var ChildShipmentsOffersDeleted $obj */
            $obj = new ChildShipmentsOffersDeleted();
            $obj->hydrate($row);
            ShipmentsOffersDeletedTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildShipmentsOffersDeleted|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShipmentsOffersDeletedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentsOffersDeletedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildShipmentsOffersDeletedQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_offer column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOffer(1234); // WHERE id_offer = 1234
     * $query->filterByIdOffer(array(12, 34)); // WHERE id_offer IN (12, 34)
     * $query->filterByIdOffer(array('min' => 12)); // WHERE id_offer > 12
     * </code>
     *
     * @param     mixed $idOffer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersDeletedQuery The current query, for fluid interface
     */
    public function filterByIdOffer($idOffer = null, $comparison = null)
    {
        if (is_array($idOffer)) {
            $useMinMax = false;
            if (isset($idOffer['min'])) {
                $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID_OFFER, $idOffer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOffer['max'])) {
                $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID_OFFER, $idOffer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID_OFFER, $idOffer, $comparison);
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
     * @return $this|ChildShipmentsOffersDeletedQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_DELETED_AT, $deletedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipmentsOffersDeleted $shipmentsOffersDeleted Object to remove from the list of results
     *
     * @return $this|ChildShipmentsOffersDeletedQuery The current query, for fluid interface
     */
    public function prune($shipmentsOffersDeleted = null)
    {
        if ($shipmentsOffersDeleted) {
            $this->addUsingAlias(ShipmentsOffersDeletedTableMap::COL_ID, $shipmentsOffersDeleted->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipments_offers_deleted table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOffersDeletedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentsOffersDeletedTableMap::clearInstancePool();
            ShipmentsOffersDeletedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOffersDeletedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentsOffersDeletedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentsOffersDeletedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentsOffersDeletedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentsOffersDeletedQuery
