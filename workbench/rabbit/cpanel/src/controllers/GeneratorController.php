<?php namespace Rabbit\Cpanel;


class GeneratorController extends BaseController
{

    public function getBench()
    {
        return \View::make('cpanel::generator.bench');
    }

    public function postBench()
    {
        $bench = \Input::get('bench');
        $benchUcwords = ucwords(str_replace('_', ' ', $bench));
        $package = \Input::get('package');
        $packageUcwords = ucwords(str_replace('_', ' ', $package));
        $namespace = \UString::toPascalCase($bench) . '\\' . \UString::toPascalCase($package);

        $path = base_path('workbench\\' . $bench . '\\' . $package . '\src');

        // Run workbench
        \Artisan::call('workbench', ['package' => $bench . '/' . $package, '--resources' => true]);

        // Gen view home
        $viewDirectory = $path . '\views\home';
        \File::makeDirectory($viewDirectory);
        $viewHome = $viewDirectory . '\index.blade.php';
        $tmpViewHome = \File::get(\Config::get('cpanel::path.template.bench.view_home'));
        \File::put($viewHome, $tmpViewHome);

        // Gen home controller
        $controllerDirectory = $path . '\controllers';
        $controllerFile = $controllerDirectory . '\HomeController.php';
        $tmpController = \File::get(\Config::get('cpanel::path.template.bench.home_controller'));
        $contentController = str_replace(
            ['$NAMESPACE$', '$PACKAGE_UC_WORDS$', '$PACKAGE$'],
            [$namespace, $packageUcwords, $package],
            $tmpController
        );
        \File::put($controllerFile, $contentController);

        // Gen route
        $routesFile = $path . '\routes.php';
        $tmpRoutes = \File::get(\Config::get('cpanel::path.template.bench.route'));
        $contentRoutes = str_replace(
            ['$NAMESPACE$', '$PACKAGE$'],
            [$namespace, $package],
            $tmpRoutes
        );
        \File::put($routesFile, $contentRoutes);

        // Gen breadcrumb
        $breadcrumbsFile = $path . '\breadcrumbs.php';
        $tmpBreadcrumbs = \File::get(\Config::get('cpanel::path.template.bench.breadcrumb'));
        $contentBreadcrumbs = str_replace(
            ['$PACKAGE$'],
            [$package],
            $tmpBreadcrumbs
        );
        \File::put($breadcrumbsFile, $contentBreadcrumbs);

        // Gen menu
        $menuFile = $path . '\config\menu.php';
        $tmpMenu = \File::get(\Config::get('cpanel::path.template.bench.menu'));
        $contentMenu = str_replace(
            ['$PACKAGE$'],
            [$package],
            $tmpMenu
        );
        \File::put($menuFile, $contentMenu);

        // Gen permission
        $permissionFile = $path . '\config\permission.php';
        $tmpPermission = \File::get(\Config::get('cpanel::path.template.bench.permission'));
        \File::put($permissionFile, $tmpPermission);

        // Gen empty directory
        $emptyDirectory = $path . '\\' . $benchUcwords . '\\' . $packageUcwords;
        \File::makeDirectory($path . '\models');
        \File::makeDirectory($emptyDirectory . '\Requests');
        \File::makeDirectory($emptyDirectory . '\Libraries');
        \File::makeDirectory($emptyDirectory . '\Facades');

        \File::put($path . '\models\.gitkeep', '');
        \File::put($emptyDirectory . '\Requests\.gitkeep', '');

        \File::put($emptyDirectory . '\Libraries\.gitkeep', '');
        $getPackageList = \File::get(\Config::get('cpanel::path.template.bench.package_list'));
        $contentPackageList = str_replace(
            ['$NAMESPACE$', '$PACKAGE_UC_WORDS$'],
            [$namespace, $packageUcwords],
            $getPackageList
        );
        \File::put($emptyDirectory . '\Libraries\\'.$packageUcwords.'List.php', $contentPackageList);

        \File::put($emptyDirectory . '\Facades\.gitkeep', '');
        $getFacadeList = \File::get(\Config::get('cpanel::path.template.bench.facade_list'));
        $contentFacadeList = str_replace(
            ['$NAMESPACE$', '$PACKAGE_UC_WORDS$', '$PACKAGE$'],
            [$namespace, $packageUcwords, $package],
            $getFacadeList
        );
        \File::put($emptyDirectory . '\Facades\\'.$packageUcwords.'List.php', $contentFacadeList);

        // Autoload controllers and models directory on composer.json
        $tmpautoloadComposer = \File::get(\Config::get('cpanel::path.template.bench.composer'));
        $autoloadComposerFile = base_path('workbench\\' . $bench . '\\' . $package . '\composer.json');
        $getAutoloadComposerFile = \File::get($autoloadComposerFile);
        $contentAutoloadComposerFile = str_replace(
            ['"src/migrations"'],
            [$tmpautoloadComposer],
            $getAutoloadComposerFile
        );
        \File::put($autoloadComposerFile, $contentAutoloadComposerFile);

        // Config package in rabbit/cpanel
        $tmpPackageConfig = \File::get(\Config::get('cpanel::path.template.bench.package_config'));
        $contentPackageConfig = str_replace(
            ['$PACKAGE$', '$PACKAGE_UC_WORDS$'],
            [$package, $packageUcwords],
            $tmpPackageConfig
        );
        $packageConfigFile = base_path('workbench\rabbit\cpanel\src\config\package.php');
        $getPackageConfigFile = \File::get($packageConfigFile);
        $contentGetPackageConfig = str_replace(
            ['/*** $PACKAGE_CONFIG$ ***/'],
            [$contentPackageConfig],
            $getPackageConfigFile
        );
        \File::put($packageConfigFile, $contentGetPackageConfig);


        // Include routes.php to service provider boot
        $tmpBootServiceProvider = \File::get(\Config::get('cpanel::path.template.bench.service_provider_boot'));
        $contentBootServiceProvider = str_replace(
            ['$BENCH$', '$PACKAGE$'],
            [$bench, $package],
            $tmpBootServiceProvider
        );
        // Include library list to service provider register
        $tmpRegisterServiceProvider = \File::get(\Config::get('cpanel::path.template.bench.service_provider_register'));
        $contentRegisterServiceProvider = str_replace(
            ['$NAMESPACE$', '$PACKAGE$', '$PACKAGE_UC_WORDS$'],
            [$namespace, $package, $packageUcwords],
            $tmpRegisterServiceProvider
        );
        // Include use library to service provider
        $tmpUseServiceProvider = \File::get(\Config::get('cpanel::path.template.bench.service_provider_use'));
        $contentUseServiceProvider = str_replace(
            ['$NAMESPACE$', '$PACKAGE_UC_WORDS$'],
            [$namespace, $packageUcwords],
            $tmpUseServiceProvider
        );

        $serviceProviderFile = $emptyDirectory . '\\' . $packageUcwords . 'ServiceProvider.php';
        $getServiceProviderFile = \File::get($serviceProviderFile);
        $boot = "\$this->package('" . $bench . "/" . $package . "');";
        $register = '	public function register()
	{
		//
	}
';
        $use = 'namespace '.$namespace.';';
        $contentGetServiceProvider = str_replace(
            [$boot, $register, $use],
            [$contentBootServiceProvider, $contentRegisterServiceProvider, $contentUseServiceProvider],
            $getServiceProviderFile
        );
        \File::put($serviceProviderFile, $contentGetServiceProvider);


        // Run php artisan dump-autoload
        \Artisan::call('dump-autoload');

        return \Redirect::back()->with('msg', 'Workbench generate successful.');
    }

    /**
     * Show the form scaffold
     *
     * @return Response
     */
    public function getScaffold()
    {

        $data['types'] = [
            "bigIncrements(':field_name')" => "bigIncrements('id')",
            "bigInteger(':field_name')" => "bigInteger('votes')",
            "binary(':field_name')" => "binary('data')",
            "boolean(':field_name')" => "boolean('confirmed')",
            "char(':field_name', :length)" => "char('name', 4)",
            "date(':field_name')" => "date('created_at')",
            "dateTime(':field_name')" => "dateTime('created_at')",
            "decimal(':field_name', :length, :decimal)" => "decimal('amount', 5, 2)",
            "double(':field_name', :length, :decimal)" => "double('column', 15, 8)",
            "enum(':field_name', array('foo', 'bar'))" => "enum('choices', array('foo', 'bar'))",
            "float(':field_name')" => "float('amount')",
            "increments(':field_name')" => "increments('id')",
            "integer(':field_name')" => "integer('votes')",
            "longText(':field_name')" => "longText('description')",
            "mediumInteger(':field_name')" => "mediumInteger('numbers')",
            "mediumText(':field_name')" => "mediumText('description')",
//            "morphs(':field_name')" => "morphs('taggable')",
//            "nullableTimestamps()" => "nullableTimestamps()",
            "smallInteger(':field_name')" => "smallInteger('votes')",
            "tinyInteger(':field_name')" => "tinyInteger('numbers')",
//            "softDeletes()" => "softDeletes()",
//            "string('email')" => "string('email')",
            "string(':field_name', :length)" => "string('name', 255)",
            "text(':field_name')" => "text('description')",
            "time(':field_name')" => "time('sunrise')",
            "timestamp(':field_name')" => "timestamp('added_on')",
//            "timestamps()" => "timestamps()",
//            "rememberToken()" => "rememberToken()",
        ];
        $data['form_object'] = [
            'text' => 'text',
            'textarea' => 'textarea',
            'number' => 'number',
            'select' => 'select',
            'multiple_select' => 'multiple select',
            'date_picker' => 'date',
            'datetime_picker' => 'datetime',
            'time_picker' => 'time',
            'dateform_picker' => 'date form',
            'dateto_picker' => 'date to',
        ];

        return \View::make('cpanel::generator.scaffold', $data);
    }

    /**
     * Store a newly created scaffold
     *
     * @return Response
     */
    public function postScaffold()
    {
//        return var_dump(\Input::get('field'));

        $data = new \stdClass();
        $data->vendor = \Input::get('vendor');
        $data->package = \Input::get('package');
        $data->resourcePrefix = \Input::get('resource_prefix');
        $data->resource = \Input::get('resource');

        $data->path = base_path('workbench\\' . $data->vendor . '\\' . $data->package . '\src');
        $data->namespace = \UString::toPascalCase($data->vendor) . '\\' . \UString::toPascalCase($data->package);
        $data->resourcePascalCase = \UString::toPascalCase($data->resource);
        $data->resourceCamelCase = \UString::toCamelCase($data->resource);
        $data->resourceTitle = ucwords(str_replace('_', ' ', $data->resource));

        $data->resourceRoute = $data->package . '.' . $data->resource;
        $data->resourceDataTableRoute = $data->package . '.datatable.' . $data->resource;
        $data->resourceValidatorRoute = $data->package . '.validator.' . $data->resource;
        $data->resourceView = $data->package . '::' . $data->resource;
        $data->modelName = $data->resourcePascalCase . 'Model';
        $data->controllerName = $data->resourcePascalCase . 'Controller';
        $data->requestName = $data->resourcePascalCase . 'Request';
        $data->viewDirectory = $data->path . '\views\\' . $data->resource;
        if (!\File::exists($data->viewDirectory)) {
            \File::makeDirectory($data->viewDirectory);
        }

        // Fields property
        $prop = new \stdClass();
        $prop->field = \Input::get('field');
        $prop->type = \Input::get('type');
        $prop->length = \Input::get('length');
        $prop->decimal = \Input::get('decimal');
        $prop->nullable = \Input::get('nullable');
        $prop->default = \Input::get('default');
        $prop->unsigned = \Input::get('unsigned');
        $prop->show = \Input::get('show');
        $prop->rule = \Input::get('rule');
        $prop->form_object = \Input::get('form_object');

//        var_dump($prop->nullable);exit;

        // --------------------------------------------------------------------------

        // Create Migration
        $this->_genMigration($data, $prop);

        // Create model
        $this->_genModel($data, $prop);

        // Create request
        $this->_genRequest($data, $prop);

        // Create controller
        $this->_genController($data, $prop);

        // Create views
        $this->_genViews($data, $prop);

        // Create route
        $this->_genRoute($data);

        // Create breadcrumb
        $this->_genBreadcrumb($data);

        // Create menu
        $this->_genMenu($data);

        // Create permission
        $this->_genPermission($data);

        // Run php artisan dump-autoload
        \Artisan::call('dump-autoload');
//        \Artisan::call('migrate', array('--bench' => $data->vendor . ' / ' . $data->package));

        return \Redirect::back()
            ->with('success', true)
            ->with('data', $data);
    }

    /**
     * Generate Model
     *
     * @param $data
     */
    private function _genModel($data)
    {
        $tmp = \File::get(\Config::get('cpanel::path.template.model'));
        $content = str_replace(
            ['$NAMESPACE$', '$MODEL_NAME$', '$TABLE_NAME$'],
            [$data->namespace, $data->modelName, $data->resourcePrefix . $data->resource],
            $tmp
        );
        $file = $data->path . '\models\\' . $data->modelName . '.php';
        \File::put($file, $content);
    }

    /**
     * Generate request
     *
     * @param $data
     */
    private function _genRequest($data, $prop)
    {
        $getFields = $this->_createField($data, $prop);
        $tmp = \File::get(\Config::get('cpanel::path.template.request'));
        $content = str_replace(
            ['$NAMESPACE$', '$REQUEST_NAME$', '$MODEL_NAME$', '$DATA_TABLE_FIELDS$', '$RESOURCE_ROUTE$'],
            [$data->namespace, $data->requestName, $data->modelName, $getFields['data_table_field'], $data->resourceRoute],
            $tmp
        );
        $file = $data->path . '\\' . $data->namespace . '\\Requests\\' . $data->requestName . '.php';
        \File::put($file, $content);
    }

    /**
     * Generate Views
     *
     * @param $data
     */
    private function _genViews($data, $prop)
    {
        $getFields = $this->_createField($data, $prop);
        // Index
        $viewIndexFile = $data->viewDirectory . '\index.blade.php';
        $tmpViewIndex = \File::get(\Config::get('cpanel::path.template.view_index'));
        $viewIndexContent = str_replace(
            ['$RESOURCE_ROUTE$', '$RESOURCE_DATATABLE_ROUTE$', '$DATA_TABLE_FIELDS_LABEL$'],
            [$data->resourceRoute, $data->resourceDataTableRoute, $getFields['data_table_field_label']],
            $tmpViewIndex
        );
        \File::put($viewIndexFile, $viewIndexContent);

        // Show
        $viewShowFile = $data->viewDirectory . '\show.blade.php';
        $tmpViewShow = \File::get(\Config::get('cpanel::path.template.view_show'));
        $viewShowContent = str_replace(
            ['$SHOW_FIELD$'],
            [$getFields['show_field']],
            $tmpViewShow
        );
        \File::put($viewShowFile, $viewShowContent);

        // Form
        $formObjectTab1 = '';
        $formObjectTab2 = '';
        $count = count($getFields['form_object']);
        foreach ($getFields['form_object'] as $key => $value) {
            if ($key < ceil($count / 2)) {
                $formObjectTab1 .= $value . "\t\t\t";
            } else {
                $formObjectTab2 .= $value . "\t\t\t";
            }
        }
        $viewCreateFile = $data->viewDirectory . '\form.blade.php';
        $tmpViewCreate = \File::get(\Config::get('cpanel::path.template.view_form'));
        $viewCreateContent = str_replace(
            ['$RESOURCE_VALIDATOR_ROUTE$', '$RESOURCE$', '$FORM_OBJECT_TAB1$', '$FORM_OBJECT_TAB2$'],
            [$data->resourceValidatorRoute, $data->resource, $formObjectTab1, $formObjectTab2],
            $tmpViewCreate
        );
        \File::put($viewCreateFile, $viewCreateContent);
    }

    /**
     * Generate Controller
     *
     * @param $data
     * @param $prop
     */
    private function _genController($data, $prop)
    {
        $getFields = $this->_createField($data, $prop);
        $saveData = str_replace('$RESOURCE_CAMEL_CASE$', $data->resourceCamelCase, $getFields['save_data']);
        $tmp = \File::get(\Config::get('cpanel::path.template.controller'));
        $content = str_replace(
            [
                '$NAMESPACE$',
                '$CONTROLLER_NAME$',
                '$RESOURCE$',
                '$RESOURCE_ROUTE$',
                '$RESOURCE_VIEW$',
                '$RESOURCE_CAMEL_CASE$',
                '$MODEL_NAME$',
                '$RESOURCE_SAVE_DATA$',
                '$REQUEST_NAME$'
            ],
            [
                $data->namespace,
                $data->controllerName,
                $data->resource,
                $data->resourceRoute,
                $data->resourceView,
                $data->resourceCamelCase,
                $data->modelName,
                $saveData,
                $data->requestName
            ],
            $tmp
        );
        $file = $data->path . '\controllers\\' . $data->controllerName . '.php';
        \File::put($file, $content);
    }

    /**
     * Generate Migration
     *
     * @param $data
     * @param $prop
     */
    private function _genMigration($data, $prop)
    {
        $schemaFields = $this->_createField($data, $prop)['schema_field'];

        // Generate Schema
        $tmpSchema = \File::get(\Config::get('cpanel::path.template.schema'));
        $schemaContent = str_replace(
            [
                '$TABLE$',
                '$FIELDS$'
            ],
            [
                $data->resourcePrefix . $data->resource,
                $schemaFields
            ],
            $tmpSchema
        );

        // Generate Migration
        $tmp = \File::get(\Config::get('cpanel::path.template.migration'));
        $content = str_replace(
            [
                '$CLASS$',
                '$UP$',
                '$TABLE$'
            ],
            [
                'Create' . $data->resourcePascalCase . 'Table',
                $schemaContent,
                $data->resourcePrefix . $data->resource
            ],
            $tmp
        );
        $file = $data->path . '\migrations\\' . date('Y_m_d_His') . '_create_' . $data->resource . '_table' . '.php';
        \File::put($file, $content);
    }

    /**
     * Generate breadcrumb
     *
     * @param $data
     */
    private function _genRoute($data)
    {
        // Route resource
        $tmpRoute = \File::get(\Config::get('cpanel::path.template.route'));
        $routeContent = str_replace(
            ['$RESOURCE$', '$CONTROLLER_NAME$', '$RESOURCE_TITLE$'],
            [$data->resource, $data->controllerName, $data->resourceTitle],
            $tmpRoute
        );
        // Route request
        $tmpRouteRequest = \File::get(\Config::get('cpanel::path.template.route_request'));
        $routeRequestContent = str_replace(
            ['$RESOURCE$', '$CONTROLLER_NAME$', '$RESOURCE_TITLE$', '$PACKAGE$'],
            [$data->resource, $data->controllerName, $data->resourceTitle, $data->package],
            $tmpRouteRequest
        );

        $file = $data->path . '\routes.php';
        $tmpOriginalRoute = \File::get($file);
        $content = str_replace(
            ['/*** $ROUTE_RESOURCE$ ***/', '/*** $ROUTE_REQUEST$ ***/'],
            [$routeContent . "\n\t/*** \$ROUTE_RESOURCE\$ ***/", $routeRequestContent . "\n\n\t/*** \$ROUTE_REQUEST\$ ***/"],
            $tmpOriginalRoute
        );

        \File::put($file, $content);
    }

    /**
     * Generate menu
     *
     * @param $data
     */
    private function _genMenu($data)
    {
        $tmpMenu = \File::get(\Config::get('cpanel::path.template.menu'));
        $menuContent = str_replace(
            ['$RESOURCE$', '$RESOURCE_TITLE$', '$PACKAGE$'],
            [$data->resource, $data->resourceTitle, $data->package],
            $tmpMenu
        );

        $file = $data->path . '\config\menu.php';
        $tmpOriginalMenu = \File::get($file);
        $content = str_replace(
            ['/*** $MENU$ ***/'],
            [$menuContent . "\n\t\t\t/*** \$MENU\$ ***/"],
            $tmpOriginalMenu
        );

        \File::put($file, $content);
    }

    /**
     * Generate permission
     *
     * @param $data
     */
    private function _genPermission($data)
    {
        $tmpPermission = \File::get(\Config::get('cpanel::path.template.permission'));
        $permissionContent = str_replace(
            ['$RESOURCE$', '$RESOURCE_TITLE$', '$PACKAGE$'],
            [$data->resource, $data->resourceTitle, $data->package],
            $tmpPermission
        );

        $file = $data->path . '\config\permission.php';
        $tmpOriginalPermission = \File::get($file);
        $content = str_replace(
            ['/*** $PERMISSION$ ***/'],
            [$permissionContent . "\n\t/*** \$PERMISSION\$ ***/"],
            $tmpOriginalPermission
        );

        \File::put($file, $content);
    }

    /**
     * Generate breadcrumb
     *
     * @param $data
     */
    private function _genBreadcrumb($data)
    {
        $tmp = \File::get(\Config::get('cpanel::path.template.breadcrumb'));
        $content = str_replace(
            ['$RESOURCE_ROUTE$', '$RESOURCE_TITLE$'],
            [$data->resourceRoute, $data->resourceTitle],
            $tmp
        );
        $file = $data->path . '\breadcrumbs.php';
//        $file = \Config::get('cpanel::path . store . breadcrumb');
        \File::append($file, $content);
    }

