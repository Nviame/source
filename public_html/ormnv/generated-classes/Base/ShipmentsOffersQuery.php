<?php

namespace Base;

use \ShipmentsOffers as ChildShipmentsOffers;
use \ShipmentsOffersQuery as ChildShipmentsOffersQuery;
use \Exception;
use \PDO;
use Map\ShipmentsOffersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipments_offers' table.
 *
 *
 *
 * @method     ChildShipmentsOffersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentsOffersQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildShipmentsOffersQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildShipmentsOffersQuery orderByOffer($order = Criteria::ASC) Order by the offer column
 * @method     ChildShipmentsOffersQuery orderByTransportId($order = Criteria::ASC) Order by the transport_id column
 * @method     ChildShipmentsOffersQuery orderByTransportType($order = Criteria::ASC) Order by the transport_type column
 * @method     ChildShipmentsOffersQuery orderByEstimatedArrivalDate($order = Criteria::ASC) Order by the estimated_arrival_date column
 * @method     ChildShipmentsOffersQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildShipmentsOffersQuery orderByAcceptedAt($order = Criteria::ASC) Order by the accepted_at column
 * @method     ChildShipmentsOffersQuery orderByApproximateArrivalValue($order = Criteria::ASC) Order by the approximate_arrival_value column
 * @method     ChildShipmentsOffersQuery orderByApproximateArrivalDesc($order = Criteria::ASC) Order by the approximate_arrival_desc column
 * @method     ChildShipmentsOffersQuery orderByApproximateDistanceValue($order = Criteria::ASC) Order by the approximate_distance_value column
 * @method     ChildShipmentsOffersQuery orderByApproximateDistanceDesc($order = Criteria::ASC) Order by the approximate_distance_desc column
 * @method     ChildShipmentsOffersQuery orderByReaded($order = Criteria::ASC) Order by the readed column
 *
 * @method     ChildShipmentsOffersQuery groupById() Group by the id column
 * @method     ChildShipmentsOffersQuery groupByIdUser() Group by the id_user column
 * @method     ChildShipmentsOffersQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildShipmentsOffersQuery groupByOffer() Group by the offer column
 * @method     ChildShipmentsOffersQuery groupByTransportId() Group by the transport_id column
 * @method     ChildShipmentsOffersQuery groupByTransportType() Group by the transport_type column
 * @method     ChildShipmentsOffersQuery groupByEstimatedArrivalDate() Group by the estimated_arrival_date column
 * @method     ChildShipmentsOffersQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildShipmentsOffersQuery groupByAcceptedAt() Group by the accepted_at column
 * @method     ChildShipmentsOffersQuery groupByApproximateArrivalValue() Group by the approximate_arrival_value column
 * @method     ChildShipmentsOffersQuery groupByApproximateArrivalDesc() Group by the approximate_arrival_desc column
 * @method     ChildShipmentsOffersQuery groupByApproximateDistanceValue() Group by the approximate_distance_value column
 * @method     ChildShipmentsOffersQuery groupByApproximateDistanceDesc() Group by the approximate_distance_desc column
 * @method     ChildShipmentsOffersQuery groupByReaded() Group by the readed column
 *
 * @method     ChildShipmentsOffersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentsOffersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentsOffersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentsOffers findOne(ConnectionInterface $con = null) Return the first ChildShipmentsOffers matching the query
 * @method     ChildShipmentsOffers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentsOffers matching the query, or a new ChildShipmentsOffers object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentsOffers findOneById(int $id) Return the first ChildShipmentsOffers filtered by the id column
 * @method     ChildShipmentsOffers findOneByIdUser(int $id_user) Return the first ChildShipmentsOffers filtered by the id_user column
 * @method     ChildShipmentsOffers findOneByIdShipment(int $id_shipment) Return the first ChildShipmentsOffers filtered by the id_shipment column
 * @method     ChildShipmentsOffers findOneByOffer(double $offer) Return the first ChildShipmentsOffers filtered by the offer column
 * @method     ChildShipmentsOffers findOneByTransportId(int $transport_id) Return the first ChildShipmentsOffers filtered by the transport_id column
 * @method     ChildShipmentsOffers findOneByTransportType(int $transport_type) Return the first ChildShipmentsOffers filtered by the transport_type column
 * @method     ChildShipmentsOffers findOneByEstimatedArrivalDate(string $estimated_arrival_date) Return the first ChildShipmentsOffers filtered by the estimated_arrival_date column
 * @method     ChildShipmentsOffers findOneByRegisteredAt(string $registered_at) Return the first ChildShipmentsOffers filtered by the registered_at column
 * @method     ChildShipmentsOffers findOneByAcceptedAt(string $accepted_at) Return the first ChildShipmentsOffers filtered by the accepted_at column
 * @method     ChildShipmentsOffers findOneByApproximateArrivalValue(double $approximate_arrival_value) Return the first ChildShipmentsOffers filtered by the approximate_arrival_value column
 * @method     ChildShipmentsOffers findOneByApproximateArrivalDesc(string $approximate_arrival_desc) Return the first ChildShipmentsOffers filtered by the approximate_arrival_desc column
 * @method     ChildShipmentsOffers findOneByApproximateDistanceValue(double $approximate_distance_value) Return the first ChildShipmentsOffers filtered by the approximate_distance_value column
 * @method     ChildShipmentsOffers findOneByApproximateDistanceDesc(string $approximate_distance_desc) Return the first ChildShipmentsOffers filtered by the approximate_distance_desc column
 * @method     ChildShipmentsOffers findOneByReaded(boolean $readed) Return the first ChildShipmentsOffers filtered by the readed column *

 * @method     ChildShipmentsOffers requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentsOffers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOne(ConnectionInterface $con = null) Return the first ChildShipmentsOffers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsOffers requireOneById(int $id) Return the first ChildShipmentsOffers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByIdUser(int $id_user) Return the first ChildShipmentsOffers filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByIdShipment(int $id_shipment) Return the first ChildShipmentsOffers filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByOffer(double $offer) Return the first ChildShipmentsOffers filtered by the offer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByTransportId(int $transport_id) Return the first ChildShipmentsOffers filtered by the transport_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByTransportType(int $transport_type) Return the first ChildShipmentsOffers filtered by the transport_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByEstimatedArrivalDate(string $estimated_arrival_date) Return the first ChildShipmentsOffers filtered by the estimated_arrival_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByRegisteredAt(string $registered_at) Return the first ChildShipmentsOffers filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByAcceptedAt(string $accepted_at) Return the first ChildShipmentsOffers filtered by the accepted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByApproximateArrivalValue(double $approximate_arrival_value) Return the first ChildShipmentsOffers filtered by the approximate_arrival_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByApproximateArrivalDesc(string $approximate_arrival_desc) Return the first ChildShipmentsOffers filtered by the approximate_arrival_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByApproximateDistanceValue(double $approximate_distance_value) Return the first ChildShipmentsOffers filtered by the approximate_distance_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByApproximateDistanceDesc(string $approximate_distance_desc) Return the first ChildShipmentsOffers filtered by the approximate_distance_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsOffers requireOneByReaded(boolean $readed) Return the first ChildShipmentsOffers filtered by the readed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsOffers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentsOffers objects based on current ModelCriteria
 * @method     ChildShipmentsOffers[]|ObjectCollection findById(int $id) Return ChildShipmentsOffers objects filtered by the id column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByIdUser(int $id_user) Return ChildShipmentsOffers objects filtered by the id_user column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildShipmentsOffers objects filtered by the id_shipment column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByOffer(double $offer) Return ChildShipmentsOffers objects filtered by the offer column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByTransportId(int $transport_id) Return ChildShipmentsOffers objects filtered by the transport_id column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByTransportType(int $transport_type) Return ChildShipmentsOffers objects filtered by the transport_type column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByEstimatedArrivalDate(string $estimated_arrival_date) Return ChildShipmentsOffers objects filtered by the estimated_arrival_date column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildShipmentsOffers objects filtered by the registered_at column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByAcceptedAt(string $accepted_at) Return ChildShipmentsOffers objects filtered by the accepted_at column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByApproximateArrivalValue(double $approximate_arrival_value) Return ChildShipmentsOffers objects filtered by the approximate_arrival_value column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByApproximateArrivalDesc(string $approximate_arrival_desc) Return ChildShipmentsOffers objects filtered by the approximate_arrival_desc column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByApproximateDistanceValue(double $approximate_distance_value) Return ChildShipmentsOffers objects filtered by the approximate_distance_value column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByApproximateDistanceDesc(string $approximate_distance_desc) Return ChildShipmentsOffers objects filtered by the approximate_distance_desc column
 * @method     ChildShipmentsOffers[]|ObjectCollection findByReaded(boolean $readed) Return ChildShipmentsOffers objects filtered by the readed column
 * @method     ChildShipmentsOffers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentsOffersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentsOffersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ShipmentsOffers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentsOffersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentsOffersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentsOffersQuery) {
            return $criteria;
        }
        $query = new ChildShipmentsOffersQuery();
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
     * @return ChildShipmentsOffers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShipmentsOffersTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsOffersTableMap::DATABASE_NAME);
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
     * @return ChildShipmentsOffers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_shipment`, `offer`, `transport_id`, `transport_type`, `estimated_arrival_date`, `registered_at`, `accepted_at`, `approximate_arrival_value`, `approximate_arrival_desc`, `approximate_distance_value`, `approximate_distance_desc`, `readed` FROM `shipments_offers` WHERE `id` = :p0';
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
            /** @var ChildShipmentsOffers $obj */
            $obj = new ChildShipmentsOffers();
            $obj->hydrate($row);
            ShipmentsOffersTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildShipmentsOffers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID_USER, $idUser, $comparison);
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
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
    }

    /**
     * Filter the query on the offer column
     *
     * Example usage:
     * <code>
     * $query->filterByOffer(1234); // WHERE offer = 1234
     * $query->filterByOffer(array(12, 34)); // WHERE offer IN (12, 34)
     * $query->filterByOffer(array('min' => 12)); // WHERE offer > 12
     * </code>
     *
     * @param     mixed $offer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByOffer($offer = null, $comparison = null)
    {
        if (is_array($offer)) {
            $useMinMax = false;
            if (isset($offer['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_OFFER, $offer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($offer['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_OFFER, $offer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_OFFER, $offer, $comparison);
    }

    /**
     * Filter the query on the transport_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTransportId(1234); // WHERE transport_id = 1234
     * $query->filterByTransportId(array(12, 34)); // WHERE transport_id IN (12, 34)
     * $query->filterByTransportId(array('min' => 12)); // WHERE transport_id > 12
     * </code>
     *
     * @param     mixed $transportId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByTransportId($transportId = null, $comparison = null)
    {
        if (is_array($transportId)) {
            $useMinMax = false;
            if (isset($transportId['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_TRANSPORT_ID, $transportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transportId['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_TRANSPORT_ID, $transportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_TRANSPORT_ID, $transportId, $comparison);
    }

    /**
     * Filter the query on the transport_type column
     *
     * Example usage:
     * <code>
     * $query->filterByTransportType(1234); // WHERE transport_type = 1234
     * $query->filterByTransportType(array(12, 34)); // WHERE transport_type IN (12, 34)
     * $query->filterByTransportType(array('min' => 12)); // WHERE transport_type > 12
     * </code>
     *
     * @param     mixed $transportType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByTransportType($transportType = null, $comparison = null)
    {
        if (is_array($transportType)) {
            $useMinMax = false;
            if (isset($transportType['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_TRANSPORT_TYPE, $transportType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transportType['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_TRANSPORT_TYPE, $transportType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_TRANSPORT_TYPE, $transportType, $comparison);
    }

    /**
     * Filter the query on the estimated_arrival_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEstimatedArrivalDate('2011-03-14'); // WHERE estimated_arrival_date = '2011-03-14'
     * $query->filterByEstimatedArrivalDate('now'); // WHERE estimated_arrival_date = '2011-03-14'
     * $query->filterByEstimatedArrivalDate(array('max' => 'yesterday')); // WHERE estimated_arrival_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $estimatedArrivalDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByEstimatedArrivalDate($estimatedArrivalDate = null, $comparison = null)
    {
        if (is_array($estimatedArrivalDate)) {
            $useMinMax = false;
            if (isset($estimatedArrivalDate['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ESTIMATED_ARRIVAL_DATE, $estimatedArrivalDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estimatedArrivalDate['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ESTIMATED_ARRIVAL_DATE, $estimatedArrivalDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_ESTIMATED_ARRIVAL_DATE, $estimatedArrivalDate, $comparison);
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
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
    }

    /**
     * Filter the query on the accepted_at column
     *
     * Example usage:
     * <code>
     * $query->filterByAcceptedAt('2011-03-14'); // WHERE accepted_at = '2011-03-14'
     * $query->filterByAcceptedAt('now'); // WHERE accepted_at = '2011-03-14'
     * $query->filterByAcceptedAt(array('max' => 'yesterday')); // WHERE accepted_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $acceptedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByAcceptedAt($acceptedAt = null, $comparison = null)
    {
        if (is_array($acceptedAt)) {
            $useMinMax = false;
            if (isset($acceptedAt['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ACCEPTED_AT, $acceptedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($acceptedAt['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_ACCEPTED_AT, $acceptedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_ACCEPTED_AT, $acceptedAt, $comparison);
    }

    /**
     * Filter the query on the approximate_arrival_value column
     *
     * Example usage:
     * <code>
     * $query->filterByApproximateArrivalValue(1234); // WHERE approximate_arrival_value = 1234
     * $query->filterByApproximateArrivalValue(array(12, 34)); // WHERE approximate_arrival_value IN (12, 34)
     * $query->filterByApproximateArrivalValue(array('min' => 12)); // WHERE approximate_arrival_value > 12
     * </code>
     *
     * @param     mixed $approximateArrivalValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByApproximateArrivalValue($approximateArrivalValue = null, $comparison = null)
    {
        if (is_array($approximateArrivalValue)) {
            $useMinMax = false;
            if (isset($approximateArrivalValue['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_VALUE, $approximateArrivalValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approximateArrivalValue['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_VALUE, $approximateArrivalValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_VALUE, $approximateArrivalValue, $comparison);
    }

    /**
     * Filter the query on the approximate_arrival_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByApproximateArrivalDesc('fooValue');   // WHERE approximate_arrival_desc = 'fooValue'
     * $query->filterByApproximateArrivalDesc('%fooValue%'); // WHERE approximate_arrival_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $approximateArrivalDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByApproximateArrivalDesc($approximateArrivalDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($approximateArrivalDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $approximateArrivalDesc)) {
                $approximateArrivalDesc = str_replace('*', '%', $approximateArrivalDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_ARRIVAL_DESC, $approximateArrivalDesc, $comparison);
    }

    /**
     * Filter the query on the approximate_distance_value column
     *
     * Example usage:
     * <code>
     * $query->filterByApproximateDistanceValue(1234); // WHERE approximate_distance_value = 1234
     * $query->filterByApproximateDistanceValue(array(12, 34)); // WHERE approximate_distance_value IN (12, 34)
     * $query->filterByApproximateDistanceValue(array('min' => 12)); // WHERE approximate_distance_value > 12
     * </code>
     *
     * @param     mixed $approximateDistanceValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByApproximateDistanceValue($approximateDistanceValue = null, $comparison = null)
    {
        if (is_array($approximateDistanceValue)) {
            $useMinMax = false;
            if (isset($approximateDistanceValue['min'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_VALUE, $approximateDistanceValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approximateDistanceValue['max'])) {
                $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_VALUE, $approximateDistanceValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_VALUE, $approximateDistanceValue, $comparison);
    }

    /**
     * Filter the query on the approximate_distance_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByApproximateDistanceDesc('fooValue');   // WHERE approximate_distance_desc = 'fooValue'
     * $query->filterByApproximateDistanceDesc('%fooValue%'); // WHERE approximate_distance_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $approximateDistanceDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByApproximateDistanceDesc($approximateDistanceDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($approximateDistanceDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $approximateDistanceDesc)) {
                $approximateDistanceDesc = str_replace('*', '%', $approximateDistanceDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_APPROXIMATE_DISTANCE_DESC, $approximateDistanceDesc, $comparison);
    }

    /**
     * Filter the query on the readed column
     *
     * Example usage:
     * <code>
     * $query->filterByReaded(true); // WHERE readed = true
     * $query->filterByReaded('yes'); // WHERE readed = true
     * </code>
     *
     * @param     boolean|string $readed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function filterByReaded($readed = null, $comparison = null)
    {
        if (is_string($readed)) {
            $readed = in_array(strtolower($readed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ShipmentsOffersTableMap::COL_READED, $readed, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipmentsOffers $shipmentsOffers Object to remove from the list of results
     *
     * @return $this|ChildShipmentsOffersQuery The current query, for fluid interface
     */
    public function prune($shipmentsOffers = null)
    {
        if ($shipmentsOffers) {
            $this->addUsingAlias(ShipmentsOffersTableMap::COL_ID, $shipmentsOffers->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipments_offers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOffersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentsOffersTableMap::clearInstancePool();
            ShipmentsOffersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsOffersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentsOffersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentsOffersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentsOffersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentsOffersQuery
