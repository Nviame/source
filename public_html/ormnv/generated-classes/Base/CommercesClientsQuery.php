<?php

namespace Base;

use \CommercesClients as ChildCommercesClients;
use \CommercesClientsQuery as ChildCommercesClientsQuery;
use \Exception;
use \PDO;
use Map\CommercesClientsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'commerces_clients' table.
 *
 *
 *
 * @method     ChildCommercesClientsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCommercesClientsQuery orderByIdCommerce($order = Criteria::ASC) Order by the id_commerce column
 * @method     ChildCommercesClientsQuery orderByIdLocality($order = Criteria::ASC) Order by the id_locality column
 * @method     ChildCommercesClientsQuery orderByIdProvince($order = Criteria::ASC) Order by the id_province column
 * @method     ChildCommercesClientsQuery orderByFullname($order = Criteria::ASC) Order by the fullname column
 * @method     ChildCommercesClientsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildCommercesClientsQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildCommercesClientsQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildCommercesClientsQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildCommercesClientsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCommercesClientsQuery groupById() Group by the id column
 * @method     ChildCommercesClientsQuery groupByIdCommerce() Group by the id_commerce column
 * @method     ChildCommercesClientsQuery groupByIdLocality() Group by the id_locality column
 * @method     ChildCommercesClientsQuery groupByIdProvince() Group by the id_province column
 * @method     ChildCommercesClientsQuery groupByFullname() Group by the fullname column
 * @method     ChildCommercesClientsQuery groupByEmail() Group by the email column
 * @method     ChildCommercesClientsQuery groupByAddress() Group by the address column
 * @method     ChildCommercesClientsQuery groupByPhone() Group by the phone column
 * @method     ChildCommercesClientsQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildCommercesClientsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCommercesClientsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommercesClientsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommercesClientsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommercesClientsQuery leftJoinProvincesLocalities($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProvincesLocalities relation
 * @method     ChildCommercesClientsQuery rightJoinProvincesLocalities($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProvincesLocalities relation
 * @method     ChildCommercesClientsQuery innerJoinProvincesLocalities($relationAlias = null) Adds a INNER JOIN clause to the query using the ProvincesLocalities relation
 *
 * @method     ChildCommercesClientsQuery leftJoinProvinces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Provinces relation
 * @method     ChildCommercesClientsQuery rightJoinProvinces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Provinces relation
 * @method     ChildCommercesClientsQuery innerJoinProvinces($relationAlias = null) Adds a INNER JOIN clause to the query using the Provinces relation
 *
 * @method     \ProvincesLocalitiesQuery|\ProvincesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCommercesClients findOne(ConnectionInterface $con = null) Return the first ChildCommercesClients matching the query
 * @method     ChildCommercesClients findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCommercesClients matching the query, or a new ChildCommercesClients object populated from the query conditions when no match is found
 *
 * @method     ChildCommercesClients findOneById(int $id) Return the first ChildCommercesClients filtered by the id column
 * @method     ChildCommercesClients findOneByIdCommerce(int $id_commerce) Return the first ChildCommercesClients filtered by the id_commerce column
 * @method     ChildCommercesClients findOneByIdLocality(int $id_locality) Return the first ChildCommercesClients filtered by the id_locality column
 * @method     ChildCommercesClients findOneByIdProvince(int $id_province) Return the first ChildCommercesClients filtered by the id_province column
 * @method     ChildCommercesClients findOneByFullname(string $fullname) Return the first ChildCommercesClients filtered by the fullname column
 * @method     ChildCommercesClients findOneByEmail(string $email) Return the first ChildCommercesClients filtered by the email column
 * @method     ChildCommercesClients findOneByAddress(string $address) Return the first ChildCommercesClients filtered by the address column
 * @method     ChildCommercesClients findOneByPhone(string $phone) Return the first ChildCommercesClients filtered by the phone column
 * @method     ChildCommercesClients findOneByRegisteredAt(string $registered_at) Return the first ChildCommercesClients filtered by the registered_at column
 * @method     ChildCommercesClients findOneByUpdatedAt(string $updated_at) Return the first ChildCommercesClients filtered by the updated_at column *

 * @method     ChildCommercesClients requirePk($key, ConnectionInterface $con = null) Return the ChildCommercesClients by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOne(ConnectionInterface $con = null) Return the first ChildCommercesClients matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesClients requireOneById(int $id) Return the first ChildCommercesClients filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByIdCommerce(int $id_commerce) Return the first ChildCommercesClients filtered by the id_commerce column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByIdLocality(int $id_locality) Return the first ChildCommercesClients filtered by the id_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByIdProvince(int $id_province) Return the first ChildCommercesClients filtered by the id_province column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByFullname(string $fullname) Return the first ChildCommercesClients filtered by the fullname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByEmail(string $email) Return the first ChildCommercesClients filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByAddress(string $address) Return the first ChildCommercesClients filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByPhone(string $phone) Return the first ChildCommercesClients filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByRegisteredAt(string $registered_at) Return the first ChildCommercesClients filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesClients requireOneByUpdatedAt(string $updated_at) Return the first ChildCommercesClients filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesClients[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCommercesClients objects based on current ModelCriteria
 * @method     ChildCommercesClients[]|ObjectCollection findById(int $id) Return ChildCommercesClients objects filtered by the id column
 * @method     ChildCommercesClients[]|ObjectCollection findByIdCommerce(int $id_commerce) Return ChildCommercesClients objects filtered by the id_commerce column
 * @method     ChildCommercesClients[]|ObjectCollection findByIdLocality(int $id_locality) Return ChildCommercesClients objects filtered by the id_locality column
 * @method     ChildCommercesClients[]|ObjectCollection findByIdProvince(int $id_province) Return ChildCommercesClients objects filtered by the id_province column
 * @method     ChildCommercesClients[]|ObjectCollection findByFullname(string $fullname) Return ChildCommercesClients objects filtered by the fullname column
 * @method     ChildCommercesClients[]|ObjectCollection findByEmail(string $email) Return ChildCommercesClients objects filtered by the email column
 * @method     ChildCommercesClients[]|ObjectCollection findByAddress(string $address) Return ChildCommercesClients objects filtered by the address column
 * @method     ChildCommercesClients[]|ObjectCollection findByPhone(string $phone) Return ChildCommercesClients objects filtered by the phone column
 * @method     ChildCommercesClients[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildCommercesClients objects filtered by the registered_at column
 * @method     ChildCommercesClients[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCommercesClients objects filtered by the updated_at column
 * @method     ChildCommercesClients[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommercesClientsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CommercesClientsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CommercesClients', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommercesClientsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommercesClientsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCommercesClientsQuery) {
            return $criteria;
        }
        $query = new ChildCommercesClientsQuery();
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
     * @return ChildCommercesClients|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommercesClientsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommercesClientsTableMap::DATABASE_NAME);
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
     * @return ChildCommercesClients A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_commerce`, `id_locality`, `id_province`, `fullname`, `email`, `address`, `phone`, `registered_at`, `updated_at` FROM `commerces_clients` WHERE `id` = :p0';
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
            /** @var ChildCommercesClients $obj */
            $obj = new ChildCommercesClients();
            $obj->hydrate($row);
            CommercesClientsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCommercesClients|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommercesClientsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommercesClientsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_ID, $id, $comparison);
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
     * @param     mixed $idCommerce The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByIdCommerce($idCommerce = null, $comparison = null)
    {
        if (is_array($idCommerce)) {
            $useMinMax = false;
            if (isset($idCommerce['min'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID_COMMERCE, $idCommerce['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCommerce['max'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID_COMMERCE, $idCommerce['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_ID_COMMERCE, $idCommerce, $comparison);
    }

    /**
     * Filter the query on the id_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByIdLocality(1234); // WHERE id_locality = 1234
     * $query->filterByIdLocality(array(12, 34)); // WHERE id_locality IN (12, 34)
     * $query->filterByIdLocality(array('min' => 12)); // WHERE id_locality > 12
     * </code>
     *
     * @see       filterByProvincesLocalities()
     *
     * @param     mixed $idLocality The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByIdLocality($idLocality = null, $comparison = null)
    {
        if (is_array($idLocality)) {
            $useMinMax = false;
            if (isset($idLocality['min'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID_LOCALITY, $idLocality['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idLocality['max'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID_LOCALITY, $idLocality['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_ID_LOCALITY, $idLocality, $comparison);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByIdProvince($idProvince = null, $comparison = null)
    {
        if (is_array($idProvince)) {
            $useMinMax = false;
            if (isset($idProvince['min'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID_PROVINCE, $idProvince['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProvince['max'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_ID_PROVINCE, $idProvince['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_ID_PROVINCE, $idProvince, $comparison);
    }

    /**
     * Filter the query on the fullname column
     *
     * Example usage:
     * <code>
     * $query->filterByFullname('fooValue');   // WHERE fullname = 'fooValue'
     * $query->filterByFullname('%fooValue%'); // WHERE fullname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fullname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByFullname($fullname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fullname)) {
                $fullname = str_replace('*', '%', $fullname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_FULLNAME, $fullname, $comparison);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CommercesClientsTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CommercesClientsTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_PHONE, $phone, $comparison);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CommercesClientsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesClientsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProvincesLocalities object
     *
     * @param \ProvincesLocalities|ObjectCollection $provincesLocalities The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByProvincesLocalities($provincesLocalities, $comparison = null)
    {
        if ($provincesLocalities instanceof \ProvincesLocalities) {
            return $this
                ->addUsingAlias(CommercesClientsTableMap::COL_ID_LOCALITY, $provincesLocalities->getId(), $comparison);
        } elseif ($provincesLocalities instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesClientsTableMap::COL_ID_LOCALITY, $provincesLocalities->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
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
     * Filter the query by a related \Provinces object
     *
     * @param \Provinces|ObjectCollection $provinces The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function filterByProvinces($provinces, $comparison = null)
    {
        if ($provinces instanceof \Provinces) {
            return $this
                ->addUsingAlias(CommercesClientsTableMap::COL_ID_PROVINCE, $provinces->getId(), $comparison);
        } elseif ($provinces instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesClientsTableMap::COL_ID_PROVINCE, $provinces->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCommercesClients $commercesClients Object to remove from the list of results
     *
     * @return $this|ChildCommercesClientsQuery The current query, for fluid interface
     */
    public function prune($commercesClients = null)
    {
        if ($commercesClients) {
            $this->addUsingAlias(CommercesClientsTableMap::COL_ID, $commercesClients->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the commerces_clients table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesClientsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommercesClientsTableMap::clearInstancePool();
            CommercesClientsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesClientsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommercesClientsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CommercesClientsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommercesClientsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CommercesClientsQuery
