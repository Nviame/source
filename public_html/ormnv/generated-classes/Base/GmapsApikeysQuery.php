<?php

namespace Base;

use \GmapsApikeys as ChildGmapsApikeys;
use \GmapsApikeysQuery as ChildGmapsApikeysQuery;
use \Exception;
use \PDO;
use Map\GmapsApikeysTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'gmaps_apikeys' table.
 *
 *
 *
 * @method     ChildGmapsApikeysQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGmapsApikeysQuery orderByApiKey($order = Criteria::ASC) Order by the api_key column
 * @method     ChildGmapsApikeysQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildGmapsApikeysQuery orderByAssociatedAccountEmail($order = Criteria::ASC) Order by the associated_account_email column
 *
 * @method     ChildGmapsApikeysQuery groupById() Group by the id column
 * @method     ChildGmapsApikeysQuery groupByApiKey() Group by the api_key column
 * @method     ChildGmapsApikeysQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildGmapsApikeysQuery groupByAssociatedAccountEmail() Group by the associated_account_email column
 *
 * @method     ChildGmapsApikeysQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGmapsApikeysQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGmapsApikeysQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGmapsApikeys findOne(ConnectionInterface $con = null) Return the first ChildGmapsApikeys matching the query
 * @method     ChildGmapsApikeys findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGmapsApikeys matching the query, or a new ChildGmapsApikeys object populated from the query conditions when no match is found
 *
 * @method     ChildGmapsApikeys findOneById(int $id) Return the first ChildGmapsApikeys filtered by the id column
 * @method     ChildGmapsApikeys findOneByApiKey(string $api_key) Return the first ChildGmapsApikeys filtered by the api_key column
 * @method     ChildGmapsApikeys findOneByRegisteredAt(string $registered_at) Return the first ChildGmapsApikeys filtered by the registered_at column
 * @method     ChildGmapsApikeys findOneByAssociatedAccountEmail(string $associated_account_email) Return the first ChildGmapsApikeys filtered by the associated_account_email column *

 * @method     ChildGmapsApikeys requirePk($key, ConnectionInterface $con = null) Return the ChildGmapsApikeys by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGmapsApikeys requireOne(ConnectionInterface $con = null) Return the first ChildGmapsApikeys matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGmapsApikeys requireOneById(int $id) Return the first ChildGmapsApikeys filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGmapsApikeys requireOneByApiKey(string $api_key) Return the first ChildGmapsApikeys filtered by the api_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGmapsApikeys requireOneByRegisteredAt(string $registered_at) Return the first ChildGmapsApikeys filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGmapsApikeys requireOneByAssociatedAccountEmail(string $associated_account_email) Return the first ChildGmapsApikeys filtered by the associated_account_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGmapsApikeys[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGmapsApikeys objects based on current ModelCriteria
 * @method     ChildGmapsApikeys[]|ObjectCollection findById(int $id) Return ChildGmapsApikeys objects filtered by the id column
 * @method     ChildGmapsApikeys[]|ObjectCollection findByApiKey(string $api_key) Return ChildGmapsApikeys objects filtered by the api_key column
 * @method     ChildGmapsApikeys[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildGmapsApikeys objects filtered by the registered_at column
 * @method     ChildGmapsApikeys[]|ObjectCollection findByAssociatedAccountEmail(string $associated_account_email) Return ChildGmapsApikeys objects filtered by the associated_account_email column
 * @method     ChildGmapsApikeys[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GmapsApikeysQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GmapsApikeysQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\GmapsApikeys', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGmapsApikeysQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGmapsApikeysQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGmapsApikeysQuery) {
            return $criteria;
        }
        $query = new ChildGmapsApikeysQuery();
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
     * @return ChildGmapsApikeys|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GmapsApikeysTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GmapsApikeysTableMap::DATABASE_NAME);
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
     * @return ChildGmapsApikeys A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `api_key`, `registered_at`, `associated_account_email` FROM `gmaps_apikeys` WHERE `id` = :p0';
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
            /** @var ChildGmapsApikeys $obj */
            $obj = new ChildGmapsApikeys();
            $obj->hydrate($row);
            GmapsApikeysTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildGmapsApikeys|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGmapsApikeysQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GmapsApikeysTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGmapsApikeysQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GmapsApikeysTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGmapsApikeysQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GmapsApikeysTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GmapsApikeysTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GmapsApikeysTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the api_key column
     *
     * Example usage:
     * <code>
     * $query->filterByApiKey('fooValue');   // WHERE api_key = 'fooValue'
     * $query->filterByApiKey('%fooValue%'); // WHERE api_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apiKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGmapsApikeysQuery The current query, for fluid interface
     */
    public function filterByApiKey($apiKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apiKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $apiKey)) {
                $apiKey = str_replace('*', '%', $apiKey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GmapsApikeysTableMap::COL_API_KEY, $apiKey, $comparison);
    }

    /**
     * Filter the query on the registered_at column
     *
     * Example usage:
     * <code>
     * $query->filterByRegisteredAt('2011-03-14'); // WHERE registered_at = '2011-03-14'
     * $query->filterByRegisteredAt('now'); // WHERE registered_at = '2011-03-14'
     * $query->filterByRegisteredAt(array('max' => 'yesterday')); // WHERE registered_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $registeredAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGmapsApikeysQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(GmapsApikeysTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(GmapsApikeysTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GmapsApikeysTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
    }

    /**
     * Filter the query on the associated_account_email column
     *
     * Example usage:
     * <code>
     * $query->filterByAssociatedAccountEmail('fooValue');   // WHERE associated_account_email = 'fooValue'
     * $query->filterByAssociatedAccountEmail('%fooValue%'); // WHERE associated_account_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $associatedAccountEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGmapsApikeysQuery The current query, for fluid interface
     */
    public function filterByAssociatedAccountEmail($associatedAccountEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($associatedAccountEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $associatedAccountEmail)) {
                $associatedAccountEmail = str_replace('*', '%', $associatedAccountEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GmapsApikeysTableMap::COL_ASSOCIATED_ACCOUNT_EMAIL, $associatedAccountEmail, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGmapsApikeys $gmapsApikeys Object to remove from the list of results
     *
     * @return $this|ChildGmapsApikeysQuery The current query, for fluid interface
     */
    public function prune($gmapsApikeys = null)
    {
        if ($gmapsApikeys) {
            $this->addUsingAlias(GmapsApikeysTableMap::COL_ID, $gmapsApikeys->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the gmaps_apikeys table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GmapsApikeysTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GmapsApikeysTableMap::clearInstancePool();
            GmapsApikeysTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GmapsApikeysTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GmapsApikeysTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GmapsApikeysTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GmapsApikeysTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GmapsApikeysQuery
