<?php

namespace Base;

use \UsersRatings as ChildUsersRatings;
use \UsersRatingsQuery as ChildUsersRatingsQuery;
use \Exception;
use \PDO;
use Map\UsersRatingsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_ratings' table.
 *
 *
 *
 * @method     ChildUsersRatingsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersRatingsQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildUsersRatingsQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildUsersRatingsQuery orderByRating($order = Criteria::ASC) Order by the rating column
 * @method     ChildUsersRatingsQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildUsersRatingsQuery orderByRegisterAt($order = Criteria::ASC) Order by the register_at column
 *
 * @method     ChildUsersRatingsQuery groupById() Group by the id column
 * @method     ChildUsersRatingsQuery groupByIdUser() Group by the id_user column
 * @method     ChildUsersRatingsQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildUsersRatingsQuery groupByRating() Group by the rating column
 * @method     ChildUsersRatingsQuery groupByComments() Group by the comments column
 * @method     ChildUsersRatingsQuery groupByRegisterAt() Group by the register_at column
 *
 * @method     ChildUsersRatingsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersRatingsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersRatingsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersRatings findOne(ConnectionInterface $con = null) Return the first ChildUsersRatings matching the query
 * @method     ChildUsersRatings findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersRatings matching the query, or a new ChildUsersRatings object populated from the query conditions when no match is found
 *
 * @method     ChildUsersRatings findOneById(int $id) Return the first ChildUsersRatings filtered by the id column
 * @method     ChildUsersRatings findOneByIdUser(int $id_user) Return the first ChildUsersRatings filtered by the id_user column
 * @method     ChildUsersRatings findOneByIdShipment(int $id_shipment) Return the first ChildUsersRatings filtered by the id_shipment column
 * @method     ChildUsersRatings findOneByRating(double $rating) Return the first ChildUsersRatings filtered by the rating column
 * @method     ChildUsersRatings findOneByComments(string $comments) Return the first ChildUsersRatings filtered by the comments column
 * @method     ChildUsersRatings findOneByRegisterAt(string $register_at) Return the first ChildUsersRatings filtered by the register_at column *

 * @method     ChildUsersRatings requirePk($key, ConnectionInterface $con = null) Return the ChildUsersRatings by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRatings requireOne(ConnectionInterface $con = null) Return the first ChildUsersRatings matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersRatings requireOneById(int $id) Return the first ChildUsersRatings filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRatings requireOneByIdUser(int $id_user) Return the first ChildUsersRatings filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRatings requireOneByIdShipment(int $id_shipment) Return the first ChildUsersRatings filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRatings requireOneByRating(double $rating) Return the first ChildUsersRatings filtered by the rating column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRatings requireOneByComments(string $comments) Return the first ChildUsersRatings filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersRatings requireOneByRegisterAt(string $register_at) Return the first ChildUsersRatings filtered by the register_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersRatings[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersRatings objects based on current ModelCriteria
 * @method     ChildUsersRatings[]|ObjectCollection findById(int $id) Return ChildUsersRatings objects filtered by the id column
 * @method     ChildUsersRatings[]|ObjectCollection findByIdUser(int $id_user) Return ChildUsersRatings objects filtered by the id_user column
 * @method     ChildUsersRatings[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildUsersRatings objects filtered by the id_shipment column
 * @method     ChildUsersRatings[]|ObjectCollection findByRating(double $rating) Return ChildUsersRatings objects filtered by the rating column
 * @method     ChildUsersRatings[]|ObjectCollection findByComments(string $comments) Return ChildUsersRatings objects filtered by the comments column
 * @method     ChildUsersRatings[]|ObjectCollection findByRegisterAt(string $register_at) Return ChildUsersRatings objects filtered by the register_at column
 * @method     ChildUsersRatings[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersRatingsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersRatingsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersRatings', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersRatingsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersRatingsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersRatingsQuery) {
            return $criteria;
        }
        $query = new ChildUsersRatingsQuery();
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
     * @return ChildUsersRatings|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersRatingsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersRatingsTableMap::DATABASE_NAME);
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
     * @return ChildUsersRatings A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_shipment`, `rating`, `comments`, `register_at` FROM `users_ratings` WHERE `id` = :p0';
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
            /** @var ChildUsersRatings $obj */
            $obj = new ChildUsersRatings();
            $obj->hydrate($row);
            UsersRatingsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsersRatings|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersRatingsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersRatingsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersRatingsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersRatingsTableMap::COL_ID_USER, $idUser, $comparison);
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
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersRatingsTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
    }

    /**
     * Filter the query on the rating column
     *
     * Example usage:
     * <code>
     * $query->filterByRating(1234); // WHERE rating = 1234
     * $query->filterByRating(array(12, 34)); // WHERE rating IN (12, 34)
     * $query->filterByRating(array('min' => 12)); // WHERE rating > 12
     * </code>
     *
     * @param     mixed $rating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersRatingsTableMap::COL_RATING, $rating, $comparison);
    }

    /**
     * Filter the query on the comments column
     *
     * Example usage:
     * <code>
     * $query->filterByComments('fooValue');   // WHERE comments = 'fooValue'
     * $query->filterByComments('%fooValue%'); // WHERE comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comments The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterByComments($comments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comments)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $comments)) {
                $comments = str_replace('*', '%', $comments);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersRatingsTableMap::COL_COMMENTS, $comments, $comparison);
    }

    /**
     * Filter the query on the register_at column
     *
     * Example usage:
     * <code>
     * $query->filterByRegisterAt('2011-03-14'); // WHERE register_at = '2011-03-14'
     * $query->filterByRegisterAt('now'); // WHERE register_at = '2011-03-14'
     * $query->filterByRegisterAt(array('max' => 'yesterday')); // WHERE register_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $registerAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function filterByRegisterAt($registerAt = null, $comparison = null)
    {
        if (is_array($registerAt)) {
            $useMinMax = false;
            if (isset($registerAt['min'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_REGISTER_AT, $registerAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registerAt['max'])) {
                $this->addUsingAlias(UsersRatingsTableMap::COL_REGISTER_AT, $registerAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersRatingsTableMap::COL_REGISTER_AT, $registerAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersRatings $usersRatings Object to remove from the list of results
     *
     * @return $this|ChildUsersRatingsQuery The current query, for fluid interface
     */
    public function prune($usersRatings = null)
    {
        if ($usersRatings) {
            $this->addUsingAlias(UsersRatingsTableMap::COL_ID, $usersRatings->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_ratings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersRatingsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersRatingsTableMap::clearInstancePool();
            UsersRatingsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersRatingsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersRatingsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersRatingsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersRatingsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersRatingsQuery
