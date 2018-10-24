#!/usr/bin/env bash
# Script de création de module (architecture de base).

if [ $1 ]
then
    sType=$1
fi
if [ $2 ]
then
    sNom=$2
    sClass="$(tr '[:lower:]' '[:upper:]' <<< ${sNom:0:1})${sNom:1}"
fi

# create module folder
mkdir "./${sType}s/${sNom}"
# create module folder
mkdir "./${sType}s/${sNom}/controller"
# create module folder
mkdir "./${sType}s/${sNom}/model"
# create module folder
mkdir "./${sType}s/${sNom}/view"
# create module folder
mkdir "./${sType}s/${sNom}/view/layout"
# create module folder
mkdir "./${sType}s/${sNom}/view/style"

# create module 
controller=$(cat <<EOF
<?php
namespace Modules\\${sClass}\Controller;
use Core\Controller\Dispatcher as Dispatcher;
use Core\Controller\View as View;

class ${sClass}Controller extends Dispatcher
{

    public function add(\$sModule, \$sAction = '')
    {
        var_dump('edit');
        
    }

    public function edit(\$sModule, \$sAction = '')
    {
        var_dump('edit');
        
    }

    public function update(\$sModule, \$sAction = '')
    {
        var_dump('update');
        
    }
}
EOF
)
echo "${controller}" > ./${sType}s/${sNom}/controller/${sClass}Controller.php

# create module 
model=$(cat <<EOF
<?php
namespace Modules\\${sClass}\Model;
use Core\Model\Model as Model;

class ${sClass}Model extends Model
{
    protected \$tableName = "${sNom}s";

    function __construct()
    {
        parent::__construct();
    }
}
EOF
)
echo "${model}" > ./${sType}s/${sNom}/model/${sClass}Model.php

# create module 
layout=$(cat <<EOF

EOF
)
echo "${layout}" > ./${sType}s/${sNom}/view/layout/${sNom}.html

# create module 
style=$(cat <<EOF

EOF
)
echo "${layout}" > ./${sType}s/${sNom}/view/style/style.css

echo "le $sType $sNom à été créé avec succès.";