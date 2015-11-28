<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\cURL;
use DTS\eBaySDK\Constants;
use DTS\eBaySDK\HttpClient\HttpClient;
use DTS\eBaySDK\Trading\Services;
use DTS\eBaySDK\Trading\Types;
use DTS\eBaySDK\Trading\Enums;

class PostController extends Controller
{

    /**
     * @Route("/post", name="post")
     */
    public function postAction()
    {
        /**
         * eBay Service
         */

        /**
         * App credentials
         */
        $config = array(
            "sandbox" => array(
                "devId" => "a32b03dc-9ce0-46ac-be02-0f507f8c621e",
                "appId" => "AldoGonz-d766-44ac-828e-0a02176a1335",
                "certId" => "3f02b4c5-ed1e-4c15-afcc-d261b0f9a45c",
                "userToken" => "AgAAAA**AQAAAA**aAAAAA**qcpDVg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDpOLogSdj6x9nY+seQ**X58DAA**AAMAAA**fs2gtPbznKBfshgP5rdTgGmjnNaXUt+47mNRzfx5NQmD2lU9EA8WoyQEKz3Ej1Ab/jAc6EwmfCqYApklIfWTC9KkZdMNmffmCu1F2jKGg9qfjHSeivxVA4nVsedM69KUK3/uak2IhoQrfalbbVtclk9gdjvymluW4c7B9cwS2WQdZxp2eyqWL6OMSMR1mBtLmRYcoEtjmDl4HJLKCzEUDrTKRhHJkEbn7u2KzUS50r7q/5N0cgr3syQwM+HwQDs62z1TAmsXpfgddklCoImFrKYw9UxXo9GHcMrHtMrCpe2tlcGT0JWHs0BDei32KQ7euUEiU1tP9C06UfRX3CIlWXt+gOzYynkpmBdpOzLLWCB5T9C7jxBz/cs61m1ve+ql8RHpczI+I/IA/R9C7FhQhSQ+KbRohMffMz+us4pm5HQqaIKfrlCpB1auoX1KjAVyl9gyCPVexGiYR+hIsnVY5KpMarLsVNGm9uzTY5xKx54F5jAnCdMcII3CNzyTQ/WEdi0J4y7j2LCoKzJSG20QiUlI1o+5bUZ2WbAQKvsMFRZgC9zo2ox2dhke5EL/oIYZNJfOBjlIL19ZOMcl9MbOrvmcHHC5mwFGCprC2zWR2bVDUMWoPT9EtCgcu86klFB7oP7TxHnMoRpLcfVrntnwoz26bpCKbFNakOejTHq9W26mgwGec5sN6OV1ER7LS+EjRYxq5nH5i6/Cv0VSPqJvuXL+fV3O6bnzVTZrkzTTtldtOZFT0EDk+HrL8AyqGq7u"
            ),
            "production" => array(
                "devId" => "a32b03dc-9ce0-46ac-be02-0f507f8c621e",
                "appId" => "AldoGonz-45f7-4613-aee6-d5b672457d2e",
                "certId" => "717118d4-958e-49e7-80f1-e41d278f0805",
                "userToken" => "AgAAAA**AQAAAA**aAAAAA**5MhDVg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AFl4uoAZeFpgqdj6x9nY+seQ**ohEDAA**AAMAAA**LJ440j75vFqm1uo6OZtYXplEwKRJhIybfa+jsfMP8YAjS2e+hGBMmlKpwwaXBztTk6QKIp263UP4ml/aurAwyKLwWj14D2m92ltZFC61yzWh74qhxqR6f9D9LsiyueBlvU5yJRqsGiaiQm7UKj7rByE4s00rQDnvlspv5L+kMK1KTuPMEp3OjNZOJjuw63F9DYeyPkBWYKnF2GsnRSI0aiy5Zz9gxPynWiUyQQYWpC/gMedP2kEvcK8cIbYa3bI41Zp8e5GRA5YscApazezDs5VMfM3ub9/HcL1PNlcFz0TpSWXww7xER05xGu8/59y506C9AdnFOBwZBQXiEwMsKdocCdyRS49hxaJ8g8gFwFpKXhkJU5vFIuF0erou+VwXKnOpKwv4dK6KFrsh3HgE/SK23x9BXtnJ2SNcbkf+G0c5XTH0JqJTxBauhVsZe5j/EMDJWmluya0Tz2Fesi7aL72etoKob1A5W/97cvKSHY7bJ6z9jKRqL8TZ4NwlWBZUCT8HlRhDFxsaG2gAUiU+HabeutqfuLjWYfcCZyIyRPN3f8KpSp/eBHQYdGjfd8M6w8+YrcHqGjyJ+bcq9LF2oK8cwz3nbCTMsyIWNt2NkmG8UGrBd70uQQuJPiCbgPvdbZAmxT6ivIG0JDgmBYGjYpRfTXMqPxtHx1EXJc7+aVVAoGzik94GSmaCkAeteqvnwAUPBpryJLJVr03ZrUTsWSHUe3ngOA4L1QU0J03k+TeQpE7iHz009pOGDulsJ0uO"
            ),
            "findingApiVersion" => "1.12.0",
            "tradingApiVersion" => "871",
            "shoppingApiVersion" => "871",
            "halfFindingApiVersion" => "1.2.0"
        );

        $quantity = (int)$_POST["quantity"];
        $start_price = (float)$_POST["start_price"];
        $best_offer = (float)$_POST["best_offer"];
        $auto_accept = (float)$_POST["auto_accept"];
        $min_offer = (float)$_POST["min_offer"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $country = $_POST["country"];
        $city = $_POST["city"];
        $zip = $_POST["zip"];
        $currency = $_POST["currency"];
        $category = (int)$_POST["category"];
        $condition = (int)$_POST["condition"];
        $domestic_shipping = $_POST["domestic_shipping"];
        $international_shipping = $_POST["international_shipping"];


        /**
         * Initiate the eBay service
         */
        $service = new Services\TradingService(array(
            "apiVersion" => $config["tradingApiVersion"],
            "sandbox" => true,
            "siteId" => Constants\SiteIds::US
        ));
        /**
         * Create the request object.
         */
        $request = new Types\AddFixedPriceItemRequestType();
        /**
         * An user token is required when using the Trading service.
         */
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $config["sandbox"]["userToken"];
        /**
         * Begin creating the fixed price item.
         */
        $item = new Types\ItemType();
        /**
         * We want a multiple quantity fixed price listing.
         */
        $item->ListingType = Enums\ListingTypeCodeType::C_FIXED_PRICE_ITEM;
        $item->Quantity = $quantity;
        /**
         * Let the listing be automatically renewed every 30 days until cancelled.
         */
        $item->ListingDuration = Enums\ListingDurationCodeType::C_GTC;
        /**
         * The cost of the item is $start_price.
         * Note that we don"t have to specify a currency as eBay will use the site id
         * that we provided earlier to determine that it will be United States Dollars (USD).
         */
        $item->StartPrice = new Types\AmountType(array("value" => $start_price));
        /**
         * Allow buyers to submit a best offer.
         */
        $item->BestOfferDetails = new Types\BestOfferDetailsType();
        if($best_offer == "true"){
            $item->BestOfferDetails->BestOfferEnabled = true;
        } else{
            $item->BestOfferDetails->BestOfferEnabled = false;
        }
        /**
         * Automatically accept best offers of $auto_accept and decline offers lower than $min_offer.
         */
        $item->ListingDetails = new Types\ListingDetailsType();
        $item->ListingDetails->BestOfferAutoAcceptPrice = new Types\AmountType(array("value" => $auto_accept));
        $item->ListingDetails->MinimumBestOfferPrice = new Types\AmountType(array("value" => $min_offer));
        /**
         * Provide a title and description and other information such as the item"s location.
         * Note that any HTML in the title or description must be converted to HTML entities.
         */
        $item->Title = $title;
        $item->Description = $description;
        $item->SKU = "ABC-001";
        $item->Country = "US";
        if($city === "sfo"){
            $item->Location = "San Francisco";
        } elseif($city === "dal"){
            $item->Location = "Dallas";
        } elseif($city === "orl"){
            $item->Location = "Orlando";
        }
        $item->PostalCode = $zip;
        /**
         * This is a required field.
         */
        $item->Currency = $currency;
        /**
         * Display a picture with the item.
         */
        $item->PictureDetails = new Types\PictureDetailsType();
        $item->PictureDetails->GalleryType = Enums\GalleryTypeCodeType::C_GALLERY;
        $item->PictureDetails->PictureURL = array("http://www.nndb.com/people/537/000024465/murray-mmnet_c0d7b094518e.jpg");
        /**
         * List item in the Books > Audiobooks (29792) category.
         */
        $item->PrimaryCategory = new Types\CategoryType();
        $item->PrimaryCategory->CategoryID = "29792";
        /**
         * Tell buyers what condition the item is in.
         * For the category that we are listing in the value of 1000 is for Brand New.
         */
        $item->ConditionID = $condition;
        /**
         * Buyers can use one of two payment methods when purchasing the item.
         * Visa / Master Card
         * PayPal
         * The item will be dispatched within 1 business days once payment has cleared.
         * Note that you have to provide the PayPal account that the seller will use.
         * This is because a seller may have more than one PayPal account.
         */
        $item->PaymentMethods = array(
            "VisaMC",
            "PayPal"
        );
        $item->PayPalEmailAddress = "aldog212@gmail.com";
        $item->DispatchTimeMax = 1;
        /**
         * Setting up the shipping details.
         * We will use a Flat shipping rate for both domestic and international.
         */
        $item->ShippingDetails = new Types\ShippingDetailsType();
        $item->ShippingDetails->ShippingType = Enums\ShippingTypeCodeType::C_FLAT;
        /**
         * Create our first domestic shipping option.
         * Offer the Economy Shipping (1-10 business days) service at $2.00 for the first item.
         * Additional items will be shipped at $1.00.
         */
        $shippingService = new Types\ShippingServiceOptionsType();
        $shippingService->ShippingServicePriority = 1;
        $shippingService->ShippingService = "Other";
        $shippingService->ShippingServiceCost = new Types\AmountType(array("value" => 2.00));
        $shippingService->ShippingServiceAdditionalCost = new Types\AmountType(array("value" => 1.00));
        $item->ShippingDetails->ShippingServiceOptions[] = $shippingService;
        /**
         * Create our second domestic shipping option.
         * Offer the USPS Parcel Select (2-9 business days) at $3.00 for the first item.
         * Additional items will be shipped at $2.00.
         */
        $shippingService = new Types\ShippingServiceOptionsType();
        $shippingService->ShippingServicePriority = 2;
        $shippingService->ShippingService = "USPSParcel";
        $shippingService->ShippingServiceCost = new Types\AmountType(array("value" => 3.00));
        $shippingService->ShippingServiceAdditionalCost = new Types\AmountType(array("value" => 2.00));
        $item->ShippingDetails->ShippingServiceOptions[] = $shippingService;
        /**
         * Create our first international shipping option.
         * Offer the USPS First Class Mail International service at $4.00 for the first item.
         * Additional items will be shipped at $3.00.
         * The item can be shipped Worldwide with this service.
         */
        $shippingService = new Types\InternationalShippingServiceOptionsType();
        $shippingService->ShippingServicePriority = 1;
        $shippingService->ShippingService = "USPSFirstClassMailInternational";
        $shippingService->ShippingServiceCost = new Types\AmountType(array("value" => 4.00));
        $shippingService->ShippingServiceAdditionalCost = new Types\AmountType(array("value" => 3.00));
        $shippingService->ShipToLocation = array("WorldWide");
        $item->ShippingDetails->InternationalShippingServiceOption[] = $shippingService;
        /**
         * Create our second international shipping option.
         * Offer the USPS Priority Mail International (6-10 business days) service at $5.00 for the first item.
         * Additional items will be shipped at $4.00.
         * The item will only be shipped to the following locations with this service.
         * N. and S. America
         * Canada
         * Australia
         * Europe
         * Japan
         */
        $shippingService = new Types\InternationalShippingServiceOptionsType();
        $shippingService->ShippingServicePriority = 2;
        $shippingService->ShippingService = "USPSPriorityMailInternational";
        $shippingService->ShippingServiceCost = new Types\AmountType(array("value" => 5.00));
        $shippingService->ShippingServiceAdditionalCost = new Types\AmountType(array("value" => 4.00));
        $shippingService->ShipToLocation = array(
            "Americas",
            "CA",
            "AU",
            "Europe",
            "JP"
        );
        $item->ShippingDetails->InternationalShippingServiceOption[] = $shippingService;
        /**
         * The return policy.
         * Returns are accepted.
         * A refund will be given as money back.
         * The buyer will have 14 days in which to contact the seller after receiving the item.
         * The buyer will pay the return shipping cost.
         */
        $item->ReturnPolicy = new Types\ReturnPolicyType();
        $item->ReturnPolicy->ReturnsAcceptedOption = "ReturnsAccepted";
        $item->ReturnPolicy->RefundOption = "MoneyBack";
        $item->ReturnPolicy->ReturnsWithinOption = "Days_14";
        $item->ReturnPolicy->ShippingCostPaidByOption = "Buyer";
        /**
         * Finish the request object.
         */
        $request->Item = $item;
        /**
         * Send the request to the AddFixedPriceItem service operation.
         */
        $response = $service->addFixedPriceItem($request);
        /**
         * Output the result of calling the service operation.
         */
        if ($response->Ack !== "Failure") {
            $item_id = $response->ItemID;
        }



        /**
         * Craigslist Service
         */


         $postdata = "<?xml version=\"1.0\" encoding=\"utf-8\"?>

         <rdf:RDF xmlns=\"http://purl.org/rss/1.0/\"
         xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"
         xmlns:cl=\"http://www.craigslist.org/about/cl-bulk-ns/1.0\">

             <channel>
                <items>
                    <rdf:li rdf:resource=\"TestSample1\"/>
                </items>

                <cl:auth username=\"EMAILADDRESS\"
                         password=\"XXXXXXXX\"
                         accountID=\"1\"/>

             </channel>
             <item rdf:about=\"TestSample1\">
                <cl:category>tid</cl:category>
                <cl:area>$city</cl:area>
                <cl:replyEmail privacy=\"C\">aldog212@gmail.com</cl:replyEmail>
                <title>$title</title>
                <description><![CDATA[$description]]></description>
                <cl:image>http://www.fillmurray.com/200/200</cl:image>
            </item>

        </rdf:RDF>";


        $cc = new cURL();
        $url = "https://post.craigslist.org/bulk-rss/post";
        //$output = $cc->post($url,$postdata);


        return $this->render("post/post.html.twig", array(
            "base_dir" => realpath($this->container->getParameter("kernel.root_dir")."/.."),
            "id" => $item_id
        ));

    }
}
