<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;

use Tall\Orm\Models\AbstractModel as ModelsAbstractModel;
use Tall\Tenant\Concerns\UsesLandlordConnection;

abstract class AbstractModel extends ModelsAbstractModel
{
    use UsesLandlordConnection;
    
}