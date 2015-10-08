<?php

/**
 * The Configuration class aims to manage all the operations regarding to the configuration file
 * @author andrew@itma.pl
 **/
class Configuration {

    /**
    * Creates a config file
    * @param $data array
    * @return true if created otherwise array containing errors
    **/
    public function create(array $configuration) {
        // An array to storage the errors that may happen during the process
        $errors = array();
        // the local storage for configuration
        $dbFile = __DIR__ . '/../db/config.php';
        if (!file_exists($dbFile)) {

            // check the required fields are filled
            if (empty($configuration['websiteForm']['name'])) {
                $errors[] = 'Fill the "Website name" field.';
            }
            if (empty($configuration['websiteForm']['url'])) {
                $errors[] = 'Fill the "Url" field.';
            }
            if (empty($configuration['websiteForm']['owner'])) {
                $errors[] = 'Fill the "Owner\'s name" field.';
            }
            if (empty($configuration['websiteForm']['email'])) {
                $errors[] = 'Fill the "Owner\'s email" field.';
            }
            if (empty($configuration['smtpForm']['host'])) {
                $errors[] = 'Fill the "(smtp) Host" field.';
            }
            if (empty($configuration['smtpForm']['user'])) {
                $errors[] = 'Fill the "(smtp) User" field.';
            }
            if (empty($configuration['smtpForm']['password'])) {
                $errors[] = 'Fill the "(smtp) Password" field.';
            }
            if (empty($configuration['smtpForm']['port'])) {
                $errors[] = 'Fill the "(smtp) Port" field.';
            }
            if (empty($configuration['smtpForm']['name'])) {
                $errors[] = 'Fill the "(smtp) Name" field.';
            }
            if (empty($configuration['smtpForm']['email'])) {
                $errors[] = 'Fill the "(smtp) Email" field.';
            }

            $template = $this->prepareConfigurationTemplate($configuration);

            if (count($errors) == 0) {
                return file_put_contents($dbFile, $template);                
            } else {
                return $errors;
            }
        }
    }

    /**
    * Prepares the configuration to write into the file
    * @param $configuration array
    * @return string
    **/
    public function prepareConfigurationTemplate($configuration) {
        // 
        $template = "<?php
            // An array to storage the website configuration.
            // Generated " . date('Y/m/d H:i:s') . "
            ";
            
            $template .= "return array(
                'site_url' => '".$configuration['websiteForm']['url']."',
                'site_language' => '".$configuration['websiteForm']['language']."',
                'site_name' => '".$configuration['websiteForm']['name']."',
                'smtp_user' => '".$configuration['smtpForm']['user']."',
                'smtp_password' => '".$configuration['smtpForm']['password']."',
                'smtp_port' => '".$configuration['smtpForm']['port']."',
                'smtp_host' => '".$configuration['smtpForm']['host']."',
                'smtp_email' => '".$configuration['smtpForm']['email']."',
                'smtp_from' => '".$configuration['smtpForm']['name']."',
                'owner_name' => '".$configuration['websiteForm']['owner']."',
                'owner_email' => '".$configuration['websiteForm']['email']."'
            );";
        return $template;
    }
}

?>