<?php

namespace Base;

use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \Exception;
use \PDO;
use Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersQuery orderByIdCompany($order = Criteria::ASC) Order by the id_company column
 * @method     ChildUsersQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     ChildUsersQuery orderByFullname($order = Criteria::ASC) Order by the fullname column
 * @method     ChildUsersQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildUsersQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildUsersQuery orderByCountryCode($order = Criteria::ASC) Order by the country_code column
 * @method     ChildUsersQuery orderByHomeAddress($order = Criteria::ASC) Order by the home_address column
 * @method     ChildUsersQuery orderByProvidenceCode($order = Criteria::ASC) Order by the providence_code column
 * @method     ChildUsersQuery orderByProvidence($order = Criteria::ASC) Order by the providence column
 * @method     ChildUsersQuery orderByLocalityCode($order = Criteria::ASC) Order by the locality_code column
 * @method     ChildUsersQuery orderByLocality($order = Criteria::ASC) Order by the locality column
 * @method     ChildUsersQuery orderByPostalCode($order = Criteria::ASC) Order by the postal_code column
 * @method     ChildUsersQuery orderByDni($order = Criteria::ASC) Order by the dni column
 * @method     ChildUsersQuery orderByDniFront($order = Criteria::ASC) Order by the dni_front column
 * @method     ChildUsersQuery orderByDniBack($order = Criteria::ASC) Order by the dni_back column
 * @method     ChildUsersQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildUsersQuery orderByDriversLicense($order = Criteria::ASC) Order by the drivers_license column
 * @method     ChildUsersQuery orderByOverallRating($order = Criteria::ASC) Order by the overall_rating column
 * @method     ChildUsersQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUsersQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildUsersQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildUsersQuery orderByLastLocationLat($order = Criteria::ASC) Order by the last_location_lat column
 * @method     ChildUsersQuery orderByLastLocationLng($order = Criteria::ASC) Order by the last_location_lng column
 * @method     ChildUsersQuery orderByLastLocationDatetime($order = Criteria::ASC) Order by the last_location_datetime column
 * @method     ChildUsersQuery orderByLastLocationLocality($order = Criteria::ASC) Order by the last_location_locality column
 * @method     ChildUsersQuery orderByLastLocationRegion($order = Criteria::ASC) Order by the last_location_region column
 * @method     ChildUsersQuery orderByLastLocationCountry($order = Criteria::ASC) Order by the last_location_country column
 * @method     ChildUsersQuery orderByTimezone($order = Criteria::ASC) Order by the timezone column
 * @method     ChildUsersQuery orderByTraveling($order = Criteria::ASC) Order by the traveling column
 * @method     ChildUsersQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildUsersQuery orderByPwdResetCode($order = Criteria::ASC) Order by the pwd_reset_code column
 * @method     ChildUsersQuery orderByCommission($order = Criteria::ASC) Order by the commission column
 * @method     ChildUsersQuery orderByDisabled($order = Criteria::ASC) Order by the disabled column
 *
 * @method     ChildUsersQuery groupById() Group by the id column
 * @method     ChildUsersQuery groupByIdCompany() Group by the id_company column
 * @method     ChildUsersQuery groupByAvatar() Group by the avatar column
 * @method     ChildUsersQuery groupByFullname() Group by the fullname column
 * @method     ChildUsersQuery groupByFirstName() Group by the first_name column
 * @method     ChildUsersQuery groupByLastName() Group by the last_name column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByCountry() Group by the country column
 * @method     ChildUsersQuery groupByCountryCode() Group by the country_code column
 * @method     ChildUsersQuery groupByHomeAddress() Group by the home_address column
 * @method     ChildUsersQuery groupByProvidenceCode() Group by the providence_code column
 * @method     ChildUsersQuery groupByProvidence() Group by the providence column
 * @method     ChildUsersQuery groupByLocalityCode() Group by the locality_code column
 * @method     ChildUsersQuery groupByLocality() Group by the locality column
 * @method     ChildUsersQuery groupByPostalCode() Group by the postal_code column
 * @method     ChildUsersQuery groupByDni() Group by the dni column
 * @method     ChildUsersQuery groupByDniFront() Group by the dni_front column
 * @method     ChildUsersQuery groupByDniBack() Group by the dni_back column
 * @method     ChildUsersQuery groupByPhone() Group by the phone column
 * @method     ChildUsersQuery groupByDriversLicense() Group by the drivers_license column
 * @method     ChildUsersQuery groupByOverallRating() Group by the overall_rating column
 * @method     ChildUsersQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUsersQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildUsersQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildUsersQuery groupByLastLocationLat() Group by the last_location_lat column
 * @method     ChildUsersQuery groupByLastLocationLng() Group by the last_location_lng column
 * @method     ChildUsersQuery groupByLastLocationDatetime() Group by the last_location_datetime column
 * @method     ChildUsersQuery groupByLastLocationLocality() Group by the last_location_locality column
 * @method     ChildUsersQuery groupByLastLocationRegion() Group by the last_location_region column
 * @method     ChildUsersQuery groupByLastLocationCountry() Group by the last_location_country column
 * @method     ChildUsersQuery groupByTimezone() Group by the timezone column
 * @method     ChildUsersQuery groupByTraveling() Group by the traveling column
 * @method     ChildUsersQuery groupByVerified() Group by the verified column
 * @method     ChildUsersQuery groupByPwdResetCode() Group by the pwd_reset_code column
 * @method     ChildUsersQuery groupByCommission() Group by the commission column
 * @method     ChildUsersQuery groupByDisabled() Group by the disabled column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsers findOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers findOneById(int $id) Return the first ChildUsers filtered by the id column
 * @method     ChildUsers findOneByIdCompany(int $id_company) Return the first ChildUsers filtered by the id_company column
 * @method     ChildUsers findOneByAvatar(string $avatar) Return the first ChildUsers filtered by the avatar column
 * @method     ChildUsers findOneByFullname(string $fullname) Return the first ChildUsers filtered by the fullname column
 * @method     ChildUsers findOneByFirstName(string $first_name) Return the first ChildUsers filtered by the first_name column
 * @method     ChildUsers findOneByLastName(string $last_name) Return the first ChildUsers filtered by the last_name column
 * @method     ChildUsers findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers findOneByCountry(string $country) Return the first ChildUsers filtered by the country column
 * @method     ChildUsers findOneByCountryCode(string $country_code) Return the first ChildUsers filtered by the country_code column
 * @method     ChildUsers findOneByHomeAddress(string $home_address) Return the first ChildUsers filtered by the home_address column
 * @method     ChildUsers findOneByProvidenceCode(string $providence_code) Return the first ChildUsers filtered by the providence_code column
 * @method     ChildUsers findOneByProvidence(string $providence) Return the first ChildUsers filtered by the providence column
 * @method     ChildUsers findOneByLocalityCode(string $locality_code) Return the first ChildUsers filtered by the locality_code column
 * @method     ChildUsers findOneByLocality(string $locality) Return the first ChildUsers filtered by the locality column
 * @method     ChildUsers findOneByPostalCode(string $postal_code) Return the first ChildUsers filtered by the postal_code column
 * @method     ChildUsers findOneByDni(string $dni) Return the first ChildUsers filtered by the dni column
 * @method     ChildUsers findOneByDniFront(string $dni_front) Return the first ChildUsers filtered by the dni_front column
 * @method     ChildUsers findOneByDniBack(string $dni_back) Return the first ChildUsers filtered by the dni_back column
 * @method     ChildUsers findOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column
 * @method     ChildUsers findOneByDriversLicense(string $drivers_license) Return the first ChildUsers filtered by the drivers_license column
 * @method     ChildUsers findOneByOverallRating(double $overall_rating) Return the first ChildUsers filtered by the overall_rating column
 * @method     ChildUsers findOneByLastLogin(string $last_login) Return the first ChildUsers filtered by the last_login column
 * @method     ChildUsers findOneByRegisteredAt(string $registered_at) Return the first ChildUsers filtered by the registered_at column
 * @method     ChildUsers findOneByUpdatedAt(string $updated_at) Return the first ChildUsers filtered by the updated_at column
 * @method     ChildUsers findOneByLastLocationLat(string $last_location_lat) Return the first ChildUsers filtered by the last_location_lat column
 * @method     ChildUsers findOneByLastLocationLng(string $last_location_lng) Return the first ChildUsers filtered by the last_location_lng column
 * @method     ChildUsers findOneByLastLocationDatetime(string $last_location_datetime) Return the first ChildUsers filtered by the last_location_datetime column
 * @method     ChildUsers findOneByLastLocationLocality(string $last_location_locality) Return the first ChildUsers filtered by the last_location_locality column
 * @method     ChildUsers findOneByLastLocationRegion(string $last_location_region) Return the first ChildUsers filtered by the last_location_region column
 * @method     ChildUsers findOneByLastLocationCountry(string $last_location_country) Return the first ChildUsers filtered by the last_location_country column
 * @method     ChildUsers findOneByTimezone(string $timezone) Return the first ChildUsers filtered by the timezone column
 * @method     ChildUsers findOneByTraveling(boolean $traveling) Return the first ChildUsers filtered by the traveling column
 * @method     ChildUsers findOneByVerified(boolean $verified) Return the first ChildUsers filtered by the verified column
 * @method     ChildUsers findOneByPwdResetCode(string $pwd_reset_code) Return the first ChildUsers filtered by the pwd_reset_code column
 * @method     ChildUsers findOneByCommission(int $commission) Return the first ChildUsers filtered by the commission column
 * @method     ChildUsers findOneByDisabled(boolean $disabled) Return the first ChildUsers filtered by the disabled column *

 * @method     ChildUsers requirePk($key, ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneById(int $id) Return the first ChildUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIdCompany(int $id_company) Return the first ChildUsers filtered by the id_company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByAvatar(string $avatar) Return the first ChildUsers filtered by the avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByFullname(string $fullname) Return the first ChildUsers filtered by the fullname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByFirstName(string $first_name) Return the first ChildUsers filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastName(string $last_name) Return the first ChildUsers filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByCountry(string $country) Return the first ChildUsers filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByCountryCode(string $country_code) Return the first ChildUsers filtered by the country_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByHomeAddress(string $home_address) Return the first ChildUsers filtered by the home_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByProvidenceCode(string $providence_code) Return the first ChildUsers filtered by the providence_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByProvidence(string $providence) Return the first ChildUsers filtered by the providence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLocalityCode(string $locality_code) Return the first ChildUsers filtered by the locality_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLocality(string $locality) Return the first ChildUsers filtered by the locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPostalCode(string $postal_code) Return the first ChildUsers filtered by the postal_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByDni(string $dni) Return the first ChildUsers filtered by the dni column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByDniFront(string $dni_front) Return the first ChildUsers filtered by the dni_front column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByDniBack(string $dni_back) Return the first ChildUsers filtered by the dni_back column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByDriversLicense(string $drivers_license) Return the first ChildUsers filtered by the drivers_license column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByOverallRating(double $overall_rating) Return the first ChildUsers filtered by the overall_rating column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLogin(string $last_login) Return the first ChildUsers filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRegisteredAt(string $registered_at) Return the first ChildUsers filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUpdatedAt(string $updated_at) Return the first ChildUsers filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLocationLat(string $last_location_lat) Return the first ChildUsers filtered by the last_location_lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLocationLng(string $last_location_lng) Return the first ChildUsers filtered by the last_location_lng column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLocationDatetime(string $last_location_datetime) Return the first ChildUsers filtered by the last_location_datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLocationLocality(string $last_location_locality) Return the first ChildUsers filtered by the last_location_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLocationRegion(string $last_location_region) Return the first ChildUsers filtered by the last_location_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLocationCountry(string $last_location_country) Return the first ChildUsers filtered by the last_location_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByTimezone(string $timezone) Return the first ChildUsers filtered by the timezone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByTraveling(boolean $traveling) Return the first ChildUsers filtered by the traveling column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByVerified(boolean $verified) Return the first ChildUsers filtered by the verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPwdResetCode(string $pwd_reset_code) Return the first ChildUsers filtered by the pwd_reset_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByCommission(int $commission) Return the first ChildUsers filtered by the commission column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByDisabled(boolean $disabled) Return the first ChildUsers filtered by the disabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|ObjectCollection findById(int $id) Return ChildUsers objects filtered by the id column
 * @method     ChildUsers[]|ObjectCollection findByIdCompany(int $id_company) Return ChildUsers objects filtered by the id_company column
 * @method     ChildUsers[]|ObjectCollection findByAvatar(string $avatar) Return ChildUsers objects filtered by the avatar column
 * @method     ChildUsers[]|ObjectCollection findByFullname(string $fullname) Return ChildUsers objects filtered by the fullname column
 * @method     ChildUsers[]|ObjectCollection findByFirstName(string $first_name) Return ChildUsers objects filtered by the first_name column
 * @method     ChildUsers[]|ObjectCollection findByLastName(string $last_name) Return ChildUsers objects filtered by the last_name column
 * @method     ChildUsers[]|ObjectCollection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|ObjectCollection findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|ObjectCollection findByCountry(string $country) Return ChildUsers objects filtered by the country column
 * @method     ChildUsers[]|ObjectCollection findByCountryCode(string $country_code) Return ChildUsers objects filtered by the country_code column
 * @method     ChildUsers[]|ObjectCollection findByHomeAddress(string $home_address) Return ChildUsers objects filtered by the home_address column
 * @method     ChildUsers[]|ObjectCollection findByProvidenceCode(string $providence_code) Return ChildUsers objects filtered by the providence_code column
 * @method     ChildUsers[]|ObjectCollection findByProvidence(string $providence) Return ChildUsers objects filtered by the providence column
 * @method     ChildUsers[]|ObjectCollection findByLocalityCode(string $locality_code) Return ChildUsers objects filtered by the locality_code column
 * @method     ChildUsers[]|ObjectCollection findByLocality(string $locality) Return ChildUsers objects filtered by the locality column
 * @method     ChildUsers[]|ObjectCollection findByPostalCode(string $postal_code) Return ChildUsers objects filtered by the postal_code column
 * @method     ChildUsers[]|ObjectCollection findByDni(string $dni) Return ChildUsers objects filtered by the dni column
 * @method     ChildUsers[]|ObjectCollection findByDniFront(string $dni_front) Return ChildUsers objects filtered by the dni_front column
 * @method     ChildUsers[]|ObjectCollection findByDniBack(string $dni_back) Return ChildUsers objects filtered by the dni_back column
 * @method     ChildUsers[]|ObjectCollection findByPhone(string $phone) Return ChildUsers objects filtered by the phone column
 * @method     ChildUsers[]|ObjectCollection findByDriversLicense(string $drivers_license) Return ChildUsers objects filtered by the drivers_license column
 * @method     ChildUsers[]|ObjectCollection findByOverallRating(double $overall_rating) Return ChildUsers objects filtered by the overall_rating column
 * @method     ChildUsers[]|ObjectCollection findByLastLogin(string $last_login) Return ChildUsers objects filtered by the last_login column
 * @method     ChildUsers[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildUsers objects filtered by the registered_at column
 * @method     ChildUsers[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUsers objects filtered by the updated_at column
 * @method     ChildUsers[]|ObjectCollection findByLastLocationLat(string $last_location_lat) Return ChildUsers objects filtered by the last_location_lat column
 * @method     ChildUsers[]|ObjectCollection findByLastLocationLng(string $last_location_lng) Return ChildUsers objects filtered by the last_location_lng column
 * @method     ChildUsers[]|ObjectCollection findByLastLocationDatetime(string $last_location_datetime) Return ChildUsers objects filtered by the last_location_datetime column
 * @method     ChildUsers[]|ObjectCollection findByLastLocationLocality(string $last_location_locality) Return ChildUsers objects filtered by the last_location_locality column
 * @method     ChildUsers[]|ObjectCollection findByLastLocationRegion(string $last_location_region) Return ChildUsers objects filtered by the last_location_region column
 * @method     ChildUsers[]|ObjectCollection findByLastLocationCountry(string $last_location_country) Return ChildUsers objects filtered by the last_location_country column
 * @method     ChildUsers[]|ObjectCollection findByTimezone(string $timezone) Return ChildUsers objects filtered by the timezone column
 * @method     ChildUsers[]|ObjectCollection findByTraveling(boolean $traveling) Return ChildUsers objects filtered by the traveling column
 * @method     ChildUsers[]|ObjectCollection findByVerified(boolean $verified) Return ChildUsers objects filtered by the verified column
 * @method     ChildUsers[]|ObjectCollection findByPwdResetCode(string $pwd_reset_code) Return ChildUsers objects filtered by the pwd_reset_code column
 * @method     ChildUsers[]|ObjectCollection findByCommission(int $commission) Return ChildUsers objects filtered by the commission column
 * @method     ChildUsers[]|ObjectCollection findByDisabled(boolean $disabled) Return ChildUsers objects filtered by the disabled column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_company`, `avatar`, `fullname`, `first_name`, `last_name`, `password`, `email`, `country`, `country_code`, `home_address`, `providence_code`, `providence`, `locality_code`, `locality`, `postal_code`, `dni`, `dni_front`, `dni_back`, `phone`, `drivers_license`, `overall_rating`, `last_login`, `registered_at`, `updated_at`, `last_location_lat`, `last_location_lng`, `last_location_datetime`, `last_location_locality`, `last_location_region`, `last_location_country`, `timezone`, `traveling`, `verified`, `pwd_reset_code`, `commission`, `disabled` FROM `users` WHERE `id` = :p0';
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
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_company column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCompany(1234); // WHERE id_company = 1234
     * $query->filterByIdCompany(array(12, 34)); // WHERE id_company IN (12, 34)
     * $query->filterByIdCompany(array('min' => 12)); // WHERE id_company > 12
     * </code>
     *
     * @param     mixed $idCompany The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByIdCompany($idCompany = null, $comparison = null)
    {
        if (is_array($idCompany)) {
            $useMinMax = false;
            if (isset($idCompany['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_COMPANY, $idCompany['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCompany['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_COMPANY, $idCompany['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ID_COMPANY, $idCompany, $comparison);
    }

    /**
     * Filter the query on the avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatar('fooValue');   // WHERE avatar = 'fooValue'
     * $query->filterByAvatar('%fooValue%'); // WHERE avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $avatar)) {
                $avatar = str_replace('*', '%', $avatar);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_AVATAR, $avatar, $comparison);
    }

    /**
     * Filter the query on the fullname column
     *
     * Example usage:
     * <code>
     * $query->filterByFullname('fooValue');   // WHERE fullname = 'fooValue'
     * $query->filterByFullname('%fooValue%'); // WHERE fullname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fullname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByFullname($fullname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fullname)) {
                $fullname = str_replace('*', '%', $fullname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_FULLNAME, $fullname, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastName)) {
                $lastName = str_replace('*', '%', $lastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $country)) {
                $country = str_replace('*', '%', $country);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the country_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryCode('fooValue');   // WHERE country_code = 'fooValue'
     * $query->filterByCountryCode('%fooValue%'); // WHERE country_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $countryCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByCountryCode($countryCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countryCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $countryCode)) {
                $countryCode = str_replace('*', '%', $countryCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_COUNTRY_CODE, $countryCode, $comparison);
    }

    /**
     * Filter the query on the home_address column
     *
     * Example usage:
     * <code>
     * $query->filterByHomeAddress('fooValue');   // WHERE home_address = 'fooValue'
     * $query->filterByHomeAddress('%fooValue%'); // WHERE home_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $homeAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByHomeAddress($homeAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($homeAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $homeAddress)) {
                $homeAddress = str_replace('*', '%', $homeAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_HOME_ADDRESS, $homeAddress, $comparison);
    }

    /**
     * Filter the query on the providence_code column
     *
     * Example usage:
     * <code>
     * $query->filterByProvidenceCode('fooValue');   // WHERE providence_code = 'fooValue'
     * $query->filterByProvidenceCode('%fooValue%'); // WHERE providence_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $providenceCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByProvidenceCode($providenceCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($providenceCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $providenceCode)) {
                $providenceCode = str_replace('*', '%', $providenceCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PROVIDENCE_CODE, $providenceCode, $comparison);
    }

    /**
     * Filter the query on the providence column
     *
     * Example usage:
     * <code>
     * $query->filterByProvidence('fooValue');   // WHERE providence = 'fooValue'
     * $query->filterByProvidence('%fooValue%'); // WHERE providence LIKE '%fooValue%'
     * </code>
     *
     * @param     string $providence The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByProvidence($providence = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($providence)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $providence)) {
                $providence = str_replace('*', '%', $providence);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PROVIDENCE, $providence, $comparison);
    }

    /**
     * Filter the query on the locality_code column
     *
     * Example usage:
     * <code>
     * $query->filterByLocalityCode('fooValue');   // WHERE locality_code = 'fooValue'
     * $query->filterByLocalityCode('%fooValue%'); // WHERE locality_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $localityCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLocalityCode($localityCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($localityCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $localityCode)) {
                $localityCode = str_replace('*', '%', $localityCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LOCALITY_CODE, $localityCode, $comparison);
    }

    /**
     * Filter the query on the locality column
     *
     * Example usage:
     * <code>
     * $query->filterByLocality('fooValue');   // WHERE locality = 'fooValue'
     * $query->filterByLocality('%fooValue%'); // WHERE locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLocality($locality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locality)) {
                $locality = str_replace('*', '%', $locality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LOCALITY, $locality, $comparison);
    }

    /**
     * Filter the query on the postal_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCode('fooValue');   // WHERE postal_code = 'fooValue'
     * $query->filterByPostalCode('%fooValue%'); // WHERE postal_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postalCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPostalCode($postalCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postalCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postalCode)) {
                $postalCode = str_replace('*', '%', $postalCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_POSTAL_CODE, $postalCode, $comparison);
    }

    /**
     * Filter the query on the dni column
     *
     * Example usage:
     * <code>
     * $query->filterByDni('fooValue');   // WHERE dni = 'fooValue'
     * $query->filterByDni('%fooValue%'); // WHERE dni LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dni The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDni($dni = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dni)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dni)) {
                $dni = str_replace('*', '%', $dni);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_DNI, $dni, $comparison);
    }

    /**
     * Filter the query on the dni_front column
     *
     * Example usage:
     * <code>
     * $query->filterByDniFront('fooValue');   // WHERE dni_front = 'fooValue'
     * $query->filterByDniFront('%fooValue%'); // WHERE dni_front LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dniFront The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDniFront($dniFront = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dniFront)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dniFront)) {
                $dniFront = str_replace('*', '%', $dniFront);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_DNI_FRONT, $dniFront, $comparison);
    }

    /**
     * Filter the query on the dni_back column
     *
     * Example usage:
     * <code>
     * $query->filterByDniBack('fooValue');   // WHERE dni_back = 'fooValue'
     * $query->filterByDniBack('%fooValue%'); // WHERE dni_back LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dniBack The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDniBack($dniBack = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dniBack)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dniBack)) {
                $dniBack = str_replace('*', '%', $dniBack);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_DNI_BACK, $dniBack, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the drivers_license column
     *
     * Example usage:
     * <code>
     * $query->filterByDriversLicense('fooValue');   // WHERE drivers_license = 'fooValue'
     * $query->filterByDriversLicense('%fooValue%'); // WHERE drivers_license LIKE '%fooValue%'
     * </code>
     *
     * @param     string $driversLicense The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDriversLicense($driversLicense = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($driversLicense)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $driversLicense)) {
                $driversLicense = str_replace('*', '%', $driversLicense);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_DRIVERS_LICENSE, $driversLicense, $comparison);
    }

    /**
     * Filter the query on the overall_rating column
     *
     * Example usage:
     * <code>
     * $query->filterByOverallRating(1234); // WHERE overall_rating = 1234
     * $query->filterByOverallRating(array(12, 34)); // WHERE overall_rating IN (12, 34)
     * $query->filterByOverallRating(array('min' => 12)); // WHERE overall_rating > 12
     * </code>
     *
     * @param     mixed $overallRating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByOverallRating($overallRating = null, $comparison = null)
    {
        if (is_array($overallRating)) {
            $useMinMax = false;
            if (isset($overallRating['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_OVERALL_RATING, $overallRating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($overallRating['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_OVERALL_RATING, $overallRating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_OVERALL_RATING, $overallRating, $comparison);
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin('2011-03-14'); // WHERE last_login = '2011-03-14'
     * $query->filterByLastLogin('now'); // WHERE last_login = '2011-03-14'
     * $query->filterByLastLogin(array('max' => 'yesterday')); // WHERE last_login > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastLogin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the last_location_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLocationLat(1234); // WHERE last_location_lat = 1234
     * $query->filterByLastLocationLat(array(12, 34)); // WHERE last_location_lat IN (12, 34)
     * $query->filterByLastLocationLat(array('min' => 12)); // WHERE last_location_lat > 12
     * </code>
     *
     * @param     mixed $lastLocationLat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastLocationLat($lastLocationLat = null, $comparison = null)
    {
        if (is_array($lastLocationLat)) {
            $useMinMax = false;
            if (isset($lastLocationLat['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_LAT, $lastLocationLat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLocationLat['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_LAT, $lastLocationLat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_LAT, $lastLocationLat, $comparison);
    }

    /**
     * Filter the query on the last_location_lng column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLocationLng(1234); // WHERE last_location_lng = 1234
     * $query->filterByLastLocationLng(array(12, 34)); // WHERE last_location_lng IN (12, 34)
     * $query->filterByLastLocationLng(array('min' => 12)); // WHERE last_location_lng > 12
     * </code>
     *
     * @param     mixed $lastLocationLng The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastLocationLng($lastLocationLng = null, $comparison = null)
    {
        if (is_array($lastLocationLng)) {
            $useMinMax = false;
            if (isset($lastLocationLng['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_LNG, $lastLocationLng['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLocationLng['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_LNG, $lastLocationLng['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_LNG, $lastLocationLng, $comparison);
    }

    /**
     * Filter the query on the last_location_datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLocationDatetime('2011-03-14'); // WHERE last_location_datetime = '2011-03-14'
     * $query->filterByLastLocationDatetime('now'); // WHERE last_location_datetime = '2011-03-14'
     * $query->filterByLastLocationDatetime(array('max' => 'yesterday')); // WHERE last_location_datetime > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastLocationDatetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastLocationDatetime($lastLocationDatetime = null, $comparison = null)
    {
        if (is_array($lastLocationDatetime)) {
            $useMinMax = false;
            if (isset($lastLocationDatetime['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_DATETIME, $lastLocationDatetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLocationDatetime['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_DATETIME, $lastLocationDatetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_DATETIME, $lastLocationDatetime, $comparison);
    }

    /**
     * Filter the query on the last_location_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLocationLocality('fooValue');   // WHERE last_location_locality = 'fooValue'
     * $query->filterByLastLocationLocality('%fooValue%'); // WHERE last_location_locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastLocationLocality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastLocationLocality($lastLocationLocality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastLocationLocality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastLocationLocality)) {
                $lastLocationLocality = str_replace('*', '%', $lastLocationLocality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_LOCALITY, $lastLocationLocality, $comparison);
    }

    /**
     * Filter the query on the last_location_region column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLocationRegion('fooValue');   // WHERE last_location_region = 'fooValue'
     * $query->filterByLastLocationRegion('%fooValue%'); // WHERE last_location_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastLocationRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastLocationRegion($lastLocationRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastLocationRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastLocationRegion)) {
                $lastLocationRegion = str_replace('*', '%', $lastLocationRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_REGION, $lastLocationRegion, $comparison);
    }

    /**
     * Filter the query on the last_location_country column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLocationCountry('fooValue');   // WHERE last_location_country = 'fooValue'
     * $query->filterByLastLocationCountry('%fooValue%'); // WHERE last_location_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastLocationCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastLocationCountry($lastLocationCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastLocationCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastLocationCountry)) {
                $lastLocationCountry = str_replace('*', '%', $lastLocationCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LAST_LOCATION_COUNTRY, $lastLocationCountry, $comparison);
    }

    /**
     * Filter the query on the timezone column
     *
     * Example usage:
     * <code>
     * $query->filterByTimezone('fooValue');   // WHERE timezone = 'fooValue'
     * $query->filterByTimezone('%fooValue%'); // WHERE timezone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $timezone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByTimezone($timezone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timezone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $timezone)) {
                $timezone = str_replace('*', '%', $timezone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_TIMEZONE, $timezone, $comparison);
    }

    /**
     * Filter the query on the traveling column
     *
     * Example usage:
     * <code>
     * $query->filterByTraveling(true); // WHERE traveling = true
     * $query->filterByTraveling('yes'); // WHERE traveling = true
     * </code>
     *
     * @param     boolean|string $traveling The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByTraveling($traveling = null, $comparison = null)
    {
        if (is_string($traveling)) {
            $traveling = in_array(strtolower($traveling), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersTableMap::COL_TRAVELING, $traveling, $comparison);
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(true); // WHERE verified = true
     * $query->filterByVerified('yes'); // WHERE verified = true
     * </code>
     *
     * @param     boolean|string $verified The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByVerified($verified = null, $comparison = null)
    {
        if (is_string($verified)) {
            $verified = in_array(strtolower($verified), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified, $comparison);
    }

    /**
     * Filter the query on the pwd_reset_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPwdResetCode('fooValue');   // WHERE pwd_reset_code = 'fooValue'
     * $query->filterByPwdResetCode('%fooValue%'); // WHERE pwd_reset_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pwdResetCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPwdResetCode($pwdResetCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pwdResetCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pwdResetCode)) {
                $pwdResetCode = str_replace('*', '%', $pwdResetCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PWD_RESET_CODE, $pwdResetCode, $comparison);
    }

    /**
     * Filter the query on the commission column
     *
     * Example usage:
     * <code>
     * $query->filterByCommission(1234); // WHERE commission = 1234
     * $query->filterByCommission(array(12, 34)); // WHERE commission IN (12, 34)
     * $query->filterByCommission(array('min' => 12)); // WHERE commission > 12
     * </code>
     *
     * @param     mixed $commission The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByCommission($commission = null, $comparison = null)
    {
        if (is_array($commission)) {
            $useMinMax = false;
            if (isset($commission['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_COMMISSION, $commission['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commission['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_COMMISSION, $commission['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_COMMISSION, $commission, $comparison);
    }

    /**
     * Filter the query on the disabled column
     *
     * Example usage:
     * <code>
     * $query->filterByDisabled(true); // WHERE disabled = true
     * $query->filterByDisabled('yes'); // WHERE disabled = true
     * </code>
     *
     * @param     boolean|string $disabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDisabled($disabled = null, $comparison = null)
    {
        if (is_string($disabled)) {
            $disabled = in_array(strtolower($disabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersTableMap::COL_DISABLED, $disabled, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsers $users Object to remove from the list of results
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_ID, $users->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersQuery
