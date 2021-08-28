<?php

namespace Base;

use \UsersMp as ChildUsersMp;
use \UsersMpQuery as ChildUsersMpQuery;
use \Exception;
use \PDO;
use Map\UsersMpTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_mp' table.
 *
 *
 *
 * @method     ChildUsersMpQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersMpQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildUsersMpQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildUsersMpQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildUsersMpQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildUsersMpQuery orderByAccessToken($order = Criteria::ASC) Order by the access_token column
 * @method     ChildUsersMpQuery orderByPublicKey($order = Criteria::ASC) Order by the public_key column
 * @method     ChildUsersMpQuery orderByLiveMode($order = Criteria::ASC) Order by the live_mode column
 * @method     ChildUsersMpQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUsersMpQuery orderByTokenType($order = Criteria::ASC) Order by the token_type column
 * @method     ChildUsersMpQuery orderByExpiresIn($order = Criteria::ASC) Order by the expires_in column
 * @method     ChildUsersMpQuery orderByScope($order = Criteria::ASC) Order by the scope column
 * @method     ChildUsersMpQuery orderByCustomerId($order = Criteria::ASC) Order by the customer_id column
 *
 * @method     ChildUsersMpQuery groupById() Group by the id column
 * @method     ChildUsersMpQuery groupByIdUser() Group by the id_user column
 * @method     ChildUsersMpQuery groupByCode() Group by the code column
 * @method     ChildUsersMpQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildUsersMpQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildUsersMpQuery groupByAccessToken() Group by the access_token column
 * @method     ChildUsersMpQuery groupByPublicKey() Group by the public_key column
 * @method     ChildUsersMpQuery groupByLiveMode() Group by the live_mode column
 * @method     ChildUsersMpQuery groupByUserId() Group by the user_id column
 * @method     ChildUsersMpQuery groupByTokenType() Group by the token_type column
 * @method     ChildUsersMpQuery groupByExpiresIn() Group by the expires_in column
 * @method     ChildUsersMpQuery groupByScope() Group by the scope column
 * @method     ChildUsersMpQuery groupByCustomerId() Group by the customer_id column
 *
 * @method     ChildUsersMpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersMpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersMpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersMp findOne(ConnectionInterface $con = null) Return the first ChildUsersMp matching the query
 * @method     ChildUsersMp findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersMp matching the query, or a new ChildUsersMp object populated from the query conditions when no match is found
 *
 * @method     ChildUsersMp findOneById(int $id) Return the first ChildUsersMp filtered by the id column
 * @method     ChildUsersMp findOneByIdUser(int $id_user) Return the first ChildUsersMp filtered by the id_user column
 * @method     ChildUsersMp findOneByCode(string $code) Return the first ChildUsersMp filtered by the code column
 * @method     ChildUsersMp findOneByRegisteredAt(string $registered_at) Return the first ChildUsersMp filtered by the registered_at column
 * @method     ChildUsersMp findOneByUpdatedAt(string $updated_at) Return the first ChildUsersMp filtered by the updated_at column
 * @method     ChildUsersMp findOneByAccessToken(string $access_token) Return the first ChildUsersMp filtered by the access_token column
 * @method     ChildUsersMp findOneByPublicKey(string $public_key) Return the first ChildUsersMp filtered by the public_key column
 * @method     ChildUsersMp findOneByLiveMode(boolean $live_mode) Return the first ChildUsersMp filtered by the live_mode column
 * @method     ChildUsersMp findOneByUserId(int $user_id) Return the first ChildUsersMp filtered by the user_id column
 * @method     ChildUsersMp findOneByTokenType(string $token_type) Return the first ChildUsersMp filtered by the token_type column
 * @method     ChildUsersMp findOneByExpiresIn(string $expires_in) Return the first ChildUsersMp filtered by the expires_in column
 * @method     ChildUsersMp findOneByScope(string $scope) Return the first ChildUsersMp filtered by the scope column
 * @method     ChildUsersMp findOneByCustomerId(string $customer_id) Return the first ChildUsersMp filtered by the customer_id column *

 * @method     ChildUsersMp requirePk($key, ConnectionInterface $con = null) Return the ChildUsersMp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOne(ConnectionInterface $con = null) Return the first ChildUsersMp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersMp requireOneById(int $id) Return the first ChildUsersMp filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByIdUser(int $id_user) Return the first ChildUsersMp filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByCode(string $code) Return the first ChildUsersMp filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByRegisteredAt(string $registered_at) Return the first ChildUsersMp filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByUpdatedAt(string $updated_at) Return the first ChildUsersMp filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByAccessToken(string $access_token) Return the first ChildUsersMp filtered by the access_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByPublicKey(string $public_key) Return the first ChildUsersMp filtered by the public_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByLiveMode(boolean $live_mode) Return the first ChildUsersMp filtered by the live_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByUserId(int $user_id) Return the first ChildUsersMp filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByTokenType(string $token_type) Return the first ChildUsersMp filtered by the token_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByExpiresIn(string $expires_in) Return the first ChildUsersMp filtered by the expires_in column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByScope(string $scope) Return the first ChildUsersMp filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersMp requireOneByCustomerId(string $customer_id) Return the first ChildUsersMp filtered by the customer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersMp[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersMp objects based on current ModelCriteria
 * @method     ChildUsersMp[]|ObjectCollection findById(int $id) Return ChildUsersMp objects filtered by the id column
 * @method     ChildUsersMp[]|ObjectCollection findByIdUser(int $id_user) Return ChildUsersMp objects filtered by the id_user column
 * @method     ChildUsersMp[]|ObjectCollection findByCode(string $code) Return ChildUsersMp objects filtered by the code column
 * @method     ChildUsersMp[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildUsersMp objects filtered by the registered_at column
 * @method     ChildUsersMp[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUsersMp objects filtered by the updated_at column
 * @method     ChildUsersMp[]|ObjectCollection findByAccessToken(string $access_token) Return ChildUsersMp objects filtered by the access_token column
 * @method     ChildUsersMp[]|ObjectCollection findByPublicKey(string $public_key) Return ChildUsersMp objects filtered by the public_key column
 * @method     ChildUsersMp[]|ObjectCollection findByLiveMode(boolean $live_mode) Return ChildUsersMp objects filtered by the live_mode column
 * @method     ChildUsersMp[]|ObjectCollection findByUserId(int $user_id) Return ChildUsersMp objects filtered by the user_id column
 * @method     ChildUsersMp[]|ObjectCollection findByTokenType(string $token_type) Return ChildUsersMp objects filtered by the token_type column
 * @method     ChildUsersMp[]|ObjectCollection findByExpiresIn(string $expires_in) Return ChildUsersMp objects filtered by the expires_in column
 * @method     ChildUsersMp[]|ObjectCollection findByScope(string $scope) Return ChildUsersMp objects filtered by the scope column
 * @method     ChildUsersMp[]|ObjectCollection findByCustomerId(string $customer_id) Return ChildUsersMp objects filtered by the customer_id column
 * @method     ChildUsersMp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersMpQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersMpQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersMp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersMpQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersMpQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersMpQuery) {
            return $criteria;
        }
        $query = new ChildUsersMpQuery();
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
     * @return ChildUsersMp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersMpTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersMpTableMap::DATABASE_NAME);
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
     * @return ChildUsersMp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `code`, `registered_at`, `updated_at`, `access_token`, `public_key`, `live_mode`, `user_id`, `token_type`, `expires_in`, `scope`, `customer_id` FROM `users_mp` WHERE `id` = :p0';
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
            /** @var ChildUsersMp $obj */
            $obj = new ChildUsersMp();
            $obj->hydrate($row);
            UsersMpTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsersMp|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersMpTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersMpTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_CODE, $code, $comparison);
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
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
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
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the access_token column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessToken('fooValue');   // WHERE access_token = 'fooValue'
     * $query->filterByAccessToken('%fooValue%'); // WHERE access_token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accessToken The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByAccessToken($accessToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accessToken)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $accessToken)) {
                $accessToken = str_replace('*', '%', $accessToken);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_ACCESS_TOKEN, $accessToken, $comparison);
    }

    /**
     * Filter the query on the public_key column
     *
     * Example usage:
     * <code>
     * $query->filterByPublicKey('fooValue');   // WHERE public_key = 'fooValue'
     * $query->filterByPublicKey('%fooValue%'); // WHERE public_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $publicKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByPublicKey($publicKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($publicKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $publicKey)) {
                $publicKey = str_replace('*', '%', $publicKey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_PUBLIC_KEY, $publicKey, $comparison);
    }

    /**
     * Filter the query on the live_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByLiveMode(true); // WHERE live_mode = true
     * $query->filterByLiveMode('yes'); // WHERE live_mode = true
     * </code>
     *
     * @param     boolean|string $liveMode The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByLiveMode($liveMode = null, $comparison = null)
    {
        if (is_string($liveMode)) {
            $liveMode = in_array(strtolower($liveMode), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_LIVE_MODE, $liveMode, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the token_type column
     *
     * Example usage:
     * <code>
     * $query->filterByTokenType('fooValue');   // WHERE token_type = 'fooValue'
     * $query->filterByTokenType('%fooValue%'); // WHERE token_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tokenType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByTokenType($tokenType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tokenType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tokenType)) {
                $tokenType = str_replace('*', '%', $tokenType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_TOKEN_TYPE, $tokenType, $comparison);
    }

    /**
     * Filter the query on the expires_in column
     *
     * Example usage:
     * <code>
     * $query->filterByExpiresIn(1234); // WHERE expires_in = 1234
     * $query->filterByExpiresIn(array(12, 34)); // WHERE expires_in IN (12, 34)
     * $query->filterByExpiresIn(array('min' => 12)); // WHERE expires_in > 12
     * </code>
     *
     * @param     mixed $expiresIn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByExpiresIn($expiresIn = null, $comparison = null)
    {
        if (is_array($expiresIn)) {
            $useMinMax = false;
            if (isset($expiresIn['min'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_EXPIRES_IN, $expiresIn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expiresIn['max'])) {
                $this->addUsingAlias(UsersMpTableMap::COL_EXPIRES_IN, $expiresIn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_EXPIRES_IN, $expiresIn, $comparison);
    }

    /**
     * Filter the query on the scope column
     *
     * Example usage:
     * <code>
     * $query->filterByScope('fooValue');   // WHERE scope = 'fooValue'
     * $query->filterByScope('%fooValue%'); // WHERE scope LIKE '%fooValue%'
     * </code>
     *
     * @param     string $scope The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByScope($scope = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scope)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $scope)) {
                $scope = str_replace('*', '%', $scope);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_SCOPE, $scope, $comparison);
    }

    /**
     * Filter the query on the customer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerId('fooValue');   // WHERE customer_id = 'fooValue'
     * $query->filterByCustomerId('%fooValue%'); // WHERE customer_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $customerId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function filterByCustomerId($customerId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customerId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $customerId)) {
                $customerId = str_replace('*', '%', $customerId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersMpTableMap::COL_CUSTOMER_ID, $customerId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersMp $usersMp Object to remove from the list of results
     *
     * @return $this|ChildUsersMpQuery The current query, for fluid interface
     */
    public function prune($usersMp = null)
    {
        if ($usersMp) {
            $this->addUsingAlias(UsersMpTableMap::COL_ID, $usersMp->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_mp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersMpTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersMpTableMap::clearInstancePool();
            UsersMpTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersMpTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersMpTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersMpTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersMpTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersMpQuery
