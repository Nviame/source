<?php

namespace Base;

use \UsersConveyances as ChildUsersConveyances;
use \UsersConveyancesQuery as ChildUsersConveyancesQuery;
use \Exception;
use \PDO;
use Map\UsersConveyancesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_conveyances' table.
 *
 *
 *
 * @method     ChildUsersConveyancesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersConveyancesQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildUsersConveyancesQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildUsersConveyancesQuery orderByBrand($order = Criteria::ASC) Order by the brand column
 * @method     ChildUsersConveyancesQuery orderByModel($order = Criteria::ASC) Order by the model column
 * @method     ChildUsersConveyancesQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildUsersConveyancesQuery orderByDomain($order = Criteria::ASC) Order by the domain column
 * @method     ChildUsersConveyancesQuery orderByMainPhoto($order = Criteria::ASC) Order by the main_photo column
 * @method     ChildUsersConveyancesQuery orderByIdentificationCard($order = Criteria::ASC) Order by the identification_card column
 * @method     ChildUsersConveyancesQuery orderByInsurancePolicy($order = Criteria::ASC) Order by the insurance_policy column
 *
 * @method     ChildUsersConveyancesQuery groupById() Group by the id column
 * @method     ChildUsersConveyancesQuery groupByIdUser() Group by the id_user column
 * @method     ChildUsersConveyancesQuery groupByType() Group by the type column
 * @method     ChildUsersConveyancesQuery groupByBrand() Group by the brand column
 * @method     ChildUsersConveyancesQuery groupByModel() Group by the model column
 * @method     ChildUsersConveyancesQuery groupByYear() Group by the year column
 * @method     ChildUsersConveyancesQuery groupByDomain() Group by the domain column
 * @method     ChildUsersConveyancesQuery groupByMainPhoto() Group by the main_photo column
 * @method     ChildUsersConveyancesQuery groupByIdentificationCard() Group by the identification_card column
 * @method     ChildUsersConveyancesQuery groupByInsurancePolicy() Group by the insurance_policy column
 *
 * @method     ChildUsersConveyancesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersConveyancesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersConveyancesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersConveyances findOne(ConnectionInterface $con = null) Return the first ChildUsersConveyances matching the query
 * @method     ChildUsersConveyances findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersConveyances matching the query, or a new ChildUsersConveyances object populated from the query conditions when no match is found
 *
 * @method     ChildUsersConveyances findOneById(int $id) Return the first ChildUsersConveyances filtered by the id column
 * @method     ChildUsersConveyances findOneByIdUser(int $id_user) Return the first ChildUsersConveyances filtered by the id_user column
 * @method     ChildUsersConveyances findOneByType(int $type) Return the first ChildUsersConveyances filtered by the type column
 * @method     ChildUsersConveyances findOneByBrand(string $brand) Return the first ChildUsersConveyances filtered by the brand column
 * @method     ChildUsersConveyances findOneByModel(string $model) Return the first ChildUsersConveyances filtered by the model column
 * @method     ChildUsersConveyances findOneByYear(int $year) Return the first ChildUsersConveyances filtered by the year column
 * @method     ChildUsersConveyances findOneByDomain(string $domain) Return the first ChildUsersConveyances filtered by the domain column
 * @method     ChildUsersConveyances findOneByMainPhoto(string $main_photo) Return the first ChildUsersConveyances filtered by the main_photo column
 * @method     ChildUsersConveyances findOneByIdentificationCard(string $identification_card) Return the first ChildUsersConveyances filtered by the identification_card column
 * @method     ChildUsersConveyances findOneByInsurancePolicy(string $insurance_policy) Return the first ChildUsersConveyances filtered by the insurance_policy column *

 * @method     ChildUsersConveyances requirePk($key, ConnectionInterface $con = null) Return the ChildUsersConveyances by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOne(ConnectionInterface $con = null) Return the first ChildUsersConveyances matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersConveyances requireOneById(int $id) Return the first ChildUsersConveyances filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByIdUser(int $id_user) Return the first ChildUsersConveyances filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByType(int $type) Return the first ChildUsersConveyances filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByBrand(string $brand) Return the first ChildUsersConveyances filtered by the brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByModel(string $model) Return the first ChildUsersConveyances filtered by the model column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByYear(int $year) Return the first ChildUsersConveyances filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByDomain(string $domain) Return the first ChildUsersConveyances filtered by the domain column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByMainPhoto(string $main_photo) Return the first ChildUsersConveyances filtered by the main_photo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByIdentificationCard(string $identification_card) Return the first ChildUsersConveyances filtered by the identification_card column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersConveyances requireOneByInsurancePolicy(string $insurance_policy) Return the first ChildUsersConveyances filtered by the insurance_policy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersConveyances[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersConveyances objects based on current ModelCriteria
 * @method     ChildUsersConveyances[]|ObjectCollection findById(int $id) Return ChildUsersConveyances objects filtered by the id column
 * @method     ChildUsersConveyances[]|ObjectCollection findByIdUser(int $id_user) Return ChildUsersConveyances objects filtered by the id_user column
 * @method     ChildUsersConveyances[]|ObjectCollection findByType(int $type) Return ChildUsersConveyances objects filtered by the type column
 * @method     ChildUsersConveyances[]|ObjectCollection findByBrand(string $brand) Return ChildUsersConveyances objects filtered by the brand column
 * @method     ChildUsersConveyances[]|ObjectCollection findByModel(string $model) Return ChildUsersConveyances objects filtered by the model column
 * @method     ChildUsersConveyances[]|ObjectCollection findByYear(int $year) Return ChildUsersConveyances objects filtered by the year column
 * @method     ChildUsersConveyances[]|ObjectCollection findByDomain(string $domain) Return ChildUsersConveyances objects filtered by the domain column
 * @method     ChildUsersConveyances[]|ObjectCollection findByMainPhoto(string $main_photo) Return ChildUsersConveyances objects filtered by the main_photo column
 * @method     ChildUsersConveyances[]|ObjectCollection findByIdentificationCard(string $identification_card) Return ChildUsersConveyances objects filtered by the identification_card column
 * @method     ChildUsersConveyances[]|ObjectCollection findByInsurancePolicy(string $insurance_policy) Return ChildUsersConveyances objects filtered by the insurance_policy column
 * @method     ChildUsersConveyances[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersConveyancesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersConveyancesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersConveyances', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersConveyancesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersConveyancesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersConveyancesQuery) {
            return $criteria;
        }
        $query = new ChildUsersConveyancesQuery();
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
     * @return ChildUsersConveyances|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersConveyancesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersConveyancesTableMap::DATABASE_NAME);
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
     * @return ChildUsersConveyances A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `type`, `brand`, `model`, `year`, `domain`, `main_photo`, `identification_card`, `insurance_policy` FROM `users_conveyances` WHERE `id` = :p0';
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
            /** @var ChildUsersConveyances $obj */
            $obj = new ChildUsersConveyances();
            $obj->hydrate($row);
            UsersConveyancesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsersConveyances|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType(1234); // WHERE type = 1234
     * $query->filterByType(array(12, 34)); // WHERE type IN (12, 34)
     * $query->filterByType(array('min' => 12)); // WHERE type > 12
     * </code>
     *
     * @param     mixed $type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_TYPE, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_TYPE, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the brand column
     *
     * Example usage:
     * <code>
     * $query->filterByBrand('fooValue');   // WHERE brand = 'fooValue'
     * $query->filterByBrand('%fooValue%'); // WHERE brand LIKE '%fooValue%'
     * </code>
     *
     * @param     string $brand The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByBrand($brand = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brand)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $brand)) {
                $brand = str_replace('*', '%', $brand);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_BRAND, $brand, $comparison);
    }

    /**
     * Filter the query on the model column
     *
     * Example usage:
     * <code>
     * $query->filterByModel('fooValue');   // WHERE model = 'fooValue'
     * $query->filterByModel('%fooValue%'); // WHERE model LIKE '%fooValue%'
     * </code>
     *
     * @param     string $model The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByModel($model = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($model)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $model)) {
                $model = str_replace('*', '%', $model);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_MODEL, $model, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(UsersConveyancesTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the domain column
     *
     * Example usage:
     * <code>
     * $query->filterByDomain('fooValue');   // WHERE domain = 'fooValue'
     * $query->filterByDomain('%fooValue%'); // WHERE domain LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domain The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByDomain($domain = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domain)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domain)) {
                $domain = str_replace('*', '%', $domain);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_DOMAIN, $domain, $comparison);
    }

    /**
     * Filter the query on the main_photo column
     *
     * Example usage:
     * <code>
     * $query->filterByMainPhoto('fooValue');   // WHERE main_photo = 'fooValue'
     * $query->filterByMainPhoto('%fooValue%'); // WHERE main_photo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mainPhoto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByMainPhoto($mainPhoto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mainPhoto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mainPhoto)) {
                $mainPhoto = str_replace('*', '%', $mainPhoto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_MAIN_PHOTO, $mainPhoto, $comparison);
    }

    /**
     * Filter the query on the identification_card column
     *
     * Example usage:
     * <code>
     * $query->filterByIdentificationCard('fooValue');   // WHERE identification_card = 'fooValue'
     * $query->filterByIdentificationCard('%fooValue%'); // WHERE identification_card LIKE '%fooValue%'
     * </code>
     *
     * @param     string $identificationCard The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByIdentificationCard($identificationCard = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($identificationCard)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $identificationCard)) {
                $identificationCard = str_replace('*', '%', $identificationCard);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_IDENTIFICATION_CARD, $identificationCard, $comparison);
    }

    /**
     * Filter the query on the insurance_policy column
     *
     * Example usage:
     * <code>
     * $query->filterByInsurancePolicy('fooValue');   // WHERE insurance_policy = 'fooValue'
     * $query->filterByInsurancePolicy('%fooValue%'); // WHERE insurance_policy LIKE '%fooValue%'
     * </code>
     *
     * @param     string $insurancePolicy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function filterByInsurancePolicy($insurancePolicy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($insurancePolicy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $insurancePolicy)) {
                $insurancePolicy = str_replace('*', '%', $insurancePolicy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersConveyancesTableMap::COL_INSURANCE_POLICY, $insurancePolicy, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersConveyances $usersConveyances Object to remove from the list of results
     *
     * @return $this|ChildUsersConveyancesQuery The current query, for fluid interface
     */
    public function prune($usersConveyances = null)
    {
        if ($usersConveyances) {
            $this->addUsingAlias(UsersConveyancesTableMap::COL_ID, $usersConveyances->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_conveyances table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersConveyancesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersConveyancesTableMap::clearInstancePool();
            UsersConveyancesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersConveyancesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersConveyancesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersConveyancesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersConveyancesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersConveyancesQuery
