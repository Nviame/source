<?php

namespace Base;

use \CommercesReminders as ChildCommercesReminders;
use \CommercesRemindersQuery as ChildCommercesRemindersQuery;
use \Exception;
use \PDO;
use Map\CommercesRemindersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'commerces_reminders' table.
 *
 *
 *
 * @method     ChildCommercesRemindersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCommercesRemindersQuery orderByIdCommerce($order = Criteria::ASC) Order by the id_commerce column
 * @method     ChildCommercesRemindersQuery orderByIcon($order = Criteria::ASC) Order by the icon column
 * @method     ChildCommercesRemindersQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildCommercesRemindersQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildCommercesRemindersQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildCommercesRemindersQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCommercesRemindersQuery groupById() Group by the id column
 * @method     ChildCommercesRemindersQuery groupByIdCommerce() Group by the id_commerce column
 * @method     ChildCommercesRemindersQuery groupByIcon() Group by the icon column
 * @method     ChildCommercesRemindersQuery groupByTitle() Group by the title column
 * @method     ChildCommercesRemindersQuery groupByContent() Group by the content column
 * @method     ChildCommercesRemindersQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildCommercesRemindersQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCommercesRemindersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommercesRemindersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommercesRemindersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommercesRemindersQuery leftJoinCommerces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Commerces relation
 * @method     ChildCommercesRemindersQuery rightJoinCommerces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Commerces relation
 * @method     ChildCommercesRemindersQuery innerJoinCommerces($relationAlias = null) Adds a INNER JOIN clause to the query using the Commerces relation
 *
 * @method     \CommercesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCommercesReminders findOne(ConnectionInterface $con = null) Return the first ChildCommercesReminders matching the query
 * @method     ChildCommercesReminders findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCommercesReminders matching the query, or a new ChildCommercesReminders object populated from the query conditions when no match is found
 *
 * @method     ChildCommercesReminders findOneById(int $id) Return the first ChildCommercesReminders filtered by the id column
 * @method     ChildCommercesReminders findOneByIdCommerce(int $id_commerce) Return the first ChildCommercesReminders filtered by the id_commerce column
 * @method     ChildCommercesReminders findOneByIcon(string $icon) Return the first ChildCommercesReminders filtered by the icon column
 * @method     ChildCommercesReminders findOneByTitle(string $title) Return the first ChildCommercesReminders filtered by the title column
 * @method     ChildCommercesReminders findOneByContent(string $content) Return the first ChildCommercesReminders filtered by the content column
 * @method     ChildCommercesReminders findOneByRegisteredAt(string $registered_at) Return the first ChildCommercesReminders filtered by the registered_at column
 * @method     ChildCommercesReminders findOneByUpdatedAt(string $updated_at) Return the first ChildCommercesReminders filtered by the updated_at column *

 * @method     ChildCommercesReminders requirePk($key, ConnectionInterface $con = null) Return the ChildCommercesReminders by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesReminders requireOne(ConnectionInterface $con = null) Return the first ChildCommercesReminders matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesReminders requireOneById(int $id) Return the first ChildCommercesReminders filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesReminders requireOneByIdCommerce(int $id_commerce) Return the first ChildCommercesReminders filtered by the id_commerce column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesReminders requireOneByIcon(string $icon) Return the first ChildCommercesReminders filtered by the icon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesReminders requireOneByTitle(string $title) Return the first ChildCommercesReminders filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesReminders requireOneByContent(string $content) Return the first ChildCommercesReminders filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesReminders requireOneByRegisteredAt(string $registered_at) Return the first ChildCommercesReminders filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesReminders requireOneByUpdatedAt(string $updated_at) Return the first ChildCommercesReminders filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesReminders[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCommercesReminders objects based on current ModelCriteria
 * @method     ChildCommercesReminders[]|ObjectCollection findById(int $id) Return ChildCommercesReminders objects filtered by the id column
 * @method     ChildCommercesReminders[]|ObjectCollection findByIdCommerce(int $id_commerce) Return ChildCommercesReminders objects filtered by the id_commerce column
 * @method     ChildCommercesReminders[]|ObjectCollection findByIcon(string $icon) Return ChildCommercesReminders objects filtered by the icon column
 * @method     ChildCommercesReminders[]|ObjectCollection findByTitle(string $title) Return ChildCommercesReminders objects filtered by the title column
 * @method     ChildCommercesReminders[]|ObjectCollection findByContent(string $content) Return ChildCommercesReminders objects filtered by the content column
 * @method     ChildCommercesReminders[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildCommercesReminders objects filtered by the registered_at column
 * @method     ChildCommercesReminders[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCommercesReminders objects filtered by the updated_at column
 * @method     ChildCommercesReminders[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommercesRemindersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CommercesRemindersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CommercesReminders', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommercesRemindersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommercesRemindersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCommercesRemindersQuery) {
            return $criteria;
        }
        $query = new ChildCommercesRemindersQuery();
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
     * @return ChildCommercesReminders|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommercesRemindersTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommercesRemindersTableMap::DATABASE_NAME);
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
     * @return ChildCommercesReminders A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_commerce`, `icon`, `title`, `content`, `registered_at`, `updated_at` FROM `commerces_reminders` WHERE `id` = :p0';
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
            /** @var ChildCommercesReminders $obj */
            $obj = new ChildCommercesReminders();
            $obj->hydrate($row);
            CommercesRemindersTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCommercesReminders|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByIdCommerce($idCommerce = null, $comparison = null)
    {
        if (is_array($idCommerce)) {
            $useMinMax = false;
            if (isset($idCommerce['min'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_ID_COMMERCE, $idCommerce['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCommerce['max'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_ID_COMMERCE, $idCommerce['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_ID_COMMERCE, $idCommerce, $comparison);
    }

    /**
     * Filter the query on the icon column
     *
     * Example usage:
     * <code>
     * $query->filterByIcon('fooValue');   // WHERE icon = 'fooValue'
     * $query->filterByIcon('%fooValue%'); // WHERE icon LIKE '%fooValue%'
     * </code>
     *
     * @param     string $icon The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByIcon($icon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($icon)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $icon)) {
                $icon = str_replace('*', '%', $icon);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_ICON, $icon, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_CONTENT, $content, $comparison);
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
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
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
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CommercesRemindersTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesRemindersTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Commerces object
     *
     * @param \Commerces|ObjectCollection $commerces The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function filterByCommerces($commerces, $comparison = null)
    {
        if ($commerces instanceof \Commerces) {
            return $this
                ->addUsingAlias(CommercesRemindersTableMap::COL_ID_COMMERCE, $commerces->getId(), $comparison);
        } elseif ($commerces instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesRemindersTableMap::COL_ID_COMMERCE, $commerces->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
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
     * @param   ChildCommercesReminders $commercesReminders Object to remove from the list of results
     *
     * @return $this|ChildCommercesRemindersQuery The current query, for fluid interface
     */
    public function prune($commercesReminders = null)
    {
        if ($commercesReminders) {
            $this->addUsingAlias(CommercesRemindersTableMap::COL_ID, $commercesReminders->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the commerces_reminders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesRemindersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommercesRemindersTableMap::clearInstancePool();
            CommercesRemindersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesRemindersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommercesRemindersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CommercesRemindersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommercesRemindersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CommercesRemindersQuery
