<?php

class GeocodableTest extends AddressableBuilder
{

    protected static $use_draft_site = true;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testGeocodable()
    {
        $silverStripe = new AddressableTestDataObject();
        $silverStripe->Address = '101-103 Courtenay Place';
        $silverStripe->Suburb = 'Wellington';
        $silverStripe->Postcode = '6011';
        $silverStripe->Country = 'NZ';
        $silverStripe->write();
        $silverStripeID = $silverStripe->ID;

        $dynamic = new AddressableTestDataObject();
        $dynamic->Address = '1526 South 12th Street';
        $dynamic->Suburb = 'Sheboygan';
        $dynamic->State = 'WI';
        $dynamic->Postcode = '53081';
        $dynamic->Country = 'US';
        $dynamic->write();
        $dynamicID = $dynamic->ID;

        $geoCodable = AddressableTestDataObject::get()->byID($silverStripeID);
        $geoCodable2 = AddressableTestDataObject::get()->byID($dynamicID);

        $silverstripeLat = -41.29256;
        $silverstripeLng = 174.77896;

        $dynamicLat = 43.73770;
        $dynamicLng =  -87.72003;

        $this->assertTrue($geoCodable->Lat == $silverstripeLat);
        $this->assertTrue($geoCodable->Lng == $silverstripeLng);
        $this->assertTrue($geoCodable2->Lat == $dynamicLat);
        $this->assertTrue($geoCodable2->Lng == $dynamicLng);
    }
}
