<?php

namespace Base;

use \UsersSettings as ChildUsersSettings;
use \UsersSettingsQuery as ChildUsersSettingsQuery;
use \Exception;
use \PDO;
use Map\UsersSettingsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_settings' table.
 *
 *
 *
 * @method     ChildUsersSettingsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersSettingsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUsersSettingsQuery orderByPushNewShipments($order = Criteria::ASC) Order by the push_new_shipments column
 * @method     ChildUsersSettingsQuery orderByPushOffers($order = Criteria::ASC) Order by the push_offers column
 * @method     ChildUsersSettingsQuery orderByPushChats($order = Criteria::ASC) Order by the push_chats column
 * @method     ChildUsersSettingsQuery orderByOnline($order = Criteria::ASC) Order by the online column
 * @method     ChildUsersSettingsQuery orderByRateBasePrice($order = Criteria::ASC) Order by the rate_base_price column
 * @method     ChildUsersSettingsQuery orderByRateBasePriceEnabled($order = Criteria::ASC) Order by the rate_base_price_enabled column
 * @method     ChildUsersSettingsQuery orderByRatePriceKm($order = Criteria::ASC) Order by the rate_price_km column
 * @method     ChildUsersSettingsQuery orderByRatePriceKmEnabled($order = Criteria::ASC) Order by the rate_price_km_enabled column
 * @method     ChildUsersSettingsQuery orderByRatePercentNightSchedule($order = Criteria::ASC) Order by the rate_percent_night_schedule column
 * @method     ChildUsersSettingsQuery orderByRatePercentNightScheduleEnabled($order = Criteria::ASC) Order by the rate_percent_night_schedule_enabled column
 * @method     ChildUsersSettingsQuery orderByRatePercentNonBusinessDay($order = Criteria::ASC) Order by the rate_percent_non_business_day column
 * @method     ChildUsersSettingsQuery orderByRatePercentNonBusinessDayEnabled($order = Criteria::ASC) Order by the rate_percent_non_business_day_enabled column
 * @method     ChildUsersSettingsQuery orderByShipmentsMaxOffers($order = Criteria::ASC) Order by the shipments_max_offers column
 *
 * @method     ChildUsersSettingsQuery groupById() Group by the id column
 * @method     ChildUsersSettingsQuery groupByUserId() Group by the user_id column
 * @method     ChildUsersSettingsQuery groupByPushNewShipments() Group by the push_new_shipments column
 * @method     ChildUsersSettingsQuery groupByPushOffers() Group by the push_offers column
 * @method     ChildUsersSettingsQuery groupByPushChats() Group by the push_chats column
 * @method     ChildUsersSettingsQuery groupByOnline() Group by the online column
 * @method     ChildUsersSettingsQuery groupByRateBasePrice() Group by the rate_base_price column
 * @method     ChildUsersSettingsQuery groupByRateBasePriceEnabled() Group by the rate_base_price_enabled column
 * @method     ChildUsersSettingsQuery groupByRatePriceKm() Group by the rate_price_km column
 * @method     ChildUsersSettingsQuery groupByRatePriceKmEnabled() Group by the rate_price_km_enabled column
 * @method     ChildUsersSettingsQuery groupByRatePercentNightSchedule() Group by the rate_percent_night_schedule column
 * @method     ChildUsersSettingsQuery groupByRatePercentNightScheduleEnabled() Group by the rate_percent_night_schedule_enabled column
 * @method     ChildUsersSettingsQuery groupByRatePercentNonBusinessDay() Group by the rate_percent_non_business_day column
 * @method     ChildUsersSettingsQuery groupByRatePercentNonBusinessDayEnabled() Group by the rate_percent_non_business_day_enabled column
 * @method     ChildUsersSettingsQuery groupByShipmentsMaxOffers() Group by the shipments_max_offers column
 *
 * @method     ChildUsersSettingsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersSettingsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersSettingsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersSettings findOne(ConnectionInterface $con = null) Return the first ChildUsersSettings matching the query
 * @method     ChildUsersSettings findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersSettings matching the query, or a new ChildUsersSettings object populated from the query conditions when no match is found
 *
 * @method     ChildUsersSettings findOneById(int $id) Return the first ChildUsersSettings filtered by the id column
 * @method     ChildUsersSettings findOneByUserId(int $user_id) Return the first ChildUsersSettings filtered by the user_id column
 * @method     ChildUsersSettings findOneByPushNewShipments(boolean $push_new_shipments) Return the first ChildUsersSettings filtered by the push_new_shipments column
 * @method     ChildUsersSettings findOneByPushOffers(boolean $push_offers) Return the first ChildUsersSettings filtered by the push_offers column
 * @method     ChildUsersSettings findOneByPushChats(boolean $push_chats) Return the first ChildUsersSettings filtered by the push_chats column
 * @method     ChildUsersSettings findOneByOnline(boolean $online) Return the first ChildUsersSettings filtered by the online column
 * @method     ChildUsersSettings findOneByRateBasePrice(double $rate_base_price) Return the first ChildUsersSettings filtered by the rate_base_price column
 * @method     ChildUsersSettings findOneByRateBasePriceEnabled(boolean $rate_base_price_enabled) Return the first ChildUsersSettings filtered by the rate_base_price_enabled column
 * @method     ChildUsersSettings findOneByRatePriceKm(double $rate_price_km) Return the first ChildUsersSettings filtered by the rate_price_km column
 * @method     ChildUsersSettings findOneByRatePriceKmEnabled(boolean $rate_price_km_enabled) Return the first ChildUsersSettings filtered by the rate_price_km_enabled column
 * @method     ChildUsersSettings findOneByRatePercentNightSchedule(double $rate_percent_night_schedule) Return the first ChildUsersSettings filtered by the rate_percent_night_schedule column
 * @method     ChildUsersSettings findOneByRatePercentNightScheduleEnabled(boolean $rate_percent_night_schedule_enabled) Return the first ChildUsersSettings filtered by the rate_percent_night_schedule_enabled column
 * @method     ChildUsersSettings findOneByRatePercentNonBusinessDay(double $rate_percent_non_business_day) Return the first ChildUsersSettings filtered by the rate_percent_non_business_day column
 * @method     ChildUsersSettings findOneByRatePercentNonBusinessDayEnabled(boolean $rate_percent_non_business_day_enabled) Return the first ChildUsersSettings filtered by the rate_percent_non_business_day_enabled column
 * @method     ChildUsersSettings findOneByShipmentsMaxOffers(int $shipments_max_offers) Return the first ChildUsersSettings filtered by the shipments_max_offers column *

 * @method     ChildUsersSettings requirePk($key, ConnectionInterface $con = null) Return the ChildUsersSettings by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOne(ConnectionInterface $con = null) Return the first ChildUsersSettings matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersSettings requireOneById(int $id) Return the first ChildUsersSettings filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByUserId(int $user_id) Return the first ChildUsersSettings filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByPushNewShipments(boolean $push_new_shipments) Return the first ChildUsersSettings filtered by the push_new_shipments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByPushOffers(boolean $push_offers) Return the first ChildUsersSettings filtered by the push_offers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByPushChats(boolean $push_chats) Return the first ChildUsersSettings filtered by the push_chats column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByOnline(boolean $online) Return the first ChildUsersSettings filtered by the online column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRateBasePrice(double $rate_base_price) Return the first ChildUsersSettings filtered by the rate_base_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRateBasePriceEnabled(boolean $rate_base_price_enabled) Return the first ChildUsersSettings filtered by the rate_base_price_enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRatePriceKm(double $rate_price_km) Return the first ChildUsersSettings filtered by the rate_price_km column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRatePriceKmEnabled(boolean $rate_price_km_enabled) Return the first ChildUsersSettings filtered by the rate_price_km_enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRatePercentNightSchedule(double $rate_percent_night_schedule) Return the first ChildUsersSettings filtered by the rate_percent_night_schedule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRatePercentNightScheduleEnabled(boolean $rate_percent_night_schedule_enabled) Return the first ChildUsersSettings filtered by the rate_percent_night_schedule_enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRatePercentNonBusinessDay(double $rate_percent_non_business_day) Return the first ChildUsersSettings filtered by the rate_percent_non_business_day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByRatePercentNonBusinessDayEnabled(boolean $rate_percent_non_business_day_enabled) Return the first ChildUsersSettings filtered by the rate_percent_non_business_day_enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersSettings requireOneByShipmentsMaxOffers(int $shipments_max_offers) Return the first ChildUsersSettings filtered by the shipments_max_offers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersSettings[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersSettings objects based on current ModelCriteria
 * @method     ChildUsersSettings[]|ObjectCollection findById(int $id) Return ChildUsersSettings objects filtered by the id column
 * @method     ChildUsersSettings[]|ObjectCollection findByUserId(int $user_id) Return ChildUsersSettings objects filtered by the user_id column
 * @method     ChildUsersSettings[]|ObjectCollection findByPushNewShipments(boolean $push_new_shipments) Return ChildUsersSettings objects filtered by the push_new_shipments column
 * @method     ChildUsersSettings[]|ObjectCollection findByPushOffers(boolean $push_offers) Return ChildUsersSettings objects filtered by the push_offers column
 * @method     ChildUsersSettings[]|ObjectCollection findByPushChats(boolean $push_chats) Return ChildUsersSettings objects filtered by the push_chats column
 * @method     ChildUsersSettings[]|ObjectCollection findByOnline(boolean $online) Return ChildUsersSettings objects filtered by the online column
 * @method     ChildUsersSettings[]|ObjectCollection findByRateBasePrice(double $rate_base_price) Return ChildUsersSettings objects filtered by the rate_base_price column
 * @method     ChildUsersSettings[]|ObjectCollection findByRateBasePriceEnabled(boolean $rate_base_price_enabled) Return ChildUsersSettings objects filtered by the rate_base_price_enabled column
 * @method     ChildUsersSettings[]|ObjectCollection findByRatePriceKm(double $rate_price_km) Return ChildUsersSettings objects filtered by the rate_price_km column
 * @method     ChildUsersSettings[]|ObjectCollection findByRatePriceKmEnabled(boolean $rate_price_km_enabled) Return ChildUsersSettings objects filtered by the rate_price_km_enabled column
 * @method     ChildUsersSettings[]|ObjectCollection findByRatePercentNightSchedule(double $rate_percent_night_schedule) Return ChildUsersSettings objects filtered by the rate_percent_night_schedule column
 * @method     ChildUsersSettings[]|ObjectCollection findByRatePercentNightScheduleEnabled(boolean $rate_percent_night_schedule_enabled) Return ChildUsersSettings objects filtered by the rate_percent_night_schedule_enabled column
 * @method     ChildUsersSettings[]|ObjectCollection findByRatePercentNonBusinessDay(double $rate_percent_non_business_day) Return ChildUsersSettings objects filtered by the rate_percent_non_business_day column
 * @method     ChildUsersSettings[]|ObjectCollection findByRatePercentNonBusinessDayEnabled(boolean $rate_percent_non_business_day_enabled) Return ChildUsersSettings objects filtered by the rate_percent_non_business_day_enabled column
 * @method     ChildUsersSettings[]|ObjectCollection findByShipmentsMaxOffers(int $shipments_max_offers) Return ChildUsersSettings objects filtered by the shipments_max_offers column
 * @method     ChildUsersSettings[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersSettingsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersSettingsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersSettings', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersSettingsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersSettingsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersSettingsQuery) {
            return $criteria;
        }
        $query = new ChildUsersSettingsQuery();
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
     * @return ChildUsersSettings|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersSettingsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersSettingsTableMap::DATABASE_NAME);
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
     * @return ChildUsersSettings A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `user_id`, `push_new_shipments`, `push_offers`, `push_chats`, `online`, `rate_base_price`, `rate_base_price_enabled`, `rate_price_km`, `rate_price_km_enabled`, `rate_percent_night_schedule`, `rate_percent_night_schedule_enabled`, `rate_percent_non_business_day`, `rate_percent_non_business_day_enabled`, `shipments_max_offers` FROM `users_settings` WHERE `id` = :p0';
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
            /** @var ChildUsersSettings $obj */
            $obj = new ChildUsersSettings();
            $obj->hydrate($row);
            UsersSettingsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsersSettings|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersSettingsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersSettingsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the push_new_shipments column
     *
     * Example usage:
     * <code>
     * $query->filterByPushNewShipments(true); // WHERE push_new_shipments = true
     * $query->filterByPushNewShipments('yes'); // WHERE push_new_shipments = true
     * </code>
     *
     * @param     boolean|string $pushNewShipments The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByPushNewShipments($pushNewShipments = null, $comparison = null)
    {
        if (is_string($pushNewShipments)) {
            $pushNewShipments = in_array(strtolower($pushNewShipments), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS, $pushNewShipments, $comparison);
    }

    /**
     * Filter the query on the push_offers column
     *
     * Example usage:
     * <code>
     * $query->filterByPushOffers(true); // WHERE push_offers = true
     * $query->filterByPushOffers('yes'); // WHERE push_offers = true
     * </code>
     *
     * @param     boolean|string $pushOffers The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByPushOffers($pushOffers = null, $comparison = null)
    {
        if (is_string($pushOffers)) {
            $pushOffers = in_array(strtolower($pushOffers), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_PUSH_OFFERS, $pushOffers, $comparison);
    }

    /**
     * Filter the query on the push_chats column
     *
     * Example usage:
     * <code>
     * $query->filterByPushChats(true); // WHERE push_chats = true
     * $query->filterByPushChats('yes'); // WHERE push_chats = true
     * </code>
     *
     * @param     boolean|string $pushChats The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByPushChats($pushChats = null, $comparison = null)
    {
        if (is_string($pushChats)) {
            $pushChats = in_array(strtolower($pushChats), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_PUSH_CHATS, $pushChats, $comparison);
    }

    /**
     * Filter the query on the online column
     *
     * Example usage:
     * <code>
     * $query->filterByOnline(true); // WHERE online = true
     * $query->filterByOnline('yes'); // WHERE online = true
     * </code>
     *
     * @param     boolean|string $online The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByOnline($online = null, $comparison = null)
    {
        if (is_string($online)) {
            $online = in_array(strtolower($online), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_ONLINE, $online, $comparison);
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
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRateBasePrice($rateBasePrice = null, $comparison = null)
    {
        if (is_array($rateBasePrice)) {
            $useMinMax = false;
            if (isset($rateBasePrice['min'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_BASE_PRICE, $rateBasePrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rateBasePrice['max'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_BASE_PRICE, $rateBasePrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_BASE_PRICE, $rateBasePrice, $comparison);
    }

    /**
     * Filter the query on the rate_base_price_enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByRateBasePriceEnabled(true); // WHERE rate_base_price_enabled = true
     * $query->filterByRateBasePriceEnabled('yes'); // WHERE rate_base_price_enabled = true
     * </code>
     *
     * @param     boolean|string $rateBasePriceEnabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRateBasePriceEnabled($rateBasePriceEnabled = null, $comparison = null)
    {
        if (is_string($rateBasePriceEnabled)) {
            $rateBasePriceEnabled = in_array(strtolower($rateBasePriceEnabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED, $rateBasePriceEnabled, $comparison);
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
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRatePriceKm($ratePriceKm = null, $comparison = null)
    {
        if (is_array($ratePriceKm)) {
            $useMinMax = false;
            if (isset($ratePriceKm['min'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PRICE_KM, $ratePriceKm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratePriceKm['max'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PRICE_KM, $ratePriceKm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PRICE_KM, $ratePriceKm, $comparison);
    }

    /**
     * Filter the query on the rate_price_km_enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByRatePriceKmEnabled(true); // WHERE rate_price_km_enabled = true
     * $query->filterByRatePriceKmEnabled('yes'); // WHERE rate_price_km_enabled = true
     * </code>
     *
     * @param     boolean|string $ratePriceKmEnabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRatePriceKmEnabled($ratePriceKmEnabled = null, $comparison = null)
    {
        if (is_string($ratePriceKmEnabled)) {
            $ratePriceKmEnabled = in_array(strtolower($ratePriceKmEnabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED, $ratePriceKmEnabled, $comparison);
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
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRatePercentNightSchedule($ratePercentNightSchedule = null, $comparison = null)
    {
        if (is_array($ratePercentNightSchedule)) {
            $useMinMax = false;
            if (isset($ratePercentNightSchedule['min'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, $ratePercentNightSchedule['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratePercentNightSchedule['max'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, $ratePercentNightSchedule['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, $ratePercentNightSchedule, $comparison);
    }

    /**
     * Filter the query on the rate_percent_night_schedule_enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByRatePercentNightScheduleEnabled(true); // WHERE rate_percent_night_schedule_enabled = true
     * $query->filterByRatePercentNightScheduleEnabled('yes'); // WHERE rate_percent_night_schedule_enabled = true
     * </code>
     *
     * @param     boolean|string $ratePercentNightScheduleEnabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRatePercentNightScheduleEnabled($ratePercentNightScheduleEnabled = null, $comparison = null)
    {
        if (is_string($ratePercentNightScheduleEnabled)) {
            $ratePercentNightScheduleEnabled = in_array(strtolower($ratePercentNightScheduleEnabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED, $ratePercentNightScheduleEnabled, $comparison);
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
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRatePercentNonBusinessDay($ratePercentNonBusinessDay = null, $comparison = null)
    {
        if (is_array($ratePercentNonBusinessDay)) {
            $useMinMax = false;
            if (isset($ratePercentNonBusinessDay['min'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, $ratePercentNonBusinessDay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratePercentNonBusinessDay['max'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, $ratePercentNonBusinessDay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, $ratePercentNonBusinessDay, $comparison);
    }

    /**
     * Filter the query on the rate_percent_non_business_day_enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByRatePercentNonBusinessDayEnabled(true); // WHERE rate_percent_non_business_day_enabled = true
     * $query->filterByRatePercentNonBusinessDayEnabled('yes'); // WHERE rate_percent_non_business_day_enabled = true
     * </code>
     *
     * @param     boolean|string $ratePercentNonBusinessDayEnabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByRatePercentNonBusinessDayEnabled($ratePercentNonBusinessDayEnabled = null, $comparison = null)
    {
        if (is_string($ratePercentNonBusinessDayEnabled)) {
            $ratePercentNonBusinessDayEnabled = in_array(strtolower($ratePercentNonBusinessDayEnabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED, $ratePercentNonBusinessDayEnabled, $comparison);
    }

    /**
     * Filter the query on the shipments_max_offers column
     *
     * Example usage:
     * <code>
     * $query->filterByShipmentsMaxOffers(1234); // WHERE shipments_max_offers = 1234
     * $query->filterByShipmentsMaxOffers(array(12, 34)); // WHERE shipments_max_offers IN (12, 34)
     * $query->filterByShipmentsMaxOffers(array('min' => 12)); // WHERE shipments_max_offers > 12
     * </code>
     *
     * @param     mixed $shipmentsMaxOffers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function filterByShipmentsMaxOffers($shipmentsMaxOffers = null, $comparison = null)
    {
        if (is_array($shipmentsMaxOffers)) {
            $useMinMax = false;
            if (isset($shipmentsMaxOffers['min'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS, $shipmentsMaxOffers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shipmentsMaxOffers['max'])) {
                $this->addUsingAlias(UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS, $shipmentsMaxOffers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS, $shipmentsMaxOffers, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersSettings $usersSettings Object to remove from the list of results
     *
     * @return $this|ChildUsersSettingsQuery The current query, for fluid interface
     */
    public function prune($usersSettings = null)
    {
        if ($usersSettings) {
            $this->addUsingAlias(UsersSettingsTableMap::COL_ID, $usersSettings->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_settings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSettingsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersSettingsTableMap::clearInstancePool();
            UsersSettingsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSettingsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersSettingsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersSettingsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersSettingsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersSettingsQuery
