<?php

namespace Base;

use \ShipmentsPaymentsExtraQuery as ChildShipmentsPaymentsExtraQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ShipmentsPaymentsExtraTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'shipments_payments_extra' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class ShipmentsPaymentsExtra implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ShipmentsPaymentsExtraTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the id_shipment field.
     * @var        int
     */
    protected $id_shipment;

    /**
     * The value for the preference_id field.
     * @var        string
     */
    protected $preference_id;

    /**
     * The value for the collection_id field.
     * @var        string
     */
    protected $collection_id;

    /**
     * The value for the collection_status field.
     * @var        string
     */
    protected $collection_status;

    /**
     * The value for the merchant_order_id field.
     * @var        string
     */
    protected $merchant_order_id;

    /**
     * The value for the total_paid_amount field.
     * @var        double
     */
    protected $total_paid_amount;

    /**
     * The value for the net_received_amount field.
     * @var        double
     */
    protected $net_received_amount;

    /**
     * The value for the registered_at field.
     * @var        \DateTime
     */
    protected $registered_at;

    /**
     * The value for the fee_mp field.
     * @var        double
     */
    protected $fee_mp;

    /**
     * The value for the fee_nv field.
     * @var        double
     */
    protected $fee_nv;

    /**
     * The value for the card_type_id field.
     * @var        string
     */
    protected $card_type_id;

    /**
     * The value for the card_method_id field.
     * @var        string
     */
    protected $card_method_id;

    /**
     * The value for the card_expiration_month field.
     * @var        int
     */
    protected $card_expiration_month;

    /**
     * The value for the card_expiration_year field.
     * @var        int
     */
    protected $card_expiration_year;

    /**
     * The value for the card_cardholder_identification_type field.
     * @var        string
     */
    protected $card_cardholder_identification_type;

    /**
     * The value for the card_cardholder_identification_number field.
     * @var        string
     */
    protected $card_cardholder_identification_number;

    /**
     * The value for the card_cardholder_name field.
     * @var        string
     */
    protected $card_cardholder_name;

    /**
     * The value for the card_date_created field.
     * @var        \DateTime
     */
    protected $card_date_created;

    /**
     * The value for the card_date_last_updated field.
     * @var        \DateTime
     */
    protected $card_date_last_updated;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\ShipmentsPaymentsExtra object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>ShipmentsPaymentsExtra</code> instance.  If
     * <code>obj</code> is an instance of <code>ShipmentsPaymentsExtra</code>, delegates to
     * <code>equals(ShipmentsPaymentsExtra)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|ShipmentsPaymentsExtra The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [id_shipment] column value.
     *
     * @return int
     */
    public function getIdShipment()
    {
        return $this->id_shipment;
    }

    /**
     * Get the [preference_id] column value.
     *
     * @return string
     */
    public function getPreferenceId()
    {
        return $this->preference_id;
    }

    /**
     * Get the [collection_id] column value.
     *
     * @return string
     */
    public function getCollectionId()
    {
        return $this->collection_id;
    }

    /**
     * Get the [collection_status] column value.
     *
     * @return string
     */
    public function getCollectionStatus()
    {
        return $this->collection_status;
    }

    /**
     * Get the [merchant_order_id] column value.
     *
     * @return string
     */
    public function getMerchantOrderId()
    {
        return $this->merchant_order_id;
    }

    /**
     * Get the [total_paid_amount] column value.
     *
     * @return double
     */
    public function getTotalPaidAmount()
    {
        return $this->total_paid_amount;
    }

    /**
     * Get the [net_received_amount] column value.
     *
     * @return double
     */
    public function getNetReceivedAmount()
    {
        return $this->net_received_amount;
    }

    /**
     * Get the [optionally formatted] temporal [registered_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRegisteredAt($format = NULL)
    {
        if ($format === null) {
            return $this->registered_at;
        } else {
            return $this->registered_at instanceof \DateTime ? $this->registered_at->format($format) : null;
        }
    }

    /**
     * Get the [fee_mp] column value.
     *
     * @return double
     */
    public function getFeeMp()
    {
        return $this->fee_mp;
    }

    /**
     * Get the [fee_nv] column value.
     *
     * @return double
     */
    public function getFeeNv()
    {
        return $this->fee_nv;
    }

    /**
     * Get the [card_type_id] column value.
     *
     * @return string
     */
    public function getCardTypeId()
    {
        return $this->card_type_id;
    }

    /**
     * Get the [card_method_id] column value.
     *
     * @return string
     */
    public function getCardMethodId()
    {
        return $this->card_method_id;
    }

    /**
     * Get the [card_expiration_month] column value.
     *
     * @return int
     */
    public function getCardExpirationMonth()
    {
        return $this->card_expiration_month;
    }

    /**
     * Get the [card_expiration_year] column value.
     *
     * @return int
     */
    public function getCardExpirationYear()
    {
        return $this->card_expiration_year;
    }

    /**
     * Get the [card_cardholder_identification_type] column value.
     *
     * @return string
     */
    public function getCardCardholderIdentificationType()
    {
        return $this->card_cardholder_identification_type;
    }

    /**
     * Get the [card_cardholder_identification_number] column value.
     *
     * @return string
     */
    public function getCardCardholderIdentificationNumber()
    {
        return $this->card_cardholder_identification_number;
    }

    /**
     * Get the [card_cardholder_name] column value.
     *
     * @return string
     */
    public function getCardCardholderName()
    {
        return $this->card_cardholder_name;
    }

    /**
     * Get the [optionally formatted] temporal [card_date_created] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCardDateCreated($format = NULL)
    {
        if ($format === null) {
            return $this->card_date_created;
        } else {
            return $this->card_date_created instanceof \DateTime ? $this->card_date_created->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [card_date_last_updated] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCardDateLastUpdated($format = NULL)
    {
        if ($format === null) {
            return $this->card_date_last_updated;
        } else {
            return $this->card_date_last_updated instanceof \DateTime ? $this->card_date_last_updated->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_shipment] column.
     *
     * @param int $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setIdShipment($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_shipment !== $v) {
            $this->id_shipment = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_ID_SHIPMENT] = true;
        }

        return $this;
    } // setIdShipment()

    /**
     * Set the value of [preference_id] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setPreferenceId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->preference_id !== $v) {
            $this->preference_id = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_PREFERENCE_ID] = true;
        }

        return $this;
    } // setPreferenceId()

    /**
     * Set the value of [collection_id] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCollectionId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->collection_id !== $v) {
            $this->collection_id = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_COLLECTION_ID] = true;
        }

        return $this;
    } // setCollectionId()

    /**
     * Set the value of [collection_status] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCollectionStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->collection_status !== $v) {
            $this->collection_status = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_COLLECTION_STATUS] = true;
        }

        return $this;
    } // setCollectionStatus()

    /**
     * Set the value of [merchant_order_id] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setMerchantOrderId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->merchant_order_id !== $v) {
            $this->merchant_order_id = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_MERCHANT_ORDER_ID] = true;
        }

        return $this;
    } // setMerchantOrderId()

    /**
     * Set the value of [total_paid_amount] column.
     *
     * @param double $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setTotalPaidAmount($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_paid_amount !== $v) {
            $this->total_paid_amount = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_TOTAL_PAID_AMOUNT] = true;
        }

        return $this;
    } // setTotalPaidAmount()

    /**
     * Set the value of [net_received_amount] column.
     *
     * @param double $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setNetReceivedAmount($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->net_received_amount !== $v) {
            $this->net_received_amount = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_NET_RECEIVED_AMOUNT] = true;
        }

        return $this;
    } // setNetReceivedAmount()

    /**
     * Sets the value of [registered_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setRegisteredAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registered_at !== null || $dt !== null) {
            if ($this->registered_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->registered_at->format("Y-m-d H:i:s")) {
                $this->registered_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_REGISTERED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setRegisteredAt()

    /**
     * Set the value of [fee_mp] column.
     *
     * @param double $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setFeeMp($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->fee_mp !== $v) {
            $this->fee_mp = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_FEE_MP] = true;
        }

        return $this;
    } // setFeeMp()

    /**
     * Set the value of [fee_nv] column.
     *
     * @param double $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setFeeNv($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->fee_nv !== $v) {
            $this->fee_nv = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_FEE_NV] = true;
        }

        return $this;
    } // setFeeNv()

    /**
     * Set the value of [card_type_id] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardTypeId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->card_type_id !== $v) {
            $this->card_type_id = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_TYPE_ID] = true;
        }

        return $this;
    } // setCardTypeId()

    /**
     * Set the value of [card_method_id] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardMethodId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->card_method_id !== $v) {
            $this->card_method_id = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_METHOD_ID] = true;
        }

        return $this;
    } // setCardMethodId()

    /**
     * Set the value of [card_expiration_month] column.
     *
     * @param int $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardExpirationMonth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->card_expiration_month !== $v) {
            $this->card_expiration_month = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_MONTH] = true;
        }

        return $this;
    } // setCardExpirationMonth()

    /**
     * Set the value of [card_expiration_year] column.
     *
     * @param int $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardExpirationYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->card_expiration_year !== $v) {
            $this->card_expiration_year = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_YEAR] = true;
        }

        return $this;
    } // setCardExpirationYear()

    /**
     * Set the value of [card_cardholder_identification_type] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardCardholderIdentificationType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->card_cardholder_identification_type !== $v) {
            $this->card_cardholder_identification_type = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE] = true;
        }

        return $this;
    } // setCardCardholderIdentificationType()

    /**
     * Set the value of [card_cardholder_identification_number] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardCardholderIdentificationNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->card_cardholder_identification_number !== $v) {
            $this->card_cardholder_identification_number = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER] = true;
        }

        return $this;
    } // setCardCardholderIdentificationNumber()

    /**
     * Set the value of [card_cardholder_name] column.
     *
     * @param string $v new value
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardCardholderName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->card_cardholder_name !== $v) {
            $this->card_cardholder_name = $v;
            $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_NAME] = true;
        }

        return $this;
    } // setCardCardholderName()

    /**
     * Sets the value of [card_date_created] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardDateCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->card_date_created !== null || $dt !== null) {
            if ($this->card_date_created === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->card_date_created->format("Y-m-d H:i:s")) {
                $this->card_date_created = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_CREATED] = true;
            }
        } // if either are not null

        return $this;
    } // setCardDateCreated()

    /**
     * Sets the value of [card_date_last_updated] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\ShipmentsPaymentsExtra The current object (for fluent API support)
     */
    public function setCardDateLastUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->card_date_last_updated !== null || $dt !== null) {
            if ($this->card_date_last_updated === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->card_date_last_updated->format("Y-m-d H:i:s")) {
                $this->card_date_last_updated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_LAST_UPDATED] = true;
            }
        } // if either are not null

        return $this;
    } // setCardDateLastUpdated()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('IdShipment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_shipment = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('PreferenceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->preference_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CollectionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->collection_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CollectionStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->collection_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('MerchantOrderId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_order_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('TotalPaidAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_paid_amount = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('NetReceivedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->net_received_amount = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('RegisteredAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->registered_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('FeeMp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fee_mp = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('FeeNv', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fee_nv = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->card_type_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardMethodId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->card_method_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardExpirationMonth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->card_expiration_month = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardExpirationYear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->card_expiration_year = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardCardholderIdentificationType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->card_cardholder_identification_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardCardholderIdentificationNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->card_cardholder_identification_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardCardholderName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->card_cardholder_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardDateCreated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->card_date_created = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ShipmentsPaymentsExtraTableMap::translateFieldName('CardDateLastUpdated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->card_date_last_updated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 20; // 20 = ShipmentsPaymentsExtraTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\ShipmentsPaymentsExtra'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsPaymentsExtraTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildShipmentsPaymentsExtraQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ShipmentsPaymentsExtra::setDeleted()
     * @see ShipmentsPaymentsExtra::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsPaymentsExtraTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildShipmentsPaymentsExtraQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsPaymentsExtraTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ShipmentsPaymentsExtraTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ShipmentsPaymentsExtraTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ShipmentsPaymentsExtraTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_ID_SHIPMENT)) {
            $modifiedColumns[':p' . $index++]  = '`id_shipment`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_PREFERENCE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`preference_id`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_COLLECTION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`collection_id`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_COLLECTION_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`collection_status`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_MERCHANT_ORDER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`merchant_order_id`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_TOTAL_PAID_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = '`total_paid_amount`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_NET_RECEIVED_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = '`net_received_amount`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_REGISTERED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`registered_at`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_FEE_MP)) {
            $modifiedColumns[':p' . $index++]  = '`fee_mp`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_FEE_NV)) {
            $modifiedColumns[':p' . $index++]  = '`fee_nv`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`card_type_id`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_METHOD_ID)) {
            $modifiedColumns[':p' . $index++]  = '`card_method_id`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_MONTH)) {
            $modifiedColumns[':p' . $index++]  = '`card_expiration_month`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_YEAR)) {
            $modifiedColumns[':p' . $index++]  = '`card_expiration_year`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`card_cardholder_identification_type`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`card_cardholder_identification_number`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`card_cardholder_name`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_CREATED)) {
            $modifiedColumns[':p' . $index++]  = '`card_date_created`';
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_LAST_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = '`card_date_last_updated`';
        }

        $sql = sprintf(
            'INSERT INTO `shipments_payments_extra` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`id_shipment`':
                        $stmt->bindValue($identifier, $this->id_shipment, PDO::PARAM_INT);
                        break;
                    case '`preference_id`':
                        $stmt->bindValue($identifier, $this->preference_id, PDO::PARAM_STR);
                        break;
                    case '`collection_id`':
                        $stmt->bindValue($identifier, $this->collection_id, PDO::PARAM_STR);
                        break;
                    case '`collection_status`':
                        $stmt->bindValue($identifier, $this->collection_status, PDO::PARAM_STR);
                        break;
                    case '`merchant_order_id`':
                        $stmt->bindValue($identifier, $this->merchant_order_id, PDO::PARAM_STR);
                        break;
                    case '`total_paid_amount`':
                        $stmt->bindValue($identifier, $this->total_paid_amount, PDO::PARAM_STR);
                        break;
                    case '`net_received_amount`':
                        $stmt->bindValue($identifier, $this->net_received_amount, PDO::PARAM_STR);
                        break;
                    case '`registered_at`':
                        $stmt->bindValue($identifier, $this->registered_at ? $this->registered_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`fee_mp`':
                        $stmt->bindValue($identifier, $this->fee_mp, PDO::PARAM_STR);
                        break;
                    case '`fee_nv`':
                        $stmt->bindValue($identifier, $this->fee_nv, PDO::PARAM_STR);
                        break;
                    case '`card_type_id`':
                        $stmt->bindValue($identifier, $this->card_type_id, PDO::PARAM_STR);
                        break;
                    case '`card_method_id`':
                        $stmt->bindValue($identifier, $this->card_method_id, PDO::PARAM_STR);
                        break;
                    case '`card_expiration_month`':
                        $stmt->bindValue($identifier, $this->card_expiration_month, PDO::PARAM_INT);
                        break;
                    case '`card_expiration_year`':
                        $stmt->bindValue($identifier, $this->card_expiration_year, PDO::PARAM_INT);
                        break;
                    case '`card_cardholder_identification_type`':
                        $stmt->bindValue($identifier, $this->card_cardholder_identification_type, PDO::PARAM_STR);
                        break;
                    case '`card_cardholder_identification_number`':
                        $stmt->bindValue($identifier, $this->card_cardholder_identification_number, PDO::PARAM_STR);
                        break;
                    case '`card_cardholder_name`':
                        $stmt->bindValue($identifier, $this->card_cardholder_name, PDO::PARAM_STR);
                        break;
                    case '`card_date_created`':
                        $stmt->bindValue($identifier, $this->card_date_created ? $this->card_date_created->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`card_date_last_updated`':
                        $stmt->bindValue($identifier, $this->card_date_last_updated ? $this->card_date_last_updated->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ShipmentsPaymentsExtraTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getIdShipment();
                break;
            case 2:
                return $this->getPreferenceId();
                break;
            case 3:
                return $this->getCollectionId();
                break;
            case 4:
                return $this->getCollectionStatus();
                break;
            case 5:
                return $this->getMerchantOrderId();
                break;
            case 6:
                return $this->getTotalPaidAmount();
                break;
            case 7:
                return $this->getNetReceivedAmount();
                break;
            case 8:
                return $this->getRegisteredAt();
                break;
            case 9:
                return $this->getFeeMp();
                break;
            case 10:
                return $this->getFeeNv();
                break;
            case 11:
                return $this->getCardTypeId();
                break;
            case 12:
                return $this->getCardMethodId();
                break;
            case 13:
                return $this->getCardExpirationMonth();
                break;
            case 14:
                return $this->getCardExpirationYear();
                break;
            case 15:
                return $this->getCardCardholderIdentificationType();
                break;
            case 16:
                return $this->getCardCardholderIdentificationNumber();
                break;
            case 17:
                return $this->getCardCardholderName();
                break;
            case 18:
                return $this->getCardDateCreated();
                break;
            case 19:
                return $this->getCardDateLastUpdated();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['ShipmentsPaymentsExtra'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ShipmentsPaymentsExtra'][$this->hashCode()] = true;
        $keys = ShipmentsPaymentsExtraTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdShipment(),
            $keys[2] => $this->getPreferenceId(),
            $keys[3] => $this->getCollectionId(),
            $keys[4] => $this->getCollectionStatus(),
            $keys[5] => $this->getMerchantOrderId(),
            $keys[6] => $this->getTotalPaidAmount(),
            $keys[7] => $this->getNetReceivedAmount(),
            $keys[8] => $this->getRegisteredAt(),
            $keys[9] => $this->getFeeMp(),
            $keys[10] => $this->getFeeNv(),
            $keys[11] => $this->getCardTypeId(),
            $keys[12] => $this->getCardMethodId(),
            $keys[13] => $this->getCardExpirationMonth(),
            $keys[14] => $this->getCardExpirationYear(),
            $keys[15] => $this->getCardCardholderIdentificationType(),
            $keys[16] => $this->getCardCardholderIdentificationNumber(),
            $keys[17] => $this->getCardCardholderName(),
            $keys[18] => $this->getCardDateCreated(),
            $keys[19] => $this->getCardDateLastUpdated(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[8]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[8]];
            $result[$keys[8]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[18]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[18]];
            $result[$keys[18]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[19]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[19]];
            $result[$keys[19]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\ShipmentsPaymentsExtra
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ShipmentsPaymentsExtraTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\ShipmentsPaymentsExtra
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdShipment($value);
                break;
            case 2:
                $this->setPreferenceId($value);
                break;
            case 3:
                $this->setCollectionId($value);
                break;
            case 4:
                $this->setCollectionStatus($value);
                break;
            case 5:
                $this->setMerchantOrderId($value);
                break;
            case 6:
                $this->setTotalPaidAmount($value);
                break;
            case 7:
                $this->setNetReceivedAmount($value);
                break;
            case 8:
                $this->setRegisteredAt($value);
                break;
            case 9:
                $this->setFeeMp($value);
                break;
            case 10:
                $this->setFeeNv($value);
                break;
            case 11:
                $this->setCardTypeId($value);
                break;
            case 12:
                $this->setCardMethodId($value);
                break;
            case 13:
                $this->setCardExpirationMonth($value);
                break;
            case 14:
                $this->setCardExpirationYear($value);
                break;
            case 15:
                $this->setCardCardholderIdentificationType($value);
                break;
            case 16:
                $this->setCardCardholderIdentificationNumber($value);
                break;
            case 17:
                $this->setCardCardholderName($value);
                break;
            case 18:
                $this->setCardDateCreated($value);
                break;
            case 19:
                $this->setCardDateLastUpdated($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ShipmentsPaymentsExtraTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdShipment($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPreferenceId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCollectionId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCollectionStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMerchantOrderId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTotalPaidAmount($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNetReceivedAmount($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setRegisteredAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFeeMp($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setFeeNv($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCardTypeId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCardMethodId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCardExpirationMonth($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCardExpirationYear($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCardCardholderIdentificationType($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCardCardholderIdentificationNumber($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCardCardholderName($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCardDateCreated($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCardDateLastUpdated($arr[$keys[19]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\ShipmentsPaymentsExtra The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ShipmentsPaymentsExtraTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_ID)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_ID_SHIPMENT)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_ID_SHIPMENT, $this->id_shipment);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_PREFERENCE_ID)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_PREFERENCE_ID, $this->preference_id);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_COLLECTION_ID)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_COLLECTION_ID, $this->collection_id);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_COLLECTION_STATUS)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_COLLECTION_STATUS, $this->collection_status);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_MERCHANT_ORDER_ID)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_MERCHANT_ORDER_ID, $this->merchant_order_id);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_TOTAL_PAID_AMOUNT)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_TOTAL_PAID_AMOUNT, $this->total_paid_amount);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_NET_RECEIVED_AMOUNT)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_NET_RECEIVED_AMOUNT, $this->net_received_amount);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_REGISTERED_AT)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_REGISTERED_AT, $this->registered_at);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_FEE_MP)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_FEE_MP, $this->fee_mp);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_FEE_NV)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_FEE_NV, $this->fee_nv);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_TYPE_ID)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_TYPE_ID, $this->card_type_id);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_METHOD_ID)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_METHOD_ID, $this->card_method_id);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_MONTH)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_MONTH, $this->card_expiration_month);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_YEAR)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_EXPIRATION_YEAR, $this->card_expiration_year);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_TYPE, $this->card_cardholder_identification_type);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_IDENTIFICATION_NUMBER, $this->card_cardholder_identification_number);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_NAME)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_CARDHOLDER_NAME, $this->card_cardholder_name);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_CREATED)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_CREATED, $this->card_date_created);
        }
        if ($this->isColumnModified(ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_LAST_UPDATED)) {
            $criteria->add(ShipmentsPaymentsExtraTableMap::COL_CARD_DATE_LAST_UPDATED, $this->card_date_last_updated);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildShipmentsPaymentsExtraQuery::create();
        $criteria->add(ShipmentsPaymentsExtraTableMap::COL_ID, $this->id);
        $criteria->add(ShipmentsPaymentsExtraTableMap::COL_COLLECTION_ID, $this->collection_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId() &&
            null !== $this->getCollectionId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getId();
        $pks[1] = $this->getCollectionId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setId($keys[0]);
        $this->setCollectionId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getId()) && (null === $this->getCollectionId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \ShipmentsPaymentsExtra (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdShipment($this->getIdShipment());
        $copyObj->setPreferenceId($this->getPreferenceId());
        $copyObj->setCollectionId($this->getCollectionId());
        $copyObj->setCollectionStatus($this->getCollectionStatus());
        $copyObj->setMerchantOrderId($this->getMerchantOrderId());
        $copyObj->setTotalPaidAmount($this->getTotalPaidAmount());
        $copyObj->setNetReceivedAmount($this->getNetReceivedAmount());
        $copyObj->setRegisteredAt($this->getRegisteredAt());
        $copyObj->setFeeMp($this->getFeeMp());
        $copyObj->setFeeNv($this->getFeeNv());
        $copyObj->setCardTypeId($this->getCardTypeId());
        $copyObj->setCardMethodId($this->getCardMethodId());
        $copyObj->setCardExpirationMonth($this->getCardExpirationMonth());
        $copyObj->setCardExpirationYear($this->getCardExpirationYear());
        $copyObj->setCardCardholderIdentificationType($this->getCardCardholderIdentificationType());
        $copyObj->setCardCardholderIdentificationNumber($this->getCardCardholderIdentificationNumber());
        $copyObj->setCardCardholderName($this->getCardCardholderName());
        $copyObj->setCardDateCreated($this->getCardDateCreated());
        $copyObj->setCardDateLastUpdated($this->getCardDateLastUpdated());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \ShipmentsPaymentsExtra Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->id_shipment = null;
        $this->preference_id = null;
        $this->collection_id = null;
        $this->collection_status = null;
        $this->merchant_order_id = null;
        $this->total_paid_amount = null;
        $this->net_received_amount = null;
        $this->registered_at = null;
        $this->fee_mp = null;
        $this->fee_nv = null;
        $this->card_type_id = null;
        $this->card_method_id = null;
        $this->card_expiration_month = null;
        $this->card_expiration_year = null;
        $this->card_cardholder_identification_type = null;
        $this->card_cardholder_identification_number = null;
        $this->card_cardholder_name = null;
        $this->card_date_created = null;
        $this->card_date_last_updated = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ShipmentsPaymentsExtraTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
