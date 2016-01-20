<?php

namespace Acme\Bundle\ResourceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeResourceBundle extends Bundle
{
  // Bundle driver list.
  const DRIVER_DOCTRINE_ORM         = 'doctrine/orm';
  const DRIVER_DOCTRINE_MONGODB_ODM = 'doctrine/mongodb-odm';
  const DRIVER_DOCTRINE_PHPCR_ODM   = 'doctrine/phpcr-odm';
}
