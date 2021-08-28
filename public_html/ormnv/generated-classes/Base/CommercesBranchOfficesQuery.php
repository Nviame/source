<?php

namespace Base;

use \CommercesBranchOffices as ChildCommercesBranchOffices;
use \CommercesBranchOfficesQuery as ChildCommercesBranchOfficesQuery;
use \Exception;
use \PDO;
use Map\CommercesBranchOfficesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'commerces_branch_offices' table.
 *
 *
 *
 * @method     ChildCommercesBranchOfficesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCommercesBranchOfficesQuery orderByIdCommerce($order = Criteria::ASC) Order by the id_commerce column
 * @method     ChildCommercesBranchOfficesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCommercesBranchOfficesQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildCommercesBranchOfficesQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildCommercesBranchOfficesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCommercesBranchOfficesQuery groupById() Group by the id column
 * @method     ChildCommercesBranchOfficesQuery groupByIdCommerce() Group by the id_commerce column
 * @method     ChildCommercesBranchOfficesQuery groupByName() Group by the name column
 * @method     ChildCommercesBranchOfficesQuery groupByAddress() Group by the address column
 * @method     ChildCommercesBranchOfficesQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildCommercesBranchOfficesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCommercesBranchOfficesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommercesBranchOfficesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommercesBranchOfficesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommercesBranchOfficesQuery leftJoinCommerces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Commerces relation
 * @method     ChildCommercesBranchOfficesQuery rightJoinCommerces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Commerces relation
 * @method     ChildCommercesBranchOfficesQuery innerJoinCommerces($relationAlias = null) Adds a INNER JOIN clause to the query using the Commerces relation
 *
 * @method     \CommercesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCommercesBranchOffices findOne(ConnectionInterface $con = null) Return the first ChildCommercesBranchOffices matching the query
 * @method     ChildCommercesBranchOffices findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCommercesBranchOffices matching the query, or a new ChildCommercesBranchOffices object populated from the query conditions when no match is found
 *
 * @method     ChildCommercesBranchOffices findOneById(int $id) Return the first ChildCommercesBranchOffices filtered by the id column
 * @method     ChildCommercesBranchOffices findOneByIdCommerce(int $id_commerce) Return the first ChildCommercesBranchOffices filtered by the id_commerce column
 * @method     ChildCommercesBranchOffices findOneByName(string $name) Return the first ChildCommercesBranchOffices filtered by the name column
 * @method     ChildCommercesBranchOffices findOneByAddress(string $address) Return the first ChildCommercesBranchOffices filtered by the address column
 * @method     ChildCommercesBranchOffices findOneByRegisteredAt(string $registered_at) Return the first ChildCommercesBranchOffices filtered by the registered_at column
 * @method     ChildCommercesBranchOffices findOneByUpdatedAt(string $updated_at) Return the first ChildCommercesBranchOffices filtered by the updated_at column *

 * @method     ChildCommercesBranchOffices requirePk($key, ConnectionInterface $con = null) Return the ChildCommercesBranchOffices by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesBranchOffices requireOne(ConnectionInterface $con = null) Return the first ChildCommercesBranchOffices matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesBranchOffices requireOneById(int $id) Return the first ChildCommercesBranchOffices filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesBranchOffices requireOneByIdCommerce(int $id_commerce) Return the first ChildCommercesBranchOffices filtered by the id_commerce column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesBranchOffices requireOneByName(string $name) Return the first ChildCommercesBranchOffices filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesBranchOffices requireOneByAddress(string $address) Return the first ChildCommercesBranchOffices filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesBranchOffices requireOneByRegisteredAt(string $registered_at) Return the first ChildCommercesBranchOffices filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesBranchOffices requireOneByUpdatedAt(string $updated_at) Return the first ChildCommercesBranchOffices filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesBranchOffices[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCommercesBranchOffices objects based on current ModelCriteria
 * @method     ChildCommercesBranchOffices[]|ObjectCollection findById(int $id) Return ChildCommercesBranchOffices objects filtered by the id column
 * @method     ChildCommercesBranchOffices[]|ObjectCollection findByIdCommerce(int $id_commerce) Return ChildCommercesBranchOffices objects filtered by the id_commerce column
 * @method     ChildCommercesBranchOffices[]|ObjectCollection findByName(string $name) Return ChildCommercesBranchOffices objects filtered by the name column
 * @method     ChildCommercesBranchOffices[]|ObjectCollection findByAddress(string $address) Return ChildCommercesBranchOffices objects filtered by the address column
 * @method     ChildCommercesBranchOffices[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildCommercesBranchOffices objects filtered by the registered_at column
 * @method     ChildCommercesBranchOffices[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCommercesBranchOffices objects filtered by the updated_at column
 * @method     ChildCommercesBranchOffices[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommercesBranchOfficesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CommercesBranchOfficesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CommercesBranchOffices', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommercesBranchOfficesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommercesBranchOfficesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCommercesBranchOfficesQuery) {
            return $criteria;
        }
        $query = new ChildCommercesBranchOfficesQuery();
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
     * @return ChildCommercesBranchOffices|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommercesBranchOfficesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommercesBranchOfficesTableMap::DATABASE_NAME);
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
     * @return ChildCommercesBranchOffices A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_commerce`, `name`, `address`, `registered_at`, `updated_at` FROM `commerces_branch_offices` WHERE `id` = :p0';
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
            /** @var ChildCommercesBranchOffices $obj */
            $obj = new ChildCommercesBranchOffices();
            $obj->hydrate($row);
            CommercesBranchOfficesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCommercesBranchOffices|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_commerce column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCommerce(1234); // WHERE id_commerce = 1234
     * $query->filterByIdCommerce(array(12, 34)); // WHERE id_commerce IN (12, 34)
     * $query->filterByIdCommerce(array('min' => 12)); // WHERE id_commerce > 12
     * </code>
     *
     * @see       filterByCommerces()
     *
     * @param     mixed $idCommerce The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByIdCommerce($idCommerce = null, $comparison = null)
    {
        if (is_array($idCommerce)) {
            $useMinMax = false;
            if (isset($idCommerce['min'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID_COMMERCE, $idCommerce['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCommerce['max'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID_COMMERCE, $idCommerce['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID_COMMERCE, $idCommerce, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ADDRESS, $address, $comparison);
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
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Commerces object
     *
     * @param \Commerces|ObjectCollection $commerces The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByCommerces($commerces, $comparison = null)
    {
        if ($commerces instanceof \Commerces) {
            return $this
                ->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID_COMMERCE, $commerces->getId(), $comparison);
        } elseif ($commerces instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID_COMMERCE, $commerces->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCommerces() only accepts arguments of type \Commerces or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Commerces relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function joinCommerces($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Commerces');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Commerces');
        }

        return $this;
    }

    /**
     * Use the Commerces relation Commerces object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CommercesQuery A secondary query class using the current class as primary query
     */
    public function useCommercesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCommerces($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Commerces', '\CommercesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCommercesBranchOffices $commercesBranchOffices Object to remove from the list of results
     *
     * @return $this|ChildCommercesBranchOfficesQuery The current query, for fluid interface
     */
    public function prune($commercesBranchOffices = null)
    {
        if ($commercesBranchOffices) {
            $this->addUsingAlias(CommercesBranchOfficesTableMap::COL_ID, $commercesBranchOffices->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the commerces_branch_offices table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesBranchOfficesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommercesBranchOfficesTableMap::clearInstancePool();
            CommercesBranchOfficesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesBranchOfficesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommercesBranchOfficesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CommercesBranchOfficesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommercesBranchOfficesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CommercesBranchOfficesQuery
