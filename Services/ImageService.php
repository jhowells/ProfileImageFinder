<?php

// This class uses the FullContact API get retrive a JSON string which is then converted into an array in which
// data is located. All we're interested in here is the photo, presumably the one set as primary, but further
// enhancements could be made to display multiple pictures.

Class ImageService {
/**
 * @var $apiKey = the API key that is stored as an environment variable
 * @url $url = the endpoint we're interested in
 * @status $status = status code to check for success or failure
 * @obj $obj = decoded JSON string
 */
    var $apiKey;
    var $url;
    var $status;
    var $obj;

    /**
     * @param $email_address
     * @return bool or string
     *
     * Do a simple lookup by using file_get_contents and then decode the json so we can find the info we're looking for.
     *
     * There are likely multiple pictures, but let's just concentrate on the primary photo. Later, we could return an
     * array of photos and ask the user to pick which avatar to display (LinkedIn, Google, Facebook, etc.
     */
    public function lookupByEmail($email_address)
    {
        // Get the API Key from an environment variable. Methods of storing environment variables vary from platform to
        // platform. In my case I use MAMP on a Mac, so the variable is stored in /Applications/MAMP/Library/bin/envvars

        $this->apiKey = getenv('FULL_CONTACT_APIKEY');
        $this->url = 'https://api.fullcontact.com/v2/person.json?apiKey=' . $this->apiKey . '&email=' . $email_address;
        $result = file_get_contents($this->url);
        $this->obj = json_decode($result,true);

        $this->status = $this->getStatusCode($this->obj);
        if ($this->status != '200)') {
            return false;
        }

        foreach ($this->obj as $key => $value) {
            if ($key == 'photos') {
                foreach ($value as $key => $v) {
                    // let's just get the primary url if there are multiples
                    if ($v['isPrimary']) {
                        // cache the results to avoid unnecessary lookups
                        $_SESSION[$email_address] = $v['url'];
                        return $v['url'];
                    }
                }
            }
        }
    }

    /**
     * @param $obj
     * @return mixed
     *
     * Get the status code from the object and return
     */
    public function getStatusCode($obj)
    {
        foreach ($obj as $key => $value) {
            if ($key == 'status') {
                return $value;
            }
        }
    }

}



