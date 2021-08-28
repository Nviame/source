<?php

namespace Base;

use \UsersSocialConnect as ChildUsersSocialConnect;
use \UsersSocialConnectQuery as ChildUsersSocialConnectQuery;
use \Exception;
use \PDO;
use Map\UsersSocialConnectTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_social_connect' table.
 *
 *
 *
 * @method     ChildUsersSocialConnectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersSocialConnectQuery orderByUid($order = Criteria::ASC) Order by the uid column
 * @method     ChildUsersSocialConnectQuery orderByProvider($order = Criteria::ASC) Order by the provider column
 * @method     ChildUsersSocialConnectQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersSocialConnectQuery orderByAuthentication($order = Criteria::ASC) Order by the authentication column
 * @method     ChildUsersSocialConnectQuery orderByInfo($order = Criteria::ASC) Order by the info column
 *
 * @method     ChildUsersSocialConnectQuery groupById() Group by the id column
 * @method     ChildUsersSocialConnectQuery groupByUid() Group by the uid column
 * @method     ChildUsersSocialConnectQuery groupByProvider() Group by the provider column
 * @method     ChildUsersSocialConnectQuery groupByEmail() Group by the email column
 * @method     ChildUsersSocialConnectQuery groupByAuthentication() Group by the authentication column
 * @method     ChildUsersSocialConnectQuery groupByInfo() Group by the info column
 *
 * @method     ChildUsersSocialConnectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersSocialConnectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersSocialConnectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersSocialConnect findOne(ConnectionInterface $con = null) Return the first ChildUsersSocialConnect matching the query
 * @method     ChildUsersSocialConnect findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersSocialConnect matching the query, or a new ChildUsersSocialConnect object populated from the query conditions when no match is found
 *
 * @method     ChildUsersSocialConnect findOneById(int $id) Return the first ChildUsersSocialConnect filtered by the id column
 * @method     ChildUsersSocialConnect findOneByUid(string $uid) Return the first ChildUsersSocialConnect filtered by the uid column
 * @method     ChildUsersSocialConnect findOneByProvider(string $provider) Return the first ChildUsersSocialConnect filtered by the provider column
 * @method     ChildUsersSocialConnect findOneByEmail(string $email) Return the first ChildUsersSocialConnect filtered by the email column
 * @method     ChildUsersSocialConnect findOneByAuthentication(string $authentication) Return the first ChildUsersSocialConnect filtered by the authentication column
 * @method     ChildUsersSocialConnect findOneByInfo(string $info) Return the first ChildUsersSocialConnect filtered by the info column *

 * @method     ChildUsersSocialConnect requirePk($key, ConnectionInterface $con = null) Return the ChildUsersSocialConnect by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSocialConnect requireOne(ConnectionInterface $con = null) Return the first ChildUsersSocialConnect matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersSocialConnect requireOneById(int $id) Return the first ChildUsersSocialConnect filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSocialConnect requireOneByUid(string $uid) Return the first ChildUsersSocialConnect filtered by the uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSocialConnect requireOneByProvider(string $provider) Return the first ChildUsersSocialConnect filtered by the provider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSocialConnect requireOneByEmail(string $email) Return the first ChildUsersSocialConnect filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSocialConnect requireOneByAuthentication(string $authentication) Return the first ChildUsersSocialConnect filtered by the authentication column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSocialConnect requireOneByInfo(string $info) Return the first ChildUsersSocialConnect filtered by the info column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersSocialConnect[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersSocialConnect objects based on current ModelCriteria
 * @method     ChildUsersSocialConnect[]|ObjectCollection findById(int $id) Return ChildUsersSocialConnect objects filtered by the id column
 * @method     ChildUsersSocialConnect[]|ObjectCollection findByUid(string $uid) Return ChildUsersSocialConnect objects filtered by the uid column
 * @method     ChildUsersSocialConnect[]|ObjectCollection findByProvider(string $provider) Return ChildUsersSocialConnect objects filtered by the provider column
 * @method     ChildUsersSocialConnect[]|ObjectCollection findByEmail(string $email) Return ChildUsersSocialConnect objects filtered by the email column
 * @method     ChildUsersSocialConnect[]|ObjectCollection findByAuthentication(string $authentication) Return ChildUsersSocialConnect objects filtered by the authentication column
 * @method     ChildUsersSocialConnect[]|ObjectCollection findByInfo(string $info) Return ChildUsersSocialConnect objects filtered by the info column
 * @method     ChildUsersSocialConnect[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersSocialConnectQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersSocialConnectQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersSocialConnect', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersSocialConnectQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersSocialConnectQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersSocialConnectQuery) {
            return $criteria;
        }
        $query = new ChildUsersSocialConnectQuery();
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
     * $obj = $c->findPk(array(12, 34, 56, 78), $con);
     * </code>
     *
     * @param array[$id, $uid, $provider, $email] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsersSocialConnect|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersSocialConnectTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2], (string) $key[3]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersSocialConnectTableMap::DATABASE_NAME);
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
     * @return ChildUsersSocialConnect A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `uid`, `provider`, `email`, `authentication`, `info` FROM `users_social_connect` WHERE `id` = :p0 AND `uid` = :p1 AND `provider` = :p2 AND `email` = :p3';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_STR);
            $stmt->bindValue(':p3', $key[3], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsersSocialConnect $obj */
            $obj = new ChildUsersSocialConnect();
            $obj->hydrate($row);
            UsersSocialConnectTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2], (string) $key[3])));
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
     * @return ChildUsersSocialConnect|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UsersSocialConnectTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UsersSocialConnectTableMap::COL_UID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(UsersSocialConnectTableMap::COL_PROVIDER, $key[2], Criteria::EQUAL);
        $this->addUsingAlias(UsersSocialConnectTableMap::COL_EMAIL, $key[3], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UsersSocialConnectTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UsersSocialConnectTableMap::COL_UID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(UsersSocialConnectTableMap::COL_PROVIDER, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $cton3 = $this->getNewCriterion(UsersSocialConnectTableMap::COL_EMAIL, $key[3], Criteria::EQUAL);
            $cton0->addAnd($cton3);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersSocialConnectTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersSocialConnectTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSocialConnectTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UsersSocialConnectTableMap::COL_UID, $uid, $comparison);
    }

    /**
     * Filter the query on the provider column
     *
     * Example usage:
     * <code>
     * $query->filterByProvider('fooValue');   // WHERE provider = 'fooValue'
     * $query->filterByProvider('%fooValue%'); // WHERE provider LIKE '%fooValue%'
     * </code>
     *
     * @param     string $provider The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function filterByProvider($provider = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($provider)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $provider)) {
                $provider = str_replace('*', '%', $provider);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersSocialConnectTableMap::COL_PROVIDER, $provider, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersSocialConnectTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the authentication column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthentication('fooValue');   // WHERE authentication = 'fooValue'
     * $query->filterByAuthentication('%fooValue%'); // WHERE authentication LIKE '%fooValue%'
     * </code>
     *
     * @param     string $authentication The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function filterByAuthentication($authentication = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($authentication)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $authentication)) {
                $authentication = str_replace('*', '%', $authentication);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersSocialConnectTableMap::COL_AUTHENTICATION, $authentication, $comparison);
    }

    /**
     * Filter the query on the info column
     *
     * Example usage:
     * <code>
     * $query->filterByInfo('fooValue');   // WHERE info = 'fooValue'
     * $query->filterByInfo('%fooValue%'); // WHERE info LIKE '%fooValue%'
     * </code>
     *
     * @param     string $info The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function filterByInfo($info = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($info)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $info)) {
                $info = str_replace('*', '%', $info);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersSocialConnectTableMap::COL_INFO, $info, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersSocialConnect $usersSocialConnect Object to remove from the list of results
     *
     * @return $this|ChildUsersSocialConnectQuery The current query, for fluid interface
     */
    public function prune($usersSocialConnect = null)
    {
        if ($usersSocialConnect) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UsersSocialConnectTableMap::COL_ID), $usersSocialConnect->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UsersSocialConnectTableMap::COL_UID), $usersSocialConnect->getUid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(UsersSocialConnectTableMap::COL_PROVIDER), $usersSocialConnect->getProvider(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond3', $this->getAliasedColName(UsersSocialConnectTableMap::COL_EMAIL), $usersSocialConnect->getEmail(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2', 'pruneCond3'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_social_connect table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSocialConnectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersSocialConnectTableMap::clearInstancePool();
            UsersSocialConnectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSocialConnectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersSocialConnectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersSocialConnectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersSocialConnectTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersSocialConnectQuery
