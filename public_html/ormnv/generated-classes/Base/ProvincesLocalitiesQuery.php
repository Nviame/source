<?php

namespace Base;

use \ProvincesLocalities as ChildProvincesLocalities;
use \ProvincesLocalitiesQuery as ChildProvincesLocalitiesQuery;
use \Exception;
use \PDO;
use Map\ProvincesLocalitiesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'provinces_localities' table.
 *
 *
 *
 * @method     ChildProvincesLocalitiesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProvincesLocalitiesQuery orderByIdProvince($order = Criteria::ASC) Order by the id_province column
 * @method     ChildProvincesLocalitiesQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildProvincesLocalitiesQuery groupById() Group by the id column
 * @method     ChildProvincesLocalitiesQuery groupByIdProvince() Group by the id_province column
 * @method     ChildProvincesLocalitiesQuery groupByName() Group by the name column
 *
 * @method     ChildProvincesLocalitiesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProvincesLocalitiesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProvincesLocalitiesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProvincesLocalitiesQuery leftJoinProvinces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Provinces relation
 * @method     ChildProvincesLocalitiesQuery rightJoinProvinces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Provinces relation
 * @method     ChildProvincesLocalitiesQuery innerJoinProvinces($relationAlias = null) Adds a INNER JOIN clause to the query using the Provinces relation
 *
 * @method     ChildProvincesLocalitiesQuery leftJoinCommerces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Commerces relation
 * @method     ChildProvincesLocalitiesQuery rightJoinCommerces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Commerces relation
 * @method     ChildProvincesLocalitiesQuery innerJoinCommerces($relationAlias = null) Adds a INNER JOIN clause to the query using the Commerces relation
 *
 * @method     ChildProvincesLocalitiesQuery leftJoinCommercesClients($relationAlias = null) Adds a LEFT JOIN clause to the query using the CommercesClients relation
 * @method     ChildProvincesLocalitiesQuery rightJoinCommercesClients($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CommercesClients relation
 * @method     ChildProvincesLocalitiesQuery innerJoinCommercesClients($relationAlias = null) Adds a INNER JOIN clause to the query using the CommercesClients relation
 *
 * @method     \ProvincesQuery|\CommercesQuery|\CommercesClientsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProvincesLocalities findOne(ConnectionInterface $con = null) Return the first ChildProvincesLocalities matching the query
 * @method     ChildProvincesLocalities findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProvincesLocalities matching the query, or a new ChildProvincesLocalities object populated from the query conditions when no match is found
 *
 * @method     ChildProvincesLocalities findOneById(int $id) Return the first ChildProvincesLocalities filtered by the id column
 * @method     ChildProvincesLocalities findOneByIdProvince(int $id_province) Return the first ChildProvincesLocalities filtered by the id_province column
 * @method     ChildProvincesLocalities findOneByName(string $name) Return the first ChildProvincesLocalities filtered by the name column *

 * @method     ChildProvincesLocalities requirePk($key, ConnectionInterface $con = null) Return the ChildProvincesLocalities by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvincesLocalities requireOne(ConnectionInterface $con = null) Return the first ChildProvincesLocalities matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProvincesLocalities requireOneById(int $id) Return the first ChildProvincesLocalities filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvincesLocalities requireOneByIdProvince(int $id_province) Return the first ChildProvincesLocalities filtered by the id_province column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvincesLocalities requireOneByName(string $name) Return the first ChildProvincesLocalities filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProvincesLocalities[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProvincesLocalities objects based on current ModelCriteria
 * @method     ChildProvincesLocalities[]|ObjectCollection findById(int $id) Return ChildProvincesLocalities objects filtered by the id column
 * @method     ChildProvincesLocalities[]|ObjectCollection findByIdProvince(int $id_province) Return ChildProvincesLocalities objects filtered by the id_province column
 * @method     ChildProvincesLocalities[]|ObjectCollection findByName(string $name) Return ChildProvincesLocalities objects filtered by the name column
 * @method     ChildProvincesLocalities[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProvincesLocalitiesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProvincesLocalitiesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProvincesLocalities', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProvincesLocalitiesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProvincesLocalitiesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProvincesLocalitiesQuery) {
            return $criteria;
        }
        $query = new ChildProvincesLocalitiesQuery();
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
     * @return ChildProvincesLocalities|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProvincesLocalitiesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProvincesLocalitiesTableMap::DATABASE_NAME);
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
     * @return ChildProvincesLocalities A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_province`, `name` FROM `provinces_localities` WHERE `id` = :p0';
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
            /** @var ChildProvincesLocalities $obj */
            $obj = new ChildProvincesLocalities();
            $obj->hydrate($row);
            ProvincesLocalitiesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProvincesLocalities|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_province column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProvince(1234); // WHERE id_province = 1234
     * $query->filterByIdProvince(array(12, 34)); // WHERE id_province IN (12, 34)
     * $query->filterByIdProvince(array('min' => 12)); // WHERE id_province > 12
     * </code>
     *
     * @see       filterByProvinces()
     *
     * @param     mixed $idProvince The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function filterByIdProvince($idProvince = null, $comparison = null)
    {
        if (is_array($idProvince)) {
            $useMinMax = false;
            if (isset($idProvince['min'])) {
                $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID_PROVINCE, $idProvince['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProvince['max'])) {
                $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID_PROVINCE, $idProvince['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID_PROVINCE, $idProvince, $comparison);
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
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related \Provinces object
     *
     * @param \Provinces|ObjectCollection $provinces The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function filterByProvinces($provinces, $comparison = null)
    {
        if ($provinces instanceof \Provinces) {
            return $this
                ->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID_PROVINCE, $provinces->getId(), $comparison);
        } elseif ($provinces instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID_PROVINCE, $provinces->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProvinces() only accepts arguments of type \Provinces or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Provinces relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function joinProvinces($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Provinces');

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
            $this->addJoinObject($join, 'Provinces');
        }

        return $this;
    }

    /**
     * Use the Provinces relation Provinces object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProvincesQuery A secondary query class using the current class as primary query
     */
    public function useProvincesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProvinces($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Provinces', '\ProvincesQuery');
    }

    /**
     * Filter the query by a related \Commerces object
     *
     * @param \Commerces|ObjectCollection $commerces the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function filterByCommerces($commerces, $comparison = null)
    {
        if ($commerces instanceof \Commerces) {
            return $this
                ->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $commerces->getIdLocality(), $comparison);
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
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
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
     * @return ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function filterByCommercesClients($commercesClients, $comparison = null)
    {
        if ($commercesClients instanceof \CommercesClients) {
            return $this
                ->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $commercesClients->getIdLocality(), $comparison);
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
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildProvincesLocalities $provincesLocalities Object to remove from the list of results
     *
     * @return $this|ChildProvincesLocalitiesQuery The current query, for fluid interface
     */
    public function prune($provincesLocalities = null)
    {
        if ($provincesLocalities) {
            $this->addUsingAlias(ProvincesLocalitiesTableMap::COL_ID, $provincesLocalities->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the provinces_localities table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProvincesLocalitiesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProvincesLocalitiesTableMap::clearInstancePool();
            ProvincesLocalitiesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProvincesLocalitiesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProvincesLocalitiesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProvincesLocalitiesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProvincesLocalitiesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProvincesLocalitiesQuery
