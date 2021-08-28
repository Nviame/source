<?php

namespace Base;

use \Companies as ChildCompanies;
use \CompaniesQuery as ChildCompaniesQuery;
use \Exception;
use \PDO;
use Map\CompaniesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'companies' table.
 *
 *
 *
 * @method     ChildCompaniesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCompaniesQuery orderByIdCompanyContractDuration($order = Criteria::ASC) Order by the id_company_contract_duration column
 * @method     ChildCompaniesQuery orderByCuit($order = Criteria::ASC) Order by the cuit column
 * @method     ChildCompaniesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCompaniesQuery orderByRateBasePrice($order = Criteria::ASC) Order by the rate_base_price column
 * @method     ChildCompaniesQuery orderByRatePriceKm($order = Criteria::ASC) Order by the rate_price_km column
 * @method     ChildCompaniesQuery orderByRatePercentNightSchedule($order = Criteria::ASC) Order by the rate_percent_night_schedule column
 * @method     ChildCompaniesQuery orderByRatePercentNonBusinessDay($order = Criteria::ASC) Order by the rate_percent_non_business_day column
 * @method     ChildCompaniesQuery orderByPercentCommission($order = Criteria::ASC) Order by the percent_commission column
 * @method     ChildCompaniesQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildCompaniesQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildCompaniesQuery orderByEmail($order = Criteria::ASC) Order by the email column
 *
 * @method     ChildCompaniesQuery groupById() Group by the id column
 * @method     ChildCompaniesQuery groupByIdCompanyContractDuration() Group by the id_company_contract_duration column
 * @method     ChildCompaniesQuery groupByCuit() Group by the cuit column
 * @method     ChildCompaniesQuery groupByName() Group by the name column
 * @method     ChildCompaniesQuery groupByRateBasePrice() Group by the rate_base_price column
 * @method     ChildCompaniesQuery groupByRatePriceKm() Group by the rate_price_km column
 * @method     ChildCompaniesQuery groupByRatePercentNightSchedule() Group by the rate_percent_night_schedule column
 * @method     ChildCompaniesQuery groupByRatePercentNonBusinessDay() Group by the rate_percent_non_business_day column
 * @method     ChildCompaniesQuery groupByPercentCommission() Group by the percent_commission column
 * @method     ChildCompaniesQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildCompaniesQuery groupByPhone() Group by the phone column
 * @method     ChildCompaniesQuery groupByEmail() Group by the email column
 *
 * @method     ChildCompaniesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCompaniesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCompaniesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCompanies findOne(ConnectionInterface $con = null) Return the first ChildCompanies matching the query
 * @method     ChildCompanies findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCompanies matching the query, or a new ChildCompanies object populated from the query conditions when no match is found
 *
 * @method     ChildCompanies findOneById(int $id) Return the first ChildCompanies filtered by the id column
 * @method     ChildCompanies findOneByIdCompanyContractDuration(int $id_company_contract_duration) Return the first ChildCompanies filtered by the id_company_contract_duration column
 * @method     ChildCompanies findOneByCuit(string $cuit) Return the first ChildCompanies filtered by the cuit column
 * @method     ChildCompanies findOneByName(string $name) Return the first ChildCompanies filtered by the name column
 * @method     ChildCompanies findOneByRateBasePrice(double $rate_base_price) Return the first ChildCompanies filtered by the rate_base_price column
 * @method     ChildCompanies findOneByRatePriceKm(double $rate_price_km) Return the first ChildCompanies filtered by the rate_price_km column
 * @method     ChildCompanies findOneByRatePercentNightSchedule(double $rate_percent_night_schedule) Return the first ChildCompanies filtered by the rate_percent_night_schedule column
 * @method     ChildCompanies findOneByRatePercentNonBusinessDay(double $rate_percent_non_business_day) Return the first ChildCompanies filtered by the rate_percent_non_business_day column
 * @method     ChildCompanies findOneByPercentCommission(int $percent_commission) Return the first ChildCompanies filtered by the percent_commission column
 * @method     ChildCompanies findOneByRegisteredAt(string $registered_at) Return the first ChildCompanies filtered by the registered_at column
 * @method     ChildCompanies findOneByPhone(string $phone) Return the first ChildCompanies filtered by the phone column
 * @method     ChildCompanies findOneByEmail(string $email) Return the first ChildCompanies filtered by the email column *

 * @method     ChildCompanies requirePk($key, ConnectionInterface $con = null) Return the ChildCompanies by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOne(ConnectionInterface $con = null) Return the first ChildCompanies matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompanies requireOneById(int $id) Return the first ChildCompanies filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByIdCompanyContractDuration(int $id_company_contract_duration) Return the first ChildCompanies filtered by the id_company_contract_duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByCuit(string $cuit) Return the first ChildCompanies filtered by the cuit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByName(string $name) Return the first ChildCompanies filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByRateBasePrice(double $rate_base_price) Return the first ChildCompanies filtered by the rate_base_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByRatePriceKm(double $rate_price_km) Return the first ChildCompanies filtered by the rate_price_km column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByRatePercentNightSchedule(double $rate_percent_night_schedule) Return the first ChildCompanies filtered by the rate_percent_night_schedule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByRatePercentNonBusinessDay(double $rate_percent_non_business_day) Return the first ChildCompanies filtered by the rate_percent_non_business_day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByPercentCommission(int $percent_commission) Return the first ChildCompanies filtered by the percent_commission column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByRegisteredAt(string $registered_at) Return the first ChildCompanies filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByPhone(string $phone) Return the first ChildCompanies filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompanies requireOneByEmail(string $email) Return the first ChildCompanies filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompanies[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCompanies objects based on current ModelCriteria
 * @method     ChildCompanies[]|ObjectCollection findById(int $id) Return ChildCompanies objects filtered by the id column
 * @method     ChildCompanies[]|ObjectCollection findByIdCompanyContractDuration(int $id_company_contract_duration) Return ChildCompanies objects filtered by the id_company_contract_duration column
 * @method     ChildCompanies[]|ObjectCollection findByCuit(string $cuit) Return ChildCompanies objects filtered by the cuit column
 * @method     ChildCompanies[]|ObjectCollection findByName(string $name) Return ChildCompanies objects filtered by the name column
 * @method     ChildCompanies[]|ObjectCollection findByRateBasePrice(double $rate_base_price) Return ChildCompanies objects filtered by the rate_base_price column
 * @method     ChildCompanies[]|ObjectCollection findByRatePriceKm(double $rate_price_km) Return ChildCompanies objects filtered by the rate_price_km column
 * @method     ChildCompanies[]|ObjectCollection findByRatePercentNightSchedule(double $rate_percent_night_schedule) Return ChildCompanies objects filtered by the rate_percent_night_schedule column
 * @method     ChildCompanies[]|ObjectCollection findByRatePercentNonBusinessDay(double $rate_percent_non_business_day) Return ChildCompanies objects filtered by the rate_percent_non_business_day column
 * @method     ChildCompanies[]|ObjectCollection findByPercentCommission(int $percent_commission) Return ChildCompanies objects filtered by the percent_commission column
 * @method     ChildCompanies[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildCompanies objects filtered by the registered_at column
 * @method     ChildCompanies[]|ObjectCollection findByPhone(string $phone) Return ChildCompanies objects filtered by the phone column
 * @method     ChildCompanies[]|ObjectCollection findByEmail(string $email) Return ChildCompanies objects filtered by the email column
 * @method     ChildCompanies[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CompaniesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CompaniesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Companies', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCompaniesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCompaniesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCompaniesQuery) {
            return $criteria;
        }
        $query = new ChildCompaniesQuery();
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
     * @return ChildCompanies|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CompaniesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CompaniesTableMap::DATABASE_NAME);
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
     * @return ChildCompanies A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_company_contract_duration`, `cuit`, `name`, `rate_base_price`, `rate_price_km`, `rate_percent_night_schedule`, `rate_percent_non_business_day`, `percent_commission`, `registered_at`, `phone`, `email` FROM `companies` WHERE `id` = :p0';
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
            /** @var ChildCompanies $obj */
            $obj = new ChildCompanies();
            $obj->hydrate($row);
            CompaniesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCompanies|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CompaniesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CompaniesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_company_contract_duration column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCompanyContractDuration(1234); // WHERE id_company_contract_duration = 1234
     * $query->filterByIdCompanyContractDuration(array(12, 34)); // WHERE id_company_contract_duration IN (12, 34)
     * $query->filterByIdCompanyContractDuration(array('min' => 12)); // WHERE id_company_contract_duration > 12
     * </code>
     *
     * @param     mixed $idCompanyContractDuration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByIdCompanyContractDuration($idCompanyContractDuration = null, $comparison = null)
    {
        if (is_array($idCompanyContractDuration)) {
            $useMinMax = false;
            if (isset($idCompanyContractDuration['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_ID_COMPANY_CONTRACT_DURATION, $idCompanyContractDuration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCompanyContractDuration['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_ID_COMPANY_CONTRACT_DURATION, $idCompanyContractDuration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_ID_COMPANY_CONTRACT_DURATION, $idCompanyContractDuration, $comparison);
    }

    /**
     * Filter the query on the cuit column
     *
     * Example usage:
     * <code>
     * $query->filterByCuit('fooValue');   // WHERE cuit = 'fooValue'
     * $query->filterByCuit('%fooValue%'); // WHERE cuit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByCuit($cuit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuit)) {
                $cuit = str_replace('*', '%', $cuit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_CUIT, $cuit, $comparison);
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
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CompaniesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the rate_base_price column
     *
     * Example usage:
     * <code>
     * $query->filterByRateBasePrice(1234); // WHERE rate_base_price = 1234
     * $query->filterByRateBasePrice(array(12, 34)); // WHERE rate_base_price IN (12, 34)
     * $query->filterByRateBasePrice(array('min' => 12)); // WHERE rate_base_price > 12
     * </code>
     *
     * @param     mixed $rateBasePrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByRateBasePrice($rateBasePrice = null, $comparison = null)
    {
        if (is_array($rateBasePrice)) {
            $useMinMax = false;
            if (isset($rateBasePrice['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_BASE_PRICE, $rateBasePrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rateBasePrice['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_BASE_PRICE, $rateBasePrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_RATE_BASE_PRICE, $rateBasePrice, $comparison);
    }

    /**
     * Filter the query on the rate_price_km column
     *
     * Example usage:
     * <code>
     * $query->filterByRatePriceKm(1234); // WHERE rate_price_km = 1234
     * $query->filterByRatePriceKm(array(12, 34)); // WHERE rate_price_km IN (12, 34)
     * $query->filterByRatePriceKm(array('min' => 12)); // WHERE rate_price_km > 12
     * </code>
     *
     * @param     mixed $ratePriceKm The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByRatePriceKm($ratePriceKm = null, $comparison = null)
    {
        if (is_array($ratePriceKm)) {
            $useMinMax = false;
            if (isset($ratePriceKm['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_PRICE_KM, $ratePriceKm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratePriceKm['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_PRICE_KM, $ratePriceKm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_RATE_PRICE_KM, $ratePriceKm, $comparison);
    }

    /**
     * Filter the query on the rate_percent_night_schedule column
     *
     * Example usage:
     * <code>
     * $query->filterByRatePercentNightSchedule(1234); // WHERE rate_percent_night_schedule = 1234
     * $query->filterByRatePercentNightSchedule(array(12, 34)); // WHERE rate_percent_night_schedule IN (12, 34)
     * $query->filterByRatePercentNightSchedule(array('min' => 12)); // WHERE rate_percent_night_schedule > 12
     * </code>
     *
     * @param     mixed $ratePercentNightSchedule The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByRatePercentNightSchedule($ratePercentNightSchedule = null, $comparison = null)
    {
        if (is_array($ratePercentNightSchedule)) {
            $useMinMax = false;
            if (isset($ratePercentNightSchedule['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, $ratePercentNightSchedule['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratePercentNightSchedule['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, $ratePercentNightSchedule['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, $ratePercentNightSchedule, $comparison);
    }

    /**
     * Filter the query on the rate_percent_non_business_day column
     *
     * Example usage:
     * <code>
     * $query->filterByRatePercentNonBusinessDay(1234); // WHERE rate_percent_non_business_day = 1234
     * $query->filterByRatePercentNonBusinessDay(array(12, 34)); // WHERE rate_percent_non_business_day IN (12, 34)
     * $query->filterByRatePercentNonBusinessDay(array('min' => 12)); // WHERE rate_percent_non_business_day > 12
     * </code>
     *
     * @param     mixed $ratePercentNonBusinessDay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByRatePercentNonBusinessDay($ratePercentNonBusinessDay = null, $comparison = null)
    {
        if (is_array($ratePercentNonBusinessDay)) {
            $useMinMax = false;
            if (isset($ratePercentNonBusinessDay['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, $ratePercentNonBusinessDay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratePercentNonBusinessDay['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, $ratePercentNonBusinessDay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, $ratePercentNonBusinessDay, $comparison);
    }

    /**
     * Filter the query on the percent_commission column
     *
     * Example usage:
     * <code>
     * $query->filterByPercentCommission(1234); // WHERE percent_commission = 1234
     * $query->filterByPercentCommission(array(12, 34)); // WHERE percent_commission IN (12, 34)
     * $query->filterByPercentCommission(array('min' => 12)); // WHERE percent_commission > 12
     * </code>
     *
     * @param     mixed $percentCommission The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByPercentCommission($percentCommission = null, $comparison = null)
    {
        if (is_array($percentCommission)) {
            $useMinMax = false;
            if (isset($percentCommission['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_PERCENT_COMMISSION, $percentCommission['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($percentCommission['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_PERCENT_COMMISSION, $percentCommission['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_PERCENT_COMMISSION, $percentCommission, $comparison);
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
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(CompaniesTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompaniesTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
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
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CompaniesTableMap::COL_PHONE, $phone, $comparison);
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
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CompaniesTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCompanies $companies Object to remove from the list of results
     *
     * @return $this|ChildCompaniesQuery The current query, for fluid interface
     */
    public function prune($companies = null)
    {
        if ($companies) {
            $this->addUsingAlias(CompaniesTableMap::COL_ID, $companies->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the companies table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompaniesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CompaniesTableMap::clearInstancePool();
            CompaniesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CompaniesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CompaniesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CompaniesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CompaniesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CompaniesQuery
