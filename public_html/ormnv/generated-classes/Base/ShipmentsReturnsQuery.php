<?php

namespace Base;

use \ShipmentsReturns as ChildShipmentsReturns;
use \ShipmentsReturnsQuery as ChildShipmentsReturnsQuery;
use \Exception;
use \PDO;
use Map\ShipmentsReturnsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipments_returns' table.
 *
 *
 *
 * @method     ChildShipmentsReturnsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentsReturnsQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildShipmentsReturnsQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildShipmentsReturnsQuery orderByIdReason($order = Criteria::ASC) Order by the id_reason column
 * @method     ChildShipmentsReturnsQuery orderByIdOption($order = Criteria::ASC) Order by the id_option column
 * @method     ChildShipmentsReturnsQuery orderByCommentsReason($order = Criteria::ASC) Order by the comments_reason column
 * @method     ChildShipmentsReturnsQuery orderByDispatchExpenses($order = Criteria::ASC) Order by the dispatch_expenses column
 * @method     ChildShipmentsReturnsQuery orderByReceiverFullname($order = Criteria::ASC) Order by the receiver_fullname column
 * @method     ChildShipmentsReturnsQuery orderByReceiverContact($order = Criteria::ASC) Order by the receiver_contact column
 * @method     ChildShipmentsReturnsQuery orderByDatetime($order = Criteria::ASC) Order by the datetime column
 *
 * @method     ChildShipmentsReturnsQuery groupById() Group by the id column
 * @method     ChildShipmentsReturnsQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildShipmentsReturnsQuery groupByIdUser() Group by the id_user column
 * @method     ChildShipmentsReturnsQuery groupByIdReason() Group by the id_reason column
 * @method     ChildShipmentsReturnsQuery groupByIdOption() Group by the id_option column
 * @method     ChildShipmentsReturnsQuery groupByCommentsReason() Group by the comments_reason column
 * @method     ChildShipmentsReturnsQuery groupByDispatchExpenses() Group by the dispatch_expenses column
 * @method     ChildShipmentsReturnsQuery groupByReceiverFullname() Group by the receiver_fullname column
 * @method     ChildShipmentsReturnsQuery groupByReceiverContact() Group by the receiver_contact column
 * @method     ChildShipmentsReturnsQuery groupByDatetime() Group by the datetime column
 *
 * @method     ChildShipmentsReturnsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentsReturnsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentsReturnsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentsReturns findOne(ConnectionInterface $con = null) Return the first ChildShipmentsReturns matching the query
 * @method     ChildShipmentsReturns findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentsReturns matching the query, or a new ChildShipmentsReturns object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentsReturns findOneById(int $id) Return the first ChildShipmentsReturns filtered by the id column
 * @method     ChildShipmentsReturns findOneByIdShipment(int $id_shipment) Return the first ChildShipmentsReturns filtered by the id_shipment column
 * @method     ChildShipmentsReturns findOneByIdUser(int $id_user) Return the first ChildShipmentsReturns filtered by the id_user column
 * @method     ChildShipmentsReturns findOneByIdReason(int $id_reason) Return the first ChildShipmentsReturns filtered by the id_reason column
 * @method     ChildShipmentsReturns findOneByIdOption(int $id_option) Return the first ChildShipmentsReturns filtered by the id_option column
 * @method     ChildShipmentsReturns findOneByCommentsReason(string $comments_reason) Return the first ChildShipmentsReturns filtered by the comments_reason column
 * @method     ChildShipmentsReturns findOneByDispatchExpenses(double $dispatch_expenses) Return the first ChildShipmentsReturns filtered by the dispatch_expenses column
 * @method     ChildShipmentsReturns findOneByReceiverFullname(string $receiver_fullname) Return the first ChildShipmentsReturns filtered by the receiver_fullname column
 * @method     ChildShipmentsReturns findOneByReceiverContact(string $receiver_contact) Return the first ChildShipmentsReturns filtered by the receiver_contact column
 * @method     ChildShipmentsReturns findOneByDatetime(string $datetime) Return the first ChildShipmentsReturns filtered by the datetime column *

 * @method     ChildShipmentsReturns requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentsReturns by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOne(ConnectionInterface $con = null) Return the first ChildShipmentsReturns matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsReturns requireOneById(int $id) Return the first ChildShipmentsReturns filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByIdShipment(int $id_shipment) Return the first ChildShipmentsReturns filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByIdUser(int $id_user) Return the first ChildShipmentsReturns filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByIdReason(int $id_reason) Return the first ChildShipmentsReturns filtered by the id_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByIdOption(int $id_option) Return the first ChildShipmentsReturns filtered by the id_option column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByCommentsReason(string $comments_reason) Return the first ChildShipmentsReturns filtered by the comments_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByDispatchExpenses(double $dispatch_expenses) Return the first ChildShipmentsReturns filtered by the dispatch_expenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByReceiverFullname(string $receiver_fullname) Return the first ChildShipmentsReturns filtered by the receiver_fullname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByReceiverContact(string $receiver_contact) Return the first ChildShipmentsReturns filtered by the receiver_contact column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentsReturns requireOneByDatetime(string $datetime) Return the first ChildShipmentsReturns filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentsReturns[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentsReturns objects based on current ModelCriteria
 * @method     ChildShipmentsReturns[]|ObjectCollection findById(int $id) Return ChildShipmentsReturns objects filtered by the id column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildShipmentsReturns objects filtered by the id_shipment column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByIdUser(int $id_user) Return ChildShipmentsReturns objects filtered by the id_user column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByIdReason(int $id_reason) Return ChildShipmentsReturns objects filtered by the id_reason column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByIdOption(int $id_option) Return ChildShipmentsReturns objects filtered by the id_option column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByCommentsReason(string $comments_reason) Return ChildShipmentsReturns objects filtered by the comments_reason column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByDispatchExpenses(double $dispatch_expenses) Return ChildShipmentsReturns objects filtered by the dispatch_expenses column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByReceiverFullname(string $receiver_fullname) Return ChildShipmentsReturns objects filtered by the receiver_fullname column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByReceiverContact(string $receiver_contact) Return ChildShipmentsReturns objects filtered by the receiver_contact column
 * @method     ChildShipmentsReturns[]|ObjectCollection findByDatetime(string $datetime) Return ChildShipmentsReturns objects filtered by the datetime column
 * @method     ChildShipmentsReturns[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentsReturnsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentsReturnsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ShipmentsReturns', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentsReturnsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentsReturnsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentsReturnsQuery) {
            return $criteria;
        }
        $query = new ChildShipmentsReturnsQuery();
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
     * @return ChildShipmentsReturns|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShipmentsReturnsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsReturnsTableMap::DATABASE_NAME);
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
     * @return ChildShipmentsReturns A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_shipment`, `id_user`, `id_reason`, `id_option`, `comments_reason`, `dispatch_expenses`, `receiver_fullname`, `receiver_contact`, `datetime` FROM `shipments_returns` WHERE `id` = :p0';
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
            /** @var ChildShipmentsReturns $obj */
            $obj = new ChildShipmentsReturns();
            $obj->hydrate($row);
            ShipmentsReturnsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildShipmentsReturns|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
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
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByIdReason(1234); // WHERE id_reason = 1234
     * $query->filterByIdReason(array(12, 34)); // WHERE id_reason IN (12, 34)
     * $query->filterByIdReason(array('min' => 12)); // WHERE id_reason > 12
     * </code>
     *
     * @param     mixed $idReason The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByIdReason($idReason = null, $comparison = null)
    {
        if (is_array($idReason)) {
            $useMinMax = false;
            if (isset($idReason['min'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_REASON, $idReason['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idReason['max'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_REASON, $idReason['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_REASON, $idReason, $comparison);
    }

    /**
     * Filter the query on the id_option column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOption(1234); // WHERE id_option = 1234
     * $query->filterByIdOption(array(12, 34)); // WHERE id_option IN (12, 34)
     * $query->filterByIdOption(array('min' => 12)); // WHERE id_option > 12
     * </code>
     *
     * @param     mixed $idOption The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByIdOption($idOption = null, $comparison = null)
    {
        if (is_array($idOption)) {
            $useMinMax = false;
            if (isset($idOption['min'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_OPTION, $idOption['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOption['max'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_OPTION, $idOption['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID_OPTION, $idOption, $comparison);
    }

    /**
     * Filter the query on the comments_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentsReason('fooValue');   // WHERE comments_reason = 'fooValue'
     * $query->filterByCommentsReason('%fooValue%'); // WHERE comments_reason LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentsReason The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByCommentsReason($commentsReason = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentsReason)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentsReason)) {
                $commentsReason = str_replace('*', '%', $commentsReason);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_COMMENTS_REASON, $commentsReason, $comparison);
    }

    /**
     * Filter the query on the dispatch_expenses column
     *
     * Example usage:
     * <code>
     * $query->filterByDispatchExpenses(1234); // WHERE dispatch_expenses = 1234
     * $query->filterByDispatchExpenses(array(12, 34)); // WHERE dispatch_expenses IN (12, 34)
     * $query->filterByDispatchExpenses(array('min' => 12)); // WHERE dispatch_expenses > 12
     * </code>
     *
     * @param     mixed $dispatchExpenses The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByDispatchExpenses($dispatchExpenses = null, $comparison = null)
    {
        if (is_array($dispatchExpenses)) {
            $useMinMax = false;
            if (isset($dispatchExpenses['min'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_DISPATCH_EXPENSES, $dispatchExpenses['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dispatchExpenses['max'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_DISPATCH_EXPENSES, $dispatchExpenses['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_DISPATCH_EXPENSES, $dispatchExpenses, $comparison);
    }

    /**
     * Filter the query on the receiver_fullname column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiverFullname('fooValue');   // WHERE receiver_fullname = 'fooValue'
     * $query->filterByReceiverFullname('%fooValue%'); // WHERE receiver_fullname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $receiverFullname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByReceiverFullname($receiverFullname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($receiverFullname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $receiverFullname)) {
                $receiverFullname = str_replace('*', '%', $receiverFullname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_RECEIVER_FULLNAME, $receiverFullname, $comparison);
    }

    /**
     * Filter the query on the receiver_contact column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiverContact('fooValue');   // WHERE receiver_contact = 'fooValue'
     * $query->filterByReceiverContact('%fooValue%'); // WHERE receiver_contact LIKE '%fooValue%'
     * </code>
     *
     * @param     string $receiverContact The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByReceiverContact($receiverContact = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($receiverContact)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $receiverContact)) {
                $receiverContact = str_replace('*', '%', $receiverContact);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_RECEIVER_CONTACT, $receiverContact, $comparison);
    }

    /**
     * Filter the query on the datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByDatetime('2011-03-14'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime('now'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime(array('max' => 'yesterday')); // WHERE datetime > '2011-03-13'
     * </code>
     *
     * @param     mixed $datetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (is_array($datetime)) {
            $useMinMax = false;
            if (isset($datetime['min'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_DATETIME, $datetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datetime['max'])) {
                $this->addUsingAlias(ShipmentsReturnsTableMap::COL_DATETIME, $datetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsReturnsTableMap::COL_DATETIME, $datetime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipmentsReturns $shipmentsReturns Object to remove from the list of results
     *
     * @return $this|ChildShipmentsReturnsQuery The current query, for fluid interface
     */
    public function prune($shipmentsReturns = null)
    {
        if ($shipmentsReturns) {
            $this->addUsingAlias(ShipmentsReturnsTableMap::COL_ID, $shipmentsReturns->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipments_returns table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsReturnsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentsReturnsTableMap::clearInstancePool();
            ShipmentsReturnsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsReturnsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentsReturnsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentsReturnsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentsReturnsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentsReturnsQuery
