<?php

namespace Base;

use \UsersPushRegIds as ChildUsersPushRegIds;
use \UsersPushRegIdsQuery as ChildUsersPushRegIdsQuery;
use \Exception;
use \PDO;
use Map\UsersPushRegIdsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_push_reg_ids' table.
 *
 *
 *
 * @method     ChildUsersPushRegIdsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersPushRegIdsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersPushRegIdsQuery orderByRegId($order = Criteria::ASC) Order by the reg_id column
 * @method     ChildUsersPushRegIdsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildUsersPushRegIdsQuery orderByDevPlatform($order = Criteria::ASC) Order by the dev_platform column
 * @method     ChildUsersPushRegIdsQuery orderByDevModel($order = Criteria::ASC) Order by the dev_model column
 * @method     ChildUsersPushRegIdsQuery orderByDevVersion($order = Criteria::ASC) Order by the dev_version column
 * @method     ChildUsersPushRegIdsQuery orderByDevManufacturer($order = Criteria::ASC) Order by the dev_manufacturer column
 * @method     ChildUsersPushRegIdsQuery orderByDevVirtual($order = Criteria::ASC) Order by the dev_virtual column
 * @method     ChildUsersPushRegIdsQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 *
 * @method     ChildUsersPushRegIdsQuery groupById() Group by the id column
 * @method     ChildUsersPushRegIdsQuery groupByEmail() Group by the email column
 * @method     ChildUsersPushRegIdsQuery groupByRegId() Group by the reg_id column
 * @method     ChildUsersPushRegIdsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildUsersPushRegIdsQuery groupByDevPlatform() Group by the dev_platform column
 * @method     ChildUsersPushRegIdsQuery groupByDevModel() Group by the dev_model column
 * @method     ChildUsersPushRegIdsQuery groupByDevVersion() Group by the dev_version column
 * @method     ChildUsersPushRegIdsQuery groupByDevManufacturer() Group by the dev_manufacturer column
 * @method     ChildUsersPushRegIdsQuery groupByDevVirtual() Group by the dev_virtual column
 * @method     ChildUsersPushRegIdsQuery groupByEnabled() Group by the enabled column
 *
 * @method     ChildUsersPushRegIdsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersPushRegIdsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersPushRegIdsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersPushRegIds findOne(ConnectionInterface $con = null) Return the first ChildUsersPushRegIds matching the query
 * @method     ChildUsersPushRegIds findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersPushRegIds matching the query, or a new ChildUsersPushRegIds object populated from the query conditions when no match is found
 *
 * @method     ChildUsersPushRegIds findOneById(int $id) Return the first ChildUsersPushRegIds filtered by the id column
 * @method     ChildUsersPushRegIds findOneByEmail(string $email) Return the first ChildUsersPushRegIds filtered by the email column
 * @method     ChildUsersPushRegIds findOneByRegId(string $reg_id) Return the first ChildUsersPushRegIds filtered by the reg_id column
 * @method     ChildUsersPushRegIds findOneByUpdatedAt(string $updated_at) Return the first ChildUsersPushRegIds filtered by the updated_at column
 * @method     ChildUsersPushRegIds findOneByDevPlatform(string $dev_platform) Return the first ChildUsersPushRegIds filtered by the dev_platform column
 * @method     ChildUsersPushRegIds findOneByDevModel(string $dev_model) Return the first ChildUsersPushRegIds filtered by the dev_model column
 * @method     ChildUsersPushRegIds findOneByDevVersion(string $dev_version) Return the first ChildUsersPushRegIds filtered by the dev_version column
 * @method     ChildUsersPushRegIds findOneByDevManufacturer(string $dev_manufacturer) Return the first ChildUsersPushRegIds filtered by the dev_manufacturer column
 * @method     ChildUsersPushRegIds findOneByDevVirtual(boolean $dev_virtual) Return the first ChildUsersPushRegIds filtered by the dev_virtual column
 * @method     ChildUsersPushRegIds findOneByEnabled(boolean $enabled) Return the first ChildUsersPushRegIds filtered by the enabled column *

 * @method     ChildUsersPushRegIds requirePk($key, ConnectionInterface $con = null) Return the ChildUsersPushRegIds by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOne(ConnectionInterface $con = null) Return the first ChildUsersPushRegIds matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersPushRegIds requireOneById(int $id) Return the first ChildUsersPushRegIds filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByEmail(string $email) Return the first ChildUsersPushRegIds filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByRegId(string $reg_id) Return the first ChildUsersPushRegIds filtered by the reg_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByUpdatedAt(string $updated_at) Return the first ChildUsersPushRegIds filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByDevPlatform(string $dev_platform) Return the first ChildUsersPushRegIds filtered by the dev_platform column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByDevModel(string $dev_model) Return the first ChildUsersPushRegIds filtered by the dev_model column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByDevVersion(string $dev_version) Return the first ChildUsersPushRegIds filtered by the dev_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByDevManufacturer(string $dev_manufacturer) Return the first ChildUsersPushRegIds filtered by the dev_manufacturer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByDevVirtual(boolean $dev_virtual) Return the first ChildUsersPushRegIds filtered by the dev_virtual column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersPushRegIds requireOneByEnabled(boolean $enabled) Return the first ChildUsersPushRegIds filtered by the enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersPushRegIds[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersPushRegIds objects based on current ModelCriteria
 * @method     ChildUsersPushRegIds[]|ObjectCollection findById(int $id) Return ChildUsersPushRegIds objects filtered by the id column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByEmail(string $email) Return ChildUsersPushRegIds objects filtered by the email column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByRegId(string $reg_id) Return ChildUsersPushRegIds objects filtered by the reg_id column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUsersPushRegIds objects filtered by the updated_at column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByDevPlatform(string $dev_platform) Return ChildUsersPushRegIds objects filtered by the dev_platform column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByDevModel(string $dev_model) Return ChildUsersPushRegIds objects filtered by the dev_model column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByDevVersion(string $dev_version) Return ChildUsersPushRegIds objects filtered by the dev_version column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByDevManufacturer(string $dev_manufacturer) Return ChildUsersPushRegIds objects filtered by the dev_manufacturer column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByDevVirtual(boolean $dev_virtual) Return ChildUsersPushRegIds objects filtered by the dev_virtual column
 * @method     ChildUsersPushRegIds[]|ObjectCollection findByEnabled(boolean $enabled) Return ChildUsersPushRegIds objects filtered by the enabled column
 * @method     ChildUsersPushRegIds[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersPushRegIdsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersPushRegIdsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersPushRegIds', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersPushRegIdsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersPushRegIdsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersPushRegIdsQuery) {
            return $criteria;
        }
        $query = new ChildUsersPushRegIdsQuery();
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
     * @return ChildUsersPushRegIds|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersPushRegIdsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersPushRegIdsTableMap::DATABASE_NAME);
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
     * @return ChildUsersPushRegIds A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `email`, `reg_id`, `updated_at`, `dev_platform`, `dev_model`, `dev_version`, `dev_manufacturer`, `dev_virtual`, `enabled` FROM `users_push_reg_ids` WHERE `id` = :p0';
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
            /** @var ChildUsersPushRegIds $obj */
            $obj = new ChildUsersPushRegIds();
            $obj->hydrate($row);
            UsersPushRegIdsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsersPushRegIds|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersPushRegIdsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersPushRegIdsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the reg_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRegId('fooValue');   // WHERE reg_id = 'fooValue'
     * $query->filterByRegId('%fooValue%'); // WHERE reg_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $regId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByRegId($regId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($regId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $regId)) {
                $regId = str_replace('*', '%', $regId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_REG_ID, $regId, $comparison);
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
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsersPushRegIdsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsersPushRegIdsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the dev_platform column
     *
     * Example usage:
     * <code>
     * $query->filterByDevPlatform('fooValue');   // WHERE dev_platform = 'fooValue'
     * $query->filterByDevPlatform('%fooValue%'); // WHERE dev_platform LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devPlatform The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByDevPlatform($devPlatform = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devPlatform)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devPlatform)) {
                $devPlatform = str_replace('*', '%', $devPlatform);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_DEV_PLATFORM, $devPlatform, $comparison);
    }

    /**
     * Filter the query on the dev_model column
     *
     * Example usage:
     * <code>
     * $query->filterByDevModel('fooValue');   // WHERE dev_model = 'fooValue'
     * $query->filterByDevModel('%fooValue%'); // WHERE dev_model LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devModel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByDevModel($devModel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devModel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devModel)) {
                $devModel = str_replace('*', '%', $devModel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_DEV_MODEL, $devModel, $comparison);
    }

    /**
     * Filter the query on the dev_version column
     *
     * Example usage:
     * <code>
     * $query->filterByDevVersion('fooValue');   // WHERE dev_version = 'fooValue'
     * $query->filterByDevVersion('%fooValue%'); // WHERE dev_version LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devVersion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByDevVersion($devVersion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devVersion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devVersion)) {
                $devVersion = str_replace('*', '%', $devVersion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_DEV_VERSION, $devVersion, $comparison);
    }

    /**
     * Filter the query on the dev_manufacturer column
     *
     * Example usage:
     * <code>
     * $query->filterByDevManufacturer('fooValue');   // WHERE dev_manufacturer = 'fooValue'
     * $query->filterByDevManufacturer('%fooValue%'); // WHERE dev_manufacturer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devManufacturer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByDevManufacturer($devManufacturer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devManufacturer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devManufacturer)) {
                $devManufacturer = str_replace('*', '%', $devManufacturer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_DEV_MANUFACTURER, $devManufacturer, $comparison);
    }

    /**
     * Filter the query on the dev_virtual column
     *
     * Example usage:
     * <code>
     * $query->filterByDevVirtual(true); // WHERE dev_virtual = true
     * $query->filterByDevVirtual('yes'); // WHERE dev_virtual = true
     * </code>
     *
     * @param     boolean|string $devVirtual The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByDevVirtual($devVirtual = null, $comparison = null)
    {
        if (is_string($devVirtual)) {
            $devVirtual = in_array(strtolower($devVirtual), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_DEV_VIRTUAL, $devVirtual, $comparison);
    }

    /**
     * Filter the query on the enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByEnabled(true); // WHERE enabled = true
     * $query->filterByEnabled('yes'); // WHERE enabled = true
     * </code>
     *
     * @param     boolean|string $enabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (is_string($enabled)) {
            $enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersPushRegIdsTableMap::COL_ENABLED, $enabled, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersPushRegIds $usersPushRegIds Object to remove from the list of results
     *
     * @return $this|ChildUsersPushRegIdsQuery The current query, for fluid interface
     */
    public function prune($usersPushRegIds = null)
    {
        if ($usersPushRegIds) {
            $this->addUsingAlias(UsersPushRegIdsTableMap::COL_ID, $usersPushRegIds->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_push_reg_ids table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersPushRegIdsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersPushRegIdsTableMap::clearInstancePool();
            UsersPushRegIdsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersPushRegIdsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersPushRegIdsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersPushRegIdsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersPushRegIdsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersPushRegIdsQuery
