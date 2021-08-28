<?php

namespace Base;

use \Provinces as ChildProvinces;
use \ProvincesQuery as ChildProvincesQuery;
use \Exception;
use \PDO;
use Map\ProvincesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'provinces' table.
 *
 *
 *
 * @method     ChildProvincesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProvincesQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildProvincesQuery groupById() Group by the id column
 * @method     ChildProvincesQuery groupByName() Group by the name column
 *
 * @method     ChildProvincesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProvincesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProvincesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProvincesQuery leftJoinCommerces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Commerces relation
 * @method     ChildProvincesQuery rightJoinCommerces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Commerces relation
 * @method     ChildProvincesQuery innerJoinCommerces($relationAlias = null) Adds a INNER JOIN clause to the query using the Commerces relation
 *
 * @method     ChildProvincesQuery leftJoinCommercesClients($relationAlias = null) Adds a LEFT JOIN clause to the query using the CommercesClients relation
 * @method     ChildProvincesQuery rightJoinCommercesClients($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CommercesClients relation
 * @method     ChildProvincesQuery innerJoinCommercesClients($relationAlias = null) Adds a INNER JOIN clause to the query using the CommercesClients relation
 *
 * @method     ChildProvincesQuery leftJoinProvincesLocalities($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProvincesLocalities relation
 * @method     ChildProvincesQuery rightJoinProvincesLocalities($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProvincesLocalities relation
 * @method     ChildProvincesQuery innerJoinProvincesLocalities($relationAlias = null) Adds a INNER JOIN clause to the query using the ProvincesLocalities relation
 *
 * @method     \CommercesQuery|\CommercesClientsQuery|\ProvincesLocalitiesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProvinces findOne(ConnectionInterface $con = null) Return the first ChildProvinces matching the query
 * @method     ChildProvinces findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProvinces matching the query, or a new ChildProvinces object populated from the query conditions when no match is found
 *
 * @method     ChildProvinces findOneById(int $id) Return the first ChildProvinces filtered by the id column
 * @method     ChildProvinces findOneByName(string $name) Return the first ChildProvinces filtered by the name column *

 * @method     ChildProvinces requirePk($key, ConnectionInterface $con = null) Return the ChildProvinces by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvinces requireOne(ConnectionInterface $con = null) Return the first ChildProvinces matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProvinces requireOneById(int $id) Return the first ChildProvinces filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvinces requireOneByName(string $name) Return the first ChildProvinces filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProvinces[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProvinces objects based on current ModelCriteria
 * @method     ChildProvinces[]|ObjectCollection findById(int $id) Return ChildProvinces objects filtered by the id column
 * @method     ChildProvinces[]|ObjectCollection findByName(string $name) Return ChildProvinces objects filtered by the name column
 * @method     ChildProvinces[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProvincesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProvincesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Provinces', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProvincesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProvincesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProvincesQuery) {
            return $criteria;
        }
        $query = new ChildProvincesQuery();
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
     * @return ChildProvinces|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProvincesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProvincesTableMap::DATABASE_NAME);
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
     * @return ChildProvinces A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `name` FROM `provinces` WHERE `id` = :p0';
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
            /** @var ChildProvinces $obj */
            $obj = new ChildProvinces();
            $obj->hydrate($row);
            ProvincesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProvinces|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProvincesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProvincesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProvincesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProvincesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProvincesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProvincesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProvincesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProvincesTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildProvincesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProvincesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related \Commerces object
     *
     * @param \Commerces|ObjectCollection $commerces the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProvincesQuery The current query, for fluid interface
     */
    public function filterByCommerces($commerces, $comparison = null)
    {
        if ($commerces instanceof \Commerces) {
            return $this
                ->addUsingAlias(ProvincesTableMap::COL_ID, $commerces->getIdProvince(), $comparison);
        } elseif ($commerces instanceof ObjectCollection) {
            return $this
                ->useCommercesQuery()
                ->filterByPrimaryKeys($commerces->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildProvincesQuery The current query, for fluid interface
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
     * Filter the query by a related \CommercesClients object
     *
     * @param \CommercesClients|ObjectCollection $commercesClients the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProvincesQuery The current query, for fluid interface
     */
    public function filterByCommercesClients($commercesClients, $comparison = null)
    {
        if ($commercesClients instanceof \CommercesClients) {
            return $this
                ->addUsingAlias(ProvincesTableMap::COL_ID, $commercesClients->getIdProvince(), $comparison);
        } elseif ($commercesClients instanceof ObjectCollection) {
            return $this
                ->useCommercesClientsQuery()
                ->filterByPrimaryKeys($commercesClients->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCommercesClients() only accepts arguments of type \CommercesClients or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CommercesClients relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProvincesQuery The current query, for fluid interface
     */
    public function joinCommercesClients($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CommercesClients');

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
            $this->addJoinObject($join, 'CommercesClients');
        }

        return $this;
    }

    /**
     * Use the CommercesClients relation CommercesClients object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CommercesClientsQuery A secondary query class using the current class as primary query
     */
    public function useCommercesClientsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCommercesClients($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CommercesClients', '\CommercesClientsQuery');
    }

    /**
     * Filter the query by a related \ProvincesLocalities object
     *
     * @param \ProvincesLocalities|ObjectCollection $provincesLocalities the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProvincesQuery The current query, for fluid interface
     */
    public function filterByProvincesLocalities($provincesLocalities, $comparison = null)
    {
        if ($provincesLocalities instanceof \ProvincesLocalities) {
            return $this
                ->addUsingAlias(ProvincesTableMap::COL_ID, $provincesLocalities->getIdProvince(), $comparison);
        } elseif ($provincesLocalities instanceof ObjectCollection) {
            return $this
                ->useProvincesLocalitiesQuery()
                ->filterByPrimaryKeys($provincesLocalities->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProvincesLocalities() only accepts arguments of type \ProvincesLocalities or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProvincesLocalities relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProvincesQuery The current query, for fluid interface
     */
    public function joinProvincesLocalities($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProvincesLocalities');

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
            $this->addJoinObject($join, 'ProvincesLocalities');
        }

        return $this;
    }

    /**
     * Use the ProvincesLocalities relation ProvincesLocalities object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProvincesLocalitiesQuery A secondary query class using the current class as primary query
     */
    public function useProvincesLocalitiesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProvincesLocalities($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProvincesLocalities', '\ProvincesLocalitiesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProvinces $provinces Object to remove from the list of results
     *
     * @return $this|ChildProvincesQuery The current query, for fluid interface
     */
    public function prune($provinces = null)
    {
        if ($provinces) {
            $this->addUsingAlias(ProvincesTableMap::COL_ID, $provinces->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the provinces table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProvincesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProvincesTableMap::clearInstancePool();
            ProvincesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProvincesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProvincesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProvincesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProvincesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProvincesQuery
