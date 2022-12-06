<?php       
    // Used for composer based installation
    //require __DIR__  . '/vendor/autoload.php';
    // Use below for direct download installation
    // require __DIR__  . '/PayMaya-PHP-SDK/autoload.php';

    require __DIR__  . '/paymayaSDK/sample/autoload.php';

    use PayMaya\PayMayaSDK;
    use PayMaya\Core\HTTPConfig;
    use PayMaya\Core\HTTPConnection;
    use PayMaya\Core\Constants;
    use PayMaya\API\Checkout;
    use PayMaya\Model\Checkout\Buyer;
    use PayMaya\Model\Checkout\Address;
    use PayMaya\Model\Checkout\Contact;
    use PayMaya\Model\Checkout\ItemAmountDetails;
    use PayMaya\Model\Checkout\ItemAmount;
    use PayMaya\Model\Checkout\Item;

    PayMayaSDK::getInstance()->initCheckout("pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah", "sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl", "SANDBOX");

    class User {
        private $firstName;
        private $middleName;
        private $lastName;
        private $contact;
        private $shippingAddress;
        private $billingAddress;

        public function __construct() {
            $this->firstName = "John";
            $this->middleName = "Michaels";
            $this->lastName = "Doe";

            // Contact
            $this->contact = new Contact();
            $this->contact->phone = "+63(2)1234567890";
            $this->contact->email = "paymayabuyer1@gmail.com";

            // Address
            $address = new Address();
            $address->line1 = "9F Robinsons Cybergate 3";
            $address->line2 = "Pioneer Street";
            $address->city = "Mandaluyong City";
            $address->state = "Metro Manila";
            $address->zipCode = "12345";
            $address->countryCode = "PH";
            $this->shippingAddress = $address;
            $this->billingAddress = $address;
        }
        
        public function buyerInfo() {
            $buyer = new Buyer();
            $buyer->firstName = $this->firstName;
            $buyer->middleName = $this->middleName;
            $buyer->lastName = $this->lastName;
            $buyer->contact = $this->contact;
            $buyer->shippingAddress = $this->shippingAddress;
            $buyer->billingAddress = $this->billingAddress;
            return $buyer;
        }
    }

    // Checkout
    $itemCheckout = new Checkout();
    $user = new User();
    $itemCheckout->buyer = $user->buyerInfo();

    // Item
    $itemAmountDetails = new ItemAmountDetails();
    $itemAmountDetails->shippingFee = "14.00";
    $itemAmountDetails->tax = "5.00";
    $itemAmountDetails->subtotal = "50.00";
    $itemAmount = new ItemAmount();
    $itemAmount->currency = "PHP";
    $itemAmount->value = "69.00";
    $itemAmount->details = $itemAmountDetails;
    $item = new Item();
    $item->name = "Leather Belt";
    $item->code = "pm_belt";
    $item->description = "Medium-sized belt made from authentic leather";
    $item->quantity = "1";
    $item->amount = $itemAmount;
    $item->totalAmount = $itemAmount;

    $itemCheckout->items = array($item);
    $itemCheckout->totalAmount = $itemAmount;
    $itemCheckout->requestReferenceNumber = "123456789";
    $itemCheckout->redirectUrl = array(
        "success" => "https://shop.com/success",
        "failure" => "https://shop.com/failure",
        "cancel" => "https://shop.com/cancel"
        );

    print_r(json_encode($itemCheckout));
?>