    private function _createField($data, $prop)
    {
        $dataReturn = array();
        $tmpField = '';
        $newLine = '';

        $tmpDataTableFieldLabel = '';
        $tmpDataTableField = '';
        $spaceDataTableField = '';

        $tmpRules = '';

        $tmpSaveData = '';

        $tmpFormObject = [];

        $tmpShowField = '';

        foreach ($prop->field as $keyField => $valField) {
            /**
             * Create schema files
             */
            $tmpField .= $newLine . '$table->' . str_replace(
                    [':field_name', ':length', ':decimal'],
                    [$valField, $prop->length[$keyField], $prop->decimal[$keyField]],
                    $prop->type[$keyField]
                );
            // Check nullable
            if (isset($prop->nullable[$keyField])) {
                $tmpField .= '->nullable()';
            }
            // Check default value
            if ($prop->default[$keyField]) {
                $tmpField .= '->default(' . $prop->default[$keyField] . ')';
            }
            // Check unsigned
            if (isset($prop->unsigned[$keyField])) {
                $tmpField .= '->unsigned()';
            }
            $tmpField .= ";";
            $newLine = "\n\t\t\t";

            /**
             * Create datatable fields
             */
            if (isset($prop->show[$keyField])) {
                $tmpDataTableFieldLabel .= $spaceDataTableField . "'" . ucwords(str_replace('_', ' ', $valField)) . "'";
                $tmpDataTableField .= $spaceDataTableField . "'" . $valField . "'";
                $spaceDataTableField = ', ';
            }

            /**
             * Create rules
             */
            if (!empty($prop->rule[$keyField])) {
                $tmpRules .= "'" . $valField . "' => '" . $prop->rule[$keyField] . "',\n\t\t\t";
            }

            /**
             * Save data on controller
             */
            // Check field name = 'id';
            if ($valField != 'id') {
                // Form object type
                switch ($prop->form_object[$keyField]) {
                    case 'multiple_select';
                        $tmpSaveData .= '$$RESOURCE_CAMEL_CASE$->' . $valField . ' = json_encode($inputs->' . $valField . ");\n\t\t";
                        break;
                    default:
                        $tmpSaveData .= '$$RESOURCE_CAMEL_CASE$->' . $valField . ' = $inputs->' . $valField . ";\n\t\t";
                }
            }

            /**
             * Form object on view
             */
            // Check field name = 'id';
            if ($valField != 'id') {

                // Form object type
                switch ($prop->form_object[$keyField]) {
                    case 'text':
                        $tmpFormObject[] = "{{ Former::text('" . $valField . "')->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'textarea':
                        $tmpFormObject[] = "{{ Former::textarea('" . $valField . "')->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'number':
                        $tmpFormObject[] = "{{ Former::number('" . $valField . "')->step(0.01)->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'select':
                        $tmpFormObject[] = "{{ Former::select('" . $valField . "')->options([])->select2()->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'multiple_select':
                        $tmpFormObject[] = "{{ Former::select('" . $valField . "[]')->multiple()->options([])->select2()->value(json_decode($" . $data->resource . "->" . $valField . "))" . " }}\n\t\t";
                        break;
                    case 'date_picker':
                        $tmpFormObject[] = "{{ Former::text('" . $valField . "')->date_picker()->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'datetime_picker':
                        $tmpFormObject[] = "{{ Former::text('" . $valField . "')->datetime_picker()->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'time_picker':
                        $tmpFormObject[] = "{{ Former::text('" . $valField . "')->time_picker()->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'dateform_picker':
                        $tmpFormObject[] = "{{ Former::text('" . $valField . "')->datefrom_picker()->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                    case 'dateto_picker':
                        $tmpFormObject[] = "{{ Former::text('" . $valField . "')->dateto_picker()->value($" . $data->resource . "->" . $valField . ")" . " }}\n\t\t";
                        break;
                }
            }

            /**
             * Create show data on view
             */
            $tmpShowField .= "<dt>" . ucwords(str_replace('_', ' ', $valField)) . "</dt>\n\t"
                . "<dd>{{ $" . $data->resource . "->" . $valField . " }}</dd>\n\t";

        }

        $dataReturn['schema_field'] = $tmpField;
        $dataReturn['data_table_field_label'] = $tmpDataTableFieldLabel;
        $dataReturn['data_table_field'] = $tmpDataTableField;
        $dataReturn['rules'] = $tmpRules;
        $dataReturn['save_data'] = $tmpSaveData;
        $dataReturn['form_object'] = $tmpFormObject;
        $dataReturn['show_field'] = $tmpShowField;

        return $dataReturn;
    }

}