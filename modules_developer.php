<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Modules_Developer extends Module
{
    public function __construct()
    {
        $this->name = 'modules_developer';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'cartorse';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Modules Developer');
        $this->description = $this->l('Manage and view modules by developer');
        $this->ps_versions_compliancy = ['min' => '9.0.0', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        Configuration::deleteByName('MODULES_DEVELOPER_AUTHOR_NAME');

        return parent::uninstall();
    }

    public function getContent()
    {
        $output = '';

        if (Tools::isSubmit('submit_config')) {
            $authorName = Tools::getValue('author_name');
            Configuration::updateValue('MODULES_DEVELOPER_AUTHOR_NAME', $authorName);
            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }

        $authorName = Configuration::get('MODULES_DEVELOPER_AUTHOR_NAME');
        $modules = $authorName ? $this->getModulesByAuthor($authorName) : array();

        $this->context->smarty->assign(array(
            'modules'     => $modules,
            'author_name' => $authorName,
            'config_form' => $this->renderConfigForm(),
        ));

        return $output . $this->display(__FILE__, 'views/templates/admin/developer_modules.tpl');
    }

    private function renderConfigForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array('title' => $this->l('Developer Settings')),
                'input'  => array(
                    array(
                        'type'     => 'text',
                        'label'    => $this->l('Author Name'),
                        'name'     => 'author_name',
                        'required' => true,
                        'desc'     => $this->l('Filter modules by this author name'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-primary',
                ),
            ),
        );

        $helper                = new HelperForm();
        $helper->module        = $this;
        $helper->submit_action = 'submit_config';
        $helper->fields_value['author_name'] = Configuration::get('MODULES_DEVELOPER_AUTHOR_NAME');

        return $helper->generateForm(array($fields_form));
    }

    private function getModulesByAuthor($authorName)
    {
        $modules     = array();
        $modulesPath = _PS_MODULE_DIR_;

        if (!is_dir($modulesPath)) {
            return $modules;
        }

        $folders = scandir($modulesPath);

        foreach ($folders as $folder) {
            if ($folder === '.' || $folder === '..' || !is_dir($modulesPath . $folder)) {
                continue;
            }

            $configFile = $modulesPath . $folder . '/config.xml';
            if (!file_exists($configFile)) {
                continue;
            }

            $xml = @simplexml_load_file($configFile);
            if (!$xml) {
                continue;
            }

            $author = (string) $xml->author;
            if (stripos($author, $authorName) === false) {
                continue;
            }

            $modules[] = array(
                'name'         => $folder,
                'displayName'  => (string) $xml->displayName,
                'version'      => (string) $xml->version,
                'description'  => (string) $xml->description,
                'author'       => $author,
                'is_installed' => Module::isInstalled($folder),
            );
        }

        usort($modules, array($this, 'sortByDisplayName'));

        return $modules;
    }

    public function sortByDisplayName($a, $b)
    {
        return strcmp($a['displayName'], $b['displayName']);
    }
}
