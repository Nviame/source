<?php

namespace Base;

use \Notifications as ChildNotifications;
use \NotificationsQuery as ChildNotificationsQuery;
use \Exception;
use \PDO;
use Map\NotificationsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'notifications' table.
 *
 *
 *
 * @method     ChildNotificationsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildNotificationsQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildNotificationsQuery orderByIdShipment($order = Criteria::ASC) Order by the id_shipment column
 * @method     ChildNotificationsQuery orderByIdOffer($order = Criteria::ASC) Order by the id_offer column
 * @method     ChildNotificationsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildNotificationsQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildNotificationsQuery orderByDatetime($order = Criteria::ASC) Order by the datetime column
 * @method     ChildNotificationsQuery orderByReaded($order = Criteria::ASC) Order by the readed column
 * @method     ChildNotificationsQuery orderByGroup($order = Criteria::ASC) Order by the group column
 *
 * @method     ChildNotificationsQuery groupById() Group by the id column
 * @method     ChildNotificationsQuery groupByIdUser() Group by the id_user column
 * @method     ChildNotificationsQuery groupByIdShipment() Group by the id_shipment column
 * @method     ChildNotificationsQuery groupByIdOffer() Group by the id_offer column
 * @method     ChildNotificationsQuery groupByTitle() Group by the title column
 * @method     ChildNotificationsQuery groupByContent() Group by the content column
 * @method     ChildNotificationsQuery groupByDatetime() Group by the datetime column
 * @method     ChildNotificationsQuery groupByReaded() Group by the readed column
 * @method     ChildNotificationsQuery groupByGroup() Group by the group column
 *
 * @method     ChildNotificationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNotificationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNotificationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNotifications findOne(ConnectionInterface $con = null) Return the first ChildNotifications matching the query
 * @method     ChildNotifications findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNotifications matching the query, or a new ChildNotifications object populated from the query conditions when no match is found
 *
 * @method     ChildNotifications findOneById(int $id) Return the first ChildNotifications filtered by the id column
 * @method     ChildNotifications findOneByIdUser(int $id_user) Return the first ChildNotifications filtered by the id_user column
 * @method     ChildNotifications findOneByIdShipment(int $id_shipment) Return the first ChildNotifications filtered by the id_shipment column
 * @method     ChildNotifications findOneByIdOffer(int $id_offer) Return the first ChildNotifications filtered by the id_offer column
 * @method     ChildNotifications findOneByTitle(string $title) Return the first ChildNotifications filtered by the title column
 * @method     ChildNotifications findOneByContent(string $content) Return the first ChildNotifications filtered by the content column
 * @method     ChildNotifications findOneByDatetime(string $datetime) Return the first ChildNotifications filtered by the datetime column
 * @method     ChildNotifications findOneByReaded(boolean $readed) Return the first ChildNotifications filtered by the readed column
 * @method     ChildNotifications findOneByGroup(string $group) Return the first ChildNotifications filtered by the group column *

 * @method     ChildNotifications requirePk($key, ConnectionInterface $con = null) Return the ChildNotifications by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOne(ConnectionInterface $con = null) Return the first ChildNotifications matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotifications requireOneById(int $id) Return the first ChildNotifications filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByIdUser(int $id_user) Return the first ChildNotifications filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByIdShipment(int $id_shipment) Return the first ChildNotifications filtered by the id_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByIdOffer(int $id_offer) Return the first ChildNotifications filtered by the id_offer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByTitle(string $title) Return the first ChildNotifications filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByContent(string $content) Return the first ChildNotifications filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByDatetime(string $datetime) Return the first ChildNotifications filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByReaded(boolean $readed) Return the first ChildNotifications filtered by the readed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByGroup(string $group) Return the first ChildNotifications filtered by the group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotifications[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNotifications objects based on current ModelCriteria
 * @method     ChildNotifications[]|ObjectCollection findById(int $id) Return ChildNotifications objects filtered by the id column
 * @method     ChildNotifications[]|ObjectCollection findByIdUser(int $id_user) Return ChildNotifications objects filtered by the id_user column
 * @method     ChildNotifications[]|ObjectCollection findByIdShipment(int $id_shipment) Return ChildNotifications objects filtered by the id_shipment column
 * @method     ChildNotifications[]|ObjectCollection findByIdOffer(int $id_offer) Return ChildNotifications objects filtered by the id_offer column
 * @method     ChildNotifications[]|ObjectCollection findByTitle(string $title) Return ChildNotifications objects filtered by the title column
 * @method     ChildNotifications[]|ObjectCollection findByContent(string $content) Return ChildNotifications objects filtered by the content column
 * @method     ChildNotifications[]|ObjectCollection findByDatetime(string $datetime) Return ChildNotifications objects filtered by the datetime column
 * @method     ChildNotifications[]|ObjectCollection findByReaded(boolean $readed) Return ChildNotifications objects filtered by the readed column
 * @method     ChildNotifications[]|ObjectCollection findByGroup(string $group) Return ChildNotifications objects filtered by the group column
 * @method     ChildNotifications[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NotificationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\NotificationsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Notifications', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNotificationsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNotificationsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNotificationsQuery) {
            return $criteria;
        }
        $query = new ChildNotificationsQuery();
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
     * @return ChildNotifications|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotificationsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NotificationsTableMap::DATABASE_NAME);
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
     * @return ChildNotifications A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_shipment`, `id_offer`, `title`, `content`, `datetime`, `readed`, `group` FROM `notifications` WHERE `id` = :p0';
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
            /** @var ChildNotifications $obj */
            $obj = new ChildNotifications();
            $obj->hydrate($row);
            NotificationsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildNotifications|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NotificationsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NotificationsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_ID_USER, $idUser, $comparison);
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByIdShipment($idShipment = null, $comparison = null)
    {
        if (is_array($idShipment)) {
            $useMinMax = false;
            if (isset($idShipment['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID_SHIPMENT, $idShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipment['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID_SHIPMENT, $idShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_ID_SHIPMENT, $idShipment, $comparison);
    }

    /**
     * Filter the query on the id_offer column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOffer(1234); // WHERE id_offer = 1234
     * $query->filterByIdOffer(array(12, 34)); // WHERE id_offer IN (12, 34)
     * $query->filterByIdOffer(array('min' => 12)); // WHERE id_offer > 12
     * </code>
     *
     * @param     mixed $idOffer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByIdOffer($idOffer = null, $comparison = null)
    {
        if (is_array($idOffer)) {
            $useMinMax = false;
            if (isset($idOffer['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID_OFFER, $idOffer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOffer['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID_OFFER, $idOffer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_ID_OFFER, $idOffer, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_CONTENT, $content, $comparison);
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (is_array($datetime)) {
            $useMinMax = false;
            if (isset($datetime['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_DATETIME, $datetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datetime['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_DATETIME, $datetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_DATETIME, $datetime, $comparison);
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByReaded($readed = null, $comparison = null)
    {
        if (is_string($readed)) {
            $readed = in_array(strtolower($readed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_READED, $readed, $comparison);
    }

    /**
     * Filter the query on the group column
     *
     * Example usage:
     * <code>
     * $query->filterByGroup('fooValue');   // WHERE group = 'fooValue'
     * $query->filterByGroup('%fooValue%'); // WHERE group LIKE '%fooValue%'
     * </code>
     *
     * @param     string $group The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByGroup($group = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($group)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $group)) {
                $group = str_replace('*', '%', $group);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_GROUP, $group, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNotifications $notifications Object to remove from the list of results
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function prune($notifications = null)
    {
        if ($notifications) {
            $this->addUsingAlias(NotificationsTableMap::COL_ID, $notifications->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the notifications table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NotificationsTableMap::clearInstancePool();
            NotificationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NotificationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NotificationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NotificationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // NotificationsQuery
