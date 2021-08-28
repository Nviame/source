<?php

namespace Base;

use \Commerces as ChildCommerces;
use \CommercesQuery as ChildCommercesQuery;
use \Exception;
use \PDO;
use Map\CommercesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'commerces' table.
 *
 *
 *
 * @method     ChildCommercesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCommercesQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildCommercesQuery orderByIdPositionCommerce($order = Criteria::ASC) Order by the id_position_commerce column
 * @method     ChildCommercesQuery orderByIdHeadingCommerce($order = Criteria::ASC) Order by the id_heading_commerce column
 * @method     ChildCommercesQuery orderByIdProvince($order = Criteria::ASC) Order by the id_province column
 * @method     ChildCommercesQuery orderByIdLocality($order = Criteria::ASC) Order by the id_locality column
 * @method     ChildCommercesQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildCommercesQuery orderByLogo($order = Criteria::ASC) Order by the logo column
 * @method     ChildCommercesQuery orderByBusinessName($order = Criteria::ASC) Order by the business_name column
 * @method     ChildCommercesQuery orderByCuitCuil($order = Criteria::ASC) Order by the cuit_cuil column
 * @method     ChildCommercesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCommercesQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildCommercesQuery orderByPhonePersonal($order = Criteria::ASC) Order by the phone_personal column
 * @method     ChildCommercesQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildCommercesQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildCommercesQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildCommercesQuery orderByAddressLat($order = Criteria::ASC) Order by the address_lat column
 * @method     ChildCommercesQuery orderByAddressLng($order = Criteria::ASC) Order by the address_lng column
 * @method     ChildCommercesQuery orderByAddressLocality($order = Criteria::ASC) Order by the address_locality column
 * @method     ChildCommercesQuery orderByAddressRegion($order = Criteria::ASC) Order by the address_region column
 * @method     ChildCommercesQuery orderByAddressCountry($order = Criteria::ASC) Order by the address_country column
 * @method     ChildCommercesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCommercesQuery groupById() Group by the id column
 * @method     ChildCommercesQuery groupByIdUser() Group by the id_user column
 * @method     ChildCommercesQuery groupByIdPositionCommerce() Group by the id_position_commerce column
 * @method     ChildCommercesQuery groupByIdHeadingCommerce() Group by the id_heading_commerce column
 * @method     ChildCommercesQuery groupByIdProvince() Group by the id_province column
 * @method     ChildCommercesQuery groupByIdLocality() Group by the id_locality column
 * @method     ChildCommercesQuery groupByToken() Group by the token column
 * @method     ChildCommercesQuery groupByLogo() Group by the logo column
 * @method     ChildCommercesQuery groupByBusinessName() Group by the business_name column
 * @method     ChildCommercesQuery groupByCuitCuil() Group by the cuit_cuil column
 * @method     ChildCommercesQuery groupByName() Group by the name column
 * @method     ChildCommercesQuery groupByPhone() Group by the phone column
 * @method     ChildCommercesQuery groupByPhonePersonal() Group by the phone_personal column
 * @method     ChildCommercesQuery groupByEmail() Group by the email column
 * @method     ChildCommercesQuery groupByPassword() Group by the password column
 * @method     ChildCommercesQuery groupByAddress() Group by the address column
 * @method     ChildCommercesQuery groupByAddressLat() Group by the address_lat column
 * @method     ChildCommercesQuery groupByAddressLng() Group by the address_lng column
 * @method     ChildCommercesQuery groupByAddressLocality() Group by the address_locality column
 * @method     ChildCommercesQuery groupByAddressRegion() Group by the address_region column
 * @method     ChildCommercesQuery groupByAddressCountry() Group by the address_country column
 * @method     ChildCommercesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCommercesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommercesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommercesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommercesQuery leftJoinPositionsCommerce($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsCommerce relation
 * @method     ChildCommercesQuery rightJoinPositionsCommerce($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsCommerce relation
 * @method     ChildCommercesQuery innerJoinPositionsCommerce($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsCommerce relation
 *
 * @method     ChildCommercesQuery leftJoinHeadingsCommerce($relationAlias = null) Adds a LEFT JOIN clause to the query using the HeadingsCommerce relation
 * @method     ChildCommercesQuery rightJoinHeadingsCommerce($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HeadingsCommerce relation
 * @method     ChildCommercesQuery innerJoinHeadingsCommerce($relationAlias = null) Adds a INNER JOIN clause to the query using the HeadingsCommerce relation
 *
 * @method     ChildCommercesQuery leftJoinProvinces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Provinces relation
 * @method     ChildCommercesQuery rightJoinProvinces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Provinces relation
 * @method     ChildCommercesQuery innerJoinProvinces($relationAlias = null) Adds a INNER JOIN clause to the query using the Provinces relation
 *
 * @method     ChildCommercesQuery leftJoinProvincesLocalities($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProvincesLocalities relation
 * @method     ChildCommercesQuery rightJoinProvincesLocalities($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProvincesLocalities relation
 * @method     ChildCommercesQuery innerJoinProvincesLocalities($relationAlias = null) Adds a INNER JOIN clause to the query using the ProvincesLocalities relation
 *
 * @method     ChildCommercesQuery leftJoinCommercesBranchOffices($relationAlias = null) Adds a LEFT JOIN clause to the query using the CommercesBranchOffices relation
 * @method     ChildCommercesQuery rightJoinCommercesBranchOffices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CommercesBranchOffices relation
 * @method     ChildCommercesQuery innerJoinCommercesBranchOffices($relationAlias = null) Adds a INNER JOIN clause to the query using the CommercesBranchOffices relation
 *
 * @method     ChildCommercesQuery leftJoinCommercesPreferences($relationAlias = null) Adds a LEFT JOIN clause to the query using the CommercesPreferences relation
 * @method     ChildCommercesQuery rightJoinCommercesPreferences($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CommercesPreferences relation
 * @method     ChildCommercesQuery innerJoinCommercesPreferences($relationAlias = null) Adds a INNER JOIN clause to the query using the CommercesPreferences relation
 *
 * @method     ChildCommercesQuery leftJoinCommercesRates($relationAlias = null) Adds a LEFT JOIN clause to the query using the CommercesRates relation
 * @method     ChildCommercesQuery rightJoinCommercesRates($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CommercesRates relation
 * @method     ChildCommercesQuery innerJoinCommercesRates($relationAlias = null) Adds a INNER JOIN clause to the query using the CommercesRates relation
 *
 * @method     ChildCommercesQuery leftJoinCommercesReminders($relationAlias = null) Adds a LEFT JOIN clause to the query using the CommercesReminders relation
 * @method     ChildCommercesQuery rightJoinCommercesReminders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CommercesReminders relation
 * @method     ChildCommercesQuery innerJoinCommercesReminders($relationAlias = null) Adds a INNER JOIN clause to the query using the CommercesReminders relation
 *
 * @method     \PositionsCommerceQuery|\HeadingsCommerceQuery|\ProvincesQuery|\ProvincesLocalitiesQuery|\CommercesBranchOfficesQuery|\CommercesPreferencesQuery|\CommercesRatesQuery|\CommercesRemindersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCommerces findOne(ConnectionInterface $con = null) Return the first ChildCommerces matching the query
 * @method     ChildCommerces findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCommerces matching the query, or a new ChildCommerces object populated from the query conditions when no match is found
 *
 * @method     ChildCommerces findOneById(int $id) Return the first ChildCommerces filtered by the id column
 * @method     ChildCommerces findOneByIdUser(int $id_user) Return the first ChildCommerces filtered by the id_user column
 * @method     ChildCommerces findOneByIdPositionCommerce(int $id_position_commerce) Return the first ChildCommerces filtered by the id_position_commerce column
 * @method     ChildCommerces findOneByIdHeadingCommerce(int $id_heading_commerce) Return the first ChildCommerces filtered by the id_heading_commerce column
 * @method     ChildCommerces findOneByIdProvince(int $id_province) Return the first ChildCommerces filtered by the id_province column
 * @method     ChildCommerces findOneByIdLocality(int $id_locality) Return the first ChildCommerces filtered by the id_locality column
 * @method     ChildCommerces findOneByToken(string $token) Return the first ChildCommerces filtered by the token column
 * @method     ChildCommerces findOneByLogo(string $logo) Return the first ChildCommerces filtered by the logo column
 * @method     ChildCommerces findOneByBusinessName(string $business_name) Return the first ChildCommerces filtered by the business_name column
 * @method     ChildCommerces findOneByCuitCuil(string $cuit_cuil) Return the first ChildCommerces filtered by the cuit_cuil column
 * @method     ChildCommerces findOneByName(string $name) Return the first ChildCommerces filtered by the name column
 * @method     ChildCommerces findOneByPhone(string $phone) Return the first ChildCommerces filtered by the phone column
 * @method     ChildCommerces findOneByPhonePersonal(string $phone_personal) Return the first ChildCommerces filtered by the phone_personal column
 * @method     ChildCommerces findOneByEmail(string $email) Return the first ChildCommerces filtered by the email column
 * @method     ChildCommerces findOneByPassword(string $password) Return the first ChildCommerces filtered by the password column
 * @method     ChildCommerces findOneByAddress(string $address) Return the first ChildCommerces filtered by the address column
 * @method     ChildCommerces findOneByAddressLat(string $address_lat) Return the first ChildCommerces filtered by the address_lat column
 * @method     ChildCommerces findOneByAddressLng(string $address_lng) Return the first ChildCommerces filtered by the address_lng column
 * @method     ChildCommerces findOneByAddressLocality(string $address_locality) Return the first ChildCommerces filtered by the address_locality column
 * @method     ChildCommerces findOneByAddressRegion(string $address_region) Return the first ChildCommerces filtered by the address_region column
 * @method     ChildCommerces findOneByAddressCountry(string $address_country) Return the first ChildCommerces filtered by the address_country column
 * @method     ChildCommerces findOneByUpdatedAt(string $updated_at) Return the first ChildCommerces filtered by the updated_at column *

 * @method     ChildCommerces requirePk($key, ConnectionInterface $con = null) Return the ChildCommerces by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOne(ConnectionInterface $con = null) Return the first ChildCommerces matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommerces requireOneById(int $id) Return the first ChildCommerces filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByIdUser(int $id_user) Return the first ChildCommerces filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByIdPositionCommerce(int $id_position_commerce) Return the first ChildCommerces filtered by the id_position_commerce column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByIdHeadingCommerce(int $id_heading_commerce) Return the first ChildCommerces filtered by the id_heading_commerce column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByIdProvince(int $id_province) Return the first ChildCommerces filtered by the id_province column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByIdLocality(int $id_locality) Return the first ChildCommerces filtered by the id_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByToken(string $token) Return the first ChildCommerces filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByLogo(string $logo) Return the first ChildCommerces filtered by the logo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByBusinessName(string $business_name) Return the first ChildCommerces filtered by the business_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByCuitCuil(string $cuit_cuil) Return the first ChildCommerces filtered by the cuit_cuil column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByName(string $name) Return the first ChildCommerces filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByPhone(string $phone) Return the first ChildCommerces filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByPhonePersonal(string $phone_personal) Return the first ChildCommerces filtered by the phone_personal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByEmail(string $email) Return the first ChildCommerces filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByPassword(string $password) Return the first ChildCommerces filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByAddress(string $address) Return the first ChildCommerces filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByAddressLat(string $address_lat) Return the first ChildCommerces filtered by the address_lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByAddressLng(string $address_lng) Return the first ChildCommerces filtered by the address_lng column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByAddressLocality(string $address_locality) Return the first ChildCommerces filtered by the address_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByAddressRegion(string $address_region) Return the first ChildCommerces filtered by the address_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByAddressCountry(string $address_country) Return the first ChildCommerces filtered by the address_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommerces requireOneByUpdatedAt(string $updated_at) Return the first ChildCommerces filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommerces[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCommerces objects based on current ModelCriteria
 * @method     ChildCommerces[]|ObjectCollection findById(int $id) Return ChildCommerces objects filtered by the id column
 * @method     ChildCommerces[]|ObjectCollection findByIdUser(int $id_user) Return ChildCommerces objects filtered by the id_user column
 * @method     ChildCommerces[]|ObjectCollection findByIdPositionCommerce(int $id_position_commerce) Return ChildCommerces objects filtered by the id_position_commerce column
 * @method     ChildCommerces[]|ObjectCollection findByIdHeadingCommerce(int $id_heading_commerce) Return ChildCommerces objects filtered by the id_heading_commerce column
 * @method     ChildCommerces[]|ObjectCollection findByIdProvince(int $id_province) Return ChildCommerces objects filtered by the id_province column
 * @method     ChildCommerces[]|ObjectCollection findByIdLocality(int $id_locality) Return ChildCommerces objects filtered by the id_locality column
 * @method     ChildCommerces[]|ObjectCollection findByToken(string $token) Return ChildCommerces objects filtered by the token column
 * @method     ChildCommerces[]|ObjectCollection findByLogo(string $logo) Return ChildCommerces objects filtered by the logo column
 * @method     ChildCommerces[]|ObjectCollection findByBusinessName(string $business_name) Return ChildCommerces objects filtered by the business_name column
 * @method     ChildCommerces[]|ObjectCollection findByCuitCuil(string $cuit_cuil) Return ChildCommerces objects filtered by the cuit_cuil column
 * @method     ChildCommerces[]|ObjectCollection findByName(string $name) Return ChildCommerces objects filtered by the name column
 * @method     ChildCommerces[]|ObjectCollection findByPhone(string $phone) Return ChildCommerces objects filtered by the phone column
 * @method     ChildCommerces[]|ObjectCollection findByPhonePersonal(string $phone_personal) Return ChildCommerces objects filtered by the phone_personal column
 * @method     ChildCommerces[]|ObjectCollection findByEmail(string $email) Return ChildCommerces objects filtered by the email column
 * @method     ChildCommerces[]|ObjectCollection findByPassword(string $password) Return ChildCommerces objects filtered by the password column
 * @method     ChildCommerces[]|ObjectCollection findByAddress(string $address) Return ChildCommerces objects filtered by the address column
 * @method     ChildCommerces[]|ObjectCollection findByAddressLat(string $address_lat) Return ChildCommerces objects filtered by the address_lat column
 * @method     ChildCommerces[]|ObjectCollection findByAddressLng(string $address_lng) Return ChildCommerces objects filtered by the address_lng column
 * @method     ChildCommerces[]|ObjectCollection findByAddressLocality(string $address_locality) Return ChildCommerces objects filtered by the address_locality column
 * @method     ChildCommerces[]|ObjectCollection findByAddressRegion(string $address_region) Return ChildCommerces objects filtered by the address_region column
 * @method     ChildCommerces[]|ObjectCollection findByAddressCountry(string $address_country) Return ChildCommerces objects filtered by the address_country column
 * @method     ChildCommerces[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCommerces objects filtered by the updated_at column
 * @method     ChildCommerces[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommercesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CommercesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Commerces', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommercesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommercesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCommercesQuery) {
            return $criteria;
        }
        $query = new ChildCommercesQuery();
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
     * @return ChildCommerces|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommercesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommercesTableMap::DATABASE_NAME);
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
     * @return ChildCommerces A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_position_commerce`, `id_heading_commerce`, `id_province`, `id_locality`, `token`, `logo`, `business_name`, `cuit_cuil`, `name`, `phone`, `phone_personal`, `email`, `password`, `address`, `address_lat`, `address_lng`, `address_locality`, `address_region`, `address_country`, `updated_at` FROM `commerces` WHERE `id` = :p0';
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
            /** @var ChildCommerces $obj */
            $obj = new ChildCommerces();
            $obj->hydrate($row);
            CommercesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCommerces|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommercesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommercesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_position_commerce column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPositionCommerce(1234); // WHERE id_position_commerce = 1234
     * $query->filterByIdPositionCommerce(array(12, 34)); // WHERE id_position_commerce IN (12, 34)
     * $query->filterByIdPositionCommerce(array('min' => 12)); // WHERE id_position_commerce > 12
     * </code>
     *
     * @see       filterByPositionsCommerce()
     *
     * @param     mixed $idPositionCommerce The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByIdPositionCommerce($idPositionCommerce = null, $comparison = null)
    {
        if (is_array($idPositionCommerce)) {
            $useMinMax = false;
            if (isset($idPositionCommerce['min'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_POSITION_COMMERCE, $idPositionCommerce['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPositionCommerce['max'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_POSITION_COMMERCE, $idPositionCommerce['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ID_POSITION_COMMERCE, $idPositionCommerce, $comparison);
    }

    /**
     * Filter the query on the id_heading_commerce column
     *
     * Example usage:
     * <code>
     * $query->filterByIdHeadingCommerce(1234); // WHERE id_heading_commerce = 1234
     * $query->filterByIdHeadingCommerce(array(12, 34)); // WHERE id_heading_commerce IN (12, 34)
     * $query->filterByIdHeadingCommerce(array('min' => 12)); // WHERE id_heading_commerce > 12
     * </code>
     *
     * @see       filterByHeadingsCommerce()
     *
     * @param     mixed $idHeadingCommerce The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByIdHeadingCommerce($idHeadingCommerce = null, $comparison = null)
    {
        if (is_array($idHeadingCommerce)) {
            $useMinMax = false;
            if (isset($idHeadingCommerce['min'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_HEADING_COMMERCE, $idHeadingCommerce['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idHeadingCommerce['max'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_HEADING_COMMERCE, $idHeadingCommerce['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ID_HEADING_COMMERCE, $idHeadingCommerce, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByIdProvince($idProvince = null, $comparison = null)
    {
        if (is_array($idProvince)) {
            $useMinMax = false;
            if (isset($idProvince['min'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_PROVINCE, $idProvince['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProvince['max'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_PROVINCE, $idProvince['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ID_PROVINCE, $idProvince, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByIdLocality($idLocality = null, $comparison = null)
    {
        if (is_array($idLocality)) {
            $useMinMax = false;
            if (isset($idLocality['min'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_LOCALITY, $idLocality['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idLocality['max'])) {
                $this->addUsingAlias(CommercesTableMap::COL_ID_LOCALITY, $idLocality['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ID_LOCALITY, $idLocality, $comparison);
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%'); // WHERE token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $token The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByToken($token = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $token)) {
                $token = str_replace('*', '%', $token);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_TOKEN, $token, $comparison);
    }

    /**
     * Filter the query on the logo column
     *
     * Example usage:
     * <code>
     * $query->filterByLogo('fooValue');   // WHERE logo = 'fooValue'
     * $query->filterByLogo('%fooValue%'); // WHERE logo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $logo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByLogo($logo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $logo)) {
                $logo = str_replace('*', '%', $logo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_LOGO, $logo, $comparison);
    }

    /**
     * Filter the query on the business_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBusinessName('fooValue');   // WHERE business_name = 'fooValue'
     * $query->filterByBusinessName('%fooValue%'); // WHERE business_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $businessName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByBusinessName($businessName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($businessName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $businessName)) {
                $businessName = str_replace('*', '%', $businessName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_BUSINESS_NAME, $businessName, $comparison);
    }

    /**
     * Filter the query on the cuit_cuil column
     *
     * Example usage:
     * <code>
     * $query->filterByCuitCuil('fooValue');   // WHERE cuit_cuil = 'fooValue'
     * $query->filterByCuitCuil('%fooValue%'); // WHERE cuit_cuil LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuitCuil The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByCuitCuil($cuitCuil = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuitCuil)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuitCuil)) {
                $cuitCuil = str_replace('*', '%', $cuitCuil);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_CUIT_CUIL, $cuitCuil, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CommercesTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CommercesTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the phone_personal column
     *
     * Example usage:
     * <code>
     * $query->filterByPhonePersonal('fooValue');   // WHERE phone_personal = 'fooValue'
     * $query->filterByPhonePersonal('%fooValue%'); // WHERE phone_personal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phonePersonal The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByPhonePersonal($phonePersonal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phonePersonal)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phonePersonal)) {
                $phonePersonal = str_replace('*', '%', $phonePersonal);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_PHONE_PERSONAL, $phonePersonal, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CommercesTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_PASSWORD, $password, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CommercesTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the address_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressLat('fooValue');   // WHERE address_lat = 'fooValue'
     * $query->filterByAddressLat('%fooValue%'); // WHERE address_lat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressLat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByAddressLat($addressLat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressLat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressLat)) {
                $addressLat = str_replace('*', '%', $addressLat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ADDRESS_LAT, $addressLat, $comparison);
    }

    /**
     * Filter the query on the address_lng column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressLng('fooValue');   // WHERE address_lng = 'fooValue'
     * $query->filterByAddressLng('%fooValue%'); // WHERE address_lng LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressLng The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByAddressLng($addressLng = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressLng)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressLng)) {
                $addressLng = str_replace('*', '%', $addressLng);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ADDRESS_LNG, $addressLng, $comparison);
    }

    /**
     * Filter the query on the address_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressLocality('fooValue');   // WHERE address_locality = 'fooValue'
     * $query->filterByAddressLocality('%fooValue%'); // WHERE address_locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressLocality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByAddressLocality($addressLocality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressLocality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressLocality)) {
                $addressLocality = str_replace('*', '%', $addressLocality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ADDRESS_LOCALITY, $addressLocality, $comparison);
    }

    /**
     * Filter the query on the address_region column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressRegion('fooValue');   // WHERE address_region = 'fooValue'
     * $query->filterByAddressRegion('%fooValue%'); // WHERE address_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByAddressRegion($addressRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressRegion)) {
                $addressRegion = str_replace('*', '%', $addressRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ADDRESS_REGION, $addressRegion, $comparison);
    }

    /**
     * Filter the query on the address_country column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressCountry('fooValue');   // WHERE address_country = 'fooValue'
     * $query->filterByAddressCountry('%fooValue%'); // WHERE address_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByAddressCountry($addressCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressCountry)) {
                $addressCountry = str_replace('*', '%', $addressCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_ADDRESS_COUNTRY, $addressCountry, $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CommercesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CommercesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \PositionsCommerce object
     *
     * @param \PositionsCommerce|ObjectCollection $positionsCommerce The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByPositionsCommerce($positionsCommerce, $comparison = null)
    {
        if ($positionsCommerce instanceof \PositionsCommerce) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_POSITION_COMMERCE, $positionsCommerce->getId(), $comparison);
        } elseif ($positionsCommerce instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_POSITION_COMMERCE, $positionsCommerce->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPositionsCommerce() only accepts arguments of type \PositionsCommerce or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsCommerce relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function joinPositionsCommerce($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsCommerce');

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
            $this->addJoinObject($join, 'PositionsCommerce');
        }

        return $this;
    }

    /**
     * Use the PositionsCommerce relation PositionsCommerce object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PositionsCommerceQuery A secondary query class using the current class as primary query
     */
    public function usePositionsCommerceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsCommerce($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsCommerce', '\PositionsCommerceQuery');
    }

    /**
     * Filter the query by a related \HeadingsCommerce object
     *
     * @param \HeadingsCommerce|ObjectCollection $headingsCommerce The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByHeadingsCommerce($headingsCommerce, $comparison = null)
    {
        if ($headingsCommerce instanceof \HeadingsCommerce) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_HEADING_COMMERCE, $headingsCommerce->getId(), $comparison);
        } elseif ($headingsCommerce instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_HEADING_COMMERCE, $headingsCommerce->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByHeadingsCommerce() only accepts arguments of type \HeadingsCommerce or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HeadingsCommerce relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function joinHeadingsCommerce($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HeadingsCommerce');

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
            $this->addJoinObject($join, 'HeadingsCommerce');
        }

        return $this;
    }

    /**
     * Use the HeadingsCommerce relation HeadingsCommerce object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \HeadingsCommerceQuery A secondary query class using the current class as primary query
     */
    public function useHeadingsCommerceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHeadingsCommerce($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HeadingsCommerce', '\HeadingsCommerceQuery');
    }

    /**
     * Filter the query by a related \Provinces object
     *
     * @param \Provinces|ObjectCollection $provinces The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByProvinces($provinces, $comparison = null)
    {
        if ($provinces instanceof \Provinces) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_PROVINCE, $provinces->getId(), $comparison);
        } elseif ($provinces instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_PROVINCE, $provinces->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
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
     * Filter the query by a related \ProvincesLocalities object
     *
     * @param \ProvincesLocalities|ObjectCollection $provincesLocalities The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByProvincesLocalities($provincesLocalities, $comparison = null)
    {
        if ($provincesLocalities instanceof \ProvincesLocalities) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_LOCALITY, $provincesLocalities->getId(), $comparison);
        } elseif ($provincesLocalities instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID_LOCALITY, $provincesLocalities->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCommercesQuery The current query, for fluid interface
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
     * Filter the query by a related \CommercesBranchOffices object
     *
     * @param \CommercesBranchOffices|ObjectCollection $commercesBranchOffices the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByCommercesBranchOffices($commercesBranchOffices, $comparison = null)
    {
        if ($commercesBranchOffices instanceof \CommercesBranchOffices) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID, $commercesBranchOffices->getIdCommerce(), $comparison);
        } elseif ($commercesBranchOffices instanceof ObjectCollection) {
            return $this
                ->useCommercesBranchOfficesQuery()
                ->filterByPrimaryKeys($commercesBranchOffices->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCommercesBranchOffices() only accepts arguments of type \CommercesBranchOffices or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CommercesBranchOffices relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function joinCommercesBranchOffices($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CommercesBranchOffices');

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
            $this->addJoinObject($join, 'CommercesBranchOffices');
        }

        return $this;
    }

    /**
     * Use the CommercesBranchOffices relation CommercesBranchOffices object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CommercesBranchOfficesQuery A secondary query class using the current class as primary query
     */
    public function useCommercesBranchOfficesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCommercesBranchOffices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CommercesBranchOffices', '\CommercesBranchOfficesQuery');
    }

    /**
     * Filter the query by a related \CommercesPreferences object
     *
     * @param \CommercesPreferences|ObjectCollection $commercesPreferences the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByCommercesPreferences($commercesPreferences, $comparison = null)
    {
        if ($commercesPreferences instanceof \CommercesPreferences) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID, $commercesPreferences->getIdCommerce(), $comparison);
        } elseif ($commercesPreferences instanceof ObjectCollection) {
            return $this
                ->useCommercesPreferencesQuery()
                ->filterByPrimaryKeys($commercesPreferences->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCommercesPreferences() only accepts arguments of type \CommercesPreferences or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CommercesPreferences relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function joinCommercesPreferences($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CommercesPreferences');

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
            $this->addJoinObject($join, 'CommercesPreferences');
        }

        return $this;
    }

    /**
     * Use the CommercesPreferences relation CommercesPreferences object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CommercesPreferencesQuery A secondary query class using the current class as primary query
     */
    public function useCommercesPreferencesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCommercesPreferences($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CommercesPreferences', '\CommercesPreferencesQuery');
    }

    /**
     * Filter the query by a related \CommercesRates object
     *
     * @param \CommercesRates|ObjectCollection $commercesRates the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByCommercesRates($commercesRates, $comparison = null)
    {
        if ($commercesRates instanceof \CommercesRates) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID, $commercesRates->getIdCommerce(), $comparison);
        } elseif ($commercesRates instanceof ObjectCollection) {
            return $this
                ->useCommercesRatesQuery()
                ->filterByPrimaryKeys($commercesRates->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCommercesRates() only accepts arguments of type \CommercesRates or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CommercesRates relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function joinCommercesRates($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CommercesRates');

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
            $this->addJoinObject($join, 'CommercesRates');
        }

        return $this;
    }

    /**
     * Use the CommercesRates relation CommercesRates object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CommercesRatesQuery A secondary query class using the current class as primary query
     */
    public function useCommercesRatesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCommercesRates($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CommercesRates', '\CommercesRatesQuery');
    }

    /**
     * Filter the query by a related \CommercesReminders object
     *
     * @param \CommercesReminders|ObjectCollection $commercesReminders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommercesQuery The current query, for fluid interface
     */
    public function filterByCommercesReminders($commercesReminders, $comparison = null)
    {
        if ($commercesReminders instanceof \CommercesReminders) {
            return $this
                ->addUsingAlias(CommercesTableMap::COL_ID, $commercesReminders->getIdCommerce(), $comparison);
        } elseif ($commercesReminders instanceof ObjectCollection) {
            return $this
                ->useCommercesRemindersQuery()
                ->filterByPrimaryKeys($commercesReminders->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCommercesReminders() only accepts arguments of type \CommercesReminders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CommercesReminders relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function joinCommercesReminders($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CommercesReminders');

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
            $this->addJoinObject($join, 'CommercesReminders');
        }

        return $this;
    }

    /**
     * Use the CommercesReminders relation CommercesReminders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CommercesRemindersQuery A secondary query class using the current class as primary query
     */
    public function useCommercesRemindersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCommercesReminders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CommercesReminders', '\CommercesRemindersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCommerces $commerces Object to remove from the list of results
     *
     * @return $this|ChildCommercesQuery The current query, for fluid interface
     */
    public function prune($commerces = null)
    {
        if ($commerces) {
            $this->addUsingAlias(CommercesTableMap::COL_ID, $commerces->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the commerces table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommercesTableMap::clearInstancePool();
            CommercesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommercesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CommercesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommercesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CommercesQuery
