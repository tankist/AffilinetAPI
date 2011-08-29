//*
        $oClient = new SoapClient($this->_options['AccountWSDL']);

        $oClient->__setSoapHeaders(array(
            new SoapHeader(
                'http://www.google.com/api/adsense/v3',
                'developer_email',
                'mschulze@runashop.com'
            ),
            new SoapHeader(
                'http://www.google.com/api/adsense/v3',
                'developer_password',
                'dizzie'
            ),
        ));
        try {
            $oAcc = $oClient->associateAccount(array(
                'loginEmail'   => 'mschulze@runashop.com',
                'postalCode'   => '10115',
                'phone'        => '39853',
                'developerUrl' => 'http://www.runashop.com/'
            ));
        } catch (SoapFault $oFault) {
            echo '!!!!!!!!!!!!!';
            $oAcc = $oFault;
        }
$sRequest  = $oClient->__getLastRequest();
$sResponse = $oClient->__getLastResponse();
file_put_contents('E:/temp/soap_request.xml',  $sRequest);
file_put_contents('E:/temp/soap_response.xml', $sResponse);

return $oAcc;
/**/







