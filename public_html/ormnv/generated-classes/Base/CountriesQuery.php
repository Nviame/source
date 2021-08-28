<?php

namespace Base;

use \Countries as ChildCountries;
use \CountriesQuery as ChildCountriesQuery;
use \Exception;
use \PDO;
use Map\CountriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'countries' table.
 *
 *
 *
 * @method     ChildCountriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCountriesQuery orderByIso($order = Criteria::ASC) Order by the iso column
 * @method     ChildCountriesQuery orderByIso2($order = Criteria::ASC) Order by the iso2 column
 * @method     ChildCountriesQuery orderByIso3($order = Criteria::ASC) Order by the iso3 column
 * @method     ChildCountriesQuery orderByPrefix($order = Criteria::ASC) Order by the prefix column
 * @method     ChildCountriesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCountriesQuery orderByContinent($order = Criteria::ASC) Order by the continent column
 * @method     ChildCountriesQuery orderBySubcontinent($order = Criteria::ASC) Order by the subcontinent column
 * @method     ChildCountriesQuery orderByCurrencyIso($order = Criteria::ASC) Order by the currency_iso column
 * @method     ChildCountriesQuery orderByCurrencyName($order = Criteria::ASC) Order by the currency_name column
 *
 * @method     ChildCountriesQuery groupById() Group by the id column
 * @method     ChildCountriesQuery groupByIso() Group by the iso column
 * @method     ChildCountriesQuery groupByIso2() Group by the iso2 column
 * @method     ChildCountriesQuery groupByIso3() Group by the iso3 column
 * @method     ChildCountriesQuery groupByPrefix() Group by the prefix column
 * @method     ChildCountriesQuery groupByName() Group by the name column
 * @method     ChildCountriesQuery groupByContinent() Group by the continent column
 * @method     ChildCountriesQuery groupBySubcontinent() Group by the subcontinent column
 * @method     ChildCountriesQuery groupByCurrencyIso() Group by the currency_iso column
 * @method     ChildCountriesQuery groupByCurrencyName() Group by the currency_name column
 *
 * @method     ChildCountriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCountriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCountriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCountries findOne(ConnectionInterface $con = null) Return the first ChildCountries matching the query
 * @method     ChildCountries findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCountries matching the query, or a new ChildCountries object populated from the query conditions when no match is found
 *
 * @method     ChildCountries findOneById(int $id) Return the first ChildCountries filtered by the id column
 * @method     ChildCountries findOneByIso(int $iso) Return the first ChildCountries filtered by the iso column
 * @method     ChildCountries findOneByIso2(string $iso2) Return the first ChildCountries filtered by the iso2 column
 * @method     ChildCountries findOneByIso3(string $iso3) Return the first ChildCountries filtered by the iso3 column
 * @method     ChildCountries findOneByPrefix(int $prefix) Return the first ChildCountries filtered by the prefix column
 * @method     ChildCountries findOneByName(string $name) Return the first ChildCountries filtered by the name column
 * @method     ChildCountries findOneByContinent(string $continent) Return the first ChildCountries filtered by the continent column
 * @method     ChildCountries findOneBySubcontinent(string $subcontinent) Return the first ChildCountries filtered by the subcontinent column
 * @method     ChildCountries findOneByCurrencyIso(string $currency_iso) Return the first ChildCountries filtered by the currency_iso column
 * @method     ChildCountries findOneByCurrencyName(string $currency_name) Return the first ChildCountries filtered by the currency_name column *

 * @method     ChildCountries requirePk($key, ConnectionInterface $con = null) Return the ChildCountries by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOne(ConnectionInterface $con = null) Return the first ChildCountries matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountries requireOneById(int $id) Return the first ChildCountries filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByIso(int $iso) Return the first ChildCountries filtered by the iso column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByIso2(string $iso2) Return the first ChildCountries filtered by the iso2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByIso3(string $iso3) Return the first ChildCountries filtered by the iso3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByPrefix(int $prefix) Return the first ChildCountries filtered by the prefix column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByName(string $name) Return the first ChildCountries filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByContinent(string $continent) Return the first ChildCountries filtered by the continent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneBySubcontinent(string $subcontinent) Return the first ChildCountries filtered by the subcontinent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByCurrencyIso(string $currency_iso) Return the first ChildCountries filtered by the currency_iso column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountries requireOneByCurrencyName(string $currency_name) Return the first ChildCountries filtered by the currency_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountries[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCountries objects based on current ModelCriteria
 * @method     ChildCountries[]|ObjectCollection findById(int $id) Return ChildCountries objects filtered by the id column
 * @method     ChildCountries[]|ObjectCollection findByIso(int $iso) Return ChildCountries objects filtered by the iso column
 * @method     ChildCountries[]|ObjectCollection findByIso2(string $iso2) Return ChildCountries objects filtered by the iso2 column
 * @method     ChildCountries[]|ObjectCollection findByIso3(string $iso3) Return ChildCountries objects filtered by the iso3 column
 * @method     ChildCountries[]|ObjectCollection findByPrefix(int $prefix) Return ChildCountries objects filtered by the prefix column
 * @method     ChildCountries[]|ObjectCollection findByName(string $name) Return ChildCountries objects filtered by the name column
 * @method     ChildCountries[]|ObjectCollection findByContinent(string $continent) Return ChildCountries objects filtered by the continent column
 * @method     ChildCountries[]|ObjectCollection findBySubcontinent(string $subcontinent) Return ChildCountries objects filtered by the subcontinent column
 * @method     ChildCountries[]|ObjectCollection findByCurrencyIso(string $currency_iso) Return ChildCountries objects filtered by the currency_iso column
 * @method     ChildCountries[]|ObjectCollection findByCurrencyName(string $currency_name) Return ChildCountries objects filtered by the currency_name column
 * @method     ChildCountries[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CountriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CountriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Countries', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCountriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCountriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCountriesQuery) {
            return $criteria;
        }
        $query = new ChildCountriesQuery();
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
     * @return ChildCountries|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CountriesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CountriesTableMap::DATABASE_NAME);
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
     * @return ChildCountries A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `iso`, `iso2`, `iso3`, `prefix`, `name`, `continent`, `subcontinent`, `currency_iso`, `currency_name` FROM `countries` WHERE `id` = :p0';
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
            /** @var ChildCountries $obj */
            $obj = new ChildCountries();
            $obj->hydrate($row);
            CountriesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCountries|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CountriesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CountriesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CountriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CountriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the iso column
     *
     * Example usage:
     * <code>
     * $query->filterByIso(1234); // WHERE iso = 1234
     * $query->filterByIso(array(12, 34)); // WHERE iso IN (12, 34)
     * $query->filterByIso(array('min' => 12)); // WHERE iso > 12
     * </code>
     *
     * @param     mixed $iso The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByIso($iso = null, $comparison = null)
    {
        if (is_array($iso)) {
            $useMinMax = false;
            if (isset($iso['min'])) {
                $this->addUsingAlias(CountriesTableMap::COL_ISO, $iso['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iso['max'])) {
                $this->addUsingAlias(CountriesTableMap::COL_ISO, $iso['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_ISO, $iso, $comparison);
    }

    /**
     * Filter the query on the iso2 column
     *
     * Example usage:
     * <code>
     * $query->filterByIso2('fooValue');   // WHERE iso2 = 'fooValue'
     * $query->filterByIso2('%fooValue%'); // WHERE iso2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iso2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByIso2($iso2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iso2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $iso2)) {
                $iso2 = str_replace('*', '%', $iso2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_ISO2, $iso2, $comparison);
    }

    /**
     * Filter the query on the iso3 column
     *
     * Example usage:
     * <code>
     * $query->filterByIso3('fooValue');   // WHERE iso3 = 'fooValue'
     * $query->filterByIso3('%fooValue%'); // WHERE iso3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iso3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByIso3($iso3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iso3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $iso3)) {
                $iso3 = str_replace('*', '%', $iso3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_ISO3, $iso3, $comparison);
    }

    /**
     * Filter the query on the prefix column
     *
     * Example usage:
     * <code>
     * $query->filterByPrefix(1234); // WHERE prefix = 1234
     * $query->filterByPrefix(array(12, 34)); // WHERE prefix IN (12, 34)
     * $query->filterByPrefix(array('min' => 12)); // WHERE prefix > 12
     * </code>
     *
     * @param     mixed $prefix The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByPrefix($prefix = null, $comparison = null)
    {
        if (is_array($prefix)) {
            $useMinMax = false;
            if (isset($prefix['min'])) {
                $this->addUsingAlias(CountriesTableMap::COL_PREFIX, $prefix['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prefix['max'])) {
                $this->addUsingAlias(CountriesTableMap::COL_PREFIX, $prefix['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_PREFIX, $prefix, $comparison);
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
     * @return $this|ChildCountriesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CountriesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the continent column
     *
     * Example usage:
     * <code>
     * $query->filterByContinent('fooValue');   // WHERE continent = 'fooValue'
     * $query->filterByContinent('%fooValue%'); // WHERE continent LIKE '%fooValue%'
     * </code>
     *
     * @param     string $continent The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByContinent($continent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($continent)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $continent)) {
                $continent = str_replace('*', '%', $continent);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_CONTINENT, $continent, $comparison);
    }

    /**
     * Filter the query on the subcontinent column
     *
     * Example usage:
     * <code>
     * $query->filterBySubcontinent('fooValue');   // WHERE subcontinent = 'fooValue'
     * $query->filterBySubcontinent('%fooValue%'); // WHERE subcontinent LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subcontinent The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterBySubcontinent($subcontinent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subcontinent)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subcontinent)) {
                $subcontinent = str_replace('*', '%', $subcontinent);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_SUBCONTINENT, $subcontinent, $comparison);
    }

    /**
     * Filter the query on the currency_iso column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyIso('fooValue');   // WHERE currency_iso = 'fooValue'
     * $query->filterByCurrencyIso('%fooValue%'); // WHERE currency_iso LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencyIso The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByCurrencyIso($currencyIso = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencyIso)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $currencyIso)) {
                $currencyIso = str_replace('*', '%', $currencyIso);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_CURRENCY_ISO, $currencyIso, $comparison);
    }

    /**
     * Filter the query on the currency_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyName('fooValue');   // WHERE currency_name = 'fooValue'
     * $query->filterByCurrencyName('%fooValue%'); // WHERE currency_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencyName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function filterByCurrencyName($currencyName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencyName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $currencyName)) {
                $currencyName = str_replace('*', '%', $currencyName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountriesTableMap::COL_CURRENCY_NAME, $currencyName, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCountries $countries Object to remove from the list of results
     *
     * @return $this|ChildCountriesQuery The current query, for fluid interface
     */
    public function prune($countries = null)
    {
        if ($countries) {
            $this->addUsingAlias(CountriesTableMap::COL_ID, $countries->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the countries table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CountriesTableMap::clearInstancePool();
            CountriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CountriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CountriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CountriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CountriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CountriesQuery
