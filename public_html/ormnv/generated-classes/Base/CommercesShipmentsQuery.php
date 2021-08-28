<?php

namespace Base;

use \CommercesShipments as ChildCommercesShipments;
use \CommercesShipmentsQuery as ChildCommercesShipmentsQuery;
use \Exception;
use \PDO;
use Map\CommercesShipmentsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'commerces_shipments' table.
 *
 *
 *
 * @method     ChildCommercesShipmentsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCommercesShipmentsQuery orderByIdCommerce($order = Criteria::ASC) Order by the id_commerce column
 * @method     ChildCommercesShipmentsQuery orderByIdRate($order = Criteria::ASC) Order by the id_rate column
 * @method     ChildCommercesShipmentsQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildCommercesShipmentsQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildCommercesShipmentsQuery orderByPickupAtName($order = Criteria::ASC) Order by the pickup_at_name column
 * @method     ChildCommercesShipmentsQuery orderByPickupAtLat($order = Criteria::ASC) Order by the pickup_at_lat column
 * @method     ChildCommercesShipmentsQuery orderByPickupAtLng($order = Criteria::ASC) Order by the pickup_at_lng column
 * @method     ChildCommercesShipmentsQuery orderByPickupAtLocality($order = Criteria::ASC) Order by the pickup_at_locality column
 * @method     ChildCommercesShipmentsQuery orderByPickupAtRegion($order = Criteria::ASC) Order by the pickup_at_region column
 * @method     ChildCommercesShipmentsQuery orderByPickupAtCountry($order = Criteria::ASC) Order by the pickup_at_country column
 * @method     ChildCommercesShipmentsQuery orderBySize($order = Criteria::ASC) Order by the size column
 * @method     ChildCommercesShipmentsQuery orderByPriority($order = Criteria::ASC) Order by the priority column
 * @method     ChildCommercesShipmentsQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildCommercesShipmentsQuery orderByTypeRate($order = Criteria::ASC) Order by the type_rate column
 * @method     ChildCommercesShipmentsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildCommercesShipmentsQuery orderByDeliveryDate($order = Criteria::ASC) Order by the delivery_date column
 * @method     ChildCommercesShipmentsQuery orderByDeliveryAddressLat($order = Criteria::ASC) Order by the delivery_address_lat column
 * @method     ChildCommercesShipmentsQuery orderByDeliveryAddressLng($order = Criteria::ASC) Order by the delivery_address_lng column
 * @method     ChildCommercesShipmentsQuery orderByDeliveryAddressLocality($order = Criteria::ASC) Order by the delivery_address_locality column
 * @method     ChildCommercesShipmentsQuery orderByDeliveryAddressRegion($order = Criteria::ASC) Order by the delivery_address_region column
 * @method     ChildCommercesShipmentsQuery orderByDeliveryAddressCountry($order = Criteria::ASC) Order by the delivery_address_country column
 * @method     ChildCommercesShipmentsQuery orderByAddresseeName($order = Criteria::ASC) Order by the addressee_name column
 * @method     ChildCommercesShipmentsQuery orderByAddresseePhone($order = Criteria::ASC) Order by the addressee_phone column
 * @method     ChildCommercesShipmentsQuery orderByDeliveryAddress($order = Criteria::ASC) Order by the delivery_address column
 * @method     ChildCommercesShipmentsQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildCommercesShipmentsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCommercesShipmentsQuery groupById() Group by the id column
 * @method     ChildCommercesShipmentsQuery groupByIdCommerce() Group by the id_commerce column
 * @method     ChildCommercesShipmentsQuery groupByIdRate() Group by the id_rate column
 * @method     ChildCommercesShipmentsQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildCommercesShipmentsQuery groupByUuid() Group by the uuid column
 * @method     ChildCommercesShipmentsQuery groupByPickupAtName() Group by the pickup_at_name column
 * @method     ChildCommercesShipmentsQuery groupByPickupAtLat() Group by the pickup_at_lat column
 * @method     ChildCommercesShipmentsQuery groupByPickupAtLng() Group by the pickup_at_lng column
 * @method     ChildCommercesShipmentsQuery groupByPickupAtLocality() Group by the pickup_at_locality column
 * @method     ChildCommercesShipmentsQuery groupByPickupAtRegion() Group by the pickup_at_region column
 * @method     ChildCommercesShipmentsQuery groupByPickupAtCountry() Group by the pickup_at_country column
 * @method     ChildCommercesShipmentsQuery groupBySize() Group by the size column
 * @method     ChildCommercesShipmentsQuery groupByPriority() Group by the priority column
 * @method     ChildCommercesShipmentsQuery groupByType() Group by the type column
 * @method     ChildCommercesShipmentsQuery groupByTypeRate() Group by the type_rate column
 * @method     ChildCommercesShipmentsQuery groupByDescription() Group by the description column
 * @method     ChildCommercesShipmentsQuery groupByDeliveryDate() Group by the delivery_date column
 * @method     ChildCommercesShipmentsQuery groupByDeliveryAddressLat() Group by the delivery_address_lat column
 * @method     ChildCommercesShipmentsQuery groupByDeliveryAddressLng() Group by the delivery_address_lng column
 * @method     ChildCommercesShipmentsQuery groupByDeliveryAddressLocality() Group by the delivery_address_locality column
 * @method     ChildCommercesShipmentsQuery groupByDeliveryAddressRegion() Group by the delivery_address_region column
 * @method     ChildCommercesShipmentsQuery groupByDeliveryAddressCountry() Group by the delivery_address_country column
 * @method     ChildCommercesShipmentsQuery groupByAddresseeName() Group by the addressee_name column
 * @method     ChildCommercesShipmentsQuery groupByAddresseePhone() Group by the addressee_phone column
 * @method     ChildCommercesShipmentsQuery groupByDeliveryAddress() Group by the delivery_address column
 * @method     ChildCommercesShipmentsQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildCommercesShipmentsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCommercesShipmentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommercesShipmentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommercesShipmentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommercesShipmentsQuery leftJoinCommercesRates($relationAlias = null) Adds a LEFT JOIN clause to the query using the CommercesRates relation
 * @method     ChildCommercesShipmentsQuery rightJoinCommercesRates($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CommercesRates relation
 * @method     ChildCommercesShipmentsQuery innerJoinCommercesRates($relationAlias = null) Adds a INNER JOIN clause to the query using the CommercesRates relation
 *
 * @method     \CommercesRatesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCommercesShipments findOne(ConnectionInterface $con = null) Return the first ChildCommercesShipments matching the query
 * @method     ChildCommercesShipments findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCommercesShipments matching the query, or a new ChildCommercesShipments object populated from the query conditions when no match is found
 *
 * @method     ChildCommercesShipments findOneById(int $id) Return the first ChildCommercesShipments filtered by the id column
 * @method     ChildCommercesShipments findOneByIdCommerce(int $id_commerce) Return the first ChildCommercesShipments filtered by the id_commerce column
 * @method     ChildCommercesShipments findOneByIdRate(int $id_rate) Return the first ChildCommercesShipments filtered by the id_rate column
 * @method     ChildCommercesShipments findOneByIdShipment(int $id_shipment) Return the first ChildCommercesShipments filtered by the id_shipment column
 * @method     ChildCommercesShipments findOneByUuid(string $uuid) Return the first ChildCommercesShipments filtered by the uuid column
 * @method     ChildCommercesShipments findOneByPickupAtName(string $pickup_at_name) Return the first ChildCommercesShipments filtered by the pickup_at_name column
 * @method     ChildCommercesShipments findOneByPickupAtLat(string $pickup_at_lat) Return the first ChildCommercesShipments filtered by the pickup_at_lat column
 * @method     ChildCommercesShipments findOneByPickupAtLng(string $pickup_at_lng) Return the first ChildCommercesShipments filtered by the pickup_at_lng column
 * @method     ChildCommercesShipments findOneByPickupAtLocality(string $pickup_at_locality) Return the first ChildCommercesShipments filtered by the pickup_at_locality column
 * @method     ChildCommercesShipments findOneByPickupAtRegion(string $pickup_at_region) Return the first ChildCommercesShipments filtered by the pickup_at_region column
 * @method     ChildCommercesShipments findOneByPickupAtCountry(string $pickup_at_country) Return the first ChildCommercesShipments filtered by the pickup_at_country column
 * @method     ChildCommercesShipments findOneBySize(string $size) Return the first ChildCommercesShipments filtered by the size column
 * @method     ChildCommercesShipments findOneByPriority(int $priority) Return the first ChildCommercesShipments filtered by the priority column
 * @method     ChildCommercesShipments findOneByType(int $type) Return the first ChildCommercesShipments filtered by the type column
 * @method     ChildCommercesShipments findOneByTypeRate(int $type_rate) Return the first ChildCommercesShipments filtered by the type_rate column
 * @method     ChildCommercesShipments findOneByDescription(string $description) Return the first ChildCommercesShipments filtered by the description column
 * @method     ChildCommercesShipments findOneByDeliveryDate(string $delivery_date) Return the first ChildCommercesShipments filtered by the delivery_date column
 * @method     ChildCommercesShipments findOneByDeliveryAddressLat(string $delivery_address_lat) Return the first ChildCommercesShipments filtered by the delivery_address_lat column
 * @method     ChildCommercesShipments findOneByDeliveryAddressLng(string $delivery_address_lng) Return the first ChildCommercesShipments filtered by the delivery_address_lng column
 * @method     ChildCommercesShipments findOneByDeliveryAddressLocality(string $delivery_address_locality) Return the first ChildCommercesShipments filtered by the delivery_address_locality column
 * @method     ChildCommercesShipments findOneByDeliveryAddressRegion(string $delivery_address_region) Return the first ChildCommercesShipments filtered by the delivery_address_region column
 * @method     ChildCommercesShipments findOneByDeliveryAddressCountry(string $delivery_address_country) Return the first ChildCommercesShipments filtered by the delivery_address_country column
 * @method     ChildCommercesShipments findOneByAddresseeName(string $addressee_name) Return the first ChildCommercesShipments filtered by the addressee_name column
 * @method     ChildCommercesShipments findOneByAddresseePhone(string $addressee_phone) Return the first ChildCommercesShipments filtered by the addressee_phone column
 * @method     ChildCommercesShipments findOneByDeliveryAddress(string $delivery_address) Return the first ChildCommercesShipments filtered by the delivery_address column
 * @method     ChildCommercesShipments findOneByRegisteredAt(string $registered_at) Return the first ChildCommercesShipments filtered by the registered_at column
 * @method     ChildCommercesShipments findOneByUpdatedAt(string $updated_at) Return the first ChildCommercesShipments filtered by the updated_at column *

 * @method     ChildCommercesShipments requirePk($key, ConnectionInterface $con = null) Return the ChildCommercesShipments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOne(ConnectionInterface $con = null) Return the first ChildCommercesShipments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesShipments requireOneById(int $id) Return the first ChildCommercesShipments filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByIdCommerce(int $id_commerce) Return the first ChildCommercesShipments filtered by the id_commerce column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByIdRate(int $id_rate) Return the first ChildCommercesShipments filtered by the id_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByIdShipment(int $id_shipment) Return the first ChildCommercesShipments filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByUuid(string $uuid) Return the first ChildCommercesShipments filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByPickupAtName(string $pickup_at_name) Return the first ChildCommercesShipments filtered by the pickup_at_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByPickupAtLat(string $pickup_at_lat) Return the first ChildCommercesShipments filtered by the pickup_at_lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByPickupAtLng(string $pickup_at_lng) Return the first ChildCommercesShipments filtered by the pickup_at_lng column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByPickupAtLocality(string $pickup_at_locality) Return the first ChildCommercesShipments filtered by the pickup_at_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByPickupAtRegion(string $pickup_at_region) Return the first ChildCommercesShipments filtered by the pickup_at_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByPickupAtCountry(string $pickup_at_country) Return the first ChildCommercesShipments filtered by the pickup_at_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneBySize(string $size) Return the first ChildCommercesShipments filtered by the size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByPriority(int $priority) Return the first ChildCommercesShipments filtered by the priority column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByType(int $type) Return the first ChildCommercesShipments filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByTypeRate(int $type_rate) Return the first ChildCommercesShipments filtered by the type_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDescription(string $description) Return the first ChildCommercesShipments filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDeliveryDate(string $delivery_date) Return the first ChildCommercesShipments filtered by the delivery_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDeliveryAddressLat(string $delivery_address_lat) Return the first ChildCommercesShipments filtered by the delivery_address_lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDeliveryAddressLng(string $delivery_address_lng) Return the first ChildCommercesShipments filtered by the delivery_address_lng column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDeliveryAddressLocality(string $delivery_address_locality) Return the first ChildCommercesShipments filtered by the delivery_address_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDeliveryAddressRegion(string $delivery_address_region) Return the first ChildCommercesShipments filtered by the delivery_address_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDeliveryAddressCountry(string $delivery_address_country) Return the first ChildCommercesShipments filtered by the delivery_address_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByAddresseeName(string $addressee_name) Return the first ChildCommercesShipments filtered by the addressee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByAddresseePhone(string $addressee_phone) Return the first ChildCommercesShipments filtered by the addressee_phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByDeliveryAddress(string $delivery_address) Return the first ChildCommercesShipments filtered by the delivery_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByRegisteredAt(string $registered_at) Return the first ChildCommercesShipments filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCommercesShipments requireOneByUpdatedAt(string $updated_at) Return the first ChildCommercesShipments filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCommercesShipments[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCommercesShipments objects based on current ModelCriteria
 * @method     ChildCommercesShipments[]|ObjectCollection findById(int $id) Return ChildCommercesShipments objects filtered by the id column
 * @method     ChildCommercesShipments[]|ObjectCollection findByIdCommerce(int $id_commerce) Return ChildCommercesShipments objects filtered by the id_commerce column
 * @method     ChildCommercesShipments[]|ObjectCollection findByIdRate(int $id_rate) Return ChildCommercesShipments objects filtered by the id_rate column
 * @method     ChildCommercesShipments[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildCommercesShipments objects filtered by the id_shipment column
 * @method     ChildCommercesShipments[]|ObjectCollection findByUuid(string $uuid) Return ChildCommercesShipments objects filtered by the uuid column
 * @method     ChildCommercesShipments[]|ObjectCollection findByPickupAtName(string $pickup_at_name) Return ChildCommercesShipments objects filtered by the pickup_at_name column
 * @method     ChildCommercesShipments[]|ObjectCollection findByPickupAtLat(string $pickup_at_lat) Return ChildCommercesShipments objects filtered by the pickup_at_lat column
 * @method     ChildCommercesShipments[]|ObjectCollection findByPickupAtLng(string $pickup_at_lng) Return ChildCommercesShipments objects filtered by the pickup_at_lng column
 * @method     ChildCommercesShipments[]|ObjectCollection findByPickupAtLocality(string $pickup_at_locality) Return ChildCommercesShipments objects filtered by the pickup_at_locality column
 * @method     ChildCommercesShipments[]|ObjectCollection findByPickupAtRegion(string $pickup_at_region) Return ChildCommercesShipments objects filtered by the pickup_at_region column
 * @method     ChildCommercesShipments[]|ObjectCollection findByPickupAtCountry(string $pickup_at_country) Return ChildCommercesShipments objects filtered by the pickup_at_country column
 * @method     ChildCommercesShipments[]|ObjectCollection findBySize(string $size) Return ChildCommercesShipments objects filtered by the size column
 * @method     ChildCommercesShipments[]|ObjectCollection findByPriority(int $priority) Return ChildCommercesShipments objects filtered by the priority column
 * @method     ChildCommercesShipments[]|ObjectCollection findByType(int $type) Return ChildCommercesShipments objects filtered by the type column
 * @method     ChildCommercesShipments[]|ObjectCollection findByTypeRate(int $type_rate) Return ChildCommercesShipments objects filtered by the type_rate column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDescription(string $description) Return ChildCommercesShipments objects filtered by the description column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDeliveryDate(string $delivery_date) Return ChildCommercesShipments objects filtered by the delivery_date column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDeliveryAddressLat(string $delivery_address_lat) Return ChildCommercesShipments objects filtered by the delivery_address_lat column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDeliveryAddressLng(string $delivery_address_lng) Return ChildCommercesShipments objects filtered by the delivery_address_lng column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDeliveryAddressLocality(string $delivery_address_locality) Return ChildCommercesShipments objects filtered by the delivery_address_locality column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDeliveryAddressRegion(string $delivery_address_region) Return ChildCommercesShipments objects filtered by the delivery_address_region column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDeliveryAddressCountry(string $delivery_address_country) Return ChildCommercesShipments objects filtered by the delivery_address_country column
 * @method     ChildCommercesShipments[]|ObjectCollection findByAddresseeName(string $addressee_name) Return ChildCommercesShipments objects filtered by the addressee_name column
 * @method     ChildCommercesShipments[]|ObjectCollection findByAddresseePhone(string $addressee_phone) Return ChildCommercesShipments objects filtered by the addressee_phone column
 * @method     ChildCommercesShipments[]|ObjectCollection findByDeliveryAddress(string $delivery_address) Return ChildCommercesShipments objects filtered by the delivery_address column
 * @method     ChildCommercesShipments[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildCommercesShipments objects filtered by the registered_at column
 * @method     ChildCommercesShipments[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCommercesShipments objects filtered by the updated_at column
 * @method     ChildCommercesShipments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommercesShipmentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CommercesShipmentsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CommercesShipments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommercesShipmentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommercesShipmentsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCommercesShipmentsQuery) {
            return $criteria;
        }
        $query = new ChildCommercesShipmentsQuery();
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
     * @return ChildCommercesShipments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommercesShipmentsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommercesShipmentsTableMap::DATABASE_NAME);
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
     * @return ChildCommercesShipments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_commerce`, `id_rate`, `id_shipment`, `uuid`, `pickup_at_name`, `pickup_at_lat`, `pickup_at_lng`, `pickup_at_locality`, `pickup_at_region`, `pickup_at_country`, `size`, `priority`, `type`, `type_rate`, `description`, `delivery_date`, `delivery_address_lat`, `delivery_address_lng`, `delivery_address_locality`, `delivery_address_region`, `delivery_address_country`, `addressee_name`, `addressee_phone`, `delivery_address`, `registered_at`, `updated_at` FROM `commerces_shipments` WHERE `id` = :p0';
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
            /** @var ChildCommercesShipments $obj */
            $obj = new ChildCommercesShipments();
            $obj->hydrate($row);
            CommercesShipmentsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCommercesShipments|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByIdCommerce($idCommerce = null, $comparison = null)
    {
        if (is_array($idCommerce)) {
            $useMinMax = false;
            if (isset($idCommerce['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_COMMERCE, $idCommerce['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCommerce['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_COMMERCE, $idCommerce['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_COMMERCE, $idCommerce, $comparison);
    }

    /**
     * Filter the query on the id_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByIdRate(1234); // WHERE id_rate = 1234
     * $query->filterByIdRate(array(12, 34)); // WHERE id_rate IN (12, 34)
     * $query->filterByIdRate(array('min' => 12)); // WHERE id_rate > 12
     * </code>
     *
     * @see       filterByCommercesRates()
     *
     * @param     mixed $idRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByIdRate($idRate = null, $comparison = null)
    {
        if (is_array($idRate)) {
            $useMinMax = false;
            if (isset($idRate['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_RATE, $idRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idRate['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_RATE, $idRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_RATE, $idRate, $comparison);
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%'); // WHERE uuid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByUuid($uuid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uuid)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uuid)) {
                $uuid = str_replace('*', '%', $uuid);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_UUID, $uuid, $comparison);
    }

    /**
     * Filter the query on the pickup_at_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPickupAtName('fooValue');   // WHERE pickup_at_name = 'fooValue'
     * $query->filterByPickupAtName('%fooValue%'); // WHERE pickup_at_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pickupAtName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPickupAtName($pickupAtName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pickupAtName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pickupAtName)) {
                $pickupAtName = str_replace('*', '%', $pickupAtName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_PICKUP_AT_NAME, $pickupAtName, $comparison);
    }

    /**
     * Filter the query on the pickup_at_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByPickupAtLat('fooValue');   // WHERE pickup_at_lat = 'fooValue'
     * $query->filterByPickupAtLat('%fooValue%'); // WHERE pickup_at_lat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pickupAtLat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPickupAtLat($pickupAtLat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pickupAtLat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pickupAtLat)) {
                $pickupAtLat = str_replace('*', '%', $pickupAtLat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_PICKUP_AT_LAT, $pickupAtLat, $comparison);
    }

    /**
     * Filter the query on the pickup_at_lng column
     *
     * Example usage:
     * <code>
     * $query->filterByPickupAtLng('fooValue');   // WHERE pickup_at_lng = 'fooValue'
     * $query->filterByPickupAtLng('%fooValue%'); // WHERE pickup_at_lng LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pickupAtLng The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPickupAtLng($pickupAtLng = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pickupAtLng)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pickupAtLng)) {
                $pickupAtLng = str_replace('*', '%', $pickupAtLng);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_PICKUP_AT_LNG, $pickupAtLng, $comparison);
    }

    /**
     * Filter the query on the pickup_at_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByPickupAtLocality('fooValue');   // WHERE pickup_at_locality = 'fooValue'
     * $query->filterByPickupAtLocality('%fooValue%'); // WHERE pickup_at_locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pickupAtLocality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPickupAtLocality($pickupAtLocality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pickupAtLocality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pickupAtLocality)) {
                $pickupAtLocality = str_replace('*', '%', $pickupAtLocality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY, $pickupAtLocality, $comparison);
    }

    /**
     * Filter the query on the pickup_at_region column
     *
     * Example usage:
     * <code>
     * $query->filterByPickupAtRegion('fooValue');   // WHERE pickup_at_region = 'fooValue'
     * $query->filterByPickupAtRegion('%fooValue%'); // WHERE pickup_at_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pickupAtRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPickupAtRegion($pickupAtRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pickupAtRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pickupAtRegion)) {
                $pickupAtRegion = str_replace('*', '%', $pickupAtRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_PICKUP_AT_REGION, $pickupAtRegion, $comparison);
    }

    /**
     * Filter the query on the pickup_at_country column
     *
     * Example usage:
     * <code>
     * $query->filterByPickupAtCountry('fooValue');   // WHERE pickup_at_country = 'fooValue'
     * $query->filterByPickupAtCountry('%fooValue%'); // WHERE pickup_at_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pickupAtCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPickupAtCountry($pickupAtCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pickupAtCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pickupAtCountry)) {
                $pickupAtCountry = str_replace('*', '%', $pickupAtCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY, $pickupAtCountry, $comparison);
    }

    /**
     * Filter the query on the size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize('fooValue');   // WHERE size = 'fooValue'
     * $query->filterBySize('%fooValue%'); // WHERE size LIKE '%fooValue%'
     * </code>
     *
     * @param     string $size The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterBySize($size = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($size)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $size)) {
                $size = str_replace('*', '%', $size);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_SIZE, $size, $comparison);
    }

    /**
     * Filter the query on the priority column
     *
     * Example usage:
     * <code>
     * $query->filterByPriority(1234); // WHERE priority = 1234
     * $query->filterByPriority(array(12, 34)); // WHERE priority IN (12, 34)
     * $query->filterByPriority(array('min' => 12)); // WHERE priority > 12
     * </code>
     *
     * @param     mixed $priority The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByPriority($priority = null, $comparison = null)
    {
        if (is_array($priority)) {
            $useMinMax = false;
            if (isset($priority['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_PRIORITY, $priority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priority['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_PRIORITY, $priority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_PRIORITY, $priority, $comparison);
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_TYPE, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_TYPE, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the type_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeRate(1234); // WHERE type_rate = 1234
     * $query->filterByTypeRate(array(12, 34)); // WHERE type_rate IN (12, 34)
     * $query->filterByTypeRate(array('min' => 12)); // WHERE type_rate > 12
     * </code>
     *
     * @param     mixed $typeRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByTypeRate($typeRate = null, $comparison = null)
    {
        if (is_array($typeRate)) {
            $useMinMax = false;
            if (isset($typeRate['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_TYPE_RATE, $typeRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeRate['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_TYPE_RATE, $typeRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_TYPE_RATE, $typeRate, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the delivery_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryDate('2011-03-14'); // WHERE delivery_date = '2011-03-14'
     * $query->filterByDeliveryDate('now'); // WHERE delivery_date = '2011-03-14'
     * $query->filterByDeliveryDate(array('max' => 'yesterday')); // WHERE delivery_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $deliveryDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveryDate($deliveryDate = null, $comparison = null)
    {
        if (is_array($deliveryDate)) {
            $useMinMax = false;
            if (isset($deliveryDate['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_DATE, $deliveryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryDate['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_DATE, $deliveryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_DATE, $deliveryDate, $comparison);
    }

    /**
     * Filter the query on the delivery_address_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryAddressLat('fooValue');   // WHERE delivery_address_lat = 'fooValue'
     * $query->filterByDeliveryAddressLat('%fooValue%'); // WHERE delivery_address_lat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryAddressLat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveryAddressLat($deliveryAddressLat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryAddressLat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryAddressLat)) {
                $deliveryAddressLat = str_replace('*', '%', $deliveryAddressLat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT, $deliveryAddressLat, $comparison);
    }

    /**
     * Filter the query on the delivery_address_lng column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryAddressLng('fooValue');   // WHERE delivery_address_lng = 'fooValue'
     * $query->filterByDeliveryAddressLng('%fooValue%'); // WHERE delivery_address_lng LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryAddressLng The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveryAddressLng($deliveryAddressLng = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryAddressLng)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryAddressLng)) {
                $deliveryAddressLng = str_replace('*', '%', $deliveryAddressLng);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG, $deliveryAddressLng, $comparison);
    }

    /**
     * Filter the query on the delivery_address_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryAddressLocality('fooValue');   // WHERE delivery_address_locality = 'fooValue'
     * $query->filterByDeliveryAddressLocality('%fooValue%'); // WHERE delivery_address_locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryAddressLocality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveryAddressLocality($deliveryAddressLocality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryAddressLocality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryAddressLocality)) {
                $deliveryAddressLocality = str_replace('*', '%', $deliveryAddressLocality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY, $deliveryAddressLocality, $comparison);
    }

    /**
     * Filter the query on the delivery_address_region column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryAddressRegion('fooValue');   // WHERE delivery_address_region = 'fooValue'
     * $query->filterByDeliveryAddressRegion('%fooValue%'); // WHERE delivery_address_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryAddressRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveryAddressRegion($deliveryAddressRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryAddressRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryAddressRegion)) {
                $deliveryAddressRegion = str_replace('*', '%', $deliveryAddressRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION, $deliveryAddressRegion, $comparison);
    }

    /**
     * Filter the query on the delivery_address_country column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryAddressCountry('fooValue');   // WHERE delivery_address_country = 'fooValue'
     * $query->filterByDeliveryAddressCountry('%fooValue%'); // WHERE delivery_address_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryAddressCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveryAddressCountry($deliveryAddressCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryAddressCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryAddressCountry)) {
                $deliveryAddressCountry = str_replace('*', '%', $deliveryAddressCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY, $deliveryAddressCountry, $comparison);
    }

    /**
     * Filter the query on the addressee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAddresseeName('fooValue');   // WHERE addressee_name = 'fooValue'
     * $query->filterByAddresseeName('%fooValue%'); // WHERE addressee_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addresseeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddresseeName($addresseeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addresseeName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addresseeName)) {
                $addresseeName = str_replace('*', '%', $addresseeName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ADDRESSEE_NAME, $addresseeName, $comparison);
    }

    /**
     * Filter the query on the addressee_phone column
     *
     * Example usage:
     * <code>
     * $query->filterByAddresseePhone('fooValue');   // WHERE addressee_phone = 'fooValue'
     * $query->filterByAddresseePhone('%fooValue%'); // WHERE addressee_phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addresseePhone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddresseePhone($addresseePhone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addresseePhone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addresseePhone)) {
                $addresseePhone = str_replace('*', '%', $addresseePhone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE, $addresseePhone, $comparison);
    }

    /**
     * Filter the query on the delivery_address column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryAddress('fooValue');   // WHERE delivery_address = 'fooValue'
     * $query->filterByDeliveryAddress('%fooValue%'); // WHERE delivery_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveryAddress($deliveryAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryAddress)) {
                $deliveryAddress = str_replace('*', '%', $deliveryAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS, $deliveryAddress, $comparison);
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CommercesShipmentsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommercesShipmentsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \CommercesRates object
     *
     * @param \CommercesRates|ObjectCollection $commercesRates The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function filterByCommercesRates($commercesRates, $comparison = null)
    {
        if ($commercesRates instanceof \CommercesRates) {
            return $this
                ->addUsingAlias(CommercesShipmentsTableMap::COL_ID_RATE, $commercesRates->getId(), $comparison);
        } elseif ($commercesRates instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommercesShipmentsTableMap::COL_ID_RATE, $commercesRates->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCommercesShipments $commercesShipments Object to remove from the list of results
     *
     * @return $this|ChildCommercesShipmentsQuery The current query, for fluid interface
     */
    public function prune($commercesShipments = null)
    {
        if ($commercesShipments) {
            $this->addUsingAlias(CommercesShipmentsTableMap::COL_ID, $commercesShipments->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the commerces_shipments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesShipmentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommercesShipmentsTableMap::clearInstancePool();
            CommercesShipmentsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesShipmentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommercesShipmentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CommercesShipmentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommercesShipmentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CommercesShipmentsQuery
