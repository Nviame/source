<?php

namespace Base;

use \Chats as ChildChats;
use \ChatsQuery as ChildChatsQuery;
use \Exception;
use \PDO;
use Map\ChatsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'chats' table.
 *
 *
 *
 * @method     ChildChatsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildChatsQuery orderByIdTransmitter($order = Criteria::ASC) Order by the id_transmitter column
 * @method     ChildChatsQuery orderByIdReceiver($order = Criteria::ASC) Order by the id_receiver column
 * @method     ChildChatsQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     ChildChatsQuery orderByTransmitterDateSent($order = Criteria::ASC) Order by the transmitter_date_sent column
 * @method     ChildChatsQuery orderByTransmitterDateReading($order = Criteria::ASC) Order by the transmitter_date_reading column
 * @method     ChildChatsQuery orderByReceiverDateSent($order = Criteria::ASC) Order by the receiver_date_sent column
 * @method     ChildChatsQuery orderByReceiverDateReading($order = Criteria::ASC) Order by the receiver_date_reading column
 * @method     ChildChatsQuery orderByArchivedTransmitter($order = Criteria::ASC) Order by the archived_transmitter column
 * @method     ChildChatsQuery orderByArchivedReceiver($order = Criteria::ASC) Order by the archived_receiver column
 * @method     ChildChatsQuery orderByAttachmentFile($order = Criteria::ASC) Order by the attachment_file column
 * @method     ChildChatsQuery orderByAttachmentGroup($order = Criteria::ASC) Order by the attachment_group column
 *
 * @method     ChildChatsQuery groupById() Group by the id column
 * @method     ChildChatsQuery groupByIdTransmitter() Group by the id_transmitter column
 * @method     ChildChatsQuery groupByIdReceiver() Group by the id_receiver column
 * @method     ChildChatsQuery groupByMessage() Group by the message column
 * @method     ChildChatsQuery groupByTransmitterDateSent() Group by the transmitter_date_sent column
 * @method     ChildChatsQuery groupByTransmitterDateReading() Group by the transmitter_date_reading column
 * @method     ChildChatsQuery groupByReceiverDateSent() Group by the receiver_date_sent column
 * @method     ChildChatsQuery groupByReceiverDateReading() Group by the receiver_date_reading column
 * @method     ChildChatsQuery groupByArchivedTransmitter() Group by the archived_transmitter column
 * @method     ChildChatsQuery groupByArchivedReceiver() Group by the archived_receiver column
 * @method     ChildChatsQuery groupByAttachmentFile() Group by the attachment_file column
 * @method     ChildChatsQuery groupByAttachmentGroup() Group by the attachment_group column
 *
 * @method     ChildChatsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildChatsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildChatsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildChats findOne(ConnectionInterface $con = null) Return the first ChildChats matching the query
 * @method     ChildChats findOneOrCreate(ConnectionInterface $con = null) Return the first ChildChats matching the query, or a new ChildChats object populated from the query conditions when no match is found
 *
 * @method     ChildChats findOneById(int $id) Return the first ChildChats filtered by the id column
 * @method     ChildChats findOneByIdTransmitter(int $id_transmitter) Return the first ChildChats filtered by the id_transmitter column
 * @method     ChildChats findOneByIdReceiver(int $id_receiver) Return the first ChildChats filtered by the id_receiver column
 * @method     ChildChats findOneByMessage(string $message) Return the first ChildChats filtered by the message column
 * @method     ChildChats findOneByTransmitterDateSent(string $transmitter_date_sent) Return the first ChildChats filtered by the transmitter_date_sent column
 * @method     ChildChats findOneByTransmitterDateReading(string $transmitter_date_reading) Return the first ChildChats filtered by the transmitter_date_reading column
 * @method     ChildChats findOneByReceiverDateSent(string $receiver_date_sent) Return the first ChildChats filtered by the receiver_date_sent column
 * @method     ChildChats findOneByReceiverDateReading(string $receiver_date_reading) Return the first ChildChats filtered by the receiver_date_reading column
 * @method     ChildChats findOneByArchivedTransmitter(boolean $archived_transmitter) Return the first ChildChats filtered by the archived_transmitter column
 * @method     ChildChats findOneByArchivedReceiver(boolean $archived_receiver) Return the first ChildChats filtered by the archived_receiver column
 * @method     ChildChats findOneByAttachmentFile(string $attachment_file) Return the first ChildChats filtered by the attachment_file column
 * @method     ChildChats findOneByAttachmentGroup(string $attachment_group) Return the first ChildChats filtered by the attachment_group column *

 * @method     ChildChats requirePk($key, ConnectionInterface $con = null) Return the ChildChats by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOne(ConnectionInterface $con = null) Return the first ChildChats matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildChats requireOneById(int $id) Return the first ChildChats filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByIdTransmitter(int $id_transmitter) Return the first ChildChats filtered by the id_transmitter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByIdReceiver(int $id_receiver) Return the first ChildChats filtered by the id_receiver column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByMessage(string $message) Return the first ChildChats filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByTransmitterDateSent(string $transmitter_date_sent) Return the first ChildChats filtered by the transmitter_date_sent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByTransmitterDateReading(string $transmitter_date_reading) Return the first ChildChats filtered by the transmitter_date_reading column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByReceiverDateSent(string $receiver_date_sent) Return the first ChildChats filtered by the receiver_date_sent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByReceiverDateReading(string $receiver_date_reading) Return the first ChildChats filtered by the receiver_date_reading column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByArchivedTransmitter(boolean $archived_transmitter) Return the first ChildChats filtered by the archived_transmitter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByArchivedReceiver(boolean $archived_receiver) Return the first ChildChats filtered by the archived_receiver column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByAttachmentFile(string $attachment_file) Return the first ChildChats filtered by the attachment_file column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChats requireOneByAttachmentGroup(string $attachment_group) Return the first ChildChats filtered by the attachment_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildChats[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildChats objects based on current ModelCriteria
 * @method     ChildChats[]|ObjectCollection findById(int $id) Return ChildChats objects filtered by the id column
 * @method     ChildChats[]|ObjectCollection findByIdTransmitter(int $id_transmitter) Return ChildChats objects filtered by the id_transmitter column
 * @method     ChildChats[]|ObjectCollection findByIdReceiver(int $id_receiver) Return ChildChats objects filtered by the id_receiver column
 * @method     ChildChats[]|ObjectCollection findByMessage(string $message) Return ChildChats objects filtered by the message column
 * @method     ChildChats[]|ObjectCollection findByTransmitterDateSent(string $transmitter_date_sent) Return ChildChats objects filtered by the transmitter_date_sent column
 * @method     ChildChats[]|ObjectCollection findByTransmitterDateReading(string $transmitter_date_reading) Return ChildChats objects filtered by the transmitter_date_reading column
 * @method     ChildChats[]|ObjectCollection findByReceiverDateSent(string $receiver_date_sent) Return ChildChats objects filtered by the receiver_date_sent column
 * @method     ChildChats[]|ObjectCollection findByReceiverDateReading(string $receiver_date_reading) Return ChildChats objects filtered by the receiver_date_reading column
 * @method     ChildChats[]|ObjectCollection findByArchivedTransmitter(boolean $archived_transmitter) Return ChildChats objects filtered by the archived_transmitter column
 * @method     ChildChats[]|ObjectCollection findByArchivedReceiver(boolean $archived_receiver) Return ChildChats objects filtered by the archived_receiver column
 * @method     ChildChats[]|ObjectCollection findByAttachmentFile(string $attachment_file) Return ChildChats objects filtered by the attachment_file column
 * @method     ChildChats[]|ObjectCollection findByAttachmentGroup(string $attachment_group) Return ChildChats objects filtered by the attachment_group column
 * @method     ChildChats[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ChatsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ChatsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Chats', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildChatsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildChatsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildChatsQuery) {
            return $criteria;
        }
        $query = new ChildChatsQuery();
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
     * @return ChildChats|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ChatsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ChatsTableMap::DATABASE_NAME);
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
     * @return ChildChats A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_transmitter`, `id_receiver`, `message`, `transmitter_date_sent`, `transmitter_date_reading`, `receiver_date_sent`, `receiver_date_reading`, `archived_transmitter`, `archived_receiver`, `attachment_file`, `attachment_group` FROM `chats` WHERE `id` = :p0';
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
            /** @var ChildChats $obj */
            $obj = new ChildChats();
            $obj->hydrate($row);
            ChatsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildChats|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ChatsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ChatsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_transmitter column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTransmitter(1234); // WHERE id_transmitter = 1234
     * $query->filterByIdTransmitter(array(12, 34)); // WHERE id_transmitter IN (12, 34)
     * $query->filterByIdTransmitter(array('min' => 12)); // WHERE id_transmitter > 12
     * </code>
     *
     * @param     mixed $idTransmitter The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByIdTransmitter($idTransmitter = null, $comparison = null)
    {
        if (is_array($idTransmitter)) {
            $useMinMax = false;
            if (isset($idTransmitter['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ID_TRANSMITTER, $idTransmitter['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTransmitter['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ID_TRANSMITTER, $idTransmitter['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_ID_TRANSMITTER, $idTransmitter, $comparison);
    }

    /**
     * Filter the query on the id_receiver column
     *
     * Example usage:
     * <code>
     * $query->filterByIdReceiver(1234); // WHERE id_receiver = 1234
     * $query->filterByIdReceiver(array(12, 34)); // WHERE id_receiver IN (12, 34)
     * $query->filterByIdReceiver(array('min' => 12)); // WHERE id_receiver > 12
     * </code>
     *
     * @param     mixed $idReceiver The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByIdReceiver($idReceiver = null, $comparison = null)
    {
        if (is_array($idReceiver)) {
            $useMinMax = false;
            if (isset($idReceiver['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ID_RECEIVER, $idReceiver['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idReceiver['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ID_RECEIVER, $idReceiver['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_ID_RECEIVER, $idReceiver, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_MESSAGE, $message, $comparison);
    }

    /**
     * Filter the query on the transmitter_date_sent column
     *
     * Example usage:
     * <code>
     * $query->filterByTransmitterDateSent('2011-03-14'); // WHERE transmitter_date_sent = '2011-03-14'
     * $query->filterByTransmitterDateSent('now'); // WHERE transmitter_date_sent = '2011-03-14'
     * $query->filterByTransmitterDateSent(array('max' => 'yesterday')); // WHERE transmitter_date_sent > '2011-03-13'
     * </code>
     *
     * @param     mixed $transmitterDateSent The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByTransmitterDateSent($transmitterDateSent = null, $comparison = null)
    {
        if (is_array($transmitterDateSent)) {
            $useMinMax = false;
            if (isset($transmitterDateSent['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_TRANSMITTER_DATE_SENT, $transmitterDateSent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transmitterDateSent['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_TRANSMITTER_DATE_SENT, $transmitterDateSent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_TRANSMITTER_DATE_SENT, $transmitterDateSent, $comparison);
    }

    /**
     * Filter the query on the transmitter_date_reading column
     *
     * Example usage:
     * <code>
     * $query->filterByTransmitterDateReading('2011-03-14'); // WHERE transmitter_date_reading = '2011-03-14'
     * $query->filterByTransmitterDateReading('now'); // WHERE transmitter_date_reading = '2011-03-14'
     * $query->filterByTransmitterDateReading(array('max' => 'yesterday')); // WHERE transmitter_date_reading > '2011-03-13'
     * </code>
     *
     * @param     mixed $transmitterDateReading The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByTransmitterDateReading($transmitterDateReading = null, $comparison = null)
    {
        if (is_array($transmitterDateReading)) {
            $useMinMax = false;
            if (isset($transmitterDateReading['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_TRANSMITTER_DATE_READING, $transmitterDateReading['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transmitterDateReading['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_TRANSMITTER_DATE_READING, $transmitterDateReading['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_TRANSMITTER_DATE_READING, $transmitterDateReading, $comparison);
    }

    /**
     * Filter the query on the receiver_date_sent column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiverDateSent('2011-03-14'); // WHERE receiver_date_sent = '2011-03-14'
     * $query->filterByReceiverDateSent('now'); // WHERE receiver_date_sent = '2011-03-14'
     * $query->filterByReceiverDateSent(array('max' => 'yesterday')); // WHERE receiver_date_sent > '2011-03-13'
     * </code>
     *
     * @param     mixed $receiverDateSent The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByReceiverDateSent($receiverDateSent = null, $comparison = null)
    {
        if (is_array($receiverDateSent)) {
            $useMinMax = false;
            if (isset($receiverDateSent['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_RECEIVER_DATE_SENT, $receiverDateSent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($receiverDateSent['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_RECEIVER_DATE_SENT, $receiverDateSent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_RECEIVER_DATE_SENT, $receiverDateSent, $comparison);
    }

    /**
     * Filter the query on the receiver_date_reading column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiverDateReading('2011-03-14'); // WHERE receiver_date_reading = '2011-03-14'
     * $query->filterByReceiverDateReading('now'); // WHERE receiver_date_reading = '2011-03-14'
     * $query->filterByReceiverDateReading(array('max' => 'yesterday')); // WHERE receiver_date_reading > '2011-03-13'
     * </code>
     *
     * @param     mixed $receiverDateReading The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByReceiverDateReading($receiverDateReading = null, $comparison = null)
    {
        if (is_array($receiverDateReading)) {
            $useMinMax = false;
            if (isset($receiverDateReading['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_RECEIVER_DATE_READING, $receiverDateReading['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($receiverDateReading['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_RECEIVER_DATE_READING, $receiverDateReading['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_RECEIVER_DATE_READING, $receiverDateReading, $comparison);
    }

    /**
     * Filter the query on the archived_transmitter column
     *
     * Example usage:
     * <code>
     * $query->filterByArchivedTransmitter(true); // WHERE archived_transmitter = true
     * $query->filterByArchivedTransmitter('yes'); // WHERE archived_transmitter = true
     * </code>
     *
     * @param     boolean|string $archivedTransmitter The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByArchivedTransmitter($archivedTransmitter = null, $comparison = null)
    {
        if (is_string($archivedTransmitter)) {
            $archivedTransmitter = in_array(strtolower($archivedTransmitter), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ChatsTableMap::COL_ARCHIVED_TRANSMITTER, $archivedTransmitter, $comparison);
    }

    /**
     * Filter the query on the archived_receiver column
     *
     * Example usage:
     * <code>
     * $query->filterByArchivedReceiver(true); // WHERE archived_receiver = true
     * $query->filterByArchivedReceiver('yes'); // WHERE archived_receiver = true
     * </code>
     *
     * @param     boolean|string $archivedReceiver The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByArchivedReceiver($archivedReceiver = null, $comparison = null)
    {
        if (is_string($archivedReceiver)) {
            $archivedReceiver = in_array(strtolower($archivedReceiver), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ChatsTableMap::COL_ARCHIVED_RECEIVER, $archivedReceiver, $comparison);
    }

    /**
     * Filter the query on the attachment_file column
     *
     * Example usage:
     * <code>
     * $query->filterByAttachmentFile('fooValue');   // WHERE attachment_file = 'fooValue'
     * $query->filterByAttachmentFile('%fooValue%'); // WHERE attachment_file LIKE '%fooValue%'
     * </code>
     *
     * @param     string $attachmentFile The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByAttachmentFile($attachmentFile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($attachmentFile)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $attachmentFile)) {
                $attachmentFile = str_replace('*', '%', $attachmentFile);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_ATTACHMENT_FILE, $attachmentFile, $comparison);
    }

    /**
     * Filter the query on the attachment_group column
     *
     * Example usage:
     * <code>
     * $query->filterByAttachmentGroup(1234); // WHERE attachment_group = 1234
     * $query->filterByAttachmentGroup(array(12, 34)); // WHERE attachment_group IN (12, 34)
     * $query->filterByAttachmentGroup(array('min' => 12)); // WHERE attachment_group > 12
     * </code>
     *
     * @param     mixed $attachmentGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function filterByAttachmentGroup($attachmentGroup = null, $comparison = null)
    {
        if (is_array($attachmentGroup)) {
            $useMinMax = false;
            if (isset($attachmentGroup['min'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ATTACHMENT_GROUP, $attachmentGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attachmentGroup['max'])) {
                $this->addUsingAlias(ChatsTableMap::COL_ATTACHMENT_GROUP, $attachmentGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatsTableMap::COL_ATTACHMENT_GROUP, $attachmentGroup, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildChats $chats Object to remove from the list of results
     *
     * @return $this|ChildChatsQuery The current query, for fluid interface
     */
    public function prune($chats = null)
    {
        if ($chats) {
            $this->addUsingAlias(ChatsTableMap::COL_ID, $chats->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the chats table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ChatsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ChatsTableMap::clearInstancePool();
            ChatsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ChatsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ChatsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ChatsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ChatsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ChatsQuery
