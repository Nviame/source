<?php

namespace Base;

use \ShipmentsPayments as ChildShipmentsPayments;
use \ShipmentsPaymentsQuery as ChildShipmentsPaymentsQuery;
use \Exception;
use \PDO;
use Map\ShipmentsPaymentsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipments_payments' table.
 *
 *
 *
 * @method     ChildShipmentsPaymentsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentsPaymentsQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildShipmentsPaymentsQuery orderByPreferenceId($order = Criteria::ASC) Order by the preference_id column
 * @method     ChildShipmentsPaymentsQuery orderByCollectionId($order = Criteria::ASC) Order by the collection_id column
 * @method     ChildShipmentsPaymentsQuery orderByCollectionStatus($order = Criteria::ASC) Order by the collection_status column
 * @method     ChildShipmentsPaymentsQuery orderByMerchantOrderId($order = Criteria::ASC) Order by the merchant_order_id column
 * @method     ChildShipmentsPaymentsQuery orderByTotalPaidAmount($order = Criteria::ASC) Order by the total_paid_amount column
 * @method     ChildShipmentsPaymentsQuery orderByNetReceivedAmount($order = Criteria::ASC) Order by the net_received_amount column
 * @method     ChildShipmentsPaymentsQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildShipmentsPaymentsQuery orderByFeeMp($order = Criteria::ASC) Order by the fee_mp column
 * @method     ChildShipmentsPaymentsQuery orderByFeeNv($order = Criteria::ASC) Order by the fee_nv column
 * @method     ChildShipmentsPaymentsQuery orderByCardTypeId($order = Criteria::ASC) Order by the card_type_id column
 * @method     ChildShipmentsPaymentsQuery orderByCardMethodId($order = Criteria::ASC) Order by the card_method_id column
 * @method     ChildShipmentsPaymentsQuery orderByCardExpirationMonth($order = Criteria::ASC) Order by the card_expiration_month column
 * @method     ChildShipmentsPaymentsQuery orderByCardExpirationYear($order = Criteria::ASC) Order by the card_expiration_year column
 * @method     ChildShipmentsPaymentsQuery orderByCardCardholderIdentificationType($order = Criteria::ASC) Order by the card_cardholder_identification_type column
 * @method     ChildShipmentsPaymentsQuery orderByCardCardholderIdentificationNumber($order = Criteria::ASC) Order by the card_cardholder_identification_number column
 * @method     ChildShipmentsPaymentsQuery orderByCardCardholderName($order = Criteria::ASC) Order by the card_cardholder_name column
 * @method     ChildShipmentsPaymentsQuery orderByCardDateCreated($order = Criteria::ASC) Order by the card_date_created column
 * @method     ChildShipmentsPaymentsQuery orderByCardDateLastUpdated($order = Criteria::ASC) Order by the card_date_last_updated column
 *
 * @method     ChildShipmentsPaymentsQuery groupById() Group by the id column
 * @method     ChildShipmentsPaymentsQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildShipmentsPaymentsQuery groupByPreferenceId() Group by the preference_id column
 * @method     ChildShipmentsPaymentsQuery groupByCollectionId() Group by the collection_id column
 * @method     ChildShipmentsPaymentsQuery groupByCollectionStatus() Group by the collection_status column
 * @method     ChildShipmentsPaymentsQuery groupByMerchantOrderId() Group by the merchant_order_id column
 * @method     ChildShipmentsPaymentsQuery groupByTotalPaidAmount() Group by the total_paid_amount column
 * @method     ChildShipmentsPaymentsQuery groupByNetReceivedAmount() Group by the net_received_amount column
 * @method     ChildShipmentsPaymentsQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildShipmentsPaymentsQuery groupByFeeMp() Group by the fee_mp column
 * @method     ChildShipmentsPaymentsQuery groupByFeeNv() Group by the fee_nv column
 * @method     ChildShipmentsPaymentsQuery groupByCardTypeId() Group by the card_type_id column
 * @method     ChildShipmentsPaymentsQuery groupByCardMethodId() Group by the card_method_id column
 * @method     ChildShipmentsPaymentsQuery groupByCardExpirationMonth() Group by the card_expiration_month column
 * @method     ChildShipmentsPaymentsQuery groupByCardExpirationYear() Group by the card_expiration_year column
 * @method     ChildShipmentsPaymentsQuery groupByCardCardholderIdentificationType() Group by the card_cardholder_identification_type column
 * @method     ChildShipmentsPaymentsQuery groupByCardCardholderIdentificationNumber() Group by the card_cardholder_identification_number column
 * @method     ChildShipmentsPaymentsQuery groupByCardCardholderName() Group by the card_cardholder_name column
 * @method     ChildShipmentsPaymentsQuery groupByCardDateCreated() Group by the card_date_created column
 * @method     ChildShipmentsPaymentsQuery groupByCardDateLastUpdated() Group by the card_date_last_updated column
 *
 * @method     ChildShipmentsPaymentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentsPaymentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentsPaymentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentsPayments findOne(ConnectionInterface $con = null) Return the first ChildShipmentsPayments matching the query
 * @method     ChildShipmentsPayments findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentsPayments matching the query, or a new ChildShipmentsPayments object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentsPayments findOneById(int $id) Return the first ChildShipmentsPayments filtered by the id column
 * @method     ChildShipmentsPayments findOneByIdShipment(int $id_shipment) Return the first ChildShipmentsPayments filtered by the id_shipment column
 * @method     ChildShipmentsPayments findOneByPreferenceId(string $preference_id) Return the first ChildShipmentsPayments filtered by the preference_id column
 * @method     ChildShipmentsPayments findOneByCollectionId(string $collection_id) Return the first ChildShipmentsPayments filtered by the collection_id column
 * @method     ChildShipmentsPayments findOneByCollectionStatus(string $collection_status) Return the first ChildShipmentsPayments filtered by the collection_status column
 * @method     ChildShipmentsPayments findOneByMerchantOrderId(string $merchant_order_id) Return the first ChildShipmentsPayments filtered by the merchant_order_id column
 * @method     ChildShipmentsPayments findOneByTotalPaidAmount(double $total_paid_amount) Return the first ChildShipmentsPayments filtered by the total_paid_amount column
 * @method     ChildShipmentsPayments findOneByNetReceivedAmount(double $net_received_amount) Return the first ChildShipmentsPayments filtered by the net_received_amount column
 * @method     ChildShipmentsPayments findOneByRegisteredAt(string $registered_at) Return the first ChildShipmentsPayments filtered by the registered_at column
 * @method     ChildShipmentsPayments findOneByFeeMp(double $fee_mp) Return the first ChildShipmentsPayments filtered by the fee_mp column
 * @method     ChildShipmentsPayments findOneByFeeNv(double $fee_nv) Return the first ChildShipmentsPayments filtered by the fee_nv column
 * @method     ChildShipmentsPayments findOneByCardTypeId(string $card_type_id) Return the first ChildShipmentsPayments filtered by the card_type_id column
 * @method     ChildShipmentsPayments findOneByCardMethodId(string $card_method_id) Return the first ChildShipmentsPayments filtered by the card_method_id column
 * @method     ChildShipmentsPayments findOneByCardExpirationMonth(int $card_expiration_month) Return the first ChildShipmentsPayments filtered by the card_expiration_month column
 * @method     ChildShipmentsPayments findOneByCardExpirationYear(int $card_expiration_year) Return the first ChildShipmentsPayments filtered by the card_expiration_year column
 * @method     ChildShipmentsPayments findOneByCardCardholderIdentificationType(string $card_cardholder_identification_type) Return the first ChildShipmentsPayments filtered by the card_cardholder_identification_type column
 * @method     ChildShipmentsPayments findOneByCardCardholderIdentificationNumber(string $card_cardholder_identification_number) Return the first ChildShipmentsPayments filtered by the card_cardholder_identification_number column
 * @method     ChildShipmentsPayments findOneByCardCardholderName(string $card_cardholder_name) Return the first ChildShipmentsPayments filtered by the card_cardholder_name column
 * @method     ChildShipmentsPayments findOneByCardDateCreated(string $card_date_created) Return the first ChildShipmentsPayments filtered by the card_date_created column
 * @method     ChildShipmentsPayments findOneByCardDateLastUpdated(string $card_date_last_updated) Return the first ChildShipmentsPayments filtered by the card_date_last_updated column *

 * @method     ChildShipmentsPayments requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentsPayments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOne(ConnectionInterface $con = null) Return the first ChildShipmentsPayments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsPayments requireOneById(int $id) Return the first ChildShipmentsPayments filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByIdShipment(int $id_shipment) Return the first ChildShipmentsPayments filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByPreferenceId(string $preference_id) Return the first ChildShipmentsPayments filtered by the preference_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCollectionId(string $collection_id) Return the first ChildShipmentsPayments filtered by the collection_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCollectionStatus(string $collection_status) Return the first ChildShipmentsPayments filtered by the collection_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByMerchantOrderId(string $merchant_order_id) Return the first ChildShipmentsPayments filtered by the merchant_order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByTotalPaidAmount(double $total_paid_amount) Return the first ChildShipmentsPayments filtered by the total_paid_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByNetReceivedAmount(double $net_received_amount) Return the first ChildShipmentsPayments filtered by the net_received_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByRegisteredAt(string $registered_at) Return the first ChildShipmentsPayments filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByFeeMp(double $fee_mp) Return the first ChildShipmentsPayments filtered by the fee_mp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByFeeNv(double $fee_nv) Return the first ChildShipmentsPayments filtered by the fee_nv column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardTypeId(string $card_type_id) Return the first ChildShipmentsPayments filtered by the card_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardMethodId(string $card_method_id) Return the first ChildShipmentsPayments filtered by the card_method_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardExpirationMonth(int $card_expiration_month) Return the first ChildShipmentsPayments filtered by the card_expiration_month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardExpirationYear(int $card_expiration_year) Return the first ChildShipmentsPayments filtered by the card_expiration_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardCardholderIdentificationType(string $card_cardholder_identification_type) Return the first ChildShipmentsPayments filtered by the card_cardholder_identification_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardCardholderIdentificationNumber(string $card_cardholder_identification_number) Return the first ChildShipmentsPayments filtered by the card_cardholder_identification_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardCardholderName(string $card_cardholder_name) Return the first ChildShipmentsPayments filtered by the card_cardholder_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardDateCreated(string $card_date_created) Return the first ChildShipmentsPayments filtered by the card_date_created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsPayments requireOneByCardDateLastUpdated(string $card_date_last_updated) Return the first ChildShipmentsPayments filtered by the card_date_last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsPayments[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentsPayments objects based on current ModelCriteria
 * @method     ChildShipmentsPayments[]|ObjectCollection findById(int $id) Return ChildShipmentsPayments objects filtered by the id column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildShipmentsPayments objects filtered by the id_shipment column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByPreferenceId(string $preference_id) Return ChildShipmentsPayments objects filtered by the preference_id column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCollectionId(string $collection_id) Return ChildShipmentsPayments objects filtered by the collection_id column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCollectionStatus(string $collection_status) Return ChildShipmentsPayments objects filtered by the collection_status column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByMerchantOrderId(string $merchant_order_id) Return ChildShipmentsPayments objects filtered by the merchant_order_id column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByTotalPaidAmount(double $total_paid_amount) Return ChildShipmentsPayments objects filtered by the total_paid_amount column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByNetReceivedAmount(double $net_received_amount) Return ChildShipmentsPayments objects filtered by the net_received_amount column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildShipmentsPayments objects filtered by the registered_at column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByFeeMp(double $fee_mp) Return ChildShipmentsPayments objects filtered by the fee_mp column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByFeeNv(double $fee_nv) Return ChildShipmentsPayments objects filtered by the fee_nv column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardTypeId(string $card_type_id) Return ChildShipmentsPayments objects filtered by the card_type_id column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardMethodId(string $card_method_id) Return ChildShipmentsPayments objects filtered by the card_method_id column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardExpirationMonth(int $card_expiration_month) Return ChildShipmentsPayments objects filtered by the card_expiration_month column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardExpirationYear(int $card_expiration_year) Return ChildShipmentsPayments objects filtered by the card_expiration_year column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardCardholderIdentificationType(string $card_cardholder_identification_type) Return ChildShipmentsPayments objects filtered by the card_cardholder_identification_type column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardCardholderIdentificationNumber(string $card_cardholder_identification_number) Return ChildShipmentsPayments objects filtered by the card_cardholder_identification_number column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardCardholderName(string $card_cardholder_name) Return ChildShipmentsPayments objects filtered by the card_cardholder_name column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardDateCreated(string $card_date_created) Return ChildShipmentsPayments objects filtered by the card_date_created column
 * @method     ChildShipmentsPayments[]|ObjectCollection findByCardDateLastUpdated(string $card_date_last_updated) Return ChildShipmentsPayments objects filtered by the card_date_last_updated column
 * @method     ChildShipmentsPayments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentsPaymentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentsPaymentsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ShipmentsPayments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentsPaymentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentsPaymentsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentsPaymentsQuery) {
            return $criteria;
        }
        $query = new ChildShipmentsPaymentsQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $collection_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildShipmentsPayments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShipmentsPaymentsTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsPaymentsTableMap::DATABASE_NAME);
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
     * @return ChildShipmentsPayments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_shipment`, `preference_id`, `collection_id`, `collection_status`, `merchant_order_id`, `total_paid_amount`, `net_received_amount`, `registered_at`, `fee_mp`, `fee_nv`, `card_type_id`, `card_method_id`, `card_expiration_month`, `card_expiration_year`, `card_cardholder_identification_type`, `card_cardholder_identification_number`, `card_cardholder_name`, `card_date_created`, `card_date_last_updated` FROM `shipments_payments` WHERE `id` = :p0 AND `collection_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildShipmentsPayments $obj */
            $obj = new ChildShipmentsPayments();
            $obj->hydrate($row);
            ShipmentsPaymentsTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildShipmentsPayments|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_COLLECTION_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ShipmentsPaymentsTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ShipmentsPaymentsTableMap::COL_COLLECTION_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
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
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
    }

    /**
     * Filter the query on the preference_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPreferenceId('fooValue');   // WHERE preference_id = 'fooValue'
     * $query->filterByPreferenceId('%fooValue%'); // WHERE preference_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $preferenceId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByPreferenceId($preferenceId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($preferenceId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $preferenceId)) {
                $preferenceId = str_replace('*', '%', $preferenceId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_PREFERENCE_ID, $preferenceId, $comparison);
    }

    /**
     * Filter the query on the collection_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCollectionId('fooValue');   // WHERE collection_id = 'fooValue'
     * $query->filterByCollectionId('%fooValue%'); // WHERE collection_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $collectionId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCollectionId($collectionId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($collectionId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $collectionId)) {
                $collectionId = str_replace('*', '%', $collectionId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_COLLECTION_ID, $collectionId, $comparison);
    }

    /**
     * Filter the query on the collection_status column
     *
     * Example usage:
     * <code>
     * $query->filterByCollectionStatus('fooValue');   // WHERE collection_status = 'fooValue'
     * $query->filterByCollectionStatus('%fooValue%'); // WHERE collection_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $collectionStatus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCollectionStatus($collectionStatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($collectionStatus)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $collectionStatus)) {
                $collectionStatus = str_replace('*', '%', $collectionStatus);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_COLLECTION_STATUS, $collectionStatus, $comparison);
    }

    /**
     * Filter the query on the merchant_order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantOrderId('fooValue');   // WHERE merchant_order_id = 'fooValue'
     * $query->filterByMerchantOrderId('%fooValue%'); // WHERE merchant_order_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $merchantOrderId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByMerchantOrderId($merchantOrderId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($merchantOrderId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $merchantOrderId)) {
                $merchantOrderId = str_replace('*', '%', $merchantOrderId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_MERCHANT_ORDER_ID, $merchantOrderId, $comparison);
    }

    /**
     * Filter the query on the total_paid_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalPaidAmount(1234); // WHERE total_paid_amount = 1234
     * $query->filterByTotalPaidAmount(array(12, 34)); // WHERE total_paid_amount IN (12, 34)
     * $query->filterByTotalPaidAmount(array('min' => 12)); // WHERE total_paid_amount > 12
     * </code>
     *
     * @param     mixed $totalPaidAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByTotalPaidAmount($totalPaidAmount = null, $comparison = null)
    {
        if (is_array($totalPaidAmount)) {
            $useMinMax = false;
            if (isset($totalPaidAmount['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_TOTAL_PAID_AMOUNT, $totalPaidAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalPaidAmount['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_TOTAL_PAID_AMOUNT, $totalPaidAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_TOTAL_PAID_AMOUNT, $totalPaidAmount, $comparison);
    }

    /**
     * Filter the query on the net_received_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByNetReceivedAmount(1234); // WHERE net_received_amount = 1234
     * $query->filterByNetReceivedAmount(array(12, 34)); // WHERE net_received_amount IN (12, 34)
     * $query->filterByNetReceivedAmount(array('min' => 12)); // WHERE net_received_amount > 12
     * </code>
     *
     * @param     mixed $netReceivedAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByNetReceivedAmount($netReceivedAmount = null, $comparison = null)
    {
        if (is_array($netReceivedAmount)) {
            $useMinMax = false;
            if (isset($netReceivedAmount['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_NET_RECEIVED_AMOUNT, $netReceivedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netReceivedAmount['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_NET_RECEIVED_AMOUNT, $netReceivedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_NET_RECEIVED_AMOUNT, $netReceivedAmount, $comparison);
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
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
    }

    /**
     * Filter the query on the fee_mp column
     *
     * Example usage:
     * <code>
     * $query->filterByFeeMp(1234); // WHERE fee_mp = 1234
     * $query->filterByFeeMp(array(12, 34)); // WHERE fee_mp IN (12, 34)
     * $query->filterByFeeMp(array('min' => 12)); // WHERE fee_mp > 12
     * </code>
     *
     * @param     mixed $feeMp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByFeeMp($feeMp = null, $comparison = null)
    {
        if (is_array($feeMp)) {
            $useMinMax = false;
            if (isset($feeMp['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_FEE_MP, $feeMp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($feeMp['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_FEE_MP, $feeMp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_FEE_MP, $feeMp, $comparison);
    }

    /**
     * Filter the query on the fee_nv column
     *
     * Example usage:
     * <code>
     * $query->filterByFeeNv(1234); // WHERE fee_nv = 1234
     * $query->filterByFeeNv(array(12, 34)); // WHERE fee_nv IN (12, 34)
     * $query->filterByFeeNv(array('min' => 12)); // WHERE fee_nv > 12
     * </code>
     *
     * @param     mixed $feeNv The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByFeeNv($feeNv = null, $comparison = null)
    {
        if (is_array($feeNv)) {
            $useMinMax = false;
            if (isset($feeNv['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_FEE_NV, $feeNv['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($feeNv['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_FEE_NV, $feeNv['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_FEE_NV, $feeNv, $comparison);
    }

    /**
     * Filter the query on the card_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCardTypeId('fooValue');   // WHERE card_type_id = 'fooValue'
     * $query->filterByCardTypeId('%fooValue%'); // WHERE card_type_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cardTypeId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardTypeId($cardTypeId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cardTypeId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cardTypeId)) {
                $cardTypeId = str_replace('*', '%', $cardTypeId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_TYPE_ID, $cardTypeId, $comparison);
    }

    /**
     * Filter the query on the card_method_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCardMethodId('fooValue');   // WHERE card_method_id = 'fooValue'
     * $query->filterByCardMethodId('%fooValue%'); // WHERE card_method_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cardMethodId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardMethodId($cardMethodId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cardMethodId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cardMethodId)) {
                $cardMethodId = str_replace('*', '%', $cardMethodId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_METHOD_ID, $cardMethodId, $comparison);
    }

    /**
     * Filter the query on the card_expiration_month column
     *
     * Example usage:
     * <code>
     * $query->filterByCardExpirationMonth(1234); // WHERE card_expiration_month = 1234
     * $query->filterByCardExpirationMonth(array(12, 34)); // WHERE card_expiration_month IN (12, 34)
     * $query->filterByCardExpirationMonth(array('min' => 12)); // WHERE card_expiration_month > 12
     * </code>
     *
     * @param     mixed $cardExpirationMonth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardExpirationMonth($cardExpirationMonth = null, $comparison = null)
    {
        if (is_array($cardExpirationMonth)) {
            $useMinMax = false;
            if (isset($cardExpirationMonth['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_MONTH, $cardExpirationMonth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cardExpirationMonth['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_MONTH, $cardExpirationMonth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_MONTH, $cardExpirationMonth, $comparison);
    }

    /**
     * Filter the query on the card_expiration_year column
     *
     * Example usage:
     * <code>
     * $query->filterByCardExpirationYear(1234); // WHERE card_expiration_year = 1234
     * $query->filterByCardExpirationYear(array(12, 34)); // WHERE card_expiration_year IN (12, 34)
     * $query->filterByCardExpirationYear(array('min' => 12)); // WHERE card_expiration_year > 12
     * </code>
     *
     * @param     mixed $cardExpirationYear The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardExpirationYear($cardExpirationYear = null, $comparison = null)
    {
        if (is_array($cardExpirationYear)) {
            $useMinMax = false;
            if (isset($cardExpirationYear['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_YEAR, $cardExpirationYear['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cardExpirationYear['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_YEAR, $cardExpirationYear['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_EXPIRATION_YEAR, $cardExpirationYear, $comparison);
    }

    /**
     * Filter the query on the card_cardholder_identification_type column
     *
     * Example usage:
     * <code>
     * $query->filterByCardCardholderIdentificationType('fooValue');   // WHERE card_cardholder_identification_type = 'fooValue'
     * $query->filterByCardCardholderIdentificationType('%fooValue%'); // WHERE card_cardholder_identification_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cardCardholderIdentificationType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardCardholderIdentificationType($cardCardholderIdentificationType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cardCardholderIdentificationType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cardCardholderIdentificationType)) {
                $cardCardholderIdentificationType = str_replace('*', '%', $cardCardholderIdentificationType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE, $cardCardholderIdentificationType, $comparison);
    }

    /**
     * Filter the query on the card_cardholder_identification_number column
     *
     * Example usage:
     * <code>
     * $query->filterByCardCardholderIdentificationNumber('fooValue');   // WHERE card_cardholder_identification_number = 'fooValue'
     * $query->filterByCardCardholderIdentificationNumber('%fooValue%'); // WHERE card_cardholder_identification_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cardCardholderIdentificationNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardCardholderIdentificationNumber($cardCardholderIdentificationNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cardCardholderIdentificationNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cardCardholderIdentificationNumber)) {
                $cardCardholderIdentificationNumber = str_replace('*', '%', $cardCardholderIdentificationNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER, $cardCardholderIdentificationNumber, $comparison);
    }

    /**
     * Filter the query on the card_cardholder_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCardCardholderName('fooValue');   // WHERE card_cardholder_name = 'fooValue'
     * $query->filterByCardCardholderName('%fooValue%'); // WHERE card_cardholder_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cardCardholderName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardCardholderName($cardCardholderName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cardCardholderName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cardCardholderName)) {
                $cardCardholderName = str_replace('*', '%', $cardCardholderName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_CARDHOLDER_NAME, $cardCardholderName, $comparison);
    }

    /**
     * Filter the query on the card_date_created column
     *
     * Example usage:
     * <code>
     * $query->filterByCardDateCreated('2011-03-14'); // WHERE card_date_created = '2011-03-14'
     * $query->filterByCardDateCreated('now'); // WHERE card_date_created = '2011-03-14'
     * $query->filterByCardDateCreated(array('max' => 'yesterday')); // WHERE card_date_created > '2011-03-13'
     * </code>
     *
     * @param     mixed $cardDateCreated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardDateCreated($cardDateCreated = null, $comparison = null)
    {
        if (is_array($cardDateCreated)) {
            $useMinMax = false;
            if (isset($cardDateCreated['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_DATE_CREATED, $cardDateCreated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cardDateCreated['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_DATE_CREATED, $cardDateCreated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_DATE_CREATED, $cardDateCreated, $comparison);
    }

    /**
     * Filter the query on the card_date_last_updated column
     *
     * Example usage:
     * <code>
     * $query->filterByCardDateLastUpdated('2011-03-14'); // WHERE card_date_last_updated = '2011-03-14'
     * $query->filterByCardDateLastUpdated('now'); // WHERE card_date_last_updated = '2011-03-14'
     * $query->filterByCardDateLastUpdated(array('max' => 'yesterday')); // WHERE card_date_last_updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $cardDateLastUpdated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function filterByCardDateLastUpdated($cardDateLastUpdated = null, $comparison = null)
    {
        if (is_array($cardDateLastUpdated)) {
            $useMinMax = false;
            if (isset($cardDateLastUpdated['min'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_DATE_LAST_UPDATED, $cardDateLastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cardDateLastUpdated['max'])) {
                $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_DATE_LAST_UPDATED, $cardDateLastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsPaymentsTableMap::COL_CARD_DATE_LAST_UPDATED, $cardDateLastUpdated, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipmentsPayments $shipmentsPayments Object to remove from the list of results
     *
     * @return $this|ChildShipmentsPaymentsQuery The current query, for fluid interface
     */
    public function prune($shipmentsPayments = null)
    {
        if ($shipmentsPayments) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ShipmentsPaymentsTableMap::COL_ID), $shipmentsPayments->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ShipmentsPaymentsTableMap::COL_COLLECTION_ID), $shipmentsPayments->getCollectionId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipments_payments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsPaymentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentsPaymentsTableMap::clearInstancePool();
            ShipmentsPaymentsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsPaymentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentsPaymentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentsPaymentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentsPaymentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentsPaymentsQuery
