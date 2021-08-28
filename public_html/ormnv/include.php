<?php
    require_once '../vendor/autoload.php';
    require_once 'generated-conf/config.php';
    require_once 'settings.php';
    require_once 'crypt.php';
    require_once 'utils.php';

    function Commerces_Map($c) {
        if(!$c instanceof Commerces) {
            $c = CommercesQuery::create()->findPK($c);
        }
        $pc = $c->getPositionsCommerce();
        $hc = $c->getHeadingsCommerce();
        $pr = $c->getProvinces();
        $lo = $c->getProvincesLocalities();
        $mp = UsersMpQuery::create()->filterByIdUser($c->getIdUser())->findOne() ?: null;
        $canScheduleShipments = $c->getLogo() && $pc && $hc && $pr && $lo && $c->getBusinessName() && $c->getCuitCuil() && $c->getName() && $c->getPhone() && $c->getAddress() && $c->getAddressLat() && $c->getAddressLng() && $mp;
        $settings = CommercesPreferencesQuery::create()->filterByIdCommerce($c->getId())->findOne();

        $url = "https://nviame.com/api/users/login?email=" . $c->getEmail() . "&password_raw=" . $c->getPassword() . "&password=";
        $jsonLogin = file_get_contents($url, false, stream_context_create(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        )));
        $jsonData = json_decode($jsonLogin, true);

        return array(
            "Id" => $c->getId(),
            "IdUser" => $c->getIdUser(),
            "Logo" => $c->getLogo(),
            "Position" => $pc ? array(
                "Id" => $pc->getId(),
                "Name" => $pc->getName()
            ) : null,
            "Heading" => $hc ? array(
                "Id" => $hc->getId(),
                "Name" => $hc->getName()
            ) : null,
            "Province" => $pr ? array(
                "Id" => $pr->getId(),
                "Name" => $pr->getName()
            ) : null,
            "Locality" => $lo ? array(
                "Id" => $lo->getId(),
                "Name" => $lo->getName()
            ) : null,
            "Token" => $c->getToken(),
            "BusinessName" => $c->getBusinessName(),
            "CuitCuil" => $c->getCuitCuil(),
            "Name" => $c->getName(),
            "Phone" => $c->getPhone(),
            "PersonalPhone" => $c->getPhonePersonal(),
            "Email" => $c->getEmail(),
            "Address" => $c->getAddress(),
            "AddressLat" => $c->getAddressLat(),
            "AddressLng" => $c->getAddressLng(),
            "AddressLocality" => $c->getAddressLocality(),
            "AddressRegion" => $c->getAddressRegion(),
            "AddressCountry" => $c->getAddressCountry(),
            "Capabilities" => array(
                "CanScheduleShipments" => $canScheduleShipments
            ),
            "Preferences" => $settings ? json_decode($settings->toJSON(), true) : null,
            "MP" => $mp ? json_decode($mp->toJSON(), true) : null,
            "RawUserData" => isset($jsonData["user_info"]) ? $jsonData["user_info"] : null
        );
    